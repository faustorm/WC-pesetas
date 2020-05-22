<?php

/*
Plugin Name: WooCommerce-pesetas
Plugin URI: https://faus.to/wordpress/plugins/woo-pesetas
Description: Add "Peseta" as currency to Woocommerce
Version: 0.1
Author: Fausto Madrid
Author URI: https://faus.to
License: GPL
*/
//Check if woocommerce is active
include_once(ABSPATH.'wp-admin/includes/plugin.php');
if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ){

	//Creates the currency
	add_filter( 'woocommerce_currencies', 'woo_pesetas_add_currency_currency' );
	function woo_pesetas_add_currency_currency( $woo_pesetas_currency ) {
	     $woo_pesetas_currency['PESETA'] = __( 'Peseta', 'woocommerce' );
	     return $woo_pesetas_currency;
	}

	//adds the currency and his symbol to the lists
	add_filter('woocommerce_currency_symbol', 'woo_pesetas_add_currency_currency_symbol', 10, 2);
	function woo_pesetas_add_currency_currency_symbol( $woo_pesetas_currency_symbol, $woo_pesetas_currency ) {
	     switch( $woo_pesetas_currency ) {
	         case 'PESETA': $woo_pesetas_currency_symbol = 'ptas.'; break;
	     }
	     return $woo_pesetas_currency_symbol;
	}
}
//If Woocommerce is not active, show the error
else {
    function woo_pesetas_required_plugin() {
        if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
            add_action( 'admin_notices', 'woo_pesetas_required_plugin_notice' );

            deactivate_plugins( plugin_basename( __FILE__ ) ); 

            if ( isset( $_GET['activate'] ) ) {
                unset( $_GET['activate'] );
            }
        }

    }
    add_action( 'admin_init', 'woo_pesetas_required_plugin' );

    function woo_pesetas_required_plugin_notice(){
        ?><div class="error"><p>Error! You need to install or activate the <a target="_blank" href="https://es.wordpress.org/plugins/woocommerce/">Woocommerce</a> plugin before use "<span style="font-weight: bold;">Woo Pesetas</span>" plugin. Why are you trying to add a currency to Woocommerce without having Woocommerce?</p></div><?php
    }
}///
?>