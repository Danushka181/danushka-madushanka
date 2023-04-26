import { createI18n } from 'vue-i18n';

const messages = {
    en: {
        greeting: 'Hello!'
    },
    es: {
        greeting: '¡Hola!'
    }
};

const i18n = createI18n({
    locale: 'en',
    fallbackLocale: 'en',
    messages
});

export default i18n;
