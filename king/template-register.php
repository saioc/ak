<?php
/**
 * Register Page.
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

global $king_theme_globals, $king_register_errors, $post;

// register
if ( isset( $_POST['user_login'] ) &&  isset( $_POST['user_email'] ) && isset( $_POST['king_register_form_nonce'] ) && wp_verify_nonce( $_POST['king_register_form_nonce'], 'king_register_form' ) ) { // input var okay; sanitization okay.


	$username	= sanitize_user( $_POST['user_login'] ); // input var okay; sanitization okay.
	$email 		= sanitize_email( $_POST['user_email'] ); // input var okay; sanitization okay.
	   // remove spaces and dots.
	$username = trim( str_replace( ' ', '', $username ) );
	// user data array.
	$register_userdata = array(
		'user_login' => wp_kses( $username, '' ), // input var okay; sanitization okay.
		'user_email' => wp_kses( $email, '' ), // input var okay; sanitization okay.
		'first_name' => '',
		'last_name' => '',
		'user_url' => '',
		'description' => '',
		'role' => 'author',
		'email' => wp_kses( $email, '' ), // input var okay; sanitization okay.
	);

	$king_register_errors = array();

	$register_userdata['user_pass'] = wp_kses( $_POST['user_pass'], '' ); // input var okay; sanitization okay.
	$register_userdata['confirm_pass'] = wp_kses( $_POST['confirm_pass'], '' ); // input var okay; sanitization okay.

	// custom user meta array.
	$register_usermeta = array(
		'agree' => ( ( isset( $_POST['checkboxagree'] ) && ! empty( $_POST['checkboxagree'] ) ) ? '1' : '0' ), // input var okay; sanitization okay.
		'user_activation_key' => wp_generate_password( 20, false ),
	);


	if ( get_field( 'enable_recaptcha', 'options' ) ) :
		$captcha = $_POST['g-recaptcha-response']; // input var okay; sanitization okay.
	endif;
	// validate username.
	if ( trim( $register_userdata['user_login'] ) === '' ) {
		$king_register_errors['user_login'] = esc_html__( 'Username is required.', 'king' );
	} elseif ( ( strlen( $register_userdata['user_login'] ) < 6 )  || ( strlen( $register_userdata['user_login'] ) > 40 ) ) {
		$king_register_errors['user_login'] = esc_html__( 'Sorry, username must be 6 characters or more.', 'king' );
	} elseif ( ! validate_username( $register_userdata['user_login'] ) ) {
		$king_register_errors['user_login'] = esc_html__( 'Sorry, the username you provided is invalid.', 'king' );
	} elseif ( username_exists( $register_userdata['user_login'] ) ) {
		$king_register_errors['user_login'] = esc_html__( 'Sorry, that username already exists.', 'king' );
	}

	if ( get_field( 'enable_recaptcha', 'options' ) ) :
		if ( ! $captcha ) {
			$king_register_errors['recaptcha'] = esc_html__( 'Please check the the captcha form', 'king' );
		} else {

			$secretkey = get_field( 'recaptcha_secret', 'options' );
			$ip = $_SERVER['REMOTE_ADDR']; // input var okay; sanitization okay.
			$response = wp_remote_get( 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secretkey . '&response=' . $captcha . '&remoteip=' . $ip );
			$response2 = wp_remote_retrieve_body( $response );
			$responsekeys = json_decode( $response2,true );
			if ( intval( $responsekeys['success'] ) !== 1 ) {
		  		$king_register_errors['recaptcha_failed'] = esc_html__( 'You are spammer', 'king' );
			}
		}
	endif;
	// validate password.
	if ( trim( $register_userdata['user_pass'] ) === '' ) {
		$king_register_errors['user_pass'] = esc_html__( 'Password is required.', 'king' );
	} elseif ( ( strlen( $register_userdata['user_pass'] ) < 6 )  || ( strlen( $register_userdata['user_pass'] ) > 40 ) ) {
		$king_register_errors['user_pass'] = esc_html__( 'Sorry, password must be 6 characters or more.', 'king' );
	} elseif ( $register_userdata['user_pass'] !== $register_userdata['confirm_pass'] ) {
		$king_register_errors['confirm_pass'] = esc_html__( 'Password and repeat password fields must match.', 'king' );
	}

	// validate user_email.
	if ( ! is_email( $register_userdata['user_email'] ) ) {
		$king_register_errors['user_email'] = esc_html__( 'You must enter a valid email address.', 'king' );
	} elseif ( email_exists( $register_userdata['user_email'] ) ) {
		$king_register_errors['user_email'] = esc_html__( 'Sorry, that email address is already in use.', 'king' );
	}

	if ( get_field( 'enable_terms_and_conditions', 'options' ) ) {
		// validate agree.
		if ( '0' === $register_usermeta['agree'] ) {
			$king_register_errors['agree'] = esc_html__( 'You must agree to our terms &amp; conditions to sign up.', 'king' );
		}
	}

	if ( empty( $king_register_errors ) ) {
		// insert new user.
		$new_user_id = wp_insert_user( $register_userdata );

		$new_user = get_userdata( $new_user_id );

		$user_obj = new WP_User( $new_user_id );

		// update custom user meta.
		foreach ( $register_usermeta as $key => $value ) {
			update_user_meta( $new_user_id, $key, $value );
		}

		// refresh.
		wp_redirect( esc_url_raw( add_query_arg( array( 'action' => 'registered' ), site_url() . '/' . $GLOBALS['king_register'] ) ) );
		exit;
	}
}

global $post;
?>
<?php get_header(); ?>
<?php $GLOBALS['hide'] = 'hide'; ?>

<?php if ( ! get_option( 'users_can_register' ) ) : ?>
	<div class="king-alert"><i class="fa fa-bell fa-lg" aria-hidden="true"></i>
		<?php esc_html_e( 'Registration is disabled in this site !', 'king' ) ?>
	</div>
<?php else : ?> 
<!-- #primary BEGIN -->
<div id="primary" class="page-content-area">
	<main id="main" class="page-site-main">
	<!--content-->

<?php
if ( isset( $_GET['action'] ) && $_GET['action'] === 'registered' ) { ?>
		<div class="alert alert-success">
			<?php esc_html_e( 'Account was successfully created. You can login now !', 'king' ) ?>						
		</div>
			<a href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_login'] ); ?>" class="king-alert-button"><?php esc_html_e( 'Log in ', 'king' ) ?></a>
<?php } else { ?>
	<?php if ( get_field( 'custom_message_register', 'options' ) ) : ?>
		<div class="king-custom-message">
			<?php the_field( 'custom_message_register', 'options' ); ?>
		</div>
	<?php endif; ?>	
	<form action="" id="register-form" method="post">
		<?php if ( isset( $errors ) && count( $errors ) > 0 ) { ?>
		<div class="alert alert-danger"><?php esc_html_e( 'Errors were encountered during signup form processing. Please try again.', 'king' ) ?></div>
		<?php } ?>
		<div class="king-form-group">
			<input tabindex="1" type="text" id="user_login" class="bpinput" name="user_login" placeholder="<?php esc_html_e( 'Username', 'king' ); ?>" value="<?php echo isset( $register_userdata['user_login'] ) ? $register_userdata['user_login'] : ''; ?>" maxlength="50" />
			<?php if ( isset( $king_register_errors['user_login'] ) ) { ?>
			<div class="king-error"><?php echo esc_attr( $king_register_errors['user_login'] ); ?></div>
			<?php } ?>
		</div>
		<div class="king-form-group">
			<input tabindex="2" type="email" id="user_email" class="bpinput" name="user_email" placeholder="<?php esc_html_e( 'Email', 'king' ); ?>" value="<?php echo isset( $register_userdata['user_email'] ) ? $register_userdata['user_email'] : ''; ?>" maxlength="80" />
			<?php if ( isset( $king_register_errors['user_email'] ) ) { ?>
			<div class="king-error"><?php echo esc_attr( $king_register_errors['user_email'] ); ?></div>
			<?php } ?>
			<input type="hidden" name="email" id="email" value="" />
			<input type="hidden" name="password" id="password" value="" />

		</div>

		<div class="king-form-group">
			<input id="user_pass" class="bpinput" type="password" placeholder="<?php esc_html_e( 'Password', 'king' ); ?>" tabindex="30" size="25" value="" name="user_pass" maxlength="50" />
			<?php if ( isset( $king_register_errors['user_pass'] ) ) { ?>
			<div class="king-error"><?php echo esc_attr( $king_register_errors['user_pass'] ); ?></div>
			<?php } ?>
		</div>
		<div class="king-form-group">
			<input id="confirm_pass" class="bpinput" type="password" tabindex="40" size="25" placeholder="<?php esc_html_e( 'Repeat password', 'king' ); ?>" value="" name="confirm_pass" maxlength="50" />
			<?php if ( isset( $king_register_errors['confirm_pass'] ) ) { ?>
			<div class="king-error"><?php echo esc_attr( $king_register_errors['confirm_pass'] ); ?></div>
			<?php } ?>

		</div>
		<?php if ( get_field( 'enable_terms_and_conditions', 'options' ) ) : ?>	
			<div class="king-form-group">
				<input type="checkbox" name="checkboxagree" id="checkboxagree" />
				<label for="checkboxagree"><?php esc_html_e( 'I accept', 'king' ); ?></label><span class="open-terms" data-toggle="dropdown" data-target=".terms-cond" aria-expanded="false"><?php esc_html_e( ' terms and conditions', 'king' ); ?> </span>
				<?php if ( isset( $king_register_errors['agree'] ) ) { ?>
				<div class="king-error"><?php echo esc_attr( $king_register_errors['agree'] ); ?></div>
				<?php } ?>
				<div class="terms-cond"> <?php the_field( 'terms_and_conditions', 'options' ) ?> </div>
			</div>
		<?php endif; ?>	
		<?php if ( get_field( 'enable_recaptcha', 'options' ) ) : ?>
			<div class="king-form-group">
				<div class="g-recaptcha" data-sitekey="<?php the_field( 'recaptcha_key', 'options' ); ?>"></div>
				<?php if ( isset( $king_register_errors['recaptcha'] ) ) { ?>
				<div class="king-error"><?php echo esc_attr( $king_register_errors['recaptcha'] ); ?></div>
				<?php } ?>		
				<?php if ( isset( $king_register_errors['recaptcha_failed'] ) ) { ?>
				<div class="king-error"><?php echo esc_attr( $king_register_errors['recaptcha_failed'] ); ?></div>
				<?php } ?>	
			</div>		
		<?php endif; ?>				
		<div class="king-form-group bwrap">
			<?php wp_nonce_field( 'king_register_form','king_register_form_nonce' ); ?>
			<input type="hidden" name="redirect_to" value="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" />
			<input type="submit" class="king-submit-button" data-loading-text="<?php esc_html_e( 'Loading...', 'king' ) ?>" value="<?php esc_html_e( 'Register', 'king' ); ?>" id="king-submitbutton" name="register" />
		</div>

	</form>
		<div class="login-rl">
			<a href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_login'] ); ?>" class="login-register"><i class="fa fa-globe" aria-hidden="true"></i><?php esc_html_e( ' Login ', 'king' ) ?></a>
		</div>	
		<?php if ( get_field( 'enable_facebook_login','option' ) || get_field( 'enable_googleplus_login', 'option' ) ) : ?>
		<div class="social-login">
		<span class="social-or"><?php esc_html_e( 'OR', 'king' ); ?></span>
		<?php if ( get_field( 'enable_facebook_login','option' ) ) : ?>
			<a class="fb-login" href="<?php echo esc_url( site_url() . '/wp-admin/admin-ajax.php?action=king_facebook_oauth_redirect' ); ?>"><i class="fa fa-facebook"></i><?php esc_html_e( 'Connect w/', 'king' ); ?><b><?php esc_html_e( ' Facebook', 'king' ); ?></b></a>
		<?php endif; ?>		
		<?php if ( get_field( 'enable_googleplus_login', 'option' ) ) : ?>
			<a class="google-login google-login-js" href="#"><i class="fa fa-google-plus"></i><?php esc_html_e( 'Connect w/', 'king' ); ?> <b><?php esc_html_e( 'Google+', 'king' ); ?></b></a>				
		<?php endif; ?>			
		</div>
		<?php endif; ?>	
		<?php } ?>
	</main><!-- #main -->
</div><!-- .main-column -->
<?php endif; ?>
<?php get_footer(); ?>
