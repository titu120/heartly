<?php
get_header();
global $heartly_option;
$post_id   = get_the_id();
$author_id = get_post_field( 'post_author', $post_id );

// Per-post layout (2left, 2right, or empty = full)
$page_layout = get_post_meta( $post_id, 'layout', true );
$col_side   = '12';
$col_left   = '';
$show_sidebar = false;
if ( $page_layout === '2left' || $page_layout === '2right' ) {
    $col_side     = '8';
    $col_left     = $page_layout === '2left' ? 'left-sidebar' : 'right-sidebar';
    $show_sidebar = is_active_sidebar( 'sidebar-1' );
}

$is_elementor = false;
if ( is_singular() && isset( $post ) && class_exists( '\Elementor\Plugin' ) && is_a( \Elementor\Plugin::$instance, '\Elementor\Plugin' ) ) {
    $doc = \Elementor\Plugin::$instance->documents->get( $post->ID );
    if ( $doc && $doc->is_built_with_elementor() ) {
        $is_elementor = true;
    }
}

if ( $is_elementor ) : ?>
<div class="container-fluid custom-container">
<?php else : ?>
<div class="container">
<?php endif; ?>

<?php if ( ! $is_elementor ) : ?>
    <section class="news-standard-section section-padding">
        <div class="container">
            <div class="news-details-area">
                <div class="row g-4">
                    <div class="col-12 col-lg-<?php echo esc_attr( $col_side ); ?> <?php echo esc_attr( $col_left ); ?> <?php echo ( $page_layout === '2left' ) ? 'order-1 order-lg-2' : ''; ?>">
                        <div class="blog-post-details">
                            <?php
                            while ( have_posts() ) :
                                the_post();
                                $first_name = get_the_author_meta( 'first_name', $author_id );
                                $last_name  = get_the_author_meta( 'last_name', $author_id );
                                $author_name = ( $first_name && $last_name ) ? $first_name . ' ' . $last_name : get_the_author();
                                $categories = get_the_category();
                                $cat_name   = ! empty( $categories ) ? $categories[0]->name : '';
                            ?>
                            <div class="single-blog-post">
                                <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-featured-thumb fix">
                                    <?php the_post_thumbnail( 'full' ); ?>
                                </div>
                                <?php endif; ?>
                                <div class="post-content">
                                    <ul class="post-list d-flex align-items-center list-unstyled ms-0 ">
                                        <li>
                                            <i class="fa-regular fa-user"></i>
                                            <?php echo esc_html( $author_name ); ?>
                                        </li>
                                        <li>
                                            <i class="fa-solid fa-calendar-days"></i>
                                            <?php echo get_the_date(); ?>
                                        </li>
                                        <?php if ( $cat_name ) : ?>
                                        <li>
                                            <i class="fa-solid fa-tag"></i>
                                            <?php echo esc_html( $cat_name ); ?>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                    <h2><?php the_title(); ?></h2>
                                    <div class="entry-content">
                                        <?php
                                        the_content();
                                        wp_link_pages( array(
                                            'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'heartly' ),
                                            'after'       => '</div>',
                                            'link_before' => '<span class="page-number">',
                                            'link_after'  => '</span>',
                                        ) );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row tag-share-wrap mt-4 mb-5">
                                <div class="col-lg-8 col-12">
                                    <?php if ( has_tag() ) : ?>
                                    <div class="tagcloud">
                                        <?php the_tags( '', '', '' ); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-4 col-12 mt-3 mt-lg-0 text-lg-end">
                                    <div class="social-share">
                                        <span class="me-3"><?php esc_html_e( 'Share:', 'heartly' ); ?></span>
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( get_permalink() ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                                        <a href="https://twitter.com/intent/tweet?url=<?php echo esc_url( get_permalink() ); ?>&text=<?php echo esc_attr( get_the_title() ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( get_permalink() ); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $author_meta = get_the_author_meta( 'description', $author_id );
                            if ( ! empty( $author_meta ) ) :
                            ?>
                            <div class="author-block">
                                <div class="author-img"><?php echo get_avatar( $author_id, 200 ); ?></div>
                                <div class="author-desc">
                                    <h3 class="author-title"><?php the_author(); ?></h3>
                                    <p><?php echo wp_kses_post( wpautop( $author_meta ) ); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php
                            if ( ( empty( $heartly_option['blog-comments'] ) || $heartly_option['blog-comments'] === 'show' ) && ( comments_open() || get_comments_number() ) ) {
                                comments_template();
                            }
                            ?>
                            <?php
                            endwhile;
                            ?>
                        </div>
                    </div>
                    <?php if ( $show_sidebar ) { get_sidebar( 'single' ); } ?>
                </div>
            </div>
        </div>
    </section>
<?php else : ?>
    <!-- Elementor-built single: keep original structure -->
    <div class="themephi-blog-details pt-70 pb-70">
        <div class="row padding-<?php echo esc_attr( $col_left ); ?>">
            <div class="col-lg-<?php echo esc_attr( $col_side ); ?> <?php echo esc_attr( $col_left ); ?>">
                <div class="news-details-inner">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                        <div class="bs-img"><?php the_post_thumbnail(); ?></div>
                        <?php endif; ?>
                        <?php get_template_part( 'template-parts/post/content', get_post_format() ); ?>
                        <div class="clear-fix"></div>
                    </article>
                    <?php
                    $author_meta = get_the_author_meta( 'description' );
                    if ( ! empty( $author_meta ) ) :
                    ?>
                    <div class="author-block">
                        <div class="author-img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 200 ); ?></div>
                        <div class="author-desc">
                            <h3 class="author-title"><?php the_author(); ?></h3>
                            <p><?php echo wp_kses_post( wpautop( $author_meta ) ); ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php
                    if ( ( empty( $heartly_option['blog-comments'] ) || $heartly_option['blog-comments'] === 'show' ) && ( comments_open() || get_comments_number() ) ) {
                        comments_template();
                    }
                    endwhile;
                    ?>
                </div>
            </div>
            <?php if ( $show_sidebar ) { get_sidebar( 'single' ); } ?>
        </div>
    </div>
<?php endif; ?>
</div>
<?php
get_footer();
