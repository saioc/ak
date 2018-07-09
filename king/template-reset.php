<?php
/**
 * Reset Password Page
 *
 * @package King
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( is_user_logged_in() ) {
	wp_redirect( get_home_url() );
	exit;
}
?>
<?php get_header(); ?>
<?php $GLOBALS['hide'] = 'hide'; ?>
<!-- #primary BEGIN -->
<div id="primary" class="page-content-area">
	<main id="main" class="page-site-main">
		<!--content-->
		<?php if ( isset( $_GET['action'] ) && $_GET['action'] === 'resetpassword' ) : // input var okay; sanitization. ?>
		<div class="alert alert-success"><?php esc_attr_e( 'Confirmation email is sent to your email address', 'king' ); ?></div>
		<?php else : ?>
		<?php if ( isset( $_GET['action'] ) && $_GET['action'] === 'userexist' ) : // input var okay; sanitization. ?>
			<div class="alert alert-success"><?php esc_attr_e( 'You must enter a valid and existing email address or username.', 'king' ); ?></div>
		<?php endif; ?>			
		<form action="<?php echo esc_url( wp_lostpassword_url( esc_url_raw( add_query_arg( array( 'action' => 'resetpassword' ), site_url() . '/' . $GLOBALS['king_reset'] ) ) ) ); ?>" id="login-form" method="post">
			<div class="king-form-group">
				<input type="text" name="user_login" id="user_email" class="bpinput" value="" placeholder="<?php esc_attr_e( 'Username or email address', 'king' ); ?>" maxlength="80" />
			</div>
			<div class="king-form-group bwrap">
				
				<input type="submit" class="king-submit-button" value="<?php esc_attr_e( 'Reset password', 'king' ); ?>" id="king-submitbutton" name="resetpassword" />
			</div>
		</form>
		<?php endif; ?>
	</main><!-- #main -->
</div><!-- .main-column -->
<?php get_footer(); ?>
