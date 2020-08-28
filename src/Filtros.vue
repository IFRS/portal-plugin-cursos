<template>
  <aside class="filter">
    <h3 class="filter__title">Filtros</h3>
    <form class="filter__form" @submit.prevent="filtrar()">
      <div class="input-group">
        <label class="sr-only" for="ifrs-cursos-filtros-search">Termo para busca</label>
        <input class="form-control form-control-sm" type="text" v-model="filtros.search" id="ifrs-cursos-filtros-search" placeholder="Buscar cursos..."/>
      </div>
      <fieldset>
        <legend>Modalidade</legend>
        <div class="form-check form-check-inline" v-for="(modalidade, m) in modalidades" :key="m">
          <input class="form-check-input" type="checkbox" v-model="filtros.curso_modalidade" :value="modalidade.id" :id="'modalidade-' + modalidade.id">
          <label class="form-check-label" :for="'modalidade-' + modalidade.id">{{modalidade.name}}</label>
        </div>
      </fieldset>
      <fieldset v-if="!$wp.atts.unidade">
        <legend>Unidade</legend>
        <div class="form-check form-check-inline" v-for="(unidade, u) in unidades" :key="u">
          <input class="form-check-input" type="checkbox" v-model="filtros.curso_unidade" :value="unidade.id" :id="'unidade-' + unidade.id">
          <label class="form-check-label" :for="'unidade-' + unidade.id">{{unidade.name}}</label>
        </div>
      </fieldset>
      <fieldset>
        <legend>N&iacute;vel</legend>
        <template v-for="(nivel, n) in niveis">
          <div class="form-check" :key="n">
            <input class="form-check-input" type="checkbox" v-model="filtros.curso_nivel" :value="nivel.id" :id="'nivel-' + nivel.id">
            <label class="form-check-label" :for="'nivel-' + nivel.id">{{nivel.name}}</label>
          </div>
          <div class="form-check ml-3" v-for="filho in nivel.children" :key="filho.id">
            <input class="form-check-input" type="checkbox" v-model="filtros.curso_nivel" :value="filho.id" :id="'nivel-' + filho.id">
            <label class="form-check-label" :for="'nivel-' + filho.id">{{filho.name}}</label>
          </div>
        </template>
      </fieldset>
      <fieldset>
        <legend>Turno</legend>
        <div class="form-check form-check-inline" v-for="(turno, t) in turnos" :key="t">
          <input class="form-check-input" type="checkbox" v-model="filtros.curso_turno" :value="turno.id" :id="'turno-' + turno.id" >
          <label class="form-check-label" :for="'turno-' + turno.id">{{turno.name}}</label>
        </div>
      </fieldset>
      <fieldset class="text-center">
        <div class="btn-group" role="group" aria-label="Ações do Filtro">
          <button type="submit" class="btn btn-primary" :disabled="disabledActions">Filtrar<span class="sr-only">&nbsp;Cursos</span></button>
          <button type="reset" class="btn btn-outline-secondary" @click="limpar()">Limpar<span class="sr-only">&nbsp;filtros</span></button>
        </div>
      </fieldset>
    </form>
  </aside>
</template>

<script>
export default {
  name: 'Filtros',
  data() {
    return {
      modalidades: null,
      unidades: null,
      niveis: null,
      turnos: null,
      filtros: {
        search: '',
        curso_modalidade: [],
        curso_unidade: [],
        curso_nivel: [],
        curso_turno: [],
      },
    }
  },
  computed: {
    disabledActions: function() {
      return (
        this.filtros.search === ''
        &&
        this.filtros.curso_modalidade.length === 0
        &&
        this.filtros.curso_unidade.length === 0
        &&
        this.filtros.curso_nivel.length === 0
        &&
        this.filtros.curso_turno.length === 0
      );
    },
  },
  mounted() {
    this.getModalidades();
    this.getUnidades();
    this.getNiveis();
    this.getTurnos();
  },
  methods: {
    filtrar() {
      this.$emit('filtro', this.filtros);
    },
    limpar() {
      this.filtros = {
        search: '',
        curso_modalidade: [],
        curso_unidade: [],
        curso_nivel: [],
        curso_turno: [],
      }
      this.$emit('filtro');
    },
    getModalidades() {
      this.$axios.get('/curso_modalidade')
      .then(response => {
        this.modalidades = response.data;
      })
      .catch(error => {
        console.error(error);
      });
    },
    getUnidades() {
      this.$axios.get('/curso_unidade')
      .then(response => {
        this.unidades = response.data;
      })
      .catch(error => {
        console.error(error);
      });
    },
    getNiveis() {
      this.$axios.get('/curso_nivel', {
        params: {
          parent: 0,
        },
      })
      .then(response => {
        let niveis = response.data.map(pai => {
          pai.children = [];
          this.$axios.get('/curso_nivel', {
            params: {
              parent: pai.id,
            },
          })
          .then(response => {
            pai.children = response.data;
          });
          return pai;
        });
        this.niveis = niveis;
      })
      .catch(error => {
        console.error(error);
      });
    },
    getTurnos() {
      this.$axios.get('/curso_turno')
      .then(response => {
        this.turnos = response.data;
      })
      .catch(error => {
        console.error(error);
      });
    },
  },
}
</script>
