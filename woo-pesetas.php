<?php

/*
Plugin Name: Woo-pesetas
Plugin URI: https://faus.to
Description: Añade pesetas como moneda a Woocommerce
Version: 0.1
Author: Fausto Ruiz Madrid
Author URI: https://faus.to
License: GPL
*/
add_filter( 'woocommerce_currencies', 'add_cw_currency' );
function add_cw_currency( $cw_currency ) {
     $cw_currency['PESETA'] = __( 'Peseta', 'woocommerce' );
     return $cw_currency;
}

add_filter('woocommerce_currency_symbol', 'add_cw_currency_symbol', 10, 2);
function add_cw_currency_symbol( $custom_currency_symbol, $custom_currency ) {
     switch( $custom_currency ) {
         case 'PESETA': $custom_currency_symbol = 'ptas.'; break;
     }
     return $custom_currency_symbol;
}
?>