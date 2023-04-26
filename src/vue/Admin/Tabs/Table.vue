<template>
  <div class="table-wrapper">
      <div class="table-wrapper__inner">
          <table>
              <TableHeadings />
              <TableRows />
          </table>
      </div>
  </div>
</template>

<script>
import TableHeadings from "../../Components/Table/TableHeadings.vue";
import TableRows from "../../Components/Table/TableRows.vue";

export default {
	name: "Table",
	components: {
      TableHeadings,
      TableRows,
	},
  methods: {
      loadTableData: () => {
          const data = {
              action: 'dm_get_table_data_ajax',
              nonce: dmVueNonce.nonce,
          };
          // Make the AJAX request using jQuery
          jQuery.post( dmVueNonce.ajax_url, data, ( response ) => {
              // Handle the response here
              const data = JSON.parse(response);
              console.log(data)
          });
      },
  },
  mounted() {
      this.loadTableData(),
      console.log('loaded');
  }
}
</script>