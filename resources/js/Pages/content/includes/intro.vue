<template>
    <!-- start of hero -->
    <section class="wpo-hero-slider">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div v-for="(slid, index) in intro" :key="index" class="swiper-slide">
                    <div class="slide-inner slide-bg-image" :data-background="asset + slid.backgroundimg">
                        <!-- <div class="gradient-overlay"></div> -->
                        <div class="container-fluid">
                            <div class="slide-content">
                                <div data-swiper-parallax="300" class="slide-title">
                                    <h2 v-html="slid.title">
                                    </h2>
                                </div>
                                <div data-swiper-parallax="400" class="slide-text">
                                    <p>{{ slid.description }}</p>
                                </div>
                                <div class="clearfix"></div>
                                <div data-swiper-parallax="500" class="slide-btns">
                                    <ul>
                                        <li class="video-holder">
                                            <a href="#" class="theme-btn-s2">Get A Free Quote</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end slide-inner -->
                </div> <!-- end swiper-slide -->
            </div>
            <!-- end swiper-wrapper -->
            <!-- swipper controls -->
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <!-- end of hero slider -->
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
    props: ["intro", "asset"],
    components: {
        Link,
    },
};
</script>
