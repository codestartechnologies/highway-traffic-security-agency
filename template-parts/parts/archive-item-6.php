<div class="htsa-vertical-posts">
    <?php while( have_posts() ) : the_post(); ?>
        <div class="row flex-column flex-md-row align-items-center pb-3 mb-5 g-3 g-lg-5">
            <div class="col-md-4">
                <a href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <img src="<?php the_post_thumbnail_url( 'medium' ); ?>" alt="" class="img-fluid" />
                    <?php else : ?>
                    <img src="<?php echo WTS_THEME_URI . 'assets/images/image.png'; ?>" alt="" class="img-fluid" />
                    <?php endif; ?>
                </a>
            </div>
            <div class="col-md-8">
                <h1 class="fs-4 fw-normal text-capitalize">
                    <a href="<?php the_permalink(); ?>" class="link-dark"> <?php the_title(); ?> </a>
                </h1>
                <small class="text-muted text-uppercase"> <?php echo get_post_type_object( get_post_type() )->labels->singular_name; ?> </small>
                <p> <?php echo wts_get_the_excerpt( null, 26 ); ?> </p>
                <div>
                    <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-dark text-capitalize rounded-0">
                        <?php esc_html_e( 'see post', 'htsa' ); ?>
                    </a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>