<?php
/**
 * The privacy policy page template file in WordPress theme
 *
 */

get_header();

?>

<style>
    main  h1,
    main  h2,
    main  h3,
    main  h4,
    main  h5,
    main  h6 {
        color: grey;
        font-family: Roboto, sans-serif;
        text-transform: capitalize;
        font-weight: normal;
    }
    main h1 + *,
    main h2 + *,
    main h3 + *,
    main h4 + *,
    main h5 + *,
    main h6 + * {
        margin-top: 1.5rem;
    }
</style>

<div class="ui section hidden divider"></div>

<!-- Main Content -->
<main>
    <div class="container">

        <?php
            get_template_part( 'template-parts/parts/title', null, array(
                'title' => get_the_title(),
            ) );
        ?>

        <div class="ui hidden divider"></div>

        <?php the_content(); ?>

    </div>

    <div class="ui hidden section divider"></div>

</main>
<!-- End Main Content -->

<?php

get_footer();

?>
