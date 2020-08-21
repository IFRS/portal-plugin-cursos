<template>
  <div class="row" v-if="cursos">
    <div class="col-12 col-lg-9">
      <div class="cursos__content">
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
    </div>
  </div>
  <div v-else class="text-center">
    <Loading/>
  </div>
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
    }
  },
  mounted() {
    this.$axios.get('/cursos')
    .then(response => {
      this.cursos = response.data;
    });
  },
}
</script>
