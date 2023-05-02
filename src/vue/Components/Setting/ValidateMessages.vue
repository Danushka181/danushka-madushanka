<template>
    <div class="notifications-bar" :class="notifications.errors || notifications.errors ? 'show' : ''">
        <ul>
            <li :class="notifications.status ? '' : 'error'" v-for="(notification, index) in notifications.errors" :style="{ transitionDelay: index * 0.1 + 's' }" :key="index">{{ notification }}</li>
            <li v-if="notifications.message" :class="notifications.status ? '' : 'error'">{{notifications.message}}</li>
        </ul>

    </div>
</template>

<script>
import { useStore } from "vuex";
import {computed, reactive} from "vue";

export default {
    name: "ValidateMessages",
    setup() {
        const store = useStore();

        const notifications = computed(() => {
            const dmMessageList = store.getters.dmMessageList;
            return {
                errors: dmMessageList.errors,
                status: dmMessageList.status,
                message: dmMessageList.message
            };
        });

        return {
            notifications,
        };
    },
};
</script>
