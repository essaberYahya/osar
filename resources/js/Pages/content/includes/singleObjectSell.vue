<template>
    <div>
        <section class="wpo-page-title">
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="wpo-breadcumb-wrap mt-5">
                            <h2></h2>
                            <ol class="wpo-breadcumb-wrap">
                                <li>
                                    <Link href="/">{{ item.category.name }}</Link>
                                </li>
                                <li>{{ item.title }}</li>
                            </ol>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>

        <div class="wpo-project-single-area mt-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-12">
                        <div class="wpo-project-single-wrap">
                            <div class="wpo-project-single-item">
                                <div class="row align-items-center">
                                    <div class="col-lg-7">
                                        <div class="wpo-project-single-title">
                                            <h3>Product : <span>{{ item.title }}</span> </h3>
                                        </div>
                                        <p>{{ item.description }}</p>
                                    </div>

                                </div>
                                <div class="wpo-project-single-main-img owl-carousel">
                                    <img v-for="(pic, index) in item.album" :key="index" :src="asset + pic.path"
                                        alt="album picture">
                                </div>
                                <div class="action w-100">
                                    <button v-if="!selected" @click="setProductForQuot" style="cursor: pointer"
                                        class="btn btn-xs btn-outline-primary  w-100">Add for quotation</button>
                                    <button v-else @click="RemoveProductForQuot" style="cursor: pointer"
                                        class="btn btn-xs btn-outline-warning  w-100">Remove from quotation
                                        list</button>
                                </div>
                            </div>

                            <div class="wpo-project-single-item">
                                <div class="wpo-project-single-title">
                                    <h3>Product details</h3>
                                </div>
                                <p v-html="item.description"></p>
                                <p v-html="item.htmlPart"></p>
                            </div>
                            <div class="wpo-project-single-gallery">
                                <div class="row mt-4">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="wpo-p-details-img">
                                            <img :src="asset + item.pictureCover" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12" v-for="(pic, index) in item.album"
                                        :key="index">
                                        <div class="wpo-p-details-img">
                                            <img :src="asset + pic.path" alt="">
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="wpo-blog-section " id="blog">
            <div class="container">
                <div class="row">
                    <div class="wpo-section-title">
                        <p>Related product</p>
                        <h3> Here is the latest products related to the one above</h3>
                    </div>
                </div>
                <div class="wpo-blog-items" v-if="productByCat != null">
                    <div class="row">
                        <CardProduct v-for="item in productByCat.data" :key="item.id" :item="item" :asset="asset">
                        </CardProduct>

                    </div>
                </div>
            </div> <!-- end container -->
        </section>


        <section class="wrapper bg-light">
            <div class="container py-14 py-md-16">
                <div class="grid grid-view projects-masonry">

                    <div class="form-select-wrapper">
                        <select class="form-select" v-model="url">
                            <option v-for="(lab, i) in productByCat.links" :key="i">
                                <Link :href="lab.url" class="badge rounded-pill bg-blue mr-2"
                                    v-if="i > 1 && i < productByCat.links.length - 1">{{ lab.label }}</Link>
                            </option>
                        </select>
                    </div>

                    <!-- /.row -->
                </div>
                <!-- /.grid -->
            </div>
            <!-- /.container -->
        </section>
    </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
import singleProjectIntroVue from "./Partials/singleProjectIntro.vue";
import allproductsVue from "./allproducts.vue";
import CardProduct from "./Partials/cardProduct.vue";

export default {
    components: {
        singleProjectIntroVue,
        Link,
        CardProduct,
        allproductsVue,
    },
    props: ["asset", "item", "productByCat"],
    methods: {
        setProductForQuot() {
            this.$store.commit("setproductsForQuot", this.item);
            this.selected = true;
        },
        RemoveProductForQuot() {
            this.$store.commit("RemoveProductForQuot", this.item);
            this.selected = false;
        },
        init() {
            var i = this.rfq.findIndex((e) => e.id == this.item.id);
            this.selected = i != -1 ? true : false;
        },
    },
    created() {
        this.init();
    },
    data() {
        return {
            url: null,
            selected: false,
        };
    },
    watch: {
        url: function () {
            this.$inertia.get(this.productByCat.path + "?page=" + this.url);
        },
    },
    computed: {
        rfq() {
            return this.$store.getters.getproductsForQuot;
        },
    },
};
</script>
<style scoped>
.boxactions.d-flex {
    gap: 15px;
    margin-top: 17px;
}
</style>
