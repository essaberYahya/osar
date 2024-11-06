<template>
    <app-layout :settings="settings" title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Services</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <adminSettingsVue :setting="settings"></adminSettingsVue>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import Welcome from '@/Jetstream/Welcome.vue'
import adminServicesVue from './content/includes/admin/adminServices.vue'
import ServiceNotAvailableVue from './content/includes/Partials/ServiceNotAvailable.vue'
import adminSettingsVue from './content/includes/admin/adminSettings.vue'



export default defineComponent({
    components: {
        AppLayout,
        Welcome,
        adminServicesVue,
        ServiceNotAvailableVue,
        adminSettingsVue
    },
    props: [
        "asset",
        "settings",
        "licence"
    ],
    created() {
        this.$store.commit("SetAsset", this.asset);
    }
})
</script>
