<?php /* Inkludera sidhuvudet */ get_header(); ?>
<?php
    // Oförändrad the loop
    if ( have_posts() ) :
        // Loopa igenom inläggen
        while ( have_posts() ) :
            // Hämta inlägget
            the_post();
?>
<!-- Headerbild -->
<div id="header-image">
    <h1><?php /* Skriv ut rubriken */ the_title(); ?></h1>
</div>
<!-- Språkval -->
<div id="language-picker">
    <select name="languages" id="languages">
        <option value="SV">SV</option>
        <option value="EN">EN</option>
        <option value="DE">DE</option>
        <option value="FR">FR</option>
        <option value="ES">ES</option>
    </select>
</div>
<section id="news">
    <!-- Inlägg/sida -->
    <article>
        <?php
            // Om inlägget har en utvald bild
            if ( has_post_thumbnail() ) {
                // Skriv ut bilden, lägg till klass
                the_post_thumbnail( 'mobile', array(
                    'class' => 'img-mobile',
                ) );
                the_post_thumbnail( 'desktop', array(
                    'class' => 'img-desktop',
                ) );
            }
        ?>
        <div class="excerpt">
            <p class="date"><?php /* Skriv ut datumet */ the_date(); ?></p>
            <?php /* Skriv ut innehållet */ the_content(); ?>
        </div>
    </article>
    <?php
        endwhile;
    endif;
    ?>
</section>
<!-- Sidfot -->
<?php /* Inkludera sidfoten */ get_footer(); ?>