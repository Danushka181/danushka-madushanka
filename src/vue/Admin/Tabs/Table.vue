<template>
    <div class="table-wrapper block-wrap">
        <div class="table-wrapper__inner">
            <h1 class="common-heading">{{dmTableTitle}}</h1>
            <table>
                <TableHeadings />
                <TableRows />
                <TableFooter/>
            </table>
        </div>
    </div>
    <div class="table-wrapper block-wrap">
        <div class="table-wrapper__inner">
            <h1 class="common-heading">{{ $t('table.emailsListHeading')}}</h1>
            <ul>
                <li v-for="(email, index) in dmAllSettings.emails" :key="index">
                    <a :href="'mailto:' + email">{{ email }}</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import TableHeadings from "../../Components/Table/TableHeadings.vue";
import TableRows from "../../Components/Table/TableRows.vue";
import TableFooter from "../../Components/Table/TableFooter.vue";
import {computed, onMounted} from 'vue';
import { useStore } from 'vuex';

export default {
    name: "Table",
    components: {
        TableHeadings,
        TableRows,
        TableFooter,
    },
    setup() {
        const store = useStore();
        // Execute load table data from the database when table mounting.
        onMounted(() => {
            store.dispatch('getTableData');
        });

        // Get table title.
        const dmTableTitle = computed(() => {
            return store.getters.dmTableTitle;
        });

        const dmAllSettings = computed(() => {
            return store.getters.dmAllSettings;
        });
        return {
            dmTableTitle,
            dmAllSettings
        }
    },
};
</script>
