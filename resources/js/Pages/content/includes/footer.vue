<template>
    <!-- start wpo-subscribe-section -->
    <section class="wpo-subscribe-section">
        <div class="container">
            <div class="wpo-subscribe-wrap">
                <div class="subscribe-text">
                    <h3>Subscribe to our newsletter to receive
                        latest news on our services.</h3>
                </div>
                <div class="subscribe-form">
                    <form action="#">
                        <div class="input-field">
                            <input type="email" placeholder="Enter your email" required>
                            <button type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end container -->
    </section>
    <!-- end subscribe-section -->
    <!-- start of wpo-site-footer-section -->
    <footer class="wpo-site-footer">
        <div class="wpo-upper-footer">
            <div class="container">
                <div class="row">
                    <div class="col col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="widget about-widget">
                            <div class="logo widget-title">
                                <a class="logo" href="#">
                                    <JetApplicationMark class="logo"></JetApplicationMark>
                                </a>
                            </div>
                            <p class="mt-5">{{ settings.content }}</p>
                            <ul>
                                <li>
                                    <a target="_blank" :href="settings.facebook">
                                        <i class="ti-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank" :href="settings.twitter">
                                        <i class="ti-twitter-alt"></i>
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank" :href="settings.instagram">
                                        <i class="ti-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank" :mail:to="settings.email">
                                        <i class="ti-google"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="widget link-widget">
                            <div class="widget-title">
                                <h3>Our Services</h3>
                            </div>
                            <ul>
                                <li><a href="service-single.html">Mechanical Engineering</a></li>
                                <li><a href="service-single.html">Petroleum Refinery</a></li>
                                <li><a href="service-single.html">Power & Engergy</a></li>
                                <li><a href="service-single.html">Electrical & Power </a></li>
                                <li><a href="service-single.html">Industrial Construction</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col col-xl-4  col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="widget wpo-service-link-widget">
                            <div class="widget-title">
                                <h3>Contact Us</h3>
                            </div>
                            <div class="contact-ft">
                                <ul>
                                    <li><i class="fi flaticon-location"></i>{{ settings.adress }}</li>
                                    <li><i class="fi flaticon-telephone"></i>{{ settings.phone }} <br>
                                        {{ settings.fix }}<br>{{ settings.whatsapp }}</li>
                                    <li><i class="fi flaticon-email"></i>{{ settings.email }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>


                </div>
            </div> <!-- end container -->
        </div>
        <div class="wpo-lower-footer">
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <ul>
                            <li>&copy; 2022 Osar platform . crafted By <a target="_blank"
                                    href="vanotic.com">Vanotic</a>. All Rights
                                Reserved.</li>
                            <li><a href="#">Terms of use |</a> <a href="#">Privacy Environmental Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end of wpo-site-footer-section -->

</template>
<script>
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
export default {
    props: ["settings"],
    components: {
        JetApplicationMark,
    },
    data() {
        return {
            form: this.$inertia.form({
                email: null,
            }),
        };
    },
    methods: {
        shownotice(payload) {
            this.$store.commit("showNotice", payload);
        },
        submit() {
            this.form.post(route("postnewsletter"), {
                onSuccess: () => {
                    var payload = {
                        color: "primary",
                        type: "success",
                        message: "Your email saved successfully",
                        show: true,
                    };
                    this.form.reset();
                    this.shownotice(payload);
                    payload = {};
                },
                onError: () => {
                    var payload = {
                        color: "orange",
                        type: "Manquée",
                        message: this.form.errors.msg,
                        show: true,
                    };
                    this.shownotice(payload);
                    payload = {};
                    this.form.reset();
                },
            });
        },
    },
};
</script>
