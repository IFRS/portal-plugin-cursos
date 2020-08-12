<?php
add_shortcode( 'cursos', function($atts) {
    // Attributes
    $atts = shortcode_atts(
        array(
            'site' => get_main_site_id(),
            'unidade' => null,
        ),
        $atts,
        'cursos'
    );

    // Query args
    $args = array(
        'post_type' => 'curso',
        'posts_per_page' => -1,
    );

    if ($atts['unidade']) {
        $args['tax_query'][] = array(
            'taxonomy' => 'curso_unidade',
            'field'    => 'slug',
            'terms'    => $atts['unidade'],
        );
    }

    if ($_POST) {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $args = array_merge($args, $_POST);
    }

    if (isset($_POST['curso_s'])) {
        $args['s'] = $_POST['curso_s'];
    }

    $is_mainsite = ($atts['site'] == get_current_blog_id());

    switch_to_blog($atts['site']);
    $cursos = new WP_Query($args);

    ob_start();
?>
    <div class="row">
        <div class="col-12 col-lg-9">
            <div class="cursos__content">
            <?php if ($cursos->have_posts()) : ?>
                <?php while ($cursos->have_posts()) : $cursos->the_post(); ?>
                    <div class="card curso-item">
                    <?php if (!$atts['unidade']) : ?>
                        <div class="card-header">
                            <?php foreach (get_the_terms(get_the_ID(), 'curso_unidade') as $unidade) : ?>
                                <span class="curso-item__unidade"><?php echo $unidade->name; ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                        <div class="card-body">
                            <h2 class="card-title curso-item__title">
                                <a href="<?php the_permalink(); ?>" class="curso-item__link"><?php the_title(); ?></a>
                                <?php if (!$is_mainsite) : ?>
                                    <span class="screen-reader-text"><?php _e('(Abre em outro site)', 'ifrs-portal-plugin-cursos'); ?></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="curso-item__icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M11 7h-5a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-5" />
                                        <line x1="10" y1="14" x2="20" y2="4" />
                                        <polyline points="15 4 20 4 20 9" />
                                    </svg>
                                <?php endif; ?>
                            </h2>
                            <p class="card-text">
                                <?php $niveis = wp_get_post_terms(get_the_ID(), 'curso_nivel', array('orderby' => 'term_id')); ?>
                                <?php foreach ($niveis as $nivel) : ?>
                                    <span class="curso-item__nivel">
                                        <?php echo $nivel->name; ?>
                                        <?php echo ($nivel !== end($niveis)) ? '<strong> / </strong>' : ''; ?>
                                    </span>
                                <?php endforeach; ?>
                                <?php foreach (get_the_terms(get_the_ID(), 'curso_modalidade') as $modalidade) : ?>
                                    <span class="curso-item__modalidade"><?php echo $modalidade->name; ?></span>
                                <?php endforeach; ?>
                            </p>
                        </div>
                        <div class="card-footer">
                            <?php $turnos = wp_get_post_terms(get_the_ID(), 'curso_turno', array('orderby' => 'term_order')); ?>
                            <?php foreach ($turnos as $turno) : ?>
                                <span class="curso-item__turnos"><?php echo $turno->name; echo ($turno !== end($turnos)) ? ', ' : ''; ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <?php if (isset($_POST['curso_s']) && !empty($_POST['curso_s'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php _e('N&atilde;o foram encontrados Cursos com os termos buscados.', 'ifrs-portal-plugin-cursos'); ?>
                    </div>
                <?php else : ?>
                    <div class="alert alert-warning" role="alert">
                        <strong><?php _e('Ops!'); ?></strong>&nbsp;<?php _e('N&atilde;o foram encontrados Cursos publicados.', 'ifrs-portal-plugin-cursos'); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <?php
                $modalidades = get_terms(array(
                    'taxonomy' => 'curso_modalidade',
                    'hide_empty' => false,
                    'orderby' => 'term_order',
                ));
                $unidades = get_terms(array(
                    'taxonomy' => 'curso_unidade',
                    'hide_empty' => false,
                    'orderby' => 'term_order',
                ));
                $niveis = get_terms(array(
                    'taxonomy' => 'curso_nivel',
                    'hide_empty' => false,
                    'orderby' => 'term_order',
                ));
                $turnos = get_terms(array(
                    'taxonomy' => 'curso_turno',
                    'hide_empty' => false,
                    'orderby' => 'term_order',
                ));
            ?>
            <aside class="filter">
                <h3 class="filter__title"><?php _e('Filtros'); ?></h3>
                <form action="" method="POST" class="filter__form">
                    <?php $seachfield_id = uniqid(); ?>
                    <div class="input-group">
                        <label class="sr-only" for="<?php echo $seachfield_id; ?>"><?php _e('Termo para busca'); ?></label>
                        <input class="form-control form-control-sm" type="text" name="curso_s" value="<?php echo (isset($_POST['curso_s'])) ? $_POST['curso_s'] : ''; ?>" id="<?php echo $seachfield_id; ?>" placeholder="<?php _e('Buscar cursos...'); ?>"/>
                    </div>
                    <fieldset>
                        <legend>Modalidade</legend>
                        <?php foreach ($modalidades as $modalidade): ?>
                            <?php $field_id = uniqid(); ?>
                            <?php $modalidade_check = (isset($_POST['curso_modalidade']) && in_array($modalidade->slug, $_POST['curso_modalidade'])) || is_tax('curso_modalidade', $modalidade->slug); ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="curso_modalidade[]" value="<?php echo $modalidade->slug; ?>" id="<?php echo $field_id; ?>" <?php echo $modalidade_check ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="<?php echo $field_id; ?>"><?php echo $modalidade->name; ?></label>
                            </div>
                        <?php endforeach; ?>
                    </fieldset>
                    <?php if (!$atts['unidade']) : ?>
                        <fieldset>
                            <legend>Unidade</legend>
                            <?php foreach ($unidades as $unidade): ?>
                                <?php $field_id = uniqid(); ?>
                                <?php $unidade_check = (isset($_POST['curso_unidade']) && in_array($unidade->slug, $_POST['curso_unidade'])) || is_tax('curso_unidade', $unidade->slug); ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="curso_unidade[]" value="<?php echo $unidade->slug; ?>" id="<?php echo $field_id; ?>" <?php echo $unidade_check ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="<?php echo $field_id; ?>"><?php echo $unidade->name; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </fieldset>
                    <?php endif; ?>
                    <fieldset>
                        <legend>N&iacute;vel</legend>
                        <?php foreach ($niveis as $nivel): ?>
                            <?php $field_id = uniqid(); ?>
                            <?php $nivel_check = (isset($_POST['curso_nivel']) && in_array($nivel->slug, $_POST['curso_nivel'])) || is_tax('curso_nivel', $nivel->slug); ?>
                            <div class="form-check<?php echo ($nivel->parent !== 0) ? ' ml-3' : '' ?>">
                                <input class="form-check-input" type="checkbox" name="curso_nivel[]" value="<?php echo $nivel->slug; ?>" id="<?php echo $field_id; ?>" <?php echo $nivel_check ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="<?php echo $field_id; ?>"><?php echo $nivel->name; ?></label>
                            </div>
                        <?php endforeach; ?>
                    </fieldset>
                    <fieldset>
                        <legend>Turno</legend>
                        <?php foreach ($turnos as $turno): ?>
                            <?php $field_id = uniqid(); ?>
                            <?php $turno_check = (isset($_POST['curso_turno']) && in_array($turno->slug, $_POST['curso_turno'])) || is_tax('curso_turno', $turno->slug); ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="curso_turno[]" value="<?php echo $turno->slug; ?>" id="<?php echo $field_id; ?>" <?php echo $turno_check ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="<?php echo $field_id; ?>"><?php echo $turno->name; ?></label>
                            </div>
                        <?php endforeach; ?>
                    </fieldset>
                    <div class="btn-group" role="group" aria-label="Ações do Filtro">
                        <input type="submit" value="Filtrar" class="btn btn-primary">
                        <a href="." class="btn btn-outline-secondary"><?php _e('Limpar Filtros', 'ifrs-portal-theme'); ?></a>
                    </div>
                </form>
            </aside>
        </div>
    </div>
<?php
    restore_current_blog();
    return ob_get_clean();
} );
