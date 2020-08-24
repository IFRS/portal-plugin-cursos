<template>
  <div id="ifrs-cursos">
    <keep-alive include="Cursos">
      <router-view></router-view>
    </keep-alive>
  </div>
</template>

<script>
export default {
  name: 'App',
}
</script>
