<template>
    <!-- wpo-partners-area-start -->
    <section class="partners-section mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="wpo-section-title">
                    <p>OUR CLIENTS & PARTNERS</p>
                    <h2>Our Clients & <span>partner</span></h2>
                </div>
            </div>
            <div class="row">
                <div class="col col-xs-12">
                    <div class="partner-grids partners-slider owl-carousel clearfix">
                        <div class="grid" v-for="oc in ourCustomer" :key="oc.id">
                            <img class="cusClient" :src="oc.picture" :alt="oc.name">
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- end contianer -->
    </section>


</template>
<script>
export default {
    props: ["ourCustomer"],
};
</script>
<style scoped>
.fancy-short-banner-nine {
    background: #4b0e55;
    padding: 110px 0;
    position: relative;
    z-index: 1;
}

.fancy-short-banner-nine .title-style-seven h2,
.fancy-short-banner-nine .title-style-seven p {
    color: #fff;
}

.fancy-short-banner-nine .download-btn {
    width: 250px;
    margin: 50px auto 0;
}

.fancy-short-banner-nine .download-btn button {
    width: 100%;
    line-height: 65px;
    border-radius: 40px;
    font-weight: 500;
    font-size: 18px;
    color: #000;
    background: #fff;
    text-align: center;
}

.fancy-short-banner-nine .download-btn button:after {
    border: none;
    position: absolute;
    right: 30px;
    vertical-align: 0;
    transition: all 0.2s ease-in-out;
}

.fancy-short-banner-nine .download-btn.show button:after {
    transform: rotate(180deg);
}

.fancy-short-banner-nine .download-btn .dropdown-menu {
    width: 100%;
    background: #fff;
    border-radius: 0px 0px 10px 10px;
    border: none;
    margin: -5px 0 0 0;
    padding: 5px 0 0px;
}

.fancy-short-banner-nine .download-btn .dropdown-menu a {
    font-weight: 500;
    font-size: 15px;
    color: #000;
    padding: 8px 15px;
    background: transparent;
}

.fancy-short-banner-nine .download-btn .dropdown-menu a span {
    padding-left: 12px;
}

.fancy-short-banner-nine .shape-one {
    bottom: 0;
    right: 0;
    width: 18%;
}

.fancy-short-banner-nine .shape-two {
    bottom: 0;
    left: 0;
    width: 17.4%;
}
</style>
