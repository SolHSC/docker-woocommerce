<?php

use PR\DHL\Utils\API_Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * WooCommerce DHL Wizard.
 *
 * @package  PR_DHL_WC_Wizard
 * @category Admin
 * @author   Shadi Manna
 */

if ( ! class_exists( 'PR_DHL_WC_Wizard_Paket' ) ) :

class PR_DHL_WC_Wizard_Paket {

	public function __construct() {
		add_action( 'admin_footer', array( $this, 'display_wizard' ), 10 );
		add_action( 'admin_notices', array( $this, 'wizard_notice' ) );
    }

	public function wizard_notice() {
		$screen    = get_current_screen();
        $screen_id = $screen ? $screen->id : '';

        if ( 'woocommerce_page_wc-settings' !== $screen_id ) {
			return;
		}

		if ( ! isset( $_GET['section'] ) || $_GET['section'] != 'pr_dhl_paket' ) {
			return;
		}
	?>
		<div class="updated notice is-dismissible">
			<p><?php _e( 'Welcome to DHL plugin! You\'re almost there, but we think this wizard might help you setup the plugin.', 'dhl-for-woocommerce' ); ?></p>
			<p><a href="#" id="pr-dhl-open-wizard-button" class="button button-primary"><?php _e( 'Run wizard', 'dhl-for-woocommerce' ); ?></a> <a href="javascript:window.location.reload()" class="button"><?php _e( 'dismiss', 'dhl-for-woocommerce' ); ?></a></p>
		</div>
	<?php
	}

