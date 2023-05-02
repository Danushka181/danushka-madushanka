<template>
    <div class="email-settings">
        <h3>{{ $t('settings.emailSetting.label') }} :</h3>
        <div v-for="(email, index) in emailList" :key="index" class="fields-wrapper">
            <input
                v-model="emailList[index]"
                :placeholder="'Email Address ' + (index+1)"
                required />
            <button
                class="email-btn email-btn--add"
                :disabled="isAddButtonDisabled"
                @click="addEmail(index)">+</button>
            <button
                class="email-btn email-btn--delete"
                @click="removeEmail(index)">-</button>
        </div>
       <div class="action-btn">
           <button
               class="btn-def"
               v-if="emailList.length === 0"
               @click="addEmail(0)">{{ $t('settings.addEmail')}}</button>
           <button
               v-if="emailList.length > 0"
               class="btn-def"
               @click="saveEmailSettings">{{ $t('settings.saveEmails') }}</button>
       </div>
      <ValidateMessages/>
    </div>
</template>

<script>

import {computed, onMounted, reactive} from 'vue';
import {useStore} from "vuex";
import ValidateMessages from "./ValidateMessages.vue";

export default {
    name: 'EmailSettings',
    components: {
        ValidateMessages
    },
    setup() {
        const store = useStore();

        const state = reactive({
            emailList: store.getters.dmEditEmails,
            isSaveEnable: true,
        });

        /**
         * Add new Email Address to Emails List array.
         * @param index
         */
        const addEmail = (index) => {
            state.emailList.splice(index+1, 0, '');
        };

        /**
         * Remove Email address From Emails list array using Index.
         * @param index
         */
        const removeEmail = (index) => {
            state.emailList.splice(index, 1);
            state.isSaveEnable = true;
        };

        /**
         * Save Emails to database after clicking the save button.
         * @returns {Promise<void>}
         */
        const saveEmailSettings = async () => {
            // prepare ajax data.
            const data = {
                action: 'dm_update_settings',
                nonce: dmVueNonce.nonce,
                emails: state.emailList
            }

            await store.dispatch('updateSettingsList', data);
        };

        return {
            ...state,
            addEmail,
            removeEmail,
            saveEmailSettings,
            isAddButtonDisabled: computed(() => state.emailList.length >= 5),
            isSaveBtnDisabled: computed(()=> state.isSaveEnable)
        };
    }
};
</script>
