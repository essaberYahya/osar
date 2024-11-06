<template>
    <div>
        <div class="content-wrapper">
            <header class="wrapper">
                <!-- Start Nav section -->
                <vnavbar :categories="categories" :settings="settings" :navitems="navItems"></vnavbar>
                <main>
                    <slot name="content"></slot>
                </main>
                <vfooter :settings="settings"></vfooter>
                <!-- End Nav section -->
                <!-- /.navbar -->
            </header>
            <!-- /header -->
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import vnavbar from "@/Pages/content/includes/nav.vue";
import vfooter from "@/Pages/content/includes/footer.vue";
import { theme } from "../theme";
export default defineComponent({
    props: ["title", "navItems", "settings", "categories"],

    components: {
        Head,
        JetApplicationMark,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
        Link,
        vnavbar,
        vfooter,
    },

    data() {
        return {
            showingNavigationDropdown: false,
        };
    },
    created() {

    },
    methods: {
        switchToTeam(team) {
            this.$inertia.put(
                route("current-team.update"),
                {
                    team_id: team.id,
                },
                {
                    preserveState: false,
                }
            );
        },

        logout() {
            this.$inertia.post(route("logout"));
        },
    },
});
</script>
<style>
#nprogress .bar {
    background: #7755fc;
    position: fixed;
    z-index: 1031;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
}
</style>
