<template>
    <n-loading-bar-provider>
        <n-message-provider>
            <n-notification-provider>
                <n-dialog-provider>
                    <sign-up/>
                </n-dialog-provider>
            </n-notification-provider>
        </n-message-provider>
    </n-loading-bar-provider>
</template>

<script setup lang="ts">
import SignUp from "./pages/SignUp/SignUp.vue";
</script>

<style scoped>

</style>
