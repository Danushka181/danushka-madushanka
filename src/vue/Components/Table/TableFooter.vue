<template>
  <tfoot>
    <tr>
        <td
          :colspan="dmTableDataHeaders.length">
          <b>{{ $t('displayResult') }}</b> {{ dmNumRows }} {{ $t('of') }} {{ dmTableDataRows.length }}.
        </td>
    </tr>
  </tfoot>
</template>

<script>
import {useStore} from "vuex";
import {computed} from "vue";

export default {
    name: 'TableFooter',
    setup() {
        const store = useStore();
        // Get table rows from the store
        const dmTableDataRows = computed(() => {
            return store.getters.dmTableDataRows;
        });
        // Get number of row count from store settings
        const dmNumRows = computed(() => {
            return store.getters.dmNumRows;
        });
        // Get table headers
        const dmTableDataHeaders = computed(() => {
            return store.getters.dmTableDataHeaders;
        });

        return {
            dmTableDataRows,
            dmNumRows,
            dmTableDataHeaders
        };
    },
}
</script>