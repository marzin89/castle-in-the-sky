<?php 
    // Inkludera sidhuvudet
    get_header(); 
?>
<?php
    // The loop
    if (have_posts()) :
        // Loopa igenom inläggen
        while (have_posts()) :
            // Hämta inlägget
            the_post();
?>
<!-- Headerbild -->
<div id="header-image">
    <h1>
        <?php
            // Skriv ut rubriken
            the_title();
        ?>
    </h1>
</div>
<!-- Språkval -->
<div id="language-picker">
    <select name="languages" id="languages">
        <option value="">SV</option>
        <option value="">EN</option>
        <option value="">DE</option>
        <option value="">FR</option>
        <option value="">ES</option>
    </select>
</div>
<!-- Rum -->
<section id="rooms">
    <div id="blog-text">
        <?php
                // Skriv ut innehållet
                the_content();
            endwhile;
        endif;
        ?>
    </div>
    <?php
        $count = 0;
        // The loop
        // Eftersom startsidan är en statisk sida (Nyheter är inläggssida)
        // Begränsa till rum
        $query = new WP_Query(array(
            'category_name' => 'Bo'));
        if ($query->have_posts()) :
            // Loopa igenom inläggen
            while ($query->have_posts()) :
                // Vartannat inlägg i varannan kolumn p.g.a. två kolumner på desktop:
                if ($count % 2 == 0) {
                    // Hämta inlägget
                    $query->the_post();
                    echo '<div class="row">';
    ?>
        <div class="room-left">
            <h2 class="h2-articles">
                <?php
                    // Skriv ut rubriken
                    the_title();
                ?>
            </h2>
            <article>
                <?php
                    // Om inlägget har en utvald bild
                    if (has_post_thumbnail()) {
                        // Skriv ut bilden, lägg till klass för responsivitet
                        the_post_thumbnail('mobile', array('class' => 'img-mobile'));
                        the_post_thumbnail('desktop', array('class' => 'img-desktop'));
                    }
                ?>
                <div class="summary">
                    <?php
                        // Lagra innehållet i en variabel
                        $content = get_the_content();
                        $list = '';
                        $length = '';
                        // Kontrollera om det finns en lista och extrahera den
                        if (strpos($content, '<ul>')) {
                            $length = strpos($content, '</ul>') - strpos($content, '<ul>');
                            $list = substr($content, strpos($content, '<ul>'), $length);
                            $list .= '</ul>';
                        }
                        // Skriv ut listan om den finns
                        if ($list !== '') {
                            echo $list;
                        } else {
                            // Skriv annars ut ett utdrag
                            the_excerpt();
                        }
                    ?>
                    <div class="find-out-more">
                        <a href="
                            <?php
                                // Länk till inlägget i helhet
                                the_permalink();
                            ?>
                    ">Läs mer</a>
                    </div>
                </div>
            </article>
        </div>
        <?php
                /* Stängningstagg om mindre än fyra inlägg finns och det sista inlägget 
                hamnar till vänster */
                if (count_posts('Bo') < 4 && $count == (count_posts('Bo') - 1)) {
                    echo '</div>';
                // Stängningstagg efter det sista inlägget om fler än fem inlägg finns
                } else if (count_posts('Bo') >= 4 && $count == 3) {
                    echo '</div>';
                }
            } else if ($count % 2 !== 0) {
                // Hämta inlägget
                $query->the_post();
        ?>
        <div class="room-right">
            <h2 class="h2-articles">
                <?php
                    // Skriv ut rubriken
                    the_title();
                ?>
            </h2>
            <article>
                <?php
                    // Om inlägget har en utvald bild
                    if (has_post_thumbnail()) {
                        // Skriv ut bilden, lägg till klass för responsivitet
                        the_post_thumbnail('mobile', array('class' => 'img-mobile'));
                        the_post_thumbnail('desktop', array('class' => 'img-desktop'));
                    }
                ?>
                <div class="summary">
                    <?php
                        // Lagra innehållet i en variabel
                        $content = get_the_content();
                        $list = '';
                        $length = '';
                        // Kontrollera om det finns en lista och extrahera den
                        if (strpos($content, '<ul>')) {
                            $length = strpos($content, '</ul>') - strpos($content, '<ul>');
                            $list = substr($content, strpos($content, '<ul>'), $length);
                            $list .= '</ul>';
                        }
                        // Skriv ut listan om den finns
                        if ($list !== '') {
                            echo $list;
                        } else {
                            // Skriv annars ut ett utdrag
                            the_excerpt();
                        }
                    ?>
                    <div class="find-out-more">
                        <a href="
                            <?php
                                // Länk till inlägget i helhet
                                the_permalink();
                            ?>
                    ">Läs mer</a>
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
<?php 
    // Inkludera sidfoten
    get_footer(); 
?>