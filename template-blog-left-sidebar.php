<?php
/**
 * Template Name: Blog Left Sidebar
 * Description: Blog listing with sidebar on the left (matches HTML news-left-sidebar).
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
?>

<section class="news-standard-section section-padding">
    <div class="container">
        <div class="gt-news-standard-wrapper">
            <div class="row g-4">
                <?php if ( $show_sidebar ) : ?>
                <div class="col-lg-4 col-12 order-2 order-lg-1">
                    <?php get_sidebar(); ?>
                </div>
                <?php endif; ?>
                <div class="col-12 <?php echo esc_attr( $show_sidebar ? 'col-lg-8 order-1 order-lg-2' : '' ); ?>">
                    <div class="gt-news-standard-items">
                        <?php
                        if ( $blog_q->have_posts() ) :
                            $post_count = 0;
                            $total      = $blog_q->post_count;
                            $read_more_text = ! empty( $heartly_option['blog_readmore'] ) ? $heartly_option['blog_readmore'] : __( 'Read More', 'heartly' );
                            while ( $blog_q->have_posts() ) :
                                $blog_q->the_post();
                                $post_count++;
                                $is_last    = ( $post_count === $total );
                                $card_class = 'gt-news-card-items-4' . ( $is_last ? ' mb-0' : '' );
                                $comments_count = get_comments_number();
                        ?>
                        <div class="<?php echo esc_attr( $card_class ); ?>">
                            <div class="gt-news-image">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full' ); ?></a>
                                <?php else : ?>
                                    <?php
                                    $placeholder = 'data:image/svg+xml,' . rawurlencode( '<svg xmlns="http://www.w3.org/2000/svg" width="800" height="500" viewBox="0 0 800 500"><rect fill="#e8e8e8" width="800" height="500"/><text fill="#999" font-family="sans-serif" font-size="24" x="50%" y="50%" text-anchor="middle" dy=".3em">No image</text></svg>' );
                                    ?>
                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_attr( $placeholder ); ?>" alt="<?php the_title_attribute(); ?>"></a>
                                <?php endif; ?>
                            </div>
                            <div class="gt-news-content">
                                <ul class="gt-date-list list-unstyled">
                                    <li>
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <?php echo get_the_date(); ?>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-comments"></i>
                                        <?php echo absint( $comments_count ); ?> <?php echo _n( 'Comment', 'Comments', $comments_count, 'heartly' ); ?>
                                    </li>
                                </ul>
                                <h2 class="news-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <p><?php echo heartly_custom_excerpt( 30 ); ?></p>
                                <a href="<?php the_permalink(); ?>" class="theme-btn">
                                    <?php echo esc_html( $read_more_text ); ?> <i class="fa-regular fa-arrow-up-right"></i>
                                </a>
                            </div>
                        </div>
                        <?php
                            endwhile;
                        ?>
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
    </div>
</section>

<?php
get_footer();
