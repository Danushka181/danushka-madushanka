<template>
  <div class="dm-plugin-wrapper">
    <router-view name="tab"></router-view>
    <router-view></router-view>
  </div>
</template>

<script>
  import {useStore} from "vuex";
  import {onMounted} from "vue";

  export default {
    name: 'App',
      setup() {
          const store = useStore();

          // Get all settings when app mounted.
          onMounted(() => {
              store.dispatch('fetchSettings');
          });
      }
  };
</script> 