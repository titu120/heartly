<?php
/**
 * Template Name: Blog Grid Left Sidebar
 * Description: Blog listing in grid layout with sidebar on the left (matches HTML news-grid-left-sidebar).
 */
get_header();
global $heartly_option;

$paged    = max( 1, get_query_var( 'paged' ) );
$blog_q   = new WP_Query( array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'paged'          => $paged,
	'posts_per_page' => get_option( 'posts_per_page' ),
) );

$show_sidebar = is_active_sidebar( 'sidebar-1' );
$read_more_text = ! empty( $heartly_option['blog_readmore'] ) ? $heartly_option['blog_readmore'] : __( 'Read more', 'heartly' );
?>

<section class="grt-news-section section-padding">
	<div class="container">
		<div class="row g-4">
			<?php if ( $show_sidebar ) : ?>
			<div class="col-lg-4 col-12 order-2 order-lg-1">
				<?php get_sidebar(); ?>
			</div>
			<?php endif; ?>
			<div class="col-12 <?php echo $show_sidebar ? 'col-lg-8 order-1 order-lg-2' : ''; ?>">
				<div class="row g-4">
					<?php
					if ( $blog_q->have_posts() ) :
						$delay = 0;
						while ( $blog_q->have_posts() ) :
							$blog_q->the_post();
							$delay_attr = ( $delay % 3 === 0 ) ? '.3s' : ( ( $delay % 3 === 1 ) ? '.5s' : '.7s' );
							$delay++;
							$categories = get_the_category();
							$cat_link   = ! empty( $categories[0] ) ? get_category_link( $categories[0]->term_id ) : get_permalink();
							$cat_name   = ! empty( $categories[0] ) ? $categories[0]->name : __( 'Blog', 'heartly' );
					?>
					<div class="col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="<?php echo esc_attr( $delay_attr ); ?>">
						<div class="grt-news-box-items mt-0 section-bg-2">
							<div class="grt-thumb">
								<?php if ( has_post_thumbnail() ) : ?>
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full' ); ?></a>
								<?php else : ?>
									<?php
									$placeholder = 'data:image/svg+xml,' . rawurlencode( '<svg xmlns="http://www.w3.org/2000/svg" width="800" height="500" viewBox="0 0 800 500"><rect fill="#e8e8e8" width="800" height="500"/><text fill="#999" font-family="sans-serif" font-size="24" x="50%" y="50%" text-anchor="middle" dy=".3em">No image</text></svg>' );
									?>
									<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_attr( $placeholder ); ?>" alt="<?php the_title_attribute(); ?>"></a>
								<?php endif; ?>
							</div>
							<div class="grt-content">
								<div class="tag-items">
									<a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $cat_name ); ?></a>
									<span class="date"><?php echo get_the_date(); ?></span>
									<div class="dotss"></div>
									<span class="date"><?php echo esc_html__( 'By', 'heartly' ); ?> <?php the_author(); ?></span>
								</div>
								<h2 class="title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>
								<a href="<?php the_permalink(); ?>" class="news-btn">
									<span class="text">
										<span class="text-default"><?php echo esc_html( $read_more_text ); ?>  <i class="fa-regular fa-arrow-up-right"></i></span>
										<span class="text-hover"><?php echo esc_html( $read_more_text ); ?>  <i class="fa-regular fa-arrow-up-right"></i></span>
									</span>
								</a>
							</div>
						</div>
					</div>
					<?php
						endwhile;
					?>
					<div class="col-12">
						<div class="page-nav-wrap text-center">
							<?php
							$max  = $blog_q->max_num_pages;
							$base = get_permalink( get_queried_object_id() );
							if ( $max > 1 ) {
								echo '<ul>';
								if ( $paged > 1 ) {
									echo '<li><a class="page-numbers" href="' . esc_url( add_query_arg( 'paged', $paged - 1, $base ) ) . '"><i class="fa-solid fa-arrow-up-left"></i></a></li>';
								}
								for ( $i = 1; $i <= $max; $i++ ) {
									$active = ( (int) $i === (int) $paged ) ? ' active' : '';
									$link   = ( 1 === $i ) ? $base : add_query_arg( 'paged', $i, $base );
									echo '<li class="' . esc_attr( trim( $active ) ) . '"><a class="page-numbers" href="' . esc_url( $link ) . '">' . sprintf( '%02d', $i ) . '</a></li>';
								}
								if ( $paged < $max ) {
									echo '<li><a class="page-numbers" href="' . esc_url( add_query_arg( 'paged', $paged + 1, $base ) ) . '"><i class="fa-solid fa-arrow-up-right"></i></a></li>';
								}
								echo '</ul>';
							}
							?>
						</div>
					</div>
					<?php
						wp_reset_postdata();
					else :
						get_template_part( 'template-parts/content', 'none' );
					endif;
					?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
