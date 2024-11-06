<template>
    <Link :href="href" :class="classes">
       <i :class="icon+' linkicon'"></i> <slot />
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
        props: ['href', 'active' , 'icon'],

        computed: {
            classes() {
                return this.active
                    ? 'inline-flex items-center  border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition'
                    : 'inline-flex items-center border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition'
            }
        }
    })
</script>
<style scoped>
.linkicon {
    font-size: 23px;
    margin-right: 6%;
    padding: 4%;
    color: #2f5a83;
}
</style>
