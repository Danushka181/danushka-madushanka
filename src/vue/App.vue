<script setup>
import TabNavigation from "./Navigation/Navigation.vue";

</script>
<template>
  <div>
    <router-view name="tab"></router-view>
    <router-view></router-view>
  </div>
</template>

<script>
  export default {
    name: 'App'
  };
</script> 