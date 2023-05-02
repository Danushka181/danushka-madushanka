const state = {
    allSettings: {
        numrows: 5,
        humandate: false,
        emails: []
    },
    numRows: 5,
    humanDate: false,
    messageList: {},
    editEmails:[]
}

const getters = {
    dmAllSettings: state => state.allSettings,
    dmNumRows: state => state.numRows,
    dmHumanDate: state => state.humanDate,
    dmMessageList: state => state.messageList,
    dmEditEmails: state => state.editEmails
}

const mutations = {
    allSettings(state, settings) {
        state.allSettings = settings;
        state.numRows = settings.numrows;
        state.humanDate = settings.humandate;
        state.editEmails = [...settings.emails];
    },
    setNotifications( state, msg ) {
        state.messageList = msg;
    },
    setNumberOfRows( state, number) {
        state.numRows = number;
        state.allSettings.numrows = number;
    },
    setHumanDate( state, status ) {
        state.humanDate = status;
        state.allSettings.humandate = status
    },
    setEmailsList( state, emails ) {
        state.allSettings.emails = emails;
    }
}

const actions = {
    async fetchSettings({ commit }) {
        const data = {
            action: 'dm_get_all_settings',
            nonce: dmVueNonce.nonce,
        }
        // Make the AJAX request using jQuery
        jQuery.post(dmVueNonce.ajax_url, data, (response) => {
            const allSettings = JSON.parse(response);
            commit('allSettings', allSettings);
        });
    },
    async updateSettingsList({commit}, data ) {
        // Make the AJAX request using jQuery
        jQuery.post(dmVueNonce.ajax_url, data, (response) => {

            const resData = JSON.parse(response);

            const messages = {
                errors: resData.errors,
                status: resData.status,
                message: resData.message
            };
            commit( 'setNotifications', messages );
            setTimeout(()=> {
                const messages = {
                    errors: {},
                    status: false,
                    message: ''
                };
                commit( 'setNotifications', messages );
            },5000);

            if ( resData.status ) {
                if ( data.numrows ) {
                    commit( 'setNumberOfRows', data.numrows );
                }
                if ( typeof data.humandate !== 'undefined' ) {
                    commit( 'setHumanDate', data.humandate );
                }
                if ( data.emails ) {
                    commit( 'setEmailsList', data.emails )
                }
            }

        })
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}
