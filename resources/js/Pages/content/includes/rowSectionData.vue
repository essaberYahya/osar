<template>
    <!-- start of wpo-about-area -->
    <div class="wpo-about-area section-padding">
        <div class="container">
            <div class="align-items-center mb-5" v-for="(rsd, index) in rowSectionData" :key="index">
                <div class="row" v-if="index % 2 == 0">
                    <div class="col-lg-6 col-md-12 colsm-12">
                        <div class="wpo-about-text">
                            <div class="wpo-about-title">
                                <span class="sub">Discover us!</span>
                                <h2 v-html="rsd.title">
                                </h2>
                            </div>
                            <h5>{{ rsd.description }}</h5>
                            <p v-html="rsd.htmlPart">

                            </p>
                            <div class="btns">
                                <a href="about.html" class="theme-btn" tabindex="0">Discover More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="wpo-about-img-left">
                            <img class="picrsd" :src="rsd.picture" alt="">

                        </div>
                    </div>
                </div>
                <div class="row" v-else>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="wpo-about-img-rigth">
                            <img class="picrsd" :src="rsd.picture" alt="">

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 colsm-12">
                        <div class="wpo-about-text">
                            <div class="wpo-about-title">
                                <span class="sub">Discover us!</span>
                                <h2 v-html="rsd.title">
                                </h2>
                            </div>
                            <h5>{{ rsd.description }}</h5>
                            <p v-html="rsd.htmlPart">

                            </p>
                            <div class="btns">
                                <a href="about.html" class="theme-btn" tabindex="0">Discover More</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>
<script>
export default {
    props: ["rowSectionData"]
}
</script>
