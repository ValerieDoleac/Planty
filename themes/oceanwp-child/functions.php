<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'font-awesome','simple-line-icons','oceanwp-style' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// END ENQUEUE PARENT ACTION


function ajouter_lien_admin_pour_utilisateurs_connectes($items, $args) {
    // Vérifier si l'emplacement du menu est soit "primary", soit "mobile_menu"
    if ($args->theme_location == 'main_menu' || $args->theme_location == 'mobile_menu') {
        // Vérifier si l'utilisateur est connecté et a les capacités d'administration
        if (is_user_logged_in()) {
            // Ajouter un lien "Admin" qui redirige vers le tableau de bord d'administration (utilisateur ayant le rôle d'administrateur)
            $lien_admin = '<li class="menu-item lien-admin"><a href="' . admin_url() . '">Admin</a></li>';
            // Ajouter le lien à la fin du menu
            $items .= $lien_admin;
        }
    }

    // Retourner les éléments du menu modifiés
    return $items;
}

// Ajouter le filtre pour modifier les éléments du menu
add_filter('wp_nav_menu_items', 'ajouter_lien_admin_pour_utilisateurs_connectes', 10, 2);

add_filter("wpcf7_autop_or_not", "__return_false");