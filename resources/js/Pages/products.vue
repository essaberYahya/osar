<template>

    <Head title="Welcome" />
    <app-layout title="appdynamic" :navItems="navItems" :categories="categories" :settings="settings">
        <template #content>
            <div>
                <allproductsVue :asset="asset" :settings="settings" :navItems="navItems" :products="products"
                    :categories="categories"></allproductsVue>
            </div>
        </template>
    </app-layout>
</template>


<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayoutVue.vue";
import allproductsVue from "./content/includes/allproducts.vue";

export default defineComponent({
    components: {
        Head,
        Link,
        AppLayout,
        allproductsVue,
    },

    props: ["navItems", "settings", "asset", "products", "categories"],
});
</script>
