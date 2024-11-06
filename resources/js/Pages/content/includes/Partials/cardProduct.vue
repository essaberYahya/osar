<template>
    <div class="col col-lg-4 col-md-6 col-12">
        <div class="wpo-blog-item">
            <div class="wpo-blog-img">
                <img class="imgcardproduct" :src="asset + item.pictureCover" alt="">
                <div class="thumb">
                    <ul>
                        <li>
                            {{ new Date(item.created_at).toDateString()}}
                        </li>
                        <li><a href="#">{{item.category.description}}</a></li>
                    </ul>
                </div>
            </div>
            <div class="wpo-blog-content">
                <h2>
                    <Link :href="route('singleObjectSell', {
                        id: item.id,
                        title: item.title.replace(' ', '-'),
                    })
                        ">{{ item.title }}</Link>
                </h2>
                <p>{{ item.description.substring(0, 50) + "..." }}</p>
            </div>
        </div>

    </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    setup() { },
    props: ["item", "asset"],
    data() {
        return {
            selected: false,
        };
    },
    components: {
        Link,
    },
    created() {
        this.init();
    },
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
    computed: {
        rfq() {
            return this.$store.getters.getproductsForQuot;
        },
    },
};
</script>
<style scoped>
img.imgelearn {
    height: 150px !important;
    object-fit: contain;
}

@media (max-width: 767px) {
    .post-category.text-line {
        font-size: 11px;
    }

    p {
        font-size: 10px;
    }
}
</style>
