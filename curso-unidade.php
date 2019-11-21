<?php
if ( ! function_exists('curso_unidade_taxonomy') ) {
    function curso_unidade_taxonomy() {
        $labels = array(
            'name'                       => _x( 'Unidades', 'Taxonomy General Name', 'ifrs-portal-plugin-cursos' ),
            'singular_name'              => _x( 'Unidade', 'Taxonomy Singular Name', 'ifrs-portal-plugin-cursos' ),
            'menu_name'                  => __( 'Unidades', 'ifrs-portal-plugin-cursos' ),
            'all_items'                  => __( 'Todas as Unidades', 'ifrs-portal-plugin-cursos' ),
            'parent_item'                => __( 'Unidade Mãe', 'ifrs-portal-plugin-cursos' ),
            'parent_item_colon'          => __( 'Unidade Mãe:', 'ifrs-portal-plugin-cursos' ),
            'new_item_name'              => __( 'Nova Unidade', 'ifrs-portal-plugin-cursos' ),
            'add_new_item'               => __( 'Adicionar Nova Unidade', 'ifrs-portal-plugin-cursos' ),
            'edit_item'                  => __( 'Editar Unidade', 'ifrs-portal-plugin-cursos' ),
            'update_item'                => __( 'Atualizar Unidade', 'ifrs-portal-plugin-cursos' ),
            'view_item'                  => __( 'Visualizar Unidade', 'ifrs-portal-plugin-cursos' ),
            'separate_items_with_commas' => __( 'Unidades separadas com vírgulas', 'ifrs-portal-plugin-cursos' ),
            'add_or_remove_items'        => __( 'Adicionar ou Remover Unidades', 'ifrs-portal-plugin-cursos' ),
            'choose_from_most_used'      => __( 'Escolher pela Unidade Mais Usada', 'ifrs-portal-plugin-cursos' ),
            'popular_items'              => __( 'Unidades Populares', 'ifrs-portal-plugin-cursos' ),
            'search_items'               => __( 'Buscar Unidades', 'ifrs-portal-plugin-cursos' ),
            'not_found'                  => __( 'Não Encontrada', 'ifrs-portal-plugin-cursos' ),
            'no_terms'                   => __( 'Sem Unidades', 'ifrs-portal-plugin-cursos' ),
            'items_list'                 => __( 'Lista de Unidades', 'ifrs-portal-plugin-cursos' ),
            'items_list_navigation'      => __( 'Lista de navegação de Unidades', 'ifrs-portal-plugin-cursos' ),
        );

        $capabilities = array(
            'manage_terms'               => 'manage_unidades',
            'edit_terms'                 => 'manage_unidades',
            'delete_terms'               => 'manage_unidades',
            'assign_terms'               => 'assign_unidades',
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
            'rewrite'                    => array('slug' => 'cursos/unidades', 'with_front' => false),
        );

        register_taxonomy( 'curso_unidade', array( 'curso' ), $args );
    }

    add_action( 'init', 'curso_unidade_taxonomy', 0 );
}

/**
 * Template
 */
add_filter('taxonomy_template', function($template) {
    global $post;

    if ( is_tax('curso_unidade') && empty(locate_template('taxonomy-curso_unidade.php', false))) {
        return plugin_dir_path(__FILE__) . 'templates/taxonomy-curso_unidade.php';
    }

    return $template;
});
