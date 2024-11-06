<template>

    <Head title="Welcome" />
    <app-layout title="appdynamic" :navItems="navItems" :settings="settings">
        <template #content>
            <div>
                <signleproject :asset="asset" :myinteresting="myinteresting" :project="project"></signleproject>
                <div class="container mb-5">
                    <ourProject :asset="asset" :oprojects="oprojects"></ourProject>
                </div>
            </div>
        </template>
    </app-layout>
</template>


<script>
import { defineComponent } from 'vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayoutVue.vue'
import vintro from '@/Pages/content/includes/intro.vue';
import vservices from '@/Pages/content/includes/ourServices.vue';
import rowSectionData from '@/Pages/content/includes/rowSectionData.vue';
import ourCustomer from '@/Pages/content/includes/ourCustomer.vue';
import ourProject from '@/Pages/content/includes/projects.vue';
import signleproject from '@/Pages/content/includes/signleproject.vue';
export default defineComponent({
    components: {
        Head,
        Link,
        AppLayout,
        vintro,
        vservices,
        rowSectionData,
        ourCustomer,
        ourProject,
        signleproject
    },

    props: [
        "canLogin",
        "canRegister",
        "laravelVersion",
        "phpVersion",
        "navItems",
        "settings",
        "project",
        "myinteresting",
        "asset",
        "oprojects"
    ]
})
</script>
