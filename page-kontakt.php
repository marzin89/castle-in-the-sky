<?php /* Inkludera sidhuvudet */ get_header(); ?>
<?php 
    // The loop
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
<!-- Kontaktformulär -->
<section id="contact-form">
    <?php
        // Skriv ut innehållet
        the_content();
    ?>  
</section>
<?php
    endwhile;
endif;
?>
<!-- Presentation av ledningsgruppen -->
<section id="staff">
    <?php
        $count = 0;
        // Eftersom startsidan är en statisk sida (Nyheter är inläggssida)
        // Begränsa till medarbetare
        $query = new WP_Query( array(
            'category_name' => 'Medarbetare',
            'posts_per_page' => 6,
        ) );
        if ( $query->have_posts() ) :
            // Loopa igenom inläggen
            while ( $query->have_posts() ) :     
                // Hämta inlägget
                $query->the_post();
                // Öppningstagg första och fjärde inlägget p.g.a. tre spalter på desktop
                if ( ! $count || $count == 3 ) {
                    echo '<div class="row">';
    ?>
    <div class="employee">
        <?php
            // Om inlägget har en utvald bild
            if ( has_post_thumbnail() ) {
                // Skriv ut bilden, lägg till klass
                the_post_thumbnail( 'employee-img-mobil', array(
                    'class' => 'employee-img-mobile',
                ) );
                the_post_thumbnail( 'employee-img-tablet', array(
                    'class' => 'employee-img-tablet',
                ) );
                the_post_thumbnail( 'employee-img-desktop', array(
                    'class' => 'employee-img-desktop',
                ) );
            }
            // Skriv ut innehållet
            the_content();
        ?>
    </div>
    <?php
        // Stängningstagg om antalet inlägg är mindre än 6 och det aktuella inlägget är det sista
        if ( count_posts( 'Medarbetare' ) < 6 && $count == ( count_posts( 'Medarbetare' ) - 1 ) ) {
            echo '</div>';
        }
    // Andra och femte inlägget
    } elseif ( $count == 1 || $count == 4 ) {
    ?>
    <div class="employee">
        <?php
            // Om inlägget har en utvald bild
            if ( has_post_thumbnail() ) {
                // Skriv ut bilden, lägg till klass
                the_post_thumbnail( 'employee-img-mobil', array(
                    'class' => 'employee-img-mobile',
                ) );
                the_post_thumbnail( 'employee-img-tablet', array(
                    'class' => 'employee-img-tablet',
                ) );
                the_post_thumbnail( 'employee-img-desktop', array(
                    'class' => 'employee-img-desktop',
                ) );
            }
            // Skriv ut innehållet
            the_content();
        ?>
    </div>
    <?php
        // Stängningstagg om antalet inlägg är mindre än 6 och det aktuella inlägget är det sista
        if ( count_posts( 'Medarbetare' ) < 6 && $count == ( count_posts( 'Medarbetare' ) - 1 ) ) {
            echo '</div>';
        }
    // Tredje och sista inlägget
    } elseif ( $count == 2 || $count == 5 ) {
    ?>
    <div class="employee">
        <?php
            // Om inlägget har en utvald bild
            if ( has_post_thumbnail() ) {
                // Skriv ut bilden, lägg till klass
                the_post_thumbnail( 'employee-img-mobil', array(
                    'class' => 'employee-img-mobile',
                ) );
                the_post_thumbnail( 'employee-img-tablet', array(
                    'class' => 'employee-img-tablet',
                ) );
                the_post_thumbnail( 'employee-img-desktop', array(
                    'class' => 'employee-img-desktop',
                ) );
            }
            // Skriv ut innehållet
            the_content();
        ?>
    </div>
    <?php
            echo '</div>';
        }
            $count++;
        endwhile;
    endif;
    ?>
</section>
<!-- Sidfot -->
<?php /* Inkludera sidfoten */ get_footer(); ?>