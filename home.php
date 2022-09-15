<?php /* Inkludera sidhuvudet */ get_header(); ?>
<!--"Headerbild"-->
<div id="header-image">
    <h1>Nyheter</h1>
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
<!-- Nyheter -->
<section id="news">
    <?php
        $count = 0;
        // Begränsa till nyhetsinlägg
        $query = new WP_Query( array(
            'category_name' => 'Nyheter',
        ) );
        // The loop
        if ( $query->have_posts() ) :
            // Loopa igenom inläggen
            while ( $query->have_posts() ) :
                // Vartannat inlägg i varannan kolumn p.g.a. två kolumner på desktop
                if ( $count % 2 == 0 ) {
                    // Hämta inlägget
                    $query->the_post();
                    echo '<div class="row">';
    ?>
    <!-- Inlägg (vänster) -->
    <div class="article-left">
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
            <div class="excerpt">
                <p class="date"><?php /* Skriv ut datumet */ the_date(); ?></p>
                <?php /* Skriv ut innehållet i avkortad form */ the_excerpt(); ?>
                <div class="find-out-more">
                    <a href="<?php /* Länk till inlägget i helhet */ the_permalink();?>">Läs mer</a>
                </div>
            </div>
        </article>
    </div>
    <?php
        /* Stängningstagg om mindre än fem inlägg finns och det sista inlägget 
        hamnar till vänster */
        if ( count_posts( 'Nyheter' ) < 5 && $count == ( count_posts( 'Nyheter' ) - 1 ) ) {
            echo '</div>';
        // Stängningstagg efter det sista inlägget om fler än fem inlägg finns
        } elseif ( count_posts( 'Nyheter' ) >= 5 && $count == 4 ) {
            echo '</div>';
        }
    } elseif ( $count % 2 !== 0 ) {
        // Hämta inlägget
        $query->the_post();
    ?>
    <!-- Inlägg (höger) -->
    <div class="article-right">
        <h2 class="h2-articles"><?php /* Skriv ut rubriken */ the_title(); ?></h2>
        <article>
            <?php
                // Om inlägget har en utvald bild
                if ( has_post_thumbnail() ) {
                    // Skriv ut bilden, lägg till klass för responsivitet
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
                <?php /* Skriv ut innehållet i avkortad form */ the_excerpt(); ?>
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