	public function display_wizard() {
		if ( ! API_Utils::is_new_merchant() ) {
			return;
		}

		$screen    = get_current_screen();
        $screen_id = $screen ? $screen->id : '';

        if ( 'woocommerce_page_wc-settings' !== $screen_id ) {
			return;
		}

		if ( ! isset( $_GET['section'] ) || $_GET['section'] != 'pr_dhl_paket' ) {
			return;
		}
	?>
		<div class="pr-dhl-wc-wizard-overlay">
			<div class="pr-dhl-wc-wizard-container">
				<div class="pr-dhl-wc-wizard">
					<div class="wizard-header">
						<img src="<?php echo esc_url( PR_DHL_PLUGIN_DIR_URL . '/assets/img/dhl-official.png' ) ?>" width="300" class="dhl-logo" alt="DHL Logo" />
					</div>
					<form class="wizard" id="dhlStepsWizard">
						<aside class="wizard-content container">
							<div class="wizard-step" data-title="Step 1">
								<h4 class="wizard-title"><?php _e( 'Quick Set Up', 'dhl-for-woocommerce' ); ?></h4>
								<div class="wizard-description">
									<?php _e( 'Thank you for installing this plugin. We\'ll guide you through the set up and minimum required fields.', 'dhl-for-woocommerce' ); ?>
								</div>
								<input type="hidden" name="start_wizard" value="yes" />
								<div class="form-group">
									<button class="button-next"><?php _e( 'Begin Setup' , 'dhl-for-woocommerce' ); ?></button>
								</div>
							</div>

							<div class="wizard-step" data-title="Step 2">
								<h4 class="wizard-title"><?php _e( 'Account Number (EKP)', 'dhl-for-woocommerce' ); ?></h4>
								<div class="wizard-description">
									<?php _e( 'Your DHL account number (10 digits - numerical), also called "EKP". This will be provided by your local DHL sales organization.', 'dhl-for-woocommerce' ); ?>
								</div>
								<div class="form-group">
									<input type="text" name="dhl_account_num" class="form-control required wizard-dhl-field" id="wizard_dhl_account_num" placeholder="<?php _e( 'Enter your EKP', 'dhl-for-woocommerce' ); ?>">
								</div>
								<div class="form-group">
									<button class="button-next"><?php _e( 'Next' , 'dhl-for-woocommerce' ); ?></button>
								</div>
							</div>

							<div class="wizard-step" data-title="Step 3">
								<h4 class="wizard-title"><?php _e( 'API Settings', 'dhl-for-woocommerce' ); ?></h4>
								<div class="wizard-description">
									<?php echo sprintf( __( 'Please configure your access towards the DHL Paket APIs by means of authentication. Your username for the DHL business customer portal. Please note the lower case and test your access data in advance at <a href="%s">here</a>.', 'dhl-for-woocommerce' ), PR_DHL_PAKET_BUSSINESS_PORTAL ); ?>
								</div>
								<div class="form-group">
									<input type="text" name="dhl_api_user" class="form-control required wizard-dhl-field" id="wizard_dhl_api_user" placeholder="<?php _e( 'Username', 'dhl-for-woocommerce' ); ?>">
								</div>
								<div class="form-group">
									<input type="password" name="dhl_api_pwd" class="form-control required wizard-dhl-field" id="wizard_dhl_api_pwd" placeholder="<?php _e( 'Password', 'dhl-for-woocommerce' ); ?>">
								</div>
								<div class="form-group">
									<button class="button-next"><?php _e( 'Next' , 'dhl-for-woocommerce' ); ?></button>
								</div>
							</div>

							<div class="wizard-step" data-title="Step 4">
								<h4 class="wizard-title"><?php _e( 'Participation Number', 'dhl-for-woocommerce' ); ?></h4>
								<div class="wizard-description">
									<?php _e( 'The participation number consists of the last two characters of the respective accounting number, which you will find in your DHL contract data (for example, 01).', 'dhl-for-woocommerce' ); ?>
								</div>
								<div class="form-group">
									<input type="text" name="dhl_participation_V01PAK" class="form-control required wizard-dhl-field" id="wizard_dhl_participation_V01PAK" placeholder="<?php _e( 'Regular product', 'dhl-for-woocommerce' ); ?>" />
									<input type="hidden" name="dhl_participation_V01PRIO" class="form-control wizard-dhl-field participation-field" id="wizard_dhl_participation_V01PRIO" />
									<input type="hidden" name="dhl_participation_V62WP" class="form-control wizard-dhl-field participation-field" id="wizard_dhl_participation_V62WP" />
									<input type="hidden" name="dhl_participation_V55PAK" class="form-control wizard-dhl-field participation-field" id="wizard_dhl_participation_V55PAK" />
									<input type="hidden" name="dhl_participation_V54EPAK" class="form-control wizard-dhl-field participation-field" id="wizard_dhl_participation_V54EPAK" />
									<input type="hidden" name="dhl_participation_V53WPAK" class="form-control wizard-dhl-field participation-field" id="wizard_dhl_participation_V53WPAK" />
									<input type="hidden" name="dhl_participation_V66WPI" class="form-control wizard-dhl-field participation-field" id="wizard_dhl_participation_V66WPI" />
									<input type="hidden" name="dhl_participation_return" class="form-control wizard-dhl-field participation-field" id="wizard_dhl_participation_return" />
								</div>
								<div class="form-group">
									<button class="button-next"><?php _e( 'Next' , 'dhl-for-woocommerce' ); ?></button>
								</div>
							</div>

							<div class="wizard-step" data-title="Step 5">
								<h4 class="wizard-title"><?php _e( 'Shipper Address', 'dhl-for-woocommerce' ); ?></h4>
								<div class="wizard-description">
									<?php _e( 'Enter Shipper Address. This address is also used for Pickup Requests.', 'dhl-for-woocommerce' ); ?>
								</div>
								<div class="form-group">
									<input type="text" name="dhl_shipper_name" class="form-control required wizard-dhl-field" id="wizard_dhl_shipper_name" placeholder="<?php _e( 'Name', 'dhl-for-woocommerce' ); ?>">
								</div>
								<div class="form-group">
									<input type="text" name="dhl_shipper_company" class="form-control required wizard-dhl-field" id="wizard_dhl_shipper_company" placeholder="<?php _e( 'Company', 'dhl-for-woocommerce' ); ?>">
								</div>
								<div class="form-group">
									<input type="text" name="dhl_shipper_address" class="form-control required wizard-dhl-field" id="wizard_dhl_shipper_address" placeholder="<?php _e( 'Street Address', 'dhl-for-woocommerce' ); ?>">
								</div>
								<div class="form-group">
									<input type="text" name="dhl_shipper_address_no" class="form-control required wizard-dhl-field" id="wizard_dhl_shipper_address_no" placeholder="<?php _e( 'Street Address Number', 'dhl-for-woocommerce' ); ?>">
								</div>
								<div class="form-group">
									<input type="text" name="dhl_shipper_address_city" class="form-control required wizard-dhl-field" id="wizard_dhl_shipper_address_city" placeholder="<?php _e( 'City', 'dhl-for-woocommerce' ); ?>">
								</div>
								<div class="form-group">
									<input type="text" name="dhl_shipper_address_state" class="form-control required wizard-dhl-field" id="wizard_dhl_shipper_address_state" placeholder="<?php _e( 'State', 'dhl-for-woocommerce' ); ?>">
								</div>
								<div class="form-group">
									<input type="text" name="dhl_shipper_address_zip" class="form-control required wizard-dhl-field" id="wizard_dhl_shipper_address_zip" placeholder="<?php _e( 'Postcode', 'dhl-for-woocommerce' ); ?>">
								</div>
								<div class="form-group">
									<input type="text" name="dhl_shipper_phone" class="form-control wizard-dhl-field" id="wizard_dhl_shipper_phone" placeholder="<?php _e( 'Phone', 'dhl-for-woocommerce' ); ?>">
								</div>
								<div class="form-group">
									<input type="text" name="dhl_shipper_email" class="form-control wizard-dhl-field" id="wizard_dhl_email" placeholder="<?php _e( 'Email', 'dhl-for-woocommerce' ); ?>">
								</div>
								<div class="form-group">
									<button class="button-next"><?php _e( 'Next' , 'dhl-for-woocommerce' ); ?></button>
								</div>
							</div>

							<div class="wizard-step" data-title="Step 6">
								<h4 class="wizard-title"><?php _e( 'All set', 'dhl-for-woocommerce' ); ?></h4>
								<div class="wizard-description">
									<?php _e( 'You can find all additional settings under WooCommerce > Settings > Shipping > DHL Paket', 'dhl-for-woocommerce' ); ?>
								</div>
								<div class="form-group">
									<input type="hidden" name="dhl_participation_finish" class="form-control wizard-dhl-field participation-field" id="wizard_dhl_participation_finish" />
								</div>
								<div class="form-group">
									<button class="button-finish"><?php _e( 'Finish Setup' , 'dhl-for-woocommerce' ); ?></button>
								</div>
							</div>
						</aside>
					</form>
				</div>
				<a href="#" class="pr-dhl-wc-skip-wizard"><span class="dashicons dashicons-no"></span></a>
			</div>
		</div>
	<?php 
	}
}

endif;
