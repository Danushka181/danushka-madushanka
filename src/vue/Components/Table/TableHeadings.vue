<template>
    <thead>
      <tr>
          <th>Name</th>
          <th>Email</th>
      </tr>
    </thead>
</template>
<script>
import { mapGetters } from 'vuex';
import { toRaw } from 'vue'
export default {
    name: 'TableHeadings',
    computed: {
        ...mapGetters([
            'dmTableData'
        ])
    },
    created() {
        this.$store.dispatch('loadTableData');
        console.log('dmTableData:', this.dmTableData)

    },
    methods: {
        getTableData() {
            const tableData = toRaw(this.dmTableData)
            console.log(tableData)
        }
    }
}
</script>