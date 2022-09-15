<?php /* Inkludera sidhuvudet */ get_header(); ?>
<?php
    // Lagra kategorin
    $cat_arr = get_the_category();
    $category = wp_list_pluck( $cat_arr, 'cat_name' );
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
<!-- Nyhet -->
<section id="news">
    <div>
        <!-- Inlägg -->
        <article>
            <?php
                // Lagra innehållet i en variabel
                $content = get_the_content();
                // Dela upp i en array med "stycken"
                $text = explode( '<p>', $content ); 
                $return1 = '';
                $return2 = '';
                $return3 = '';
                // Om detta är ett nyhetsinlägg
                if ( $category[0] == 'Nyheter' ) {
                    // Loopa igenom alla stycken
                    foreach ( $text as $paragraph ) {
                        if ( strpos( $paragraph, '<figure' ) ) {
                            $return1 .= substr( $paragraph, 0, strpos( $paragraph, '<figure' ) );
                            $return2 .= substr( $paragraph, strpos( $paragraph, '<figure' ) );
                        } else {
                            $return1 .= '<p>' . $paragraph;
                        }
                    }
            ?>
            <div class="single-right">
                <?php
                    // Om inlägget har en utvald bild
                    if ( has_post_thumbnail() ) {
                        // Skriv ut bilden, lägg till klass för responsivitet
                        the_post_thumbnail( 'mobil', array(
                            'class' => 'img-mobile',
                        ) );
                        the_post_thumbnail( 'desktop', array(
                            'class' => 'img-desktop',
                        ) );
                    }

                    if ( $return2 ) {
                        echo $return2;
                    }
                ?>
            </div>
            <div class="single-left single-text">
                <?php
                    // Skriv ut
                    if ( $return1 ) {
                        echo $return1;
                    }
                ?>
            </div>
            <?php
                // Om aktivitet eller rum
                } else {
                    // Ny rad
                    echo '<div class="row">';
            ?>  
            <div class="single-left">
                <?php
                    // Om inlägget har en utvald bild
                    if ( has_post_thumbnail() ) {
                        // Skriv ut bilden, lägg till klass för responsivitet
                        the_post_thumbnail( 'mobil', array(
                            'class' => 'img-mobile',
                        ) );
                        the_post_thumbnail( 'desktop', array(
                            'class' => 'img-desktop',
                        ) );
                    }
                ?>
            </div>
            <?php
                // Höger eller vänster beroende på om det är en lista, text eller en bild
                $return1 = '<div class="single-right">';
                $return2 = '<div class="single-left single-text">';
                $return3 = '<div class="single-right">';
                // Loopa igenom "styckena"
                foreach ( $text as $paragraph ) {
                    // Om det finns en lista
                    if ( strpos( $paragraph, '<ul>' ) ) {
                        // Extrahera den, lägg till bokningsknappen samt CSS-klasser
                        $return1 .= '<div class="summary">' . $paragraph .
                        '<button class="find-out-more">Boka nu</button></div></div></div>';
                    // Om det finns en bild
                    } elseif ( strpos( $paragraph, '<figure' ) ) {
                        // Extrahera texten före bilden
                        $return2 .= '<p>' . substr( $paragraph, 0, strpos( $paragraph, '<figure' ) ) .
                        '</div>';
                        // Extrahera bilden
                        $return3 .= substr( $paragraph, strpos( $paragraph, '<figure' ) ) . '</div>';
                    // Om det är text
                    } else {
                        // Extrahera texten
                        $return2 .= '<p>' . $paragraph;
                    }
                }
                // Skriv ut listan om den finns
                if ( $return1 ) {
                    echo $return1;
                }
                // Skriv ut texten
                if ( $return2 ) {
                    echo $return2;
                }
                // Skriv ut bilden om den finns
                if ( $return3 ) {
                    echo $return3;
                }
            }
            ?>
        </article>
    </div>
    <?php
        endwhile;
    endif;
    ?>
</section>
<!-- Sidfot -->
<?php /* Inkludera sidfoten */ get_footer(); ?>