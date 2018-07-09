<?php
/**
 * User settings page.
 *
 * @package King
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$GLOBALS['settings'] = 'active';
global $king_submit_errors;
$this_user = wp_get_current_user();
if ( ! $this_user->ID ) {
	wp_die( esc_attr( 'You don not have permissions on this page.', 'king' ) );
}

/**
 * Custom name for cover photo.
 *
 * @param  [type] $filename filename.
 * @return [type] string
 */
function king_custom_avatar_upload_name( $filename ) {
	$info = pathinfo( $filename );
	$this_user = wp_get_current_user();
	$temp = explode( '.', $_FILES['avatar-edit']['name'] );
	$temp = end( $temp );
	$filename = 'avatarimg_user' . $this_user->ID . '.' . $temp;
	return $filename;
}
add_filter( 'sanitize_file_name', 'king_custom_avatar_upload_name', 10 );


/**
 * Custom name for cover photo.
 *
 * @param  [type] $filename filename.
 * @return [type] string
 */
function king_custom_cover_upload_name( $filename ) {
	$info = pathinfo( $filename );
	$this_user = wp_get_current_user();
	$temp = explode( '.', $_FILES['cover-edit']['name'] );
	$temp = end( $temp );
	$filename = 'coverimg_user' . $this_user->ID . '.' . $temp;
	return $filename;
}

add_filter( 'sanitize_file_name', 'king_custom_cover_upload_name', 10 );

/*
Update user information.
 */
