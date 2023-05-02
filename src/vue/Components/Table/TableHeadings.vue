<template>
    <thead>
    <tr>
        <th v-for="(heading, index) in dmTableDataHeaders" :key="index">{{ heading }}</th>
    </tr>
    </thead>
</template>

<script>
import { computed } from 'vue';
import { useStore } from 'vuex';

export default {
    name: 'TableHeadings',
    setup() {
        const store = useStore();
        const dmTableDataHeaders = computed(() => {
            return store.getters.dmTableDataHeaders;
        });

        return {
            dmTableDataHeaders,
        };
    },
};
</script>
