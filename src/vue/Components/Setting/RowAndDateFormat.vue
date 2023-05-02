<template>
    <div class="rows-and-date">
        <div class="num-rows">
            <h3>{{ $t('settings.numberOfRows') }} :</h3>
            <select name="" id="" v-model="numrows" @change="updateNumberOfRows">
                <option v-for="index in numberOfRows" :value="index" :key="index">{{index}}</option>
            </select>
        </div>
    </div>
    <div class="rows-and-date">
        <div class="num-rows">
            <h3><label for="humandate">{{ $t('settings.humanDate') }} :</label></h3>
            <input id="humandate" type="checkbox" v-model="humandate" @change="updateHumanDate" >
        </div>
    </div>
</template>

<script>
import { computed, reactive } from "vue";
import { useStore } from "vuex";

export default {
    name: "RowAndDateFormat",
    setup() {
        const store = useStore();

        const state = reactive({
            numberOfRows: 5,
            numrows: store.getters.dmNumRows,
            humandate: store.getters.dmHumanDate,
            errorMessage: "",
        });

        // Update Number of Rows
        const updateNumberOfRows = async (e) => {
            state.numrows = e.target.value;
            // prepare ajax data.
            const data = {
                action: 'dm_update_settings',
                nonce: dmVueNonce.nonce,
                numrows:  state.numrows
            }
            await store.dispatch('updateSettingsList', data);
        };

        // Update human date
        const updateHumanDate = async (e) => {
            state.humandate = e.target.checked;
            // prepare ajax data.
            const data = {
                action: 'dm_update_settings',
                nonce: dmVueNonce.nonce,
                humandate: state.humandate
            }
            await store.dispatch('updateSettingsList', data);
        };


        return {
            state,
            numrows: state.numrows,
            updateNumberOfRows,
            humandate: state.humandate,
            numberOfRows: state.numberOfRows,
            updateHumanDate
        };
    },
};
</script>