if ( isset( $_POST['save-edit'] ) ) {
	$king_submit_errors = array();

	$king_about = wp_strip_all_tags( sanitize_text_field( $_POST['edit-about'] ) );
	$king_firstname = wp_strip_all_tags( sanitize_text_field( $_POST['firstname-edit'] ) );
	$king_lastname = wp_strip_all_tags( sanitize_text_field( $_POST['lastname-edit'] ) );
	$king_facebook = wp_strip_all_tags( sanitize_text_field( esc_url( wp_unslash( $_POST['facebook-edit'] ) ) ) ); // input var okay; sanitization okay.
	$king_twitter = wp_strip_all_tags( sanitize_text_field( esc_url( wp_unslash( $_POST['twitter-edit'] ) ) ) ); // input var okay; sanitization okay.
	$king_google = wp_strip_all_tags( sanitize_text_field( esc_url( wp_unslash( $_POST['google-edit'] ) ) ) ); // input var okay; sanitization okay.
	$king_linkedin = wp_strip_all_tags( sanitize_text_field( esc_url( wp_unslash( $_POST['linkedin-edit'] ) ) ) ); // input var okay; sanitization okay.
	$king_customurl = wp_strip_all_tags( sanitize_text_field( esc_url( wp_unslash( $_POST['customurl-edit'] ) ) ) ); // input var okay; sanitization okay.
	$email = sanitize_email( $_POST['email-edit'] );
	$password = esc_attr( $_POST['password-edit'] );
	$confirm_password = esc_attr( $_POST['confirm-pass'] );

	if ( ! empty( $password ) ) {
		if ( ( strlen( $password ) < 6 ) || ( strlen( $password ) > 40 ) ) {
			$king_submit_errors['user_pass'] = esc_html__( 'Sorry, password must be 6 characters or more.', 'king' );
		} elseif ( $password !== $confirm_password ) {
			$king_submit_errors['confirm_pass'] = esc_html__( 'Password and repeat password fields must match.', 'king' );
		} else {
			wp_update_user( array( 'ID' => $this_user->ID, 'user_pass' => $password ) );
		}
	}

	if ( isset( $king_about ) && ( strlen( $king_about ) < 1000 ) ) {
		wp_update_user( array( 'ID' => $this_user->ID, 'description' => $king_about ) );
	}
	if ( isset( $king_firstname ) && ( strlen( $king_firstname ) < 140 ) && ! empty( $king_firstname ) ) {
		wp_update_user( array( 'ID' => $this_user->ID, 'first_name' => $king_firstname ) );
	}
	if ( isset( $king_lastname ) && ( strlen( $king_lastname ) < 140 ) && ! empty( $king_lastname ) ) {
		wp_update_user( array( 'ID' => $this_user->ID, 'last_name' => $king_lastname ) );
	}

	if ( isset( $king_facebook ) && ( strlen( $king_facebook ) < 140 ) ) {
		update_user_meta( $this_user->ID, '_profile_facebook','field_587be5f411824' );
		update_user_meta( $this_user->ID, 'profile_facebook', $king_facebook );
	}

	if ( isset( $king_twitter ) && ( strlen( $king_twitter ) < 140 ) ) {
		update_user_meta( $this_user->ID, '_profile_twitter', 'field_587be62b11825' );
		update_user_meta( $this_user->ID, 'profile_twitter', $king_twitter );
	}

	if ( isset( $king_google ) && ( strlen( $king_google ) < 140 ) ) {
		update_user_meta( $this_user->ID, '_profile_google', 'field_587be66611827' );
		update_user_meta( $this_user->ID, 'profile_google', $king_google );
	}

	if ( isset( $king_linkedin ) && ( strlen( $king_linkedin ) < 140 ) ) {
		update_user_meta( $this_user->ID, '_profile_linkedin', 'field_587be65111826');
		update_user_meta( $this_user->ID, 'profile_linkedin', $king_linkedin);
	}
	
	if ( isset( $king_customurl ) && ( strlen( $king_customurl ) < 140 ) ) {
		update_user_meta( $this_user->ID, '_profile_add_url', 'field_5a132d05c424b');
		update_user_meta( $this_user->ID, 'profile_add_url', $king_customurl);
	}
	/*
	Change Email.
	*/
	if ( $email ) { // input var okay; sanitization okay.
		$some_user = get_user_by( 'email', $email );
		if ( $some_user && ( $some_user->ID !== $this_user->ID ) ) {
			$king_submit_errors['confirm_email'] = esc_html__( 'This e-mail is already in use, please use another one.', 'king' );
		} else {
			wp_update_user( array( 'ID' => $this_user->ID, 'user_email' => $email ) );
		}
	}

	/*
	Upload avatar.
	*/
	if ( isset( $_FILES['avatar-edit'] ) ) { // input var okay; sanitization okay.

		if ( ! empty( $_FILES['avatar-edit']['name'] ) ) { // input var okay; sanitization okay.

			$image_data = @getimagesize( $_FILES['avatar-edit']['tmp_name'] ); // input var okay; sanitization okay.
			$allowed_file_types = array( 'image/jpg', 'image/jpeg', 'image/png', 'image/gif' );
			if ( ! in_array( $image_data['mime'], $allowed_file_types, true ) ) {
				$king_submit_errors['avatar_error'] = esc_html__( 'This image is not valid', 'king' );
			}
			if ( get_field( 'max_avatar_size', 'option' ) ) {
				$maxsize = get_field( 'max_avatar_size', 'option' );
			} else {
				$maxsize = '2';
			}
			define( 'MB', 1048576 );
			if ( ( $_FILES['avatar-edit']['size'] >= $maxsize * MB ) || ( 0 === $_FILES['avatar-edit']['size'] ) ) { // input var okay; sanitization okay.
				$king_submit_errors['avatar_error'] = esc_html__( 'File too large. File must be less than ', 'king' ) . $maxsize . 'MB';
			}

			if ( empty( $king_submit_errors ) ) {
				require_once ABSPATH . 'wp-admin/includes/admin.php';
				$upload_overrides = array( 'test_form' => false,'unique_filename_callback' => 'king_custom_avatar_upload_name' );
				$file_return = wp_handle_upload( $_FILES['avatar-edit'], $upload_overrides ); // input var okay; sanitization okay.
				$filename = $file_return['file'];
				$attachment = array(
					'guid' => $file_return['url'],
					'post_mime_type' => $file_return['type'],
					'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
					'post_content' => '',
					'post_status' => 'inherit',
					);
				$attach_id = wp_insert_attachment( $attachment, $filename );
				require_once( ABSPATH . 'wp-admin/includes/image.php' );
				$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
				wp_update_attachment_metadata( $attach_id, $attach_data );

				update_user_meta( $this_user->ID, '_author_image', 'field_587be48552f9f' );
				update_user_meta( $this_user->ID, 'author_image', $attach_id );
			}
		}
	}

	/*
	Upload user cover photo.
	*/
	if ( isset( $_FILES['cover-edit'] ) ) { // input var okay; sanitization okay.

		if ( ! empty( $_FILES['cover-edit']['name'] ) ) { // input var okay; sanitization okay.
			$image_data = @getimagesize( $_FILES['cover-edit']['tmp_name'] ); // input var okay; sanitization okay.
			$allowed_file_types = array( 'image/jpg', 'image/jpeg', 'image/png', 'image/gif' );
			if ( ! in_array( $image_data['mime'], $allowed_file_types, true ) ) {
				$king_submit_errors['cover_error'] = esc_html__( 'This image is not valid', 'king' );
			}
			if ( get_field( 'max_cover_size', 'option' ) ) {
				$maxsize = get_field( 'max_cover_size', 'option' );
			} else {
				$maxsize = '2';
			}
			define( 'MB', 1048576 );
			if ( ( $_FILES['cover-edit']['size'] >= $maxsize * MB) || ( 0 === $_FILES['cover-edit']['size'] ) ) { // input var okay; sanitization okay.
				$king_submit_errors['cover_error'] = esc_html__( 'File too large. File must be less than ', 'king' ) . $maxsize . 'MB';
			}
			if ( empty( $king_submit_errors ) ) {
				require_once ABSPATH . 'wp-admin/includes/admin.php';
				$upload_overrides = array( 'test_form' => false,'unique_filename_callback' => 'king_custom_cover_upload_name' );
				$file_return = wp_handle_upload( $_FILES['cover-edit'], $upload_overrides );
				$filename = $file_return['file'];
				$attachment = array(
					'guid' => $file_return['url'],
					'post_mime_type' => $file_return['type'],
					'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
					'post_content' => '',
					'post_status' => 'inherit',
					);
				$attach_id = wp_insert_attachment( $attachment, $filename );
				require_once( ABSPATH . 'wp-admin/includes/image.php' );
				$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
				wp_update_attachment_metadata( $attach_id, $attach_data );

				update_user_meta( $this_user->ID, '_cover_image', 'field_587be575569ec' );
				update_user_meta( $this_user->ID, 'cover_image', $attach_id);
			}
		}
	}

	if ( empty( $king_submit_errors ) ) {
		wp_safe_redirect( site_url() . '/' . $GLOBALS['king_account'] );
		die( esc_html__( 'Saving Data', 'king' ) );
	}
}
/*Update User*/
?>
<?php get_header(); ?>
<?php $GLOBALS['hide'] = 'hide'; ?>
<?php get_template_part( 'template-parts/king-profile-header' ); ?>

<div id="primary" class="page-content-area">
	<main id="main" class="page-site-main">
		<div class="edit-dialog">
			<h5 class="dialog-title"><span><?php esc_attr_e( 'Edit Profile', 'king' ); ?></span></h5>
			<form action="" class="edit-profile" method="post" enctype="multipart/form-data" autocomplete="off">

				<div class="king-form-group">
					<label for="name-edit"><?php esc_attr_e( 'Username', 'king' ); ?></label>
					<input type="text" id="name-edit" class="bpinput" name="name-edit" readonly="readonly" value="<?php the_author_meta( 'user_login',$this_user->ID ); ?>">
			</div>

			<div class="king-form-group">
					<label for="password-edit"><?php esc_attr_e( 'Password', 'king' ); ?></label>
					<input type="password" id="password-edit" class="bpinput" placeholder="<?php esc_attr_e( 'Password', 'king' ); ?>" name="password-edit" autocomplete="off" maxlength="50" >
			</div>
			<?php if ( isset( $king_submit_errors['user_pass'] ) ) { ?>
			<div class="king-error"><?php echo esc_attr( $king_submit_errors['user_pass'] ); ?></div>
			<?php } ?>

			<div class="king-form-group">
				<label for="password-edit"><?php esc_attr_e( 'Repeat password', 'king' ); ?></label>
				<input id="confirm_pass" class="bpinput" type="password" placeholder="<?php esc_attr_e( 'Repeat password', 'king' ); ?>" value="" name="confirm-pass" autocomplete="off" maxlength="50" >
		</div>
		<?php if ( isset( $king_submit_errors['confirm_pass'] ) ) { ?>
		<div class="king-error"><?php echo esc_attr( $king_submit_errors['confirm_pass'] ); ?></div>
		<?php } ?>

		<div class="king-form-group">
			<label for="email-edit"><?php esc_attr_e( 'Email', 'king' ); ?></label>
			<input type="email" id="email-edit" class="bpinput" name="email-edit" placeholder="<?php the_author_meta( 'user_email', $this_user->ID ); ?>" maxlength="140">
	</div>
	<?php if ( isset( $king_submit_errors['confirm_email'] ) ) { ?>
	<div class="king-error"><?php echo esc_attr( $king_submit_errors['confirm_email'] ); ?></div>
	<?php } ?>

	<div class="king-form-group">
		<label for="firstname-edit"><?php esc_attr_e( 'First Name', 'king' ); ?></label>
		<input type="text" id="firstname-edit" class="bpinput" name="firstname-edit" placeholder="<?php the_author_meta( 'first_name',$this_user->ID ); ?>" maxlength="140">
</div>

<div class="king-form-group">
		<label for="lastname-edit"><?php esc_attr_e( 'Last Name', 'king' ); ?></label>
		<input type="text" id="lastname-edit" class="bpinput" name="lastname-edit" placeholder="<?php the_author_meta( 'last_name', $this_user->ID ); ?>" maxlength="140">
</div>

<div class="king-form-group">
		<label for="avatar-edit"><?php esc_attr_e( 'Avatar', 'king' ); ?></label>
		<input type="file" id="avatar-edit" name="avatar-edit">
</div>
<?php if ( isset( $king_submit_errors['avatar_error'] ) ) { ?>
<div class="king-error"><?php echo esc_attr( $king_submit_errors['avatar_error'] ); ?></div>
<?php } ?>

<div class="king-form-group">
	<label for="cover-edit"><?php esc_attr_e( 'cover', 'king' ); ?></label>
	<input type="file" id="cover-edit" name="cover-edit">
</div>
<?php if ( isset( $king_submit_errors['cover_error'] ) ) { ?>
<div class="king-error"><?php echo esc_attr( $king_submit_errors['cover_error'] ); ?></div>
<?php } ?>

<div class="king-form-group">
		<label for="facebook-edit"><?php esc_attr_e( 'facebook', 'king' ); ?></label>
		<input type="text" id="facebook-edit" class="bpinput" name="facebook-edit" value="<?php the_field( 'profile_facebook', 'user_' . $this_user->ID ); ?>" maxlength="140">
</div>

<div class="king-form-group">
		<label for="twitter-edit"><?php esc_attr_e( 'twitter', 'king' ); ?></label>
		<input type="text" id="twitter-edit" class="bpinput" name="twitter-edit" value="<?php the_field( 'profile_twitter', 'user_' . $this_user->ID ); ?>" maxlength="140">
</div>

<div class="king-form-group">
		<label for="google-edit"><?php esc_attr_e( 'google', 'king' ); ?></label>
		<input type="text" id="google-edit" class="bpinput" name="google-edit" value="<?php the_field( 'profile_google', 'user_' . $this_user->ID ); ?>" maxlength="140">
</div>

<div class="king-form-group">
		<label for="linkedin-edit"><?php esc_attr_e( 'linkedin', 'king' ); ?></label>
		<input type="text" id="linkedin-edit" class="bpinput" name="linkedin-edit" value="<?php the_field( 'profile_linkedin', 'user_' . $this_user->ID ); ?>" maxlength="140">
</div>
<div class="king-form-group">
		<label for="customurl-edit"><?php esc_attr_e( 'Url', 'king' ); ?></label>
		<input type="text" id="customurl-edit" class="bpinput" name="customurl-edit" value="<?php the_field( 'profile_add_url', 'user_' . $this_user->ID ); ?>" maxlength="140">
</div>

<div class="king-form-group">
		<label for="edit-about"><?php esc_attr_e( 'About', 'king' ); ?></label>
		<textarea name="edit-about" id="edit-about" class="bptextarea" rows="4" cols="50" maxlength="1000"><?php the_author_meta( 'description', $this_user->ID ); ?></textarea>
</div>
<p>
		<input type="submit" id="king-submitbutton" class="king-submit-button" name="save-edit" value="Save">
</p>
</form>
</div>
</main>
</div>

<?php get_footer(); ?>
