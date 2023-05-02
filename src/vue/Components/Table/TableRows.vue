<template>
    <tbody>

        <tr v-for="(row, index) in dmTableDataRows.slice(0, dmNumRows)" :key="index">
            <td v-for="(col, td) in row" :key="td">
                <a v-if="td === 'url'" :href="col" target="_blank">{{col}}</a>
                <span v-else-if="td === 'date'">{{dmHumanDate ? new Date(col * 1000).toLocaleDateString() : col}}</span>
                <span v-else>{{col}}</span>
            </td>
        </tr>
    </tbody>
</template>

<script>
import { computed } from 'vue';
import { useStore } from 'vuex';

export default {
    name: 'TableRows',
    setup() {
        const store = useStore();
        // get table rows from the store
        const dmTableDataRows = computed(() => {
            return store.getters.dmTableDataRows;
        });
        // get number of row count from store settings
        const dmNumRows = computed(() => {
            return store.getters.dmNumRows;
        });
        // Get Human Date state form store.
        const dmHumanDate = computed( () => {
           return store.getters.dmHumanDate
        });

        return {
            dmTableDataRows,
            dmNumRows,
            dmHumanDate
        };
    },
};
</script>
