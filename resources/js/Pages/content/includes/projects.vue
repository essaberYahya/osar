<template>
    <!-- start of wpo-project-area -->
    <div class="wpo-project-area">
        <div class="container-fluid">
            <div class="row">
                <div class="wpo-section-title">
                    <p>Recent Project</p>
                    <h2>Projects for <span>Inspirations</span> </h2>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="wpo-project-wrap project-active owl-carousel">
                    <div class="wpo-project-item" v-for="(pro, index) in oprojects" :key="index">
                        <div class="wpo-project-img">
                            <img class="projectCoverImg" :src="asset + pro.cover" alt="">
                            <div class="thumb">
                                <h4>{{ ++index }}</h4>
                            </div>
                        </div>
                        <div class="wpo-project-text">
                            <h2>
                                <Link :href="route('project', { 'id': pro.id, 'title': pro.title })">
                                {{ pro.title.length > 50 ? pro.title.substring(0, 20) + '...' : pro.title }}
                                </Link>
                            </h2>
                            <span>Recent Project</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>


</template>
<script>
/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/

import { Link } from '@inertiajs/inertia-vue3';
export default {
    props: ["oprojects", "asset"],
    components: {
        Link
    },
}
</script>
