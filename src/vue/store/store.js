import { createStore } from 'vuex';
import settings from './modules/Settings';
import tabeledata from './modules/TableData';
import graph from './modules/Graph';

// Create store
export default createStore({
    modules: {
        settings,
        tabeledata,
        graph,
    },
});