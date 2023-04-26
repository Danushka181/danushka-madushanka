const state = {
    settings: {
        numrows: 5,
        humandate: false,
        emails: []
    }
}

const getters = {
    dmSettings: state => state.settings
}

const mutations = {
    SET_SETTINGS: (state, settings) => {
        state.settings = settings
    }
}

const actions = {
    async fetchSettings({ commit }) {
        const response = await fetch('/api/settings')
        const settings = await response.json()
        commit('SET_SETTINGS', settings)
    },

    async loadSettings({ dispatch }) {
        try {
            await dispatch('fetchSettings')
            // Settings loaded successfully
        } catch (error) {
            // Error loading settings
        }
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}
