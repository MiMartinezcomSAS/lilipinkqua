<?php
/**
 * Show error messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;
?>
<div class="popUpErrorPay">

</div>
<div class="errorMessagePay">
    <div class="closePopUp">x</div>
    <div class="logoerror"><img src="http://experimental.mi-martinez.com/lilipink/wp-content/uploads/2014/09/logo2.png"></div>
    <div class="errortexto">Importante</div>
    <ul>
        <?php foreach ( $messages as $message ) : ?>
            <li><?php echo wp_kses_post( $message ); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<ul class="woocommerce-error">
	<?php foreach ( $messages as $message ) : ?>
		<li><?php echo wp_kses_post( $message ); ?></li>
	<?php endforeach; ?>
</ul>