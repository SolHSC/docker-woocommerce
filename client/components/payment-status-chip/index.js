/** @format **/

/**
 * External dependencies
 */
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies.
 */
import { getChargeStatus } from '../../utils/charge';
import Chip from '../chip';

/* TODO: implement other payment statuses */
/* TODO: implement support for different dispute messages - check https://stripe.com/docs/api/disputes/object */
const statuses = {
	'partially-refunded': {
		type: 'light',
		message: __( 'Partially Refunded', 'woocommerce-payments' ),
	},
	'fully-refunded': {
		type: 'light',
		message: __( 'Fully Refunded', 'woocommerce-payments' ),
	},
	paid: {
		type: 'light',
		message: __( 'Paid', 'woocommerce-payments' ),
	},
	authorized: {
		type: 'primary',
		message: __( 'Payment Authorized', 'woocommerce-payments' ),
	},
	failed: {
		type: 'alert',
		message: __( 'Blocked', 'woocommerce-payments' ),
	},
	disputed: {
		type: 'primary',
		message: __( 'Disputed', 'woocommerce-payments' ),
	},
	default: {
		type: 'light',
		message: '',
	},
};

const PaymentStatusChip = ( props ) => {
	const { charge } = props;
	const status = statuses[ getChargeStatus( charge ) ] || statuses.default;
	return (
		<Chip message={ status.message } type={ status.type } />
	);
};

export default PaymentStatusChip;
