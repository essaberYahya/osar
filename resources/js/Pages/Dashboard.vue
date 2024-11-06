<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <welcome  v-if="licence != null && licence.available"
                        :access_right="licence.access_right" :asset="asset"/>
                        <ServiceNotAvailableVue fname="sna1" v-else></ServiceNotAvailableVue>
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


    export default defineComponent({
        components: {
            AppLayout,
            Welcome,
            ServiceNotAvailableVue
        },
        props : [
            "asset",
            "licence"
        ],
        created(){
            this.$store.commit("SetAsset",this.asset);
        }
    })
</script>