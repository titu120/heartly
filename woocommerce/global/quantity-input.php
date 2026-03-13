<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 *

 * @var string $type     The input type attribute.
 */

defined( 'ABSPATH' ) || exit;

/* translators: %s: Quantity. */
$label = ! empty( $args['product_name'] ) 
    ? sprintf( 
        esc_html__( '%s quantity', 'heartly' ), 
        wp_strip_all_tags( $args['product_name'] ) 
      ) 
    : esc_html__( 'Quantity', 'heartly' );


?>
<div class="quantity custom-quantity">
    <?php do_action( 'woocommerce_before_quantity_input_field' ); ?>
    <button type="button" class="quantity-button minus" aria-label="Decrease Quantity">&minus;</button>
    <label class='screen-reader-text' for='<?php echo esc_attr( $input_id ); ?>'><?php echo esc_html( $label ); ?></label>
    <input
        type="<?php echo esc_attr( $type ); ?>"
        id="<?php echo esc_attr( $input_id ); ?>"
        class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?>"
        name="<?php echo esc_attr( $input_name ); ?>"
        value="<?php echo esc_attr( $input_value ); ?>"
        min="<?php echo esc_attr( $min_value ); ?>"
        max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
        step="<?php echo esc_attr( $step ); ?>"
        placeholder="<?php echo esc_attr( $placeholder ); ?>"
        inputmode="<?php echo esc_attr( $inputmode ); ?>"
        autocomplete="<?php echo esc_attr( isset( $autocomplete ) ? $autocomplete : 'on' ); ?>"
    />
    <button type="button" class="quantity-button plus" aria-label="Increase Quantity">&plus;</button>
    <?php do_action( 'woocommerce_after_quantity_input_field' ); ?>
</div>

<?php
