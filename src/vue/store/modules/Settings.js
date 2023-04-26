import axios from 'axios';

const state = {
    settings: [],
};

const getters = {
    dmSettings: state => state.settings
};

const actions = {
    async getSettings({ commit }) {
        const response = await axios.get(
            'https://jsonplaceholder.typicode.com/todos'
        );

        commit('dmSettings', response.data);
    },
};

const mutations = {
    setSettings: (state, settings) => (state.settings = setting),
    newTodo: (state, todo) => state.todos.unshift(todo),
    removeTodo: (state, id) =>
        (state.todos = state.todos.filter(todo => todo.id !== id)),
    updateTodo: (state, updTodo) => {
        const index = state.todos.findIndex(todo => todo.id === updTodo.id);
        if (index !== -1) {
            state.todos.splice(index, 1, updTodo);
        }
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};