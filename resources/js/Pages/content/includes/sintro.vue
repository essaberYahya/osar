<template>
    <div class="containerr">
        <div class="hero-slider-wrapper bg-dark">
      <div class="hero-slider owl-carousel dots-over" data-nav="true" data-dots="true" data-autoplay="true">
        <div v-for="intro in intros" :key="intro.id" class="owl-slide d-flex align-items-center bg-overlay bg-overlay-400" :style="'background-image: url('+asset+intro.backgroundimg+');'">
          <div class="container text-center">
            <div class="row">
              <div class="col-12 col-md-8 text-center text-lg-start">
                <h2 class="display-1 fs-56 mb-4 text-white animated-caption" data-anim="animate__slideInDown" data-anim-delay="500">{{intro.title}}</h2>
                <p class="lead fs-23 lh-sm mb-7 text-white animated-caption" data-anim="animate__slideInRight" data-anim-delay="1000">{{intro.description}}</p>
                <div class="animated-caption" data-anim="animate__slideInUp" data-anim-delay="1500" v-html="intro.htmlPart"></div>
              </div>
              <!--/column -->
            </div>
            <!--/.row -->
          </div>
          <!--/.container -->
        </div>
      </div>
      <!--/.hero-slider -->
    </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
    props: [
        "intros",
        "asset"
    ],
    components : {
        Link
    }
}
</script>
