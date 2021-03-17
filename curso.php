<?php
add_action( 'init', function() {
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
        'featured_image'        => __( 'Marca do Curso', 'ifrs-portal-plugin-cursos' ),
        'set_featured_image'    => __( 'Escolher imagem', 'ifrs-portal-plugin-cursos' ),
        'remove_featured_image' => __( 'Remover imagem', 'ifrs-portal-plugin-cursos' ),
        'use_featured_image'    => __( 'Usar como imagem', 'ifrs-portal-plugin-cursos' ),
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
        'taxonomies'          => array( 'modalidade', 'nivel', 'turno', 'unidade' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => (get_current_blog_id() === get_main_site_id()) ? true : false,
        'show_in_menu'        => true,
        'menu_position'       => 10,
        'menu_icon'           => 'dashicons-welcome-learn-more',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capabilities'        => $capabilities,
        'show_in_rest'        => true,
        'rest_base'           => 'cursos',
        'rewrite'             => array( 'slug' => 'cursos' ),
    );
    register_post_type( 'curso', $args );
}, 1 );

/**
 * Definição das metaboxes
 */
add_action( 'rwmb_meta_boxes', function($metaboxes) {
	$prefix = '_curso_';

	/**
	 * Informações do Curso
	 */
    $metaboxes[] = array(
        'title'      => __( 'Informações do Curso', 'ifrs-portal-plugin-cursos' ),
        'post_types' => 'curso',
        'fields'     => array(
            array(
                'id'         => $prefix . 'carga_horaria',
                'name'       => __( 'Carga Horária', 'ifrs-portal-plugin-cursos' ),
                'desc'       => __( 'em horas.', 'ifrs-portal-plugin-cursos' ),
                'type'       => 'text',
                'size'       => 10,
                'attributes' => array(
                    'required' => 'required',
                    'type'     => 'number',
                    'pattern'  => '\d*',
                ),
            ),
            array(
                'id'         => $prefix . 'duracao',
                'name'       => __( 'Duração', 'ifrs-portal-plugin-cursos' ),
                'desc'       => __( '2 meses, 4 semestres, 3 anos, etc.', 'ifrs-portal-plugin-cursos' ),
                'type'       => 'text',
                'attributes' => array(
                    'required' => 'required',
                ),
            ),
            array(
                'id'   => $prefix . 'nota',
                'name' => __( 'Avaliação do Curso', 'ifrs-portal-plugin-cursos' ),
                'desc' => __( 'Nota recebida pela última avaliação do Curso.', 'ifrs-portal-plugin-cursos' ),
                'type' => 'number',
                'step' => '1',
                'min'  => '1',
                'max'  => '5',
            ),
        ),
    );

    /**
	 * Arquivos do Curso
	 */
    $metaboxes[] = array(
        'title'      => __( 'Arquivos do Curso', 'ifrs-portal-plugin-cursos' ),
		'post_types' => 'curso',
        'fields'     => array(
            array(
                'id'               => $prefix . 'ppc',
                'name'             => __( 'PPC (Projeto Pedagógico do Curso)', 'ifrs-portal-plugin-cursos' ),
                'type'             => 'file_advanced',
                'max_file_uploads' => 1,
                'mime_type'        => 'application/pdf',
                'attributes'       => array(
                    'required' => 'required',
                ),
            ),
            array(
                'id'               => $prefix . 'matriz_curricular',
                'name'             => __( 'Matriz Curricular Vigente', 'ifrs-portal-plugin-cursos' ),
                'type'             => 'file_advanced',
                'max_file_uploads' => 1,
                'mime_type'        => 'application/pdf',
                'attributes'       => array(
                    'required' => 'required',
                ),
            ),
            array(
                'id'               => $prefix . 'representacao_grafica',
                'name'             => __( 'Representação Gráfica', 'ifrs-portal-plugin-cursos' ),
                'type'             => 'file_advanced',
                'max_file_uploads' => 1,
                'mime_type'        => 'application/pdf',
                'attributes'       => array(
                    'required' => 'required',
                ),
            ),
            array(
                'id'               => $prefix . 'corpo_docente',
                'name'             => __( 'Corpo Docente', 'ifrs-portal-plugin-cursos' ),
                'type'             => 'file_advanced',
                'max_file_uploads' => 1,
                'mime_type'        => 'application/pdf',
                'attributes'       => array(
                    'required' => 'required',
                ),
            ),
            array(
                'id'               => $prefix . 'corpo_docente_componentes_curriculares',
                'name'             => __( 'Corpo Docente X Componentes Curriculares', 'ifrs-portal-plugin-cursos' ),
                'type'             => 'file_advanced',
                'max_file_uploads' => 1,
                'mime_type'        => 'application/pdf',
                'attributes'       => array(
                    'required' => 'required',
                ),
            ),
            array(
                'id'   => $prefix . 'arquivos',
                'name' => __( 'Outros Arquivos', 'ifrs-portal-plugin-cursos' ),
                'desc' => __( 'Demais informações como "Ato autorizativo e/ou de reconhecimento do MEC", "Resolução de Aprovação e/ou alteração do Curso", etc.', 'ifrs-portal-plugin-cursos' ),
                'type' => 'file_advanced',
            ),
        ),
    );

    /**
	 * Taxonomy Unidade
	 */
    $metaboxes[] = array(
        'title'      => __( 'Unidade', 'ifrs-portal-plugin-cursos' ),
		'post_types' => 'curso',
		'context'    => 'side',
		'priority'   => 'low',
        'fields'     => array(
            array(
                'id'                => $prefix . 'unidade_taxonomy',
                'desc'              => __( 'Escolha a Unidade de oferta do Curso.', 'ifrs-portal-plugin-cursos' ),
                'type'              => 'taxonomy',
                'taxonomy'          => 'curso_unidade',
                'add_new'           => false,
                'remove_default'    => true,
            ),
        ),
    );

    /**
	 * Taxonomy Modalidade
	 */
    $metaboxes[] = array(
        'title'      => __( 'Modalidade', 'ifrs-portal-plugin-cursos' ),
		'post_types' => 'curso',
		'context'    => 'side',
		'priority'   => 'low',
        'fields'     => array(
            array(
                'id'                => $prefix . 'modalidade_taxonomy',
                'desc'              => __( 'Escolha a Modalidade do Curso.', 'ifrs-portal-plugin-cursos' ),
                'type'              => 'taxonomy',
                'taxonomy'          => 'curso_modalidade',
                'add_new'           => false,
                'remove_default'    => true,
                'field_type'        => 'radio_list',
            ),
        ),
    );

    /**
	 * Taxonomy Nível
	 */
    $metaboxes[] = array(
        'title'      => __( 'Nível', 'ifrs-portal-plugin-cursos' ),
		'post_types' => 'curso',
		'context'    => 'side',
		'priority'   => 'low',
        'fields'     => array(
            array(
                'id'                => $prefix . 'nivel_taxonomy',
                'desc'              => __( 'Escolha o Nível do Curso.', 'ifrs-portal-plugin-cursos' ),
                'type'              => 'taxonomy',
                'taxonomy'          => 'curso_nivel',
                'add_new'           => false,
                'remove_default'    => true,
                'field_type'        => 'select_tree',
            ),
        ),
    );

    /**
	 * Taxonomy Turno
	 */
    $metaboxes[] = array(
        'title'      => __( 'Turnos', 'ifrs-portal-plugin-cursos' ),
		'post_types' => 'curso',
		'context'    => 'side',
		'priority'   => 'low',
        'fields'     => array(
            array(
                'id'                => $prefix . 'turno_taxonomy',
                'desc'              => __( 'Escolha o(s) Turno(s) do Curso.', 'ifrs-portal-plugin-cursos' ),
                'type'              => 'taxonomy',
                'taxonomy'          => 'curso_turno',
                'add_new'           => false,
                'remove_default'    => true,
                'field_type'        => 'checkbox_list',
            ),
        ),
    );

    /**
	 * Coordenador do Curso
	 */
    $metaboxes[] = array(
        'title'      => __( 'Coordenador do Curso', 'ifrs-portal-plugin-cursos' ),
		'post_types' => 'curso',
		'context'    => 'side',
		'priority'   => 'low',
        'fields'     => array(
            array(
                'id'         => $prefix . 'coordenador_nome',
                'name'       => __( 'Nome', 'ifrs-portal-plugin-cursos' ),
                'type'       => 'text',
                'attributes' => array(
                    'required' => 'required',
                ),
            ),
            array(
                'id'         => $prefix . 'coordenador_email',
                'name'       => __( 'E-mail', 'ifrs-portal-plugin-cursos' ),
                'type'       => 'email',
                'attributes' => array(
                    'required' => 'required',
                ),
            ),
            array(
                'id'   => $prefix . 'coordenador_lattes',
                'name' => __( 'Currículo Lattes', 'ifrs-portal-plugin-cursos' ),
                'desc' => __( 'URL da página do Currículo Lattes.', 'ifrs-portal-plugin-cursos' ),
                'type' => 'url',
            )
        ),
    );

    return $metaboxes;
} );

/**
 * Templates
 */
add_filter( 'archive_template', function($template) {
    global $post;

    if (is_post_type_archive('curso') && empty(locate_template('archive-curso.php', false))) {
        return plugin_dir_path(__FILE__) . 'templates/archive-curso.php';
    }

    return $template;
} );

add_filter( 'single_template', function($template) {
    global $post;

    if (is_singular('curso') && empty(locate_template('single-curso.php', false))) {
        return plugin_dir_path(__FILE__) . 'templates/single-curso.php';
    }

    return $template;
} );

add_filter( 'page_template', function($template) {
    if (is_page('cursos') && empty(locate_template('page-cursos.php', false))) {
        return plugin_dir_path(__FILE__) . 'templates/page-cursos.php';
    }

    return $template;
} );
