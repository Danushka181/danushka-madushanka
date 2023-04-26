import { reactive } from 'vue'

const state = reactive({
    tableData: []
})

const getters = {
    dmTableData: () => state.tableData
}

const mutations = {
    SET_TABLE_DATA: (data) => {
        state.tableData = data
    }
}

const actions = {
    async getTableData({ commit }) {
        const data = {
            action: 'dm_get_table_data_ajax',
            nonce: dmVueNonce.nonce,
        }

        // Make the AJAX request using jQuery
        jQuery.post(dmVueNonce.ajax_url, data, (response) => {
            const resData = JSON.parse(response)
            commit('SET_TABLE_DATA', resData)
        })
    },

    async loadTableData({ dispatch }) {
        try {
            await dispatch('getTableData')
        } catch (error) {
            console.log(error)
        }
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}
