<?php
add_shortcode( 'cursos', function($atts) {
    // Attributes
    $atts = shortcode_atts(
        array(
            'site' => get_main_site_id(),
            'unidade' => null,
            'posts_per_page' => -1,
        ),
        $atts,
        'cursos'
    );

    wp_enqueue_script('ifrs-cursos-vendors', plugin_dir_url(__FILE__) . 'js/vendors.js', array(), null, true);
    wp_enqueue_script('ifrs-cursos-runtime', plugin_dir_url(__FILE__) . 'js/runtime.js', array(), null, true);
    wp_enqueue_script('ifrs-cursos-index', plugin_dir_url(__FILE__) . 'js/index.js', array(), null, true);

    wp_localize_script('ifrs-cursos-index', 'wp', array(
        'api' => get_rest_url($atts['site'], 'wp/v2'),
    ));

    ob_start();
?>
    <div id="ifrs-cursos"></div>
<?php

    return ob_get_clean();
} );
