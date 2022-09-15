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
    <h1>
        <?php
                // Skriv ut rubriken
                the_title();
            endwhile;
        endif;
        ?>
    </h1>
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
<!-- Bokningsformulär -->
<section id="booking-form">
    <p id="form-text">Välj antal rum och datum för ankomst 
        och avresa. Välj sedan antal vuxna 
        och barn per rum. Klicka på "Se rum och 
        priser" för att se lediga rum. </p>
    <?php /* Skriv ut innehållet */ the_content(); ?>
</section>
<!-- Rum -->
<section id="rooms">
    <?php
        $count = 0;
        // The loop
        // Eftersom startsidan är en statisk sida (Nyheter är inläggssida)
        // Begränsa till rum
        $query = new WP_Query( array(
            'category_name' => 'Bo',
        ) );
        if ( $query->have_posts() ) :
            // Loopa igenom inläggen
            while ( $query->have_posts() ) :
                // Vartannat inlägg i varannan kolumn p.g.a. två kolumner på desktop:
                if ( $count % 2 == 0 ) {
                    // Hämta inlägget
                    $query->the_post();
                    echo '<div class="row">';
    ?>
    <!-- Rum (vänster) -->
    <div class="room-left">
        <h2 class="h2-articles"><?php /* Skriv ut rubriken */ the_title(); ?></h2>
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
            <div class="summary">
                <?php
                    // Lagra innehållet i en variabel
                    $content = get_the_content();
                    $list    = '';
                    $length  = '';
                    // Kontrollera om det finns en lista och extrahera den
                    if ( strpos( $content, '<ul>' ) ) {
                        $length =  strpos( $content, '</ul>' ) - strpos( $content, '<ul>' );
                        $list   =  substr( $content, strpos( $content, '<ul>' ), $length );
                        $list   .= '</ul>';
                    }
                    // Skriv ut listan om den finns
                    if ( $list !== '' ) {
                        echo $list;
                    } else {
                        // Skriv annars ut ett utdrag
                        the_excerpt();
                    }
                ?>
                <div class="find-out-more">
                    <a href="<?php /* Länk till inlägget i helhet */ the_permalink(); ?>">Läs mer</a>
                </div>
            </div>
        </article>
    </div>
    <?php
        /* Stängningstagg om mindre än fyra inlägg finns och det sista inlägget 
        hamnar till vänster */
        if ( count_posts( 'Bo' ) < 4 && $count == ( count_posts( 'Bo' ) - 1 ) ) {
            echo '</div>';
        // Stängningstagg efter det sista inlägget om fler än fem inlägg finns
        } elseif ( count_posts( 'Bo' ) >= 4 && $count >= 4 ) {
            echo '</div>';
        }
    } elseif ( $count % 2 !== 0 ) {
        // Hämta inlägget
        $query->the_post();
    ?>
    <!-- Rum (höger) -->
    <div class="room-right">
        <h2 class="h2-articles"><?php /* Skriv ut rubriken */ the_title(); ?></h2>
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
            <div class="summary">
                <?php
                    // Lagra innehållet i en variabel
                    $content = get_the_content();
                    $list    = '';
                    $length  = '';
                    // Kontrollera om det finns en lista och extrahera den
                    if ( strpos( $content, '<ul>' ) ) {
                        $length =  ( strpos( $content, '</ul>' ) ) - ( strpos( $content, '<ul>' ) );
                        $list   =  substr( $content, strpos( $content, '<ul>' ), $length );
                        $list   .= '</ul>';
                    }
                    // Skriv ut listan om den finns
                    if ( $list !== '' ) {
                        echo $list;
                    } else {
                        // Skriv annars ut ett utdrag
                        the_excerpt();
                    }
                ?>
                <div class="find-out-more">
                    <a href="<?php /* Länk till inlägget i helhet */ the_permalink(); ?>">Läs mer</a>
                </div>
            </div>
        </article>
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