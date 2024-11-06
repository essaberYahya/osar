<template>
    <app-layout :settings="settings" title="Dashboard">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <adminintroVue v-if="licence != null && licence.available" :access_right="licence.access_right"
                        :asset="asset" :intros="intros"></adminintroVue>
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
import adminintroVue from './content/includes/admin/adminintro.vue'
import ServiceNotAvailableVue from './content/includes/Partials/ServiceNotAvailable.vue'


export default defineComponent({
    components: {
        AppLayout,
        Welcome,
        adminintroVue,
        ServiceNotAvailableVue
    },
    props: [
        "intros",
        "asset",
        "licence",
        "settings"
    ]
})
</script>
