import { createStore } from 'vuex';
import settings from './modules/Settings';
import tabeledata from './modules/TableData';

// Create store
export default createStore({
    modules: {
        settings,
        tabeledata,
    },
});