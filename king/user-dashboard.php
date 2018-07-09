<?php
/**
 * User following users posts page.
 *
 * @package King
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$profile_id = get_query_var( 'profile_id' );
if ( $profile_id ) {
	$this_user = get_user_by( 'login',$profile_id );
} else {
	$this_user = wp_get_current_user();
}
if ( ! $this_user->ID ) {
	wp_redirect(site_url());
}
?>
<?php get_header(); ?> 

<div class="king-dashboard-user">
	<div class="king-dashboard-avatar">
		<a href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_account'] ); ?>">
			<?php if ( get_field( 'author_image','user_' . $this_user->ID ) ) : $image = get_field( 'author_image','user_' . $this_user->ID ); ?>
				<img src="<?php echo esc_url( $image['sizes']['thumbnail'] ); ?>" alt=""/>
			<?php endif; ?>
		</a>
	</div>
	<div class="king-dashboard-username">
		<a href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_account'] ); ?>">
			<h4><?php echo esc_attr( $this_user->data->display_name ); ?></h4>
		</a>
		<?php echo esc_html_e( ' / Following Users Posts', 'king' ); ?> 
	</div>
</div>

<div id="primary" class="profile-content-area">
	<main id="main" class="profile-site-main">
		<div class="king-user-posts king-grid">
			<div class="row">                        
				<?php
				$followingusers = array();
				$user_query = new WP_User_Query( array(
					'meta_query' => array(
						array(
							'key' => 'wp__user_followd',
							'value' => '"user-' . $this_user->ID . '";i:' . $this_user->ID . ';',
							'compare' => 'LIKE',
							),
					),
					)
				);
				if ( ! empty( $user_query->results ) ) :
					foreach ( $user_query->results as $user ) {
						$followingusers[] = $user->ID;
					}

					$paged = isset( $_GET['page'] ) ? $_GET['page'] : 0 ;
					if ( get_field( 'length_of_users_dashboard', 'options' ) ) {
						$length_dashboard = get_field( 'length_of_users_dashboard', 'option' );
					} else {
						$length_dashboard = '10';
					}
					$the_query = new WP_Query( array(
						'posts_per_page' => $length_dashboard,
						'post_type' => 'post',
						'author__in' => $followingusers,
						'paged' => $paged,
						'post__not_in' => get_option( 'sticky_posts' ),
					) );

					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						get_template_part( 'template-parts/content', 'profile-post' );
					}
					wp_reset_postdata();
					;else : ?>
					<div class="no-follower"><i class="fa fa-slack fa-2x" aria-hidden="true"></i><?php esc_html_e( 'not following anyone yet', 'king' ); ?> </div>
				<?php endif; ?>	


			</div>
			<?php if ( ! empty( $user_query->results ) ) : ?>
				<div class="king-pagination">
					<?php
					$format = '?page=%#%';
					if ( $profile_id ) {
						$url = site_url() . '/' . $GLOBALS['king_dashboard'] . '/' . $profile_id . '%_%';
					} else {
						$url = site_url() . '/' . $GLOBALS['king_dashboard'] . '%_%';
					}
							$big = 999999999; // need an unlikely integer.
							echo paginate_links( array(
								'base' => $url,
								'format' => $format,
								'current' => max( 1, $paged ),
								'total' => $the_query->max_num_pages,
								'prev_next'    => true,
								'prev_text'          => '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
								'next_text'          => '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
							) );
								?>
							</div>
						<?php endif; ?>	
					</div>
				</main><!-- #main -->
			</div><!-- #primary -->

<?php get_footer(); ?>
