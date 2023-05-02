import { reactive } from 'vue'

const state = reactive({
    tableHeaders: [],
    dmTableDataRows: [],
    dmTableTitle: '',
})

const getters = {
    dmTableDataHeaders: () => state.tableHeaders,
    dmTableDataRows: () => state.dmTableDataRows,
    dmTableTitle: () => state.dmTableTitle
}

const mutations = {
    setTableData(state, data){
        state.tableHeaders = data.headers;
        state.dmTableDataRows = data.rows;
        state.dmTableTitle = data.title;
    }
}

const actions = {
    getTableData({ commit }) {
        const data = {
            action: 'dm_get_table_data_ajax',
            nonce: dmVueNonce.nonce,
        }
        // Make the AJAX request using jQuery
        jQuery.post(dmVueNonce.ajax_url, data, (response) => {
            const resData = JSON.parse(response)
            commit('setTableData', resData)
        })
    },
}

export default {
    state,
    getters,
    actions,
    mutations
}
