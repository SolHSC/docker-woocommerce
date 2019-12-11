/** @format **/

/**
 * External dependencies
 */
import { __ } from '@wordpress/i18n';
import { dateI18n } from '@wordpress/date';
import { Button } from '@wordpress/components';
import { Card } from '@woocommerce/components';
import { formatCurrency } from '@woocommerce/currency';
import moment from 'moment';
import { get } from 'lodash';

/**
 * Internal dependencies.
 */
import {
	isChargeRefunded,
	isChargePartiallyRefunded,
	isChargeFullyRefunded,
} from '../../utils/charge';
import PaymentStatusChip from '../../components/payment-status-chip';
import OrderLink from '../../components/order-link';
import PaymentMethodDetails from '../../components/payment-method-details';
import HorizontalList from '../../components/horizontal-list';
import './style.scss';

const PaymentDetailsSummary = ( props ) => {
	let { charge } = props;
	charge = charge || {};
	return (
		<Card className="payment-details-summary-details">
			<div className="payment-details-summary">
				<div className="payment-details-summary__section">
					<p className="payment-details-summary__amount">
						{ formatCurrency( ( charge.amount || 0 ) / 100 ) }
						<span className="payment-details-summary__amount-currency">{ ( charge.currency || 'cur' ) }</span>
						<PaymentStatusChip charge={ charge } />
					</p>
					<div className="payment-details-summary__breakdown">
						{ isChargeRefunded( charge )
							? <p>
								{ `${ __( 'Refunded', 'woocommerce-payments' ) }: ` }
								{ formatCurrency( -( charge.amount_refunded || 0 ) / 100 ) }
							</p>
							: '' }
						<p>
							{ `${ __( 'Fee', 'woocommerce-payments' ) }: ` }
							{ formatCurrency( ( -charge.fee || 0 ) / 100 ) }
						</p>
						<p>
							{ `${ __( 'Net', 'woocommerce-payments' ) }: ` }
							{ formatCurrency( ( charge.net || 0 ) / 100 ) }
						</p>
					</div>
				</div>
				<div className="payment-details-summary__section">
					{ /* TODO: implement control buttons depending on the transaction status */ }
					{ /* E.g. if transaction is under dispute display Accept Dispute and Respond to Dispute buttons */ }
					<div className="payment-details-summary__actions">
						<Button className="payment-details-summary__actions-item"
							isDefault
							isLarge
							disabled={ ! get( charge, 'order.url' ) ||	isChargeFullyRefunded( charge ) }
							href={ `${ get( charge, 'order.url' ) }#woocommerce-order-items` }>
							{ ( isChargePartiallyRefunded( charge ) )
								? __( 'Refund more', 'woocommerce-payments' )
								: __( 'Refund', 'woocommerce-payments' ) }
						</Button>
					</div>
				</div>
			</div>
			<hr className="full-width" />
			<HorizontalList items={ [
				{
					title: __( 'Date', 'woocommerce-payments' ),
					content: charge.created ? dateI18n( 'M j, Y, g:ia', moment( charge.created * 1000 ) ) : '–',
				},
				{
					title: __( 'Order No.', 'woocommerce-payments' ),
					content: <OrderLink order={ charge.order } />,
				},
				{
					title: __( 'Customer', 'woocommerce-payments' ),
					content: get( charge, 'billing_details.name' ) || '–',
				},
				{
					title: __( 'Payment Method', 'woocommerce-payments' ),
					content: <PaymentMethodDetails payment={ charge.payment_method_details } />,
				},
				{
					title: __( 'Risk Evaluation', 'woocommerce-payments' ),
					content: get( charge, 'outcome.risk_level' ) || '–',
				},
				{
					content: charge.id || '–',
				},
			] } />
		</Card>
	);
};

export default PaymentDetailsSummary;
