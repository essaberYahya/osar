<template>
    <div>
        <div class="text-center">
            <div class="card-body p-12 pb-0">
               <div class="row">
              <div class="col-md-10 offset-md-1">
                <figure class="mb-6"><img class="serviceNotAvailable" src="../../../../../img/photos/sna.png" srcset="../../../../../img/photos/sna.png" alt="" /></figure>
              </div>
              <!-- /column -->
            </div>
            <!-- /.row -->
            <h3>{{title}}</h3>
            <p class="mb-6">{{description}}</p>

            </div>
            <!--/.card-body -->

        </div>
    </div>
</template>
<script>
export default {
    props : ["title","description"]
}
</script>
<style scoped>
img.serviceNotAvailable {
    height: 200px !important;
    object-fit: contain;
    object-position: center !important;
}
</style>
