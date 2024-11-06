<template>
  <Head title="Welcome" />
  <app-layout
    :categories="categories"
    title="appdynamic"
    :navItems="navItems"
    :settings="settings"
  >
    <template #content>
      <singleProjectIntroVue
        :vtitle="category.name"
        :vdescription="category.description"
        :vcreated_at="category.created_at"
      ></singleProjectIntroVue>

      <div class="mt-5">
        <div class="container mt-5">
          <div class="row">
            <cardProductVue
              v-for="item in products.data"
              :key="item.id"
              :item="item"
              :asset="asset"
            >
            </cardProductVue>
            <div class="form-select-wrapper">
              <select class="form-select" v-model="url">
                <option v-for="(lab, i) in products.links" :key="i">
                  <Link
                    :href="lab.url"
                    class="badge rounded-pill bg-blue mr-2"
                    v-if="i > 1 && i < products.links.length - 1"
                    >{{ lab.label }}</Link
                  >
                </option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </template>
  </app-layout>
</template>


<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayoutVue.vue";
import singleProjectIntroVue from "./content/includes/Partials/singleProjectIntro.vue";
import cardProductVue from "./content/includes/Partials/cardProduct.vue";

export default defineComponent({
  components: {
    Head,
    Link,
    AppLayout,
    singleProjectIntroVue,
    cardProductVue,
  },
  data() {
    return {
      url: null,
    };
  },
  props: [
    "navItems",
    "settings",
    "asset",
    "products",
    "category",
    "categories",
  ],
  methods: {
    setProductForQuot($item) {
      this.$store.commit("setproductsForQuot", $item);
    },
  },
  watch: {
    url: function () {
      this.$inertia.get(this.products.path + "?page=" + this.url);
    },
  },
});
</script>
