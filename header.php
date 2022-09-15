<!DOCTYPE html>
<html <?php /* Aktuellt språk */ language_attributes(); ?>>
    <head>
        <meta charset="<?php /* Aktuell teckenuppsättning */ bloginfo( 'charset' ); ?>">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            <?php 
                /* Sidans titel */ bloginfo( 'name' ) . wp_title( $sep = '|', 
                $display = true );
            ?>
        </title>
        <link rel="stylesheet" href="<?php /* Sökväg till css */ bloginfo( 'stylesheet_url' ); ?>">
        <!-- Favicon -->
        <link rel="icon" href="<?php /* Sökväg till temat */ bloginfo( 'template_url' ); ?>/bilder/favicon/favicon.png" type="img/png" sizes="16x16">
        <?php /* Stöd för plugins */ wp_head(); ?>
    </head>
    <body>
        <div id="page-wrapper">
            <!-- Sidhuvud -->
            <header>
                <div id="header-wrapper">
                    <div id="logo-wrapper">
                        <!--Logga-->
                        <a id="logo" href="<?php /* Sökväg till startsidan */ bloginfo( 'wpurl' ); ?>">
                            <img src="<?php /* Sökväg till temat */ bloginfo( 'template_url' ); ?>/bilder/logo/logo.png" alt="Logotyp">
                        </a>
                    </div>
                    <div id="header-right">
                        <div id="book-btn">
                            <a href="
                                <?php 
                                    /* Länk till bokningssidan */ $permalink = get_permalink( '80' );
                                    echo $permalink ; 
                                ?>
                            ">Boka nu</a>    
                        </div>
                        <!--Sökfunktion-->
                        <svg id="search-icon" width="25" height="30">
                            <circle cx="10" cy="10" r="7.5" stroke="black" stroke-width="3" fill="white" />
                            <line x1=16 y1="17" x2="21" y2="23" style="stroke:black; stroke-width:3" /> 
                        </svg>
                        <input id="search" type="search" value="Sök">
                        <!-- Hamburgerikon -->
                        <svg id="hamburger-icon" width="35" height="25">
                            <rect x="0" y="0" width="35" height="5" /> 
                            <rect x="0" y="10" width="35" height="5" />
                            <rect x="0" y="20" width="35" height="5" />
                        </svg>
                        <!-- Huvudnavigering -->
                        <?php
                            // Visa huvudmenyn
                            wp_nav_menu( array(
                                'theme_location' => 'main-nav',
                                'container'      => 'nav',
                                'container_id'   => 'main-nav',
                            ) );
                        ?>
                    </div>
                    <!--Hamburgermeny-->
                </div>      
            </header>
            <main>