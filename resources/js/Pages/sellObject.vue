<template>
    <app-layout :settings="settings" title="Dashboard">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <adminSellsVue v-if="licence != null && licence.available" :access_right="licence.access_right"
                        :asset="asset" :sells="sells" :categories="categories"></adminSellsVue>
                    <adminFormationsVue v-else></adminFormationsVue>
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
import adminFormationsVue from './content/includes/adminFormations.vue'
import adminSellsVue from './content/includes/admin/adminSells.vue'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

export default defineComponent({
    components: {
        AppLayout,
        Welcome,
        adminServicesVue,
        adminProjects,
        adminFormationsVue,
        adminSellsVue,
        vSelect
    },
    props: [
        "asset",
        "licence",
        "sells",
        "categories",
        "settings"
    ],
    created() {
        this.$store.commit("SetAsset", this.asset);
    }
})
</script>
