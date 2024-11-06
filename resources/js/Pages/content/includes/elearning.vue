<template>
    <div>
        <!-- start wpo-blog-section -->
        <section class="wpo-blog-section " id="blog">
            <div class="container">
                <div class="row">
                    <div class="wpo-section-title">
                        <p>OUR products</p>
                        <h3> Here is the latest news of our computer products that have
                            retained the more attention from our customers.</h3>
                    </div>
                </div>
                <div class="wpo-blog-items">
                    <div class="row">
                        <cardProductVue v-for="item in elearnings" :key="item.id" :item="item" :asset="asset">
                        </cardProductVue>

                    </div>
                </div>
            </div> <!-- end container -->
        </section>

    </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
import cardProductVue from "./Partials/cardProduct.vue";

export default {
    props: ["elearnings", "asset"],
    components: {
        Link,
        cardProductVue,
    },
    methods: {
        setProductForQuot($item) {
            this.$store.commit("setproductsForQuot", $item);
        },
    },
};
</script>

<style scoped>
img.imgelearn {
    height: 150px !important;
    object-fit: contain;
}
</style>
