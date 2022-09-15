<?php /* Inkludera sidhuvudet */ get_header(); ?>
<?php
    // The loop
    if ( have_posts() ) :
        // Loopa igenom inläggen
        while ( have_posts() ) :
            // Hämta inlägget
            the_post();
?>
<!--"Headerbild"-->
<div id="header-image">
    <section id="welcome">
        <h1><?php /* Skriv ut rubriken */ the_title(); ?></h1>
    </section>
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
<!-- Innehåll -->
<div id="main-content">
    <!-- Välkomsttext -->
    <div id="front-page-text">
        <?php
                // Lagra innehållet i en variabel
                $content = get_the_content();
                $link    = '';
                $h2      = '';
                // Om det finns en länk, extrahera den
                if ( strpos( $content, '<a' ) ) {
                    $link = substr( $content, strpos( $content, '<a' ), strpos( $content, '</a>' ) );
                }
                // Extrahera textinnehållet före länken
                if ( $link ) {
                    $content = substr( $content, 0, strpos( $content, $link ) );
                }
                // Om det finns en underrubrik, extrahera den
                if ( strpos( $content, '<h2' ) ) {
                    $h2 = substr( $content, strpos( $content, '<h2' ), strpos( $content, '</h2>' ) );
                }
                // Extrahera textinnehållet före underrubriken
                if ( $h2 ) {
                    $content = substr( $content, 0, strpos( $content, $h2 ) );
                }
                // Skriv ut textinnehållet
                echo $content;
            endwhile;
        endif;
        ?>
        <!-- Läs-mer-länk -->
        <div class="find-out-more">
            <a href="
                <?php 
                    $permalink_about = get_the_permalink( '51' ); 
                    /* Sökväg till "Om oss" */ echo esc_attr( $permalink_about ); 
                ?>
            ">Läs mer</a>
        </div>
    </div>
    <!-- Kommande aktiviteter/widgetområde -->
    <section id="upcoming-events">
        <?php
            // Skriv ut underrubriken om den finns
            if ( $h2 ) {
                echo $h2;
            }
        ?>
        <?php /* Inkludera widgetområdet om det innehåller widgets */ get_sidebar( 'widget-area' ); ?>
        <p class="blog-link">
            <?php
                // Skriv ut länken om den finns, ta bort p-stängningstaggen
                if ( $link ) {
                    if ( strpos( $link, '</p>' ) ) {
                        $link = substr( $link, 0, strpos( $link, '</p>' ) );
                        echo $link;
                    }
                }
            ?>
        </p>
    </section>
    <!-- De tre senaste nyhetsinläggen -->
    <section id="recent-news">
        <h2 class="h2-home">Senaste nytt</h2>
        <div>
            <?php
                // The loop
                // Eftersom startsidan är en statisk sida (Nyheter är inläggssida)
                // Begränsa till nyheter
                $query2 = new WP_Query( array(
                    'category_name' => 'Nyheter',
                    'posts_per_page' => 3 ) );
                if ( $query2->have_posts() ) :
                    // Loopa igenom inläggen
                    while ( $query2->have_posts() ) :
                        // Hämta inlägget
                        $query2->the_post();
            ?>
            <!-- Inlägg -->
            <article class="news-article">
                <h3 class="h3-article"><?php /* Skriv ut rubriken */ the_title(); ?></h3>
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
                    <?php /* Skriv ut inlägget i avkortad form */ the_excerpt(); ?>
                    <div class="find-out-more">
                        <a href="<?php /* Länk till inlägget i helhet */ the_permalink(); ?>">Läs mer</a>
                    </div>
                </div>
            </article>
            <?php
                endwhile;
            endif;
            ?>
        </div>
        <p class="blog-link">
            <a href="
                <?php 
                    $permalink_news = get_the_permalink( '20' );
                    /* Sökväg till Nyheter */ echo esc_attr( $permalink_news ); 
                ?> 
            ">Alla nyheter</a>
        </p>
    </section>
</div>
<!-- Sidfot -->
<?php /* Inkludera sidfoten */ get_footer(); ?>