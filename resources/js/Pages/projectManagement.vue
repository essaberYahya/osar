<template>
    <app-layout :settings="settings" title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Project management</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <adminProjects v-if="licence != null && licence.available" :access_right="licence.access_right"
                        :categories="categories" :asset="asset" :projects="projects"></adminProjects>
                    <ServiceNotAvailableVue v-else fname="sna"></ServiceNotAvailableVue>
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
import adminProjects from './content/includes/admin/adminProjects.vue'
import ServiceNotAvailableVue from './content/includes/Partials/ServiceNotAvailable.vue'


export default defineComponent({
    components: {
        AppLayout,
        Welcome,
        adminServicesVue,
        adminProjects,
        ServiceNotAvailableVue
    },
    props: [
        "asset",
        "projects",
        "categories",
        "licence",
        "settings"
    ],
    created() {
        this.$store.commit("SetAsset", this.asset);
    }
})
</script>
