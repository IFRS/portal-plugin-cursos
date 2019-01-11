<?php
if ( ! function_exists('curso_post_type') ) {
    function curso_post_type() {
        $labels = array(
            'name'                  => _x( 'Cursos', 'Post Type General Name', 'ifrs-portal-plugin-cursos' ),
            'singular_name'         => _x( 'Curso', 'Post Type Singular Name', 'ifrs-portal-plugin-cursos' ),
            'menu_name'             => __( 'Cursos', 'ifrs-portal-plugin-cursos' ),
            'name_admin_bar'        => __( 'Curso', 'ifrs-portal-plugin-cursos' ),
            'archives'              => __( 'Arquivo de Cursos', 'ifrs-portal-plugin-cursos' ),
            'attributes'            => __( 'Atributos de Curso', 'ifrs-portal-plugin-cursos' ),
            'parent_item_colon'     => __( 'Curso Pai:', 'ifrs-portal-plugin-cursos' ),
            'all_items'             => __( 'Todos os Cursos', 'ifrs-portal-plugin-cursos' ),
            'add_new_item'          => __( 'Adicionar Novo Curso', 'ifrs-portal-plugin-cursos' ),
            'add_new'               => __( 'Adicionar Novo', 'ifrs-portal-plugin-cursos' ),
            'new_item'              => __( 'Novo Curso', 'ifrs-portal-plugin-cursos' ),
            'edit_item'             => __( 'Editar Curso', 'ifrs-portal-plugin-cursos' ),
            'update_item'           => __( 'Atualizar Curso', 'ifrs-portal-plugin-cursos' ),
            'view_item'             => __( 'Ver Curso', 'ifrs-portal-plugin-cursos' ),
            'view_items'            => __( 'Ver Cursos', 'ifrs-portal-plugin-cursos' ),
            'search_items'          => __( 'Buscar Curso', 'ifrs-portal-plugin-cursos' ),
            'not_found'             => __( 'Não encontrado', 'ifrs-portal-plugin-cursos' ),
            'not_found_in_trash'    => __( 'Não encontrado na Lixeira', 'ifrs-portal-plugin-cursos' ),
            'featured_image'        => __( 'Imagem Destaque', 'ifrs-portal-plugin-cursos' ),
            'set_featured_image'    => __( 'Escolher imagem destaque', 'ifrs-portal-plugin-cursos' ),
            'remove_featured_image' => __( 'Remover imagem destaque', 'ifrs-portal-plugin-cursos' ),
            'use_featured_image'    => __( 'Usar como imagem destaque', 'ifrs-portal-plugin-cursos' ),
            'insert_into_item'      => __( 'Inserir no Curso', 'ifrs-portal-plugin-cursos' ),
            'uploaded_to_this_item' => __( 'Enviado para esse Curso', 'ifrs-portal-plugin-cursos' ),
            'items_list'            => __( 'Lista de Cursos', 'ifrs-portal-plugin-cursos' ),
            'items_list_navigation' => __( 'Lista de navegação de Cursos', 'ifrs-portal-plugin-cursos' ),
            'filter_items_list'     => __( 'Filtrar lista de Cursos', 'ifrs-portal-plugin-cursos' ),
        );
        $capabilities = array(
			// meta caps (don't assign these to roles)
			'edit_post'              => 'edit_curso',
			'read_post'              => 'read_curso',
			'delete_post'            => 'delete_curso',

			// primitive/meta caps
			'create_posts'           => 'create_cursos',

			// primitive caps used outside of map_meta_cap()
			'edit_posts'             => 'edit_cursos',
			'edit_others_posts'      => 'edit_cursos',
			'publish_posts'          => 'publish_cursos',
			'read_private_posts'     => 'read',

			// primitive caps used inside of map_meta_cap()
			'read'                   => 'read',
			'delete_posts'           => 'delete_cursos',
			'delete_private_posts'   => 'delete_cursos',
			'delete_published_posts' => 'delete_cursos',
			'delete_others_posts'    => 'delete_cursos',
			'edit_private_posts'     => 'edit_cursos',
			'edit_published_posts'   => 'edit_cursos',
		);
        $args = array(
            'label'               => __( 'Curso', 'ifrs-portal-plugin-cursos' ),
            'description'         => __( 'Cursos', 'ifrs-portal-plugin-cursos' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies'          => array( 'modalidade', 'nivel' ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 10,
            'menu_icon'           => 'dashicons-welcome-learn-more',
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capabilities'        => $capabilities,
            'show_in_rest'        => true,
            'rest_base'           => 'cursos',
        );
        register_post_type( 'curso', $args );
    }

    add_action( 'init', 'curso_post_type', 1 );
}

add_action( 'cmb2_admin_init', 'curso_metaboxes' );
/**
 * Definição das metaboxes
 */
function curso_metaboxes() {
	$prefix = '_curso_';

	/**
	 * Informações do Curso
	 */
	$info_metabox = new_cmb2_box( array(
		'id'           => 'info_metabox',
		'title'        => __( 'Informações do Curso', 'ifrs-portal-plugin-cursos' ),
		'object_types' => array( 'curso' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
    ) );

	$info_metabox->add_field( array(
		'name'       => __( 'Carga Horária', 'ifrs-portal-plugin-cursos' ),
		'id'         => $prefix . 'carga_horaria',
        'type'       => 'text_small',
        'attributes' => array(
            'required' => 'required',
            'type'     => 'number',
            'pattern'  => '\d*',
        ),
    ) );

    $info_metabox->add_field( array(
        'name'       => __( 'Duração', 'ifrs-portal-plugin-cursos' ),
        'desc'       => __( '2 meses, 4 semestres, 3 anos, etc.', 'ifrs-portal-plugin-cursos' ),
		'id'         => $prefix . 'duracao',
        'type'       => 'text',
        'attributes' => array(
            'required' => 'required',
        ),
    ) );

    $info_metabox->add_field( array(
        'name' => __( 'Autorização', 'ifrs-portal-plugin-cursos' ),
        'desc' => __( 'Portaria ou documento de autorização.', 'ifrs-portal-plugin-cursos' ),
		'id'   => $prefix . 'autorizacao',
		'type' => 'text',
    ) );

    $info_metabox->add_field( array(
        'name'       => __( 'Nota do MEC', 'ifrs-portal-plugin-cursos' ),
        'desc'       => __( 'Nota dada pela última avaliação do MEC.', 'ifrs-portal-plugin-cursos' ),
		'id'         => $prefix . 'nota',
        'type'       => 'text_small',
        'attributes' => array(
            'type' => 'number',
            'min'  => '1',
            'max'  => '5',
            'step' => '1',
        ),
    ) );

    $info_metabox->add_field( array(
        'name' => __( 'Estrutura Física', 'ifrs-portal-plugin-cursos' ),
		'id'   => $prefix . 'estrutura',
		'type' => 'wysiwyg',
    ) );

    /**
	 * Coordenador do Curso
	 */
    $coordenador_metabox = new_cmb2_box( array(
		'id'           => 'coordenador_metabox',
		'title'        => __( 'Coordenador do Curso', 'ifrs-portal-plugin-cursos' ),
		'object_types' => array( 'curso' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
    ) );

    $coordenador_metabox->add_field( array(
		'name'       => __( 'Nome', 'ifrs-portal-plugin-cursos' ),
		'id'         => $prefix . 'coordenador_nome',
        'type'       => 'text',
        'attributes' => array(
            'required' => 'required',
        ),
    ) );

    $coordenador_metabox->add_field( array(
		'name'       => __( 'E-mail', 'ifrs-portal-plugin-cursos' ),
		'id'         => $prefix . 'coordenador_email',
        'type'       => 'text_email',
        'attributes' => array(
            'required' => 'required',
        ),
    ) );

    $coordenador_metabox->add_field( array(
		'name' => __( 'Titulação', 'ifrs-portal-plugin-cursos' ),
		'id'   => $prefix . 'coordenador_titulacao',
		'type' => 'text',
    ) );

    /**
	 * Taxonomy Modalidade
	 */
    $modalidade_metabox = new_cmb2_box( array(
		'id'           => 'modalidade_taxonomy_metabox',
		'title'        => __( 'Modalidade', 'ifrs-portal-plugin-cursos' ),
		'object_types' => array( 'curso' ),
		'context'      => 'side',
		'priority'     => 'low',
		'show_names'   => false,
    ) );

    $modalidade_metabox->add_field( array(
        'id'                => $prefix . 'modalidade_taxonomy',
        'name'              => __( 'Modalidade', 'ifrs-portal-plugin-cursos' ),
        'desc'              => __( 'Escolha a Modalidade do Curso.', 'ifrs-portal-plugin-cursos' ),
        'taxonomy'          => 'modalidade',
        'type'              => 'taxonomy_radio',
        'show_option_none'  => false,
        'text'              => array(
            'no_terms_text' => __( 'Ops! Nenhuma modalidade cadastrada. Por favor, cadastre alguma modalidade antes de cadastrar um Curso.', 'ifrs-portal-plugin-cursos')
        ),
        'remove_default'    => 'true',
    ) );

    /**
	 * Taxonomy Nível
	 */
    $nivel_metabox = new_cmb2_box( array(
		'id'           => 'nivel_taxonomy_metabox',
		'title'        => __( 'Nível', 'ifrs-portal-plugin-cursos' ),
		'object_types' => array( 'curso' ),
		'context'      => 'side',
		'priority'     => 'low',
		'show_names'   => false,
    ) );

    $nivel_metabox->add_field( array(
        'id'                => $prefix . 'nivel_taxonomy',
        'name'              => __( 'Nível', 'ifrs-portal-plugin-cursos' ),
        'desc'              => __( 'Escolha o Nível do Curso.', 'ifrs-portal-plugin-cursos' ),
        'taxonomy'          => 'nivel',
        'type'              => 'taxonomy_radio_hierarchical',
        'show_option_none'  => false,
        'text'              => array(
            'no_terms_text' => __( 'Ops! Nenhum nível cadastrado. Por favor, cadastre algum nível antes de cadastrar um Curso.', 'ifrs-portal-plugin-cursos')
        ),
        'remove_default'    => 'true',
    ) );
}
