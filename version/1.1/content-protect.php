<?php
/**
 * Plugin Name: Content Protect
 * Plugin URI: https://www.itisuniqueofficial.com
 * Description: Protects website content by disabling text selection, right-click, and certain keyboard interactions.
 * Version: 1.1
 * Author: It Is Unique Official
 * Author URI: https://www.itisuniqueofficial.com
 * License: MIT
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Enqueue CSS and JS
function content_protect_enqueue_scripts() {
    // Enqueue the CSS
    wp_register_style('content-protect-css', false);
    wp_enqueue_style('content-protect-css');
    wp_add_inline_style(
        'content-protect-css',
        '/*! DisableTextSelection.min.css */
        * { -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; }'
    );

    // Enqueue the JS
    wp_register_script('content-protect-js', false);
    wp_enqueue_script('content-protect-js');
    wp_add_inline_script(
        'content-protect-js',
        '/*! WebActivityShield.min.js */
        document.addEventListener("contextmenu", e => e.preventDefault());
        document.addEventListener("keydown", e => {
            if (e.ctrlKey || e.metaKey || e.altKey || [112, 123].includes(e.keyCode)) e.preventDefault();
        });
        document.addEventListener("mousedown", e => e.preventDefault());
        document.addEventListener("dragstart", e => e.preventDefault());'
    );
}

// Add credit to the page source
function content_protect_add_credit() {
    echo "\n<!-- Content Protected by It Is Unique Official - https://www.itisuniqueofficial.com -->\n";
}

add_action('wp_enqueue_scripts', 'content_protect_enqueue_scripts');
add_action('wp_head', 'content_protect_add_credit', 9999); // Add the credit before </head>
?>
