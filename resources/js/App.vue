<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>
<script>
import bulma from "bulma-extensions";
export default {
  components: {
    bulma
  }
};
</script>
<style  lang="scss">
@import "../../public/assets/scss/theme.scss";
</style>