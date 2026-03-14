<?php
get_header();
global $heartly_option;
?>

    <?php
    // Blog layout options
    $col         = '';
    $blog_layout = '';
    $layout      = '';
    $show_sidebar = true;

    if ( ! empty( $heartly_option['blog-layout'] ) || ! is_active_sidebar( 'sidebar-1' ) ) {
        $blog_layout = ! empty( $heartly_option['blog-layout'] ) ? $heartly_option['blog-layout'] : '';
        if ( $blog_layout == 'full' || ! is_active_sidebar( 'sidebar-1' ) ) {
            $layout       = 'full-layout';
            $show_sidebar = false;
        } elseif ( $blog_layout == '2left' ) {
            $layout = 'full-layout-left';
        } elseif ( $blog_layout == '2right' ) {
            $layout = 'full-layout-right';
        } else {
            $layout = '';
        }
    }

    $content_col_class = $show_sidebar ? 'col-12 col-lg-8' : 'col-12';
    $content_order     = ( $layout === 'full-layout-left' ) ? 'order-1 order-lg-2' : '';
    $sidebar_order     = ( $layout === 'full-layout-left' ) ? 'order-2 order-lg-1' : '';
    ?>

    <section class="news-standard-section section-padding">
        <div class="container">
            <div class="gt-news-standard-wrapper">
                <div class="row g-4">
                    <div class="<?php echo esc_attr( $content_col_class ); ?> <?php echo esc_attr( $content_order ); ?>">
                        <div class="gt-news-standard-items">
                            <?php
                            if ( have_posts() ) :
                                $post_count = 0;
                                $total      = $wp_query->post_count;
                                while ( have_posts() ) :
                                    the_post();
                                    $post_count++;
                                    $is_last = ( $post_count === $total );
                                    $card_class = 'gt-news-card-items-4' . ( $is_last ? ' mb-0' : '' );
                                    $comments_count = get_comments_number();
                                    $read_more_text = ! empty( $heartly_option['blog_readmore'] ) ? $heartly_option['blog_readmore'] : __( 'Read More', 'heartly' );
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
                                $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
                                $max   = $wp_query->max_num_pages;
                                if ( $max > 1 ) {
                                    echo '<ul>';
                                    // Previous
                                    if ( $paged > 1 ) {
                                        echo '<li><a class="page-numbers" href="' . esc_url( get_pagenum_link( $paged - 1 ) ) . '"><i class="fa-solid fa-arrow-up-left"></i></a></li>';
                                    }
                                    // Page numbers
                                    for ( $i = 1; $i <= $max; $i++ ) {
                                        $active = ( (int) $i === (int) $paged ) ? ' active' : '';
                                        echo '<li class="' . esc_attr( trim( $active ) ) . '"><a class="page-numbers" href="' . esc_url( get_pagenum_link( $i ) ) . '">' . sprintf( '%02d', $i ) . '</a></li>';
                                    }
                                    // Next
                                    if ( $paged < $max ) {
                                        echo '<li><a class="page-numbers" href="' . esc_url( get_pagenum_link( $paged + 1 ) ) . '"><i class="fa-solid fa-arrow-up-right"></i></a></li>';
                                    }
                                    echo '</ul>';
                                }
                                ?>
                            </div>
                            <?php
                            else :
                                get_template_part( 'template-parts/content', 'none' );
                            endif;
                            ?>
                        </div>
                    </div>
                    <?php if ( $show_sidebar ) : ?>
                    <div class="col-lg-4 col-12 <?php echo esc_attr( $sidebar_order ); ?>">
                        <?php get_sidebar(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php
get_footer();
