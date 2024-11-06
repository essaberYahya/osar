<template>
    <Head title="Welcome" />
    <app-layout
      title="appdynamic"
      :services="service"
      :navItems="navItems"
      :settings="settings"
      :intro="intro"
      :categories="categories"
    >
      <template #content>
        <div>
          <vintro :asset="asset" :intro="intros"></vintro>
          <vservices :asset="asset" :ourServices="service"></vservices>
          <elearningVue :asset="asset" :elearnings="elearnings"></elearningVue>

          <ourProject :asset="asset" :oprojects="oprojects"></ourProject>
          <ourCustomer :asset="asset" :ourCustomer="ourCustomer"></ourCustomer>
          <rowSectionData
            :asset="asset"
            :rowSectionData="rowSectionData"
          ></rowSectionData>
          <factVue></factVue>
         
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
  import sintroVue from "./content/includes/sintro.vue";
  import factVue from "./content/includes/fact.vue";
  import elearningVue from "./content/includes/elearning.vue";
  
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
      sintroVue,
      factVue,
      elearningVue,
    },
  
    props: [
      "canLogin",
      "canRegister",
      "laravelVersion",
      "phpVersion",
      "navItems",
      "settings",
      "intros",
      "service",
      "rowSectionData",
      "ourCustomer",
      "oprojects",
      "asset",
      "elearnings",
      "categories",
    ],
  });
  </script>
  