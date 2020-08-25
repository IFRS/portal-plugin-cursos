<template>
  <article class="cursos">
    <div class="row">
      <div class="col-12 col-lg-9">
        <h2 class="cursos__title">Cursos</h2>
        <div class="cursos__content" v-if="cursos">
          <div class="card curso-item" v-for="(curso, i) in cursos" :key="i">
            <div class="card-header">
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
        </div>
        <div v-else class="text-center">
          <Loading/>
        </div>
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

export default {
  name: 'Cursos',
  components: {
    Loading,
  },
  data() {
    return {
      cursos: null,
      pages: null,
      page: 1,
    }
  },
  mounted() {
    this.getCursos();
  },
  methods: {
    getCursos() {
      this.$axios.get('/cursos', {
        params: {
          order: 'asc',
          orderby: 'title',
          page: this.page,
          per_page: 1,
        }
      })
      .then(response => {
        this.cursos = response.data;
        this.pages = parseInt(response.headers['x-wp-totalpages']);
      });
    },
  },
  watch: {
    page: function(newPage) {
      this.getCursos();
    },
  },
}
</script>
