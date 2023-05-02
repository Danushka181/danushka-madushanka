import { createI18n } from 'vue-i18n';

const messages = {
    en: {
        greeting: 'Hello!',
        displayResult: 'Display Results',
        of: 'of',
        nav: {
            tabTable: 'Table',
            tabGraph: 'Graph',
            tabSetting: 'Settings',
        },
        settings: {
            emailSetting:{
                label: 'Update Emails List'
            },
            numberOfRows : 'Number of Rows to display in the Table',
            humanDate: 'Make Table date Readable?',
            saveEmails: 'Save Emails',
            addEmail: 'Add Email',
        },
        table: {
            emailsListHeading: 'Emails List',
        },
        graph: {
            liveDataButton: 'Use Live Data'
        }
    },
    es: {
        displayResult: '',
        nav: {
            tabTable: 'Table',
            tabGraph: 'Graph',
            tabSetting: 'Settings',
        },
        settings: {
            emailSetting:{
                label: ''
            },
            numberOfRows : '',
            humanDate: '',
            saveEmails: '',
            addEmail: '',
        }
    }
};

const i18n = createI18n({
    locale: 'en',
    fallbackLocale: 'en',
    messages
});

export default i18n;
