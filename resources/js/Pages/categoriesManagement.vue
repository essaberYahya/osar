<template>
    <app-layout :settings="settings" title="Dashboard">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <adminCategoriesVue v-if="licence != null && licence.available" :access_right="licence.access_right"
                        :asset="asset" :categories="categories"></adminCategoriesVue>
                    <ServiceNotAvailableVue fname="sna" v-else></ServiceNotAvailableVue>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import Welcome from '@/Jetstream/Welcome.vue'

import ServiceNotAvailableVue from './content/includes/Partials/ServiceNotAvailable.vue'
import adminCategoriesVue from './content/includes/admin/adminCategories.vue'


export default defineComponent({
    components: {
        AppLayout,
        Welcome,
        adminCategoriesVue,
        ServiceNotAvailableVue
    },
    props: [
        "categories",
        "asset",
        "licence",
        "settings"
    ]
})
</script>
