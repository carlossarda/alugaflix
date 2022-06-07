<script>
import MenuLateral from './MenuLateral/MenuLateral.vue';

export default {
  data() {
    return {
      count: 0
    }
  },
  components: {
      MenuLateral
  }
}
</script>

<template>
<div class="areaLogo">
    <h1>Alugaflix</h1>
</div>
<div class="conteudo">
    <MenuLateral />
    <div class="exibicaoPagina">
        <router-view></router-view>
    </div>
</div>
</template>

<style scoped>
.conteudo {
  display: flex;
}
.exibicaoPagina {
    width: 85%;
}
.areaLogo {
    min-height: 5vh;
}
</style>