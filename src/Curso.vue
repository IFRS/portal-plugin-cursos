<template>
  <div v-if="curso">
    <div class="row">
      <div class="col-12 col-lg-9">
        <h2 class="curso__title">{{curso.title.rendered}}</h2>
        <div class="curso__content">
          <img class="curso__thumb" v-if="media" :src="media.source_url" :alt="media.alt_text"/>
          <template v-html="curso.content.rendered"/>
          <h3>Pr&eacute;-requisitos</h3>
          <p v-for="(requisito, r) in curso.meta_box._curso_nivel_taxonomy" :key="r">
            {{requisito.description}}
          </p>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col">
            <div class="curso-arquivos">
              <div class="card bg-light">
                <div class="card-header">
                  <h3 class="curso-arquivos__title">Grade e Corpo Docente</h3>
                </div>
                <div class="list-group list-group-flush" role="list">
                  <a :href="curso.meta_box._curso_ppc[0].url" class="list-group-item list-group-item-action" role="listitem">Projeto Pedag&oacute;gico do Curso (PPC)</a>
                  <a :href="curso.meta_box._curso_matriz_curricular[0].url" class="list-group-item list-group-item-action" role="listitem">Matriz Curricular</a>
                  <a :href="curso.meta_box._curso_representacao_grafica[0].url" class="list-group-item list-group-item-action" role="listitem">Representa&ccedil;&atilde;o Gr&aacute;fica</a>
                  <a :href="curso.meta_box._curso_corpo_docente[0].url" class="list-group-item list-group-item-action" role="listitem">Corpo Docente</a>
                  <a :href="curso.meta_box._curso_corpo_docente_componentes_curriculares[0].url" class="list-group-item list-group-item-action" role="listitem">Corpo Docente X Componentes Curriculares</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6" v-if="curso.meta_box._curso_arquivos.lenght > 0">
            <div class="curso-arquivos">
              <div class="card bg-light">
                <div class="card-header">
                  <h3 class="curso-arquivos__title">Demais Arquivos</h3>
                </div>
                <div class="list-group list-group-flush" role="list">
                  <a v-for="(arquivo, a) in curso.meta_box._curso_arquivos" :key="a" :href="arquivo.url" class="list-group-item list-group-item-action" role="listitem">{{arquivo.title}}</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-3">
        <div class="row">
          <div class="col">
            <div class="curso-aside">
              <h3 class="curso-aside__title">Informa&ccedil;&otilde;es</h3>
              <div class="curso-aside__content">
                <div class="curso-info">
                  <svg xmlns="http://www.w3.org/2000/svg" class="curso-info__icon" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"/>
                    <path d="M16 16v2a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h2v-2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-2" />
                  </svg>
                  <h4 class="curso-info__title">Modalidade</h4>
                  <p class="curso-info__text">{{curso.meta_box._curso_modalidade_taxonomy.name}}</p>
                </div>
                <div class="curso-info">
                  <svg xmlns="http://www.w3.org/2000/svg" class="curso-info__icon" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"/>
                    <line x1="3" y1="21" x2="21" y2="21" />
                    <line x1="9" y1="8" x2="10" y2="8" />
                    <line x1="9" y1="12" x2="10" y2="12" />
                    <line x1="9" y1="16" x2="10" y2="16" />
                    <line x1="14" y1="8" x2="15" y2="8" />
                    <line x1="14" y1="12" x2="15" y2="12" />
                    <line x1="14" y1="16" x2="15" y2="16" />
                    <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" />
                  </svg>
                  <h4 class="curso-info__title">Unidade</h4>
                  <p class="curso-info__text">{{curso.meta_box._curso_unidade_taxonomy.name}}</p>
                </div>
                <div class="curso-info">
                  <svg xmlns="http://www.w3.org/2000/svg" class="curso-info__icon" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"/>
                    <rect x="3" y="15" width="6" height="6" rx="2" />
                    <rect x="15" y="15" width="6" height="6" rx="2" />
                    <rect x="9" y="3" width="6" height="6" rx="2" />
                    <path d="M6 15v-1a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v1" />
                    <line x1="12" y1="9" x2="12" y2="12" />
                  </svg>
                  <h4 class="curso-info__title">N&iacute;vel</h4>
                  <p class="curso-info__text">
                    <span v-for="(nivel, n) in curso.meta_box._curso_nivel_taxonomy" :key="n">{{nivel.name}}<template v-if="n < (curso.meta_box._curso_nivel_taxonomy.length - 1)"> / </template></span>
                  </p>
                </div>
                <div class="curso-info">
                  <svg xmlns="http://www.w3.org/2000/svg" class="curso-info__icon" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"/>
                    <circle cx="12" cy="12" r="4" />
                    <path d="M3 12h1M12 3v1M20 12h1M12 20v1M5.6 5.6l.7 .7M18.4 5.6l-.7 .7M17.7 17.7l.7 .7M6.3 17.7l-.7 .7" />
                  </svg>
                  <h4 class="curso-info__title">Turnos</h4>
                  <p class="curso-info__text">
                    <span v-for="(turno, t) in curso.meta_box._curso_turno_taxonomy" :key="t">{{turno.name}}<template v-if="t < (curso.meta_box._curso_turno_taxonomy.length - 1)">, </template></span>
                  </p>
                </div>
                <div class="curso-info">
                  <svg xmlns="http://www.w3.org/2000/svg" class="curso-info__icon" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"/>
                    <rect x="4" y="5" width="16" height="16" rx="2" />
                    <line x1="16" y1="3" x2="16" y2="7" />
                    <line x1="8" y1="3" x2="8" y2="7" />
                    <line x1="4" y1="11" x2="20" y2="11" />
                    <rect x="8" y="15" width="2" height="2" />
                  </svg>
                  <h4 class="curso-info__title">Dura&ccedil;&atilde;o</h4>
                  <p class="curso-info__text">{{curso.meta_box._curso_duracao}} <span class="curso-info__text--lower">({{curso.meta_box._curso_carga_horaria}}h)</span></p>
                </div>
                <div class="curso-info" v-if="curso.meta_box._curso_nota">
                  <svg xmlns="http://www.w3.org/2000/svg" class="curso-info__icon" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"/>
                    <path d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
                  </svg>
                  <h4 class="curso-info__title">Avalia&ccedil;&atilde;o do Curso</h4>
                  <p class="curso-info__text">{{curso.meta_box._curso_nota}}</p>
                </div>
              </div>
            </div>
            <div class="curso-aside">
              <h3 class="curso-aside__title">Coordena&ccedil;&atilde;o</h3>
              <div class="curso-aside__content">
                <div class="curso-coordenador">
                  <p class="curso-coordenador__nome">
                    <a v-if="curso.meta_box._curso_coordenador_lattes" :href="curso.meta_box._curso_coordenador_lattes">{{curso.meta_box._curso_coordenador_nome}}</a>
                    <template v-else>
                      {{curso.meta_box._curso_coordenador_nome}}
                    </template>
                  </p>
                  <span class="curso-coordenador__email"><a :href="'mailto:'+curso.meta_box._curso_coordenador_email" target="_blank" rel="noopener noreferrer">{{curso.meta_box._curso_coordenador_email}}</a></span>
                </div>
              </div>
            </div>
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
  name: 'Curso',
  components: {
    Loading,
  },
  props: ['slug'],
  data() {
    return {
      curso: null,
      media: null,
    }
  },
  mounted() {
    this.$axios.get('/cursos', {
      params: {
        slug: this.slug,
      },
    })
    .then(response => {
      this.curso = response.data[0];
    });
  },
  watch: {
    curso: function(curso) {
      if (curso.featured_media) {
        this.$axios.get('/media/' + curso.featured_media)
        .then(response => {
          this.media = response.data;
        });
      }
    },
  },
}
</script>
