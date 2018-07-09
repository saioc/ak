<?php
/**
 * Navigation in header theme part.
 *
 * @package King
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<nav id="site-navigation" class="main-navigation">
	<span class="king-menu-toggle"  data-toggle="dropdown" data-target=".header-nav" aria-expanded="false" role="button"><i class="fa fa-align-center fa-lg" aria-hidden="true"></i></span>
	<div class="king-switch <?php echo esc_attr( $GLOBALS['hide'] ); ?>">

		<span class="king-switch-toggle"  data-toggle="dropdown" data-target=".king-switch-buttons" aria-expanded="false" role="button">
			<i class="fa fa-th-large fa-lg" aria-hidden="true"></i>
		</span>

		<div class="king-switch-buttons" data-toggle="buttons" id="btn-switch">

			<span class="btn-default g">
			<input type="radio" id="option1" name="options" value="1" data-color="king-grid">
				<label for="option1" title="<?php echo esc_html_e( 'Grid view', 'king' ); ?>"><i class="fa fa-th" aria-hidden="true"></i></label>
			</span> 			
			<span class="btn-default gs">
				<input type="radio" id="option4" name="options" value="4" data-color="king-grid-side">
				<label for="option4" title="<?php echo esc_html_e( 'Grid without sidebar view', 'king' ); ?>"><i class="fa fa-window-maximize" aria-hidden="true"></i></label>
			</span>             
			<span class="btn-default bg">
				<input type="radio" id="option3" name="options" value="3" data-color="king-big-grid">
				<label for="option3" title="<?php echo esc_html_e( 'Big grid view', 'king' ); ?>"><i class="fa fa-th-large" aria-hidden="true"></i></label>
			</span>             
			<span class="btn-default l">
				<input type="radio" id="option2" name="options" value="2" data-color="king-list">
				<label for="option2" title="<?php echo esc_html_e( 'List view', 'king' ); ?>"><i class="fa fa-th-list" aria-hidden="true"></i></label>
			</span> 

		</div>
	</div>
	<?php if ( king_plugin_active( 'woocommerce/woocommerce.php' ) ) : ?>
		<?php $king_shop_count = WC()->cart->get_cart_contents_count(); ?>
		<div class="king-cart">
			<span class="king-cart-toggle"  data-toggle="modal" data-target=".king-cart-content" aria-expanded="false" role="button">
				<?php if ( $king_shop_count ) : ?>
					<span class="king-cart-badge"><?php echo (int) $king_shop_count; ?></span>
				<?php else : ?>
					<span class="king-cart-badge hide">0</span>
				<?php endif; ?>
				<i class="fa fa-shopping-bag" aria-hidden="true"></i>
			</span>
			<div class="king-cart-content">
			<button type="button" class="king-cart-close" data-dismiss="modal" aria-label="Close"><i class="icon fa fa-fw fa-times"></i></button>
				<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
			</div>
		</div>
	<?php endif; ?>        
	<div class="header-nav">
		<?php
		// Primary navigation menu.
		wp_nav_menu( array(
			'menu_id'     => 'primary-menu',
			'theme_location' => 'primary',
		) );
			?>
	</div>
</nav><!-- #site-navigation -->
