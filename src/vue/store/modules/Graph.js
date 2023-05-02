import { reactive } from 'vue'

const state = reactive({
    graphData: [],
})

const getters = {
    dmGraphData: () => state.graphData,
}

const mutations = {
    setGraphData(state, data){
        state.graphData = data;
    }
}

const actions = {
    getGraphDataFromServer({ commit }) {
        const data = {
            action: 'dm_get_graph_data_ajax',
            nonce: dmVueNonce.nonce,
        }
        // Make the AJAX request using jQuery
        jQuery.post(dmVueNonce.ajax_url, data, (response) => {
            const resData = JSON.parse(response)
            commit('setGraphData', resData)
        })
    },
    getGraphHotDataFromServer({ commit }) {
        const data = {
            action: 'dm_get_graph_data_ajax',
            nonce: dmVueNonce.nonce,
            hot_data: true
        }
        // Make the AJAX request using jQuery
        jQuery.post(dmVueNonce.ajax_url, data, (response) => {
            const resData = JSON.parse(response)
            commit('setGraphData', resData)
        })
    },
}

export default {
    state,
    getters,
    actions,
    mutations
}
