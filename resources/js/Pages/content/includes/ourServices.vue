<template>
    <div class="wpo-service-area mt-5">
        <div class="container">
            <div class="row">
                <div class="wpo-section-title">
                    <p>Our Services</p>
                    <h2>We Provide Best <span>Services</span> </h2>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6 col-12" v-for="(serv, index) in ourServices" :key="index">
                    <div class="wpo-service-item">
                        <div class="icon">
                            <i><img class="imgservlogo" :src="asset + serv.icon" :alt="serv.title"></i>
                        </div>
                        <h2><a href="service-single.html">
                                {{ serv.title }}
                            </a></h2>
                        <p>{{ serv.description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
export default {
    props: ["ourServices", "asset"],
};
</script>
<style scoped>
.tts {
    font-family: "Lora", serif;
}
</style>
