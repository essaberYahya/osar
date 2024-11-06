<template>
  <div>
    <section class="wpo-page-title">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="wpo-breadcumb-wrap mt-5">
                        <h2></h2>
                        <ol class="wpo-breadcumb-wrap">
                            <li><a href="#">Search for your product</a></li>
                            <li>{{ vdescription }}</li>
                        </ol>
                    </div>
                    <div id="mc_embed_signup2">
                    <div id="mc_embed_signup_scroll2">
                      <div class="mc-field-group input-group">
                        <input
                          type="text"
                          v-model="keyworld"
                          name="keyworld"
                          class="required email form-control"
                          placeholder="Search for your product"
                          id="mce-EMAIL2"
                          v-on:keyup.enter="search"
                        />
                        <button
                          id="mc-embedded-subscribe2"
                          class="theme-btn"
                          @click="search"
                        >
                          Search
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    
    <section class="wrapper bg-light wrapper-border">
      <div v-if="searching" class="justify-center">
        <spinnerVue></spinnerVue>
      </div>
      <div class="xddata" v-else>
        <div v-if="data != null" class="container py-14 py-md-16">
          <div class="row align-items-center mb-10">
            <div class="col-md-8 col-lg-9 col-xl-8 col-xxl-7 pe-xl-20">
              <h3 class="display-4 mb-0">
                We found {{ this.data.total }} product
              </h3>
              <p>Vanotic provide many IT/IS product try to find yours</p>
            </div>
            <!--/column -->
            <div class="col-md-4 col-lg-3 ms-md-auto text-md-end mt-5 mt-md-0">
              <Link
                href="/products"
                class="theme-btn"
                >see all products</Link
              >
            </div>
            <!--/column -->
          </div>
          <!--/.row -->
          <div class="row gx-lg-6 gx-xl-11 gy-10 blog grid-view mt-3"></div>
          <!-- /.row -->
          <select
            v-if="this.data.last_page > 1"
            class="form-select"
            v-model="turl"
          >
            <option v-for="(lab, i) in this.data.links" :key="i">
              <Link
                :href="lab.url"
                class="badge rounded-pill bg-blue mr-2"
                v-if="i > 1 && i < this.data.links.length - 1"
                >{{ lab.label }}</Link
              >
            </option>
          </select>

          <section class="wpo-blog-section mt-2" id="blog">
            <div class="container">
                <div class="wpo-blog-items">
                    <div class="row">
                        <cardProductVue v-for="item in this.data.data" :key="item.id" :item="item" :asset="asset">
                        </cardProductVue>

                    </div>
                </div>
            </div> <!-- end container -->
        </section>
          <!-- /section -->
        </div>
      </div>
      <!-- /.container -->
    </section>
    <section class="wrapper bg-light wrapper-border">
      <div class="container py-14 py-md-16">
        <div class="row align-items-center mb-10">
          <div class="col-md-8 col-lg-9 col-xl-8 col-xxl-7 pe-xl-20">
            <h3 class="display-4 mb-0">Find your request here</h3>
            <p>Vanotic provide many IT/IS product try to find yours</p>
          </div>
          <!--/column -->
          <div class="col-md-4 col-lg-3 ms-md-auto text-md-end mt-5 mt-md-0">
            <Link
              href="/products"
              class="btn btn-soft-primary rounded-pill mb-0"
              >see all products</Link
            >
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
        <div class="row gx-lg-6 gx-xl-11 gy-10 blog grid-view"></div>
        <!-- /.row -->
        <div class="form-select-wrapper mt-3">
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
        <section class="wpo-blog-section mt-2" id="blog">
            <div class="container">
                <div class="wpo-blog-items">
                    <div class="row">
                        <cardProductVue v-for="item in products.data" :key="item.id" :item="item" :asset="asset">
                        </cardProductVue>

                    </div>
                </div>
            </div> <!-- end container -->
        </section>
        <!-- /section -->
      </div>
      <!-- /.container -->
    </section>
  </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
import singleProjectIntroVue from "./Partials/singleProjectIntro.vue";
import cardProductVue from "./Partials/cardProduct.vue";
import JetInput from "@/Jetstream/Input.vue";
import spinnerVue from "./Partials/spinner.vue";

export default {
  components: {
    singleProjectIntroVue,
    Link,
    cardProductVue,
    JetInput,
    spinnerVue,
  },
  data() {
    return {
      keyworld: null,
      data: null,
      searching: false,
      url: null,
      turl: null,
    };
  },
  props: ["asset", "products"],
  methods: {
    setProductForQuot() {
      this.$store.commit("setproductsForQuot", this.item);
    },
    search() {
      this.searching = true;
      axios
        .get("/api/v1/psearch/" + this.keyworld)
        .then((result) => {
          this.data = result.data.data;
          this.searching = false;
        })
        .catch((err) => {
          this.searching = false;
        });
    },
    fetchResult($url) {
      this.searching = true;
      axios
        .get($url)
        .then((result) => {
          this.data = result.data.data;
          this.searching = false;
        })
        .catch((err) => {
          this.searching = false;
        });
    },
  },
  watch: {
    url: function () {
      this.$inertia.get(this.products.path + "?page=" + this.url);
    },
    turl: function () {
      this.fetchResult(this.data.path + "?page=" + this.turl);
    },
  },
};
</script>
<style scoped>
.boxactions.d-flex {
  gap: 15px;
  margin-top: 17px;
}

input#mc-embedded-subscribe2 {
  width: 85px;
  padding: 5px;
}
</style>
