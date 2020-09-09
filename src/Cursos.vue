<template>
  <article class="cursos">
    <div class="row">
      <div class="col-12 col-lg-9">
        <h2 class="cursos__title">{{title}}</h2>
        <div v-if="description" v-html="description"/>
        <div class="cursos__content" v-if="!loading">
          <template v-if="cursos && cursos.length > 0">
            <div class="card curso-item" v-for="(curso, i) in cursos" :key="i">
              <div class="card-header" v-if="!$wp.atts.unidade">
                <span class="curso-item__unidade">
                  {{curso.meta_box._curso_unidade_taxonomy.name}}
                </span>
              </div>
              <div class="card-body">
                <h2 class="card-title curso-item__title">
                  <a :href="curso.link" class="curso-item__link" @click.prevent.stop="$router.push({ path: `/${curso.slug}`});">{{curso.title.rendered}}</a>
                </h2>
                <p class="card-text">
                  <span class="curso-item__nivel" v-for="(nivel, n) in curso.meta_box._curso_nivel_taxonomy" :key="n">
                    {{nivel.name}}
                    <template v-if="n+1 < curso.meta_box._curso_nivel_taxonomy.length">
                      /
                    </template>
                  </span>
                  <span class="curso-item__modalidade">
                    {{curso.meta_box._curso_modalidade_taxonomy.name}}
                  </span>
                </p>
              </div>
              <div class="card-footer">
                <span class="curso-item__turnos" v-for="(turno, t) in curso.meta_box._curso_turno_taxonomy" :key="t">
                  {{turno.name}}<template v-if="t+1 < curso.meta_box._curso_turno_taxonomy.length">,</template>
                </span>
              </div>
            </div>
          </template>
          <div v-else class="alert alert-warning">
            N&atilde;o foram encontrados Cursos.
          </div>
        </div>
        <div v-else class="text-center">
          <Loading/>
        </div>
      </div>
      <div class="col-12 col-lg-3">
        <Filtros @filtro="onFiltro"/>
      </div>
      <div class="col-12" v-if="pages && pages > 1">
        <nav aria-label="Paginação de Cursos">
            <ul class="pagination justify-content-center">
              <li class="page-item" :class="(page == 1) ? 'disabled' : ''">
                <button class="page-link" :disabled="(page == 1)" @click="page = page - 1">Anterior</button>
              </li>
              <li class="page-item" v-for="n in pages" :key="n" :class="(page == n) ? 'disabled' : ''">
                <button class="page-link" :disabled="(page == n)" @click="page = n">{{n}}</button>
              </li>
              <li class="page-item" :class="(page == pages) ? 'disabled' : ''">
                <button class="page-link" :disabled="(page == pages)" @click="page = page + 1">Pr&oacute;xima</button>
              </li>
            </ul>
          </nav>
      </div>
    </div>
  </article>
</template>

<script>
import Loading from './Loading';
import Filtros from './Filtros';

export default {
  name: 'Cursos',
  components: {
    Loading,
    Filtros,
  },
  data() {
    return {
      loading: false,
      title: this.$wp.title || 'Cursos',
      description: this.$wp.description || '',
      cursos: null,
      pages: null,
      page: 1,
      per_page: this.$wp.atts.posts_per_page,
      search: this.$route.query.busca || null,
      curso_modalidade: this.$route.query.modalidade || [],
      curso_unidade: this.$wp.atts.unidade || this.$route.query.unidade || [],
      curso_nivel: this.$route.query.nivel || [],
      curso_turno: this.$route.query.turno || [],
    }
  },
  mounted() {
    this.getCursos();
  },
  methods: {
    getCursos(filtros) {
      this.loading = true;

      let query = {
        order: 'asc',
        orderby: 'title',
        page: this.page,
        per_page: this.per_page,
        search: this.search,
        curso_modalidade: this.curso_modalidade,
        curso_unidade: this.curso_unidade,
        curso_nivel: this.curso_nivel,
        curso_turno: this.curso_turno,
      };

      if (filtros) {
        query = Object.assign(query, filtros);
      }

      this.$http.get('/cursos', {
        params: query,
      })
      .then(response => {
        this.cursos = response.data;
        this.pages = parseInt(response.headers['x-wp-totalpages']);
      })
      .catch(error => {
        console.error(error);
      })
      .then(() => {
        this.loading = false;
      });
    },
    onFiltro: function (params) {
      this.getCursos(params);
    }
  },
  watch: {
    page: function(newPage) {
      this.getCursos();
    },
  },
}
</script>
