<?php
// Fix Media Permissions
add_action('init', function() {
    global $wp_post_types;
    $wp_post_types['attachment']->cap->edit_posts = 'edit_uploads';
    $wp_post_types['attachment']->cap->delete_posts = 'delete_uploads';
});

// Create Roles
function ifrs_portal_cursos_addRoles() {
    $admin = get_role('administrator');
    $admin->add_cap('create_cursos');
    $admin->add_cap('publish_cursos');
    $admin->add_cap('edit_cursos');
    $admin->add_cap('delete_cursos');

    if (!get_role('cadastrador_cursos')) {
        add_role('cadastrador_cursos', __('Cadastrador de Cursos'), array(
            'read'           => true,
            'upload_files'   => true,
            'edit_uploads'   => true,
            'delete_uploads' => false,

            'create_cursos'  => true,
            'publish_cursos' => true,
            'edit_cursos'    => true,
            'delete_cursos'  => false,
        ));
    }

    if (!get_role('gerente_cursos')) {
        add_role('gerente_cursos', __('Gerente de Cursos'), array(
            'read'           => true,
            'upload_files'   => true,
            'edit_uploads'   => true,
            'delete_uploads' => true,

            'create_cursos'  => true,
            'publish_cursos' => true,
            'edit_cursos'    => true,
            'delete_cursos'  => true,
        ));
    }
}

// Remove Roles
function ifrs_portal_cursos_removeRoles() {
    $admin = get_role('administrator');
    $admin->remove_cap('create_concursos');
    $admin->remove_cap('publish_concursos');
    $admin->remove_cap('edit_concursos');
    $admin->remove_cap('delete_concursos');

    if (get_role('cadastrador_concursos')) {
        remove_role('cadastrador_concursos');
    }

    if (get_role('gerente_concursos')) {
        remove_role('gerente_concursos');
    }
}
