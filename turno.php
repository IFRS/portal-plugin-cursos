<?php
if ( ! function_exists( 'turno_taxonomy' ) ) {
    function turno_taxonomy() {
        $labels = array(
            'name'                       => _x( 'Turnos', 'Taxonomy General Name', 'ifrs-portal-plugin-cursos' ),
            'singular_name'              => _x( 'Turno', 'Taxonomy Singular Name', 'ifrs-portal-plugin-cursos' ),
            'menu_name'                  => __( 'Turno', 'ifrs-portal-plugin-cursos' ),
            'all_items'                  => __( 'Todos os Turnos', 'ifrs-portal-plugin-cursos' ),
            'parent_item'                => __( 'Turno Pai', 'ifrs-portal-plugin-cursos' ),
            'parent_item_colon'          => __( 'Turno Pai:', 'ifrs-portal-plugin-cursos' ),
            'new_item_name'              => __( 'Novo Turno', 'ifrs-portal-plugin-cursos' ),
            'add_new_item'               => __( 'Adicionar Novo Turno', 'ifrs-portal-plugin-cursos' ),
            'edit_item'                  => __( 'Editar Turno', 'ifrs-portal-plugin-cursos' ),
            'update_item'                => __( 'Atualizar Turno', 'ifrs-portal-plugin-cursos' ),
            'view_item'                  => __( 'Visualizar Turno', 'ifrs-portal-plugin-cursos' ),
            'separate_items_with_commas' => __( 'Turnos separados com vírgulas', 'ifrs-portal-plugin-cursos' ),
            'add_or_remove_items'        => __( 'Adicionar ou Remover Turnos', 'ifrs-portal-plugin-cursos' ),
            'choose_from_most_used'      => __( 'Escolher pelo Turno Mais Usado', 'ifrs-portal-plugin-cursos' ),
            'popular_items'              => __( 'Turnos Populares', 'ifrs-portal-plugin-cursos' ),
            'search_items'               => __( 'Buscar Turnos', 'ifrs-portal-plugin-cursos' ),
            'not_found'                  => __( 'Não Encontrado', 'ifrs-portal-plugin-cursos' ),
            'no_terms'                   => __( 'Sem Turnos', 'ifrs-portal-plugin-cursos' ),
            'items_list'                 => __( 'Lista de Turnos', 'ifrs-portal-plugin-cursos' ),
            'items_list_navigation'      => __( 'Lista de navegação de Turnos', 'ifrs-portal-plugin-cursos' ),
        );

        $capabilities = array(
            'manage_terms'               => 'manage_turnos',
            'edit_terms'                 => 'manage_turnos',
            'delete_terms'               => 'manage_turnos',
            'assign_terms'               => 'assign_turnos',
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
        );

        register_taxonomy( 'turno', array( 'curso' ), $args );
    }

    add_action( 'init', 'turno_taxonomy', 0 );
}
