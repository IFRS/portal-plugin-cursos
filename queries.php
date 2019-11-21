<?php
function ifrs_cursos_custom_queries( $query ) {
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_post_type_archive('curso') || $query->is_tax('curso_modalidade') || $query->is_tax('curso_nivel') || $query->is_tax('curso_turno')) {
            $query->set('posts_per_page', -1);
            $query->set('nopaging', true);
            $query->set('orderby', 'title');
            $query->set('order', 'ASC');
        }
    }
}

add_action('pre_get_posts', 'ifrs_cursos_custom_queries');
