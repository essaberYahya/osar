<template>
    <div id="latesttraining">
        <singleProjectIntroVue vtitle="Products" vdescription="Here is the list of our products"
            :vcreated_at="new Date()">
        </singleProjectIntroVue>
        <section class="wrapper bg-light">
            <div class="container py-14 py-md-16">
                <div class="grid grid-view projects-masonry">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div v-if="products.last_page > 1" class="mt-2">
                                <h3 class="mt-10 mb-3">
                                    Select from {{ this.products.total }} products
                                </h3>
                                <div class="form-select-wrapper">
                                    <select class="form-select" v-model="url">
                                        <option v-for="(lab, i) in products.links" :key="i">
                                            <Link :href="lab.url" class="badge rounded-pill bg-blue mr-2"
                                                v-if="i > 1 && i < products.links.length - 1">{{ lab.label }}</Link>
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <section class="wpo-blog-section " id="blog">
                        <div class="container">
                            <div class="row">
                                <div class="wpo-section-title">
                                    <p>Latest product</p>
                                    <h3> Here is the latest products from our database</h3>
                                </div>
                            </div>
                            <div class="wpo-blog-items">
                                <div class="row">
                                    <CardProduct v-for="item in products.data" :key="item.id" :item="item"
                                        :asset="asset">
                                    </CardProduct>

                                </div>
                            </div>
                        </div> <!-- end container -->
                    </section>



                    <!-- /.row -->
                </div>
                <!-- /.grid -->
            </div>

            <!-- /.container -->
        </section>
    </div>
</template>
<script>
import InfiniteScroll from "infinite-loading-vue3";
import singleProjectIntroVue from "./Partials/singleProjectIntro.vue";
import { Link } from "@inertiajs/inertia-vue3";
import CardProduct from "./Partials/cardProduct.vue";

export default {
    components: {
        InfiniteScroll,
        singleProjectIntroVue,
        Link,
        CardProduct,
    },
    props: ["asset", "categories", "products"],
    data() {
        return {
            last: null,
            next: null,
            current: null,
            elearnings: null,
            belearnings: null,
            total: null,
            path: null,
            nnoResult: true,
            message: "",
            url: "",
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() { },
    },
    watch: {
        url: function () {
            this.$inertia.get(this.products.path + "?page=" + this.url);
        },
    },
};
</script>
