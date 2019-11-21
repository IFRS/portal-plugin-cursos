<?php
if ( ! function_exists('curso_modalidade_taxonomy') ) {
    function curso_modalidade_taxonomy() {
        $labels = array(
            'name'                       => _x( 'Modalidades', 'Taxonomy General Name', 'ifrs-portal-plugin-cursos' ),
            'singular_name'              => _x( 'Modalidade', 'Taxonomy Singular Name', 'ifrs-portal-plugin-cursos' ),
            'menu_name'                  => __( 'Modalidades', 'ifrs-portal-plugin-cursos' ),
            'all_items'                  => __( 'Todas as Modalidades', 'ifrs-portal-plugin-cursos' ),
            'parent_item'                => __( 'Modalidade Mãe', 'ifrs-portal-plugin-cursos' ),
            'parent_item_colon'          => __( 'Modalidade Mãe:', 'ifrs-portal-plugin-cursos' ),
            'new_item_name'              => __( 'Nova Modalidade', 'ifrs-portal-plugin-cursos' ),
            'add_new_item'               => __( 'Adicionar Nova Modalidade', 'ifrs-portal-plugin-cursos' ),
            'edit_item'                  => __( 'Editar Modalidade', 'ifrs-portal-plugin-cursos' ),
            'update_item'                => __( 'Atualizar Modalidade', 'ifrs-portal-plugin-cursos' ),
            'view_item'                  => __( 'Visualizar Modalidade', 'ifrs-portal-plugin-cursos' ),
            'separate_items_with_commas' => __( 'Modalidades separadas com vírgulas', 'ifrs-portal-plugin-cursos' ),
            'add_or_remove_items'        => __( 'Adicionar ou Remover Modalidades', 'ifrs-portal-plugin-cursos' ),
            'choose_from_most_used'      => __( 'Escolher pela Modalidade Mais Usada', 'ifrs-portal-plugin-cursos' ),
            'popular_items'              => __( 'Modalidades Populares', 'ifrs-portal-plugin-cursos' ),
            'search_items'               => __( 'Buscar Modalidades', 'ifrs-portal-plugin-cursos' ),
            'not_found'                  => __( 'Não Encontrada', 'ifrs-portal-plugin-cursos' ),
            'no_terms'                   => __( 'Sem Modalidades', 'ifrs-portal-plugin-cursos' ),
            'items_list'                 => __( 'Lista de Modalidades', 'ifrs-portal-plugin-cursos' ),
            'items_list_navigation'      => __( 'Lista de navegação de Modalidades', 'ifrs-portal-plugin-cursos' ),
        );

        $capabilities = array(
            'manage_terms'               => 'manage_modalidades',
            'edit_terms'                 => 'manage_modalidades',
            'delete_terms'               => 'manage_modalidades',
            'assign_terms'               => 'assign_modalidades',
        );

        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => false,
            'capabilities'               => $capabilities,
            'show_in_rest'               => true,
            'rewrite'                    => array('slug' => 'cursos/modalidades', 'with_front' => false),
        );

        register_taxonomy( 'curso_modalidade', array( 'curso' ), $args );
    }

    add_action( 'init', 'curso_modalidade_taxonomy', 0 );
}

/**
 * Template
 */
add_filter('taxonomy_template', function($template) {
    global $post;

    if ( is_tax('curso_modalidade') && empty(locate_template('taxonomy-curso_modalidade.php', false))) {
        return plugin_dir_path(__FILE__) . 'templates/taxonomy-curso_modalidade.php';
    }

    return $template;
});
