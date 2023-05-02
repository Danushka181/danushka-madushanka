<template>
  <button @click="clickHotDataButton" class="btn-def fetch-live">{{ $t('graph.liveDataButton')}}</button>
</template>
<script>
import {useStore} from "vuex";

export default {
    name: "LiveDataButton",
    setup() {
        const store = useStore();

        const clickHotDataButton = () => {
            console.log('clicked')
            store.dispatch('getGraphHotDataFromServer');
        }

        return {
            clickHotDataButton,
        }
    }
}
</script>