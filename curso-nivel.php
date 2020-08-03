<?php
add_action( 'init', function() {
    $labels = array(
        'name'                       => _x( 'Níveis', 'Taxonomy General Name', 'ifrs-portal-plugin-cursos' ),
        'singular_name'              => _x( 'Nível', 'Taxonomy Singular Name', 'ifrs-portal-plugin-cursos' ),
        'menu_name'                  => __( 'Nível', 'ifrs-portal-plugin-cursos' ),
        'all_items'                  => __( 'Todos os Níveis', 'ifrs-portal-plugin-cursos' ),
        'parent_item'                => __( 'Nível Pai', 'ifrs-portal-plugin-cursos' ),
        'parent_item_colon'          => __( 'Nível Pai:', 'ifrs-portal-plugin-cursos' ),
        'new_item_name'              => __( 'Novo Nível', 'ifrs-portal-plugin-cursos' ),
        'add_new_item'               => __( 'Adicionar Novo Nível', 'ifrs-portal-plugin-cursos' ),
        'edit_item'                  => __( 'Editar Nível', 'ifrs-portal-plugin-cursos' ),
        'update_item'                => __( 'Atualizar Nível', 'ifrs-portal-plugin-cursos' ),
        'view_item'                  => __( 'Visualizar Nível', 'ifrs-portal-plugin-cursos' ),
        'separate_items_with_commas' => __( 'Níveis separados por vírgula', 'ifrs-portal-plugin-cursos' ),
        'add_or_remove_items'        => __( 'Adicionar ou Remover Níveis', 'ifrs-portal-plugin-cursos' ),
        'choose_from_most_used'      => __( 'Escolher pelo Nível Mais Usado', 'ifrs-portal-plugin-cursos' ),
        'popular_items'              => __( 'Níveis Populares', 'ifrs-portal-plugin-cursos' ),
        'search_items'               => __( 'Buscar Níveis', 'ifrs-portal-plugin-cursos' ),
        'not_found'                  => __( 'Não Encontrado', 'ifrs-portal-plugin-cursos' ),
        'no_terms'                   => __( 'Sem Níveis', 'ifrs-portal-plugin-cursos' ),
        'items_list'                 => __( 'Lista de Níveis', 'ifrs-portal-plugin-cursos' ),
        'items_list_navigation'      => __( 'Lista de navegação de Níveis', 'ifrs-portal-plugin-cursos' ),
    );

    $capabilities = array(
        'manage_terms'               => 'manage_niveis',
        'edit_terms'                 => 'manage_niveis',
        'delete_terms'               => 'manage_niveis',
        'assign_terms'               => 'assign_niveis',
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'capabilities'               => $capabilities,
        'show_in_rest'               => true,
        'rewrite'                    => array('slug' => 'cursos/niveis', 'with_front' => false),
    );

    register_taxonomy( 'curso_nivel', array( 'curso' ), $args );
}, 0 );

/**
 * Limita a profundidade da hierarquia
 */
add_filter( 'taxonomy_parent_dropdown_args', function( $args, $taxonomy ) {
    if ( 'curso_nivel' != $taxonomy ) return $args;

    $args['depth'] = '1';
    return $args;
}, 10, 2 );

/**
 * Template
 */
add_filter( 'taxonomy_template', function($template) {
    global $post;

    if (is_tax('curso_nivel') && empty(locate_template('taxonomy-curso_nivel.php', false))) {
        return plugin_dir_path(__FILE__) . 'templates/taxonomy-curso_nivel.php';
    }

    return $template;
} );
