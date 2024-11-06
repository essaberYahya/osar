<template>
    <header id="header">
        <div class="wpo-site-header wpo-header-style-1">
            <nav class="navigation navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-3 col-3 d-lg-none dl-block">
                            <div class="mobail-menu">
                                <button type="button" class="navbar-toggler open-btn">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar first-angle"></span>
                                    <span class="icon-bar middle-angle"></span>
                                    <span class="icon-bar last-angle"></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-6 col-6">
                            <div class="navbar-wrap">
                                <div class="navbar-header">
                                    <Link class="navbar-brand logo" href="/">
                                    <JetApplicationMark class="logo"></JetApplicationMark>
                                    </Link>
                                </div>
                                <div id="navbar" class="collapse navbar-collapse navigation-holder">
                                    <button class="menu-close"><i class="ti-close"></i></button>
                                    <ul class="nav navbar-nav mb-2 mb-lg-0">
                                        <li v-for="(nav, index) in navitems" :key="index">
                                            <Link :href="nav.routeLink">{{ nav.name }}</Link>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#">Products</a>
                                            <ul class="sub-menu">
                                                <li v-for="(cat, index) in categories" :key="index">
                                                    <Link :href="'/products/category/' + cat.id + '/' + cat.name">{{ cat.name
                                                    }}</Link>
                                                </li>
                                            </ul>
                                        </li>


                                    </ul>

                                </div><!-- end of nav-collapse -->
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3 col-3">
                            <div class="header-right">
                                <div class="get-btn">
                                    <Link href="/request-for-quotation" class="theme-btn">Get a Free Quote</Link>
                                </div>

                                <div class="mini-cart">
                                    <Link href="/request-for-quotation" class="btn cart-toggle-btn"> <i
                                        class="fi flaticon-shopping-cart"></i>
                                    <span class="cart-count">{{ this.quot.length }}</span></Link>

                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end of container -->
            </nav>
        </div>
    </header>
</template>
<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
export default {
    props: ["navitems", "settings", "categories"],
    components: {
        JetApplicationMark,
        Link,
    },
    data() {
        return {
            navState: "navbar-collapse offcanvas-nav d-lg-flex mx-lg-auto",
            navOpen: false,
            dropState: false,
            dropstyle: "display:none;",
            collapseNav: {
                state: false,
                defaultcss: "collapse navbar-collapse"
            }
        };
    },
    methods: {
        switchCollapseNav() {
            if (this.collapseNav.state) {
                this.collapseNav.defaultcss = "collapse navbar-collapse hide";
            } else {
                this.collapseNav.defaultcss = "navbar-collapse collapse show";
            }
            this.collapseNav.state = !this.collapseNav.state;
        },
        sswitch() {
            if (this.navOpen) {
                this.navOpen = false;
                this.navState =
                    "navbar-collapse offcanvas-nav d-lg-flex mx-lg-auto";
            } else {
                this.navOpen = true;
                this.navState =
                    "navbar-collapse offcanvas-nav d-lg-flex mx-lg-auto open";
            }
        },
    },
    computed: {
        quot() {
            return this.$store.getters.getproductsForQuot;
        },
        notice() {
            return this.$store.getters.getNotice;
        },
    },
};
</script>
<style>
.dropdown-menu {
    min-width: 16rem !important;
}

.quto {
    position: fixed;
    top: 0px;
    left: 0px;
    width: 0px;
    height: 0px;
    background: rgba(0, 0, 0, 0);
    text-align: center;
    z-index: 99999;
}

.btnquto {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 200px;
    height: 64px;
    background: rgb(95, 127, 255);
    color: white;
    border-radius: 25px;
    position: fixed;
    right: 24px;
    bottom: 18px;
    box-shadow: rgb(0 0 0 / 40%) 0px 4px 8px;
    z-index: 9999;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.2s ease 0s;
    animation: jumpTwo 5s infinite linear;
}
</style>
