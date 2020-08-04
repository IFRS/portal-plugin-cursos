<div class="row">
    <div class="col-12 col-lg-9" class="cursos">
        <h2 class="cursos__title">
        <?php
            _e('Cursos', 'ifrs-portal-theme');

            if (is_tax('curso_modalidade') && !isset($_POST['curso_modalidade'])) {
                printf(__(' na modalidade %s', 'ifrs-portal-theme'), single_term_title('', false));
            }

            if (is_tax('curso_unidade') && !isset($_POST['curso_unidade'])) {
                printf(__(' ofertados no Campus %s', 'ifrs-portal-theme'), single_term_title('', false));
            }

            if (is_tax('curso_nivel') && !isset($_POST['curso_nivel'])) {
                printf(__(' do nível %s', 'ifrs-portal-theme'), single_term_title('', false));
            }

            if (is_tax('curso_turno') && !isset($_POST['curso_turno'])) {
                printf(__(' ofertados no turno da %s', 'ifrs-portal-theme'), single_term_title('', false));
            }

            if (is_search() && get_search_query()) {
                printf(__('<small>(Resultados com o termo &ldquo;%s&rdquo;)</small>', 'ifrs-portal-theme'), get_search_query());
            }
        ?>
        </h2>
        <?php if (have_posts()) : ?>
            <div class="cursos__content">
            <?php while(have_posts()) : the_post(); ?>
                <div class="card curso-item">
                    <div class="card-header">
                        <?php foreach (get_the_terms(get_the_ID(), 'curso_unidade') as $unidade) : ?>
                            <span class="curso-item__unidade"><?php echo $unidade->name; ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title curso-item__title"><a href="<?php the_permalink(); ?>" class="curso-item__link"><?php the_title(); ?></a></h2>
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
            </div>
        <?php else : ?>
            <?php if (is_search()) : ?>
                <div class="alert alert-danger" role="alert">
                    <p><?php _e('N&atilde;o foram encontrados Cursos com os termos buscados.', 'ifrs-portal-theme'); ?></p>
                </div>
            <?php else : ?>
                <div class="alert alert-warning" role="alert">
                    <strong><?php _e('Ops!'); ?></strong>&nbsp;<?php _e('N&atilde;o foram encontrados Cursos publicados.', 'ifrs-portal-theme'); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="col-12 col-lg-3">
        <?php load_template(plugin_dir_path(__FILE__) . 'filter.php'); ?>
    </div>
</div>
