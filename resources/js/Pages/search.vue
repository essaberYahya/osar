<template>
  <Head title="Welcome" />
  <app-layout
    :categories="categories"
    title="appdynamic"
    :navItems="navItems"
    :settings="settings"
  >
    <template #content>
      <div>
        <vsearchVue :asset="asset" :products="products"></vsearchVue>
      </div>
    </template>
  </app-layout>
</template>


<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayoutVue.vue";
import vintro from "@/Pages/content/includes/intro.vue";
import vservices from "@/Pages/content/includes/ourServices.vue";
import rowSectionData from "@/Pages/content/includes/rowSectionData.vue";
import ourCustomer from "@/Pages/content/includes/ourCustomer.vue";
import ourProject from "@/Pages/content/includes/projects.vue";
import signleproject from "@/Pages/content/includes/signleproject.vue";
import singleObjectSellVue from "./content/includes/singleObjectSell.vue";
import vsearchVue from "./content/includes/vsearch.vue";

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
    singleObjectSellVue,
    vsearchVue,
  },

  props: [
    "canLogin",
    "canRegister",
    "laravelVersion",
    "phpVersion",
    "navItems",
    "settings",
    "asset",
    "categories",
    "products",
  ],
});
</script>
