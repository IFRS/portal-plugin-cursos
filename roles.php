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
    $admin->add_cap('manage_modalidades');
    $admin->add_cap('assign_modalidades');
    $admin->add_cap('manage_niveis');
    $admin->add_cap('assign_niveis');
    $admin->add_cap('manage_turnos');
    $admin->add_cap('assign_turnos');

    if (!get_role('cadastrador_cursos')) {
        add_role('cadastrador_cursos', __('Cadastrador de Cursos'), array(
            'read'               => true,
            'upload_files'       => true,
            'edit_uploads'       => true,
            'delete_uploads'     => false,

            'create_cursos'      => true,
            'publish_cursos'     => true,
            'edit_cursos'        => true,
            'delete_cursos'      => false,

            'manage_modalidades' => false,
            'assign_modalidades' => true,
            'manage_niveis'      => false,
            'assign_niveis'      => true,
            'manage_turnos'      => false,
            'assign_turnos'      => true,
        ));
    }

    if (!get_role('gerente_cursos')) {
        add_role('gerente_cursos', __('Gerente de Cursos'), array(
            'read'               => true,
            'upload_files'       => true,
            'edit_uploads'       => true,
            'delete_uploads'     => true,

            'create_cursos'      => true,
            'publish_cursos'     => true,
            'edit_cursos'        => true,
            'delete_cursos'      => true,

            'manage_modalidades' => true,
            'assign_modalidades' => true,
            'manage_niveis'      => true,
            'assign_niveis'      => true,
            'manage_turnos'      => true,
            'assign_turnos'      => true,
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
    $admin->remove_cap('manage_modalidades');
    $admin->remove_cap('assign_modalidades');
    $admin->remove_cap('manage_niveis');
    $admin->remove_cap('assign_niveis');
    $admin->remove_cap('manage_turnos');
    $admin->remove_cap('assign_turnos');

    if (get_role('cadastrador_concursos')) {
        remove_role('cadastrador_concursos');
    }

    if (get_role('gerente_concursos')) {
        remove_role('gerente_concursos');
    }
}
