<template>
    <section class="wpo-page-title">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="wpo-breadcumb-wrap mt-5">
                        <h2>Blog</h2>
                        <ol class="wpo-breadcumb-wrap">
                            <li><a href="#">{{ project.category.description }}</a></li>
                            <li>{{ project.title }}</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- start wpo-blog-pg-section -->
    <section class="wpo-blog-pg-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col col-lg-12">
                    <div class="wpo-blog-content">
                        <div class="post format-standard-image">
                            <div class="entry-media">
                                <img class="imgblogcover" :src="asset + project.cover" alt>
                            </div>

                            <div class="entry-details mt-5">
                                <h3><a href="blog-single.html">{{ project.title }}</a></h3>
                                <p v-html="project.description"></p>
                            </div>
                        </div>
                        <div class="post format-standard">
                            <div class="entry-meta">
                                <ul>
                                    <li><i class="fi flaticon-user"></i> By <a href="#">Osar admin</a> </li>
                                    <li><i class="fi flaticon-comment-white-oval-bubble"></i>Enjoy </li>
                                    <li><i class="fi flaticon-calendar-1"></i> {{ new
                                        Date(project.created_at).toDateString() }}</li>
                                </ul>
                            </div>
                            <div class="entry-details">
                                <h3><a href="blog-single.html">Exploring The Wild Side with osar.</a>
                                </h3>
                                <p
                                    v-html="!this.learMore ? project.htmlPart.substring(0, 100) + '...' : project.htmlPart">
                                </p>
                                <span @click="switchreamore" class="read-more">
                                    Learn more
                                </span>
                            </div>
                        </div>

                        <div class="post format-gallery">
                            <div class="entry-media">
                                <div class="post-slider owl-carousel">
                                    <img src="assets/images/blog/img-5.jpg" alt>
                                    <img src="assets/images/blog/img-4.jpg" alt>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- end container -->
    </section>
    <!-- end wpo-blog-pg-section -->

</template>
<script>
import { Link } from '@inertiajs/inertia-vue3'
import commentsVue from './Partials/comments.vue'
import singleProjectIntroVue from './Partials/singleProjectIntro.vue'



export default {
    props: ["project", "asset", "myinteresting"],
    components: {
        singleProjectIntroVue,
        commentsVue,
        Link
    },
    data() {
        return {
            learMore: false,
        }
    },
    created() {

    },
    methods: {
        switchreamore() {
            this.learMore = !this.learMore;
        }
    }
}
</script>

<style scoped>
.hero-slider-wrapper .hero-slider .owl-slide.bg-overlay-400:before {
    background: transparent !important;
}
</style>
