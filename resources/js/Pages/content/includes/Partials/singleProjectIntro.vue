<template>
    <section class="wpo-page-title">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="wpo-breadcumb-wrap mt-5">
                        <h2></h2>
                        <ol class="wpo-breadcumb-wrap">
                            <li><a href="#">{{ vtitle }}</a></li>
                            <li>{{ vdescription }}</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>

</template>
<script>
export default {
    props: ["vtitle", "vdescription", "vcreated_at"]
}
</script>

