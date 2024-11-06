<template>
    <div>
        <singleProjectIntroVue
            vtitle="OSAR give your the right to do a request for quotation rqgarding your product list"
            vdescription="Request for quotation" :vcreated_at="new Date()"></singleProjectIntroVue>
        <!-- /header -->
        <!-- section articls-->
        <section class="wrapper bg-light wrapper-border">
            <div class="container py-14 py-md-16">
                <div class="rfq-on" v-if="rfq.length > 0">
                    <div v-if="!this.requestSent && !this.requestErr" class="row mb-5">
                        <div class="col-md-10 col-xl-8 col-xxl-7 mx-auto text-center">
                            <h2 class="display-4 mb-4 px-lg-14">
                                Find your request for quotation easly
                            </h2>
                        </div>
                        <!-- /column -->
                    </div>
                    <!-- /.row -->
                    <div v-if="!this.requestSent && !this.requestErr"
                        class="row gx-md-8 gx-xl-12 gy-10 align-items-center">
                        <div class="container justify-center">
                            <div class="table-responsive" v-if="this.rfq.length > 0">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td>Picture</td>
                                            <td>Title</td>
                                            <td>Category</td>
                                            <td>Delete</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in rfq" :key="item.id">
                                            <td>
                                                <img :src="asset + item.pictureCover" style="
                            height: 100px;
                            width: 100px;
                            object-fit: contain;
                          " :alt="item.title" srcset />
                                            </td>
                                            <td>
                                                <p>{{ item.title }}</p>
                                            </td>

                                            <td>
                                                <span class="badge bg-success rounded-pill mb-3 mt-3">{{
                                                    item.category.name
                                                    }}</span>
                                            </td>

                                            <td>
                                                <span @click="RemoveProductForQuot(item)"
                                                    class="bbadge bg-warning rounded-pill mb-3 mt-3"><i
                                                        class="uil uil-minus-circle"></i>Remove</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <span class="btn btn-primary rounded-pill mb-0" @click="showModalNewIntro">
                                Confirm your request for x{{ rfq.length }} products
                            </span>
                        </div>
                    </div>
                    <!--/.row -->
                </div>
                <div class="rfq-of" v-else-if="rfq.length == 0 && !this.requestSent && !this.requestErr">
                    <div class="row mb-5">
                        <div class="col-md-10 col-xl-8 col-xxl-7 mx-auto text-center">
                            <h2 class="display-4 mb-4 px-lg-14">Empty cart</h2>
                            <p>Try to select one of our product and go back here</p>
                        </div>
                        <!-- /column -->
                    </div>
                    <!-- /.row -->
                    <div class="row gx-md-8 gx-xl-12 gy-10 align-items-center">
                        <div class="container justify-center">
                            <img src="../../../../img/shape/undraw_no_data_re_kwbl.svg" class="imgempty" alt="" />
                        </div>
                    </div>
                    <!--/.row -->
                </div>
                <div class="rfq-success" v-if="this.requestSent && !this.requestErr">
                    <div class="row mb-5">
                        <div class="col-md-10 col-xl-8 col-xxl-7 mx-auto text-center">
                            <h2 class="display-4 mb-4 px-lg-14">Request sent!</h2>
                            <p>Your request for quotation is being processed</p>
                        </div>
                        <!-- /column -->
                    </div>
                    <!-- /.row -->
                    <div class="row gx-md-8 gx-xl-12 gy-10 align-items-center">
                        <div class="container justify-center">
                            <img src="../../../../img/shape/undraw_mail_sent_re_0ofv.svg" class="imgempty" alt="" />
                        </div>
                    </div>
                    <!--/.row -->
                </div>
                <div class="rfq-err" v-if="!this.requestSent && this.requestErr">
                    <div class="row mb-5">
                        <div class="col-md-10 col-xl-8 col-xxl-7 mx-auto text-center">
                            <h2 class="display-4 mb-4 px-lg-14">Request failed!</h2>
                            <p>Something went wrong. thank you try later</p>
                        </div>
                        <!-- /column -->
                    </div>
                    <!-- /.row -->
                    <div class="row gx-md-8 gx-xl-12 gy-10 align-items-center">
                        <div class="container justify-center">
                            <img src="../../../../img/shape/undraw_cancel_re_pkdm.svg" class="imgempty" alt="" />
                        </div>
                    </div>
                    <!--/.row -->
                </div>
            </div>
            <!-- /.container -->
        </section>

        <!-- end section articls-->
        <!-- /section -->
        <section class="wrapper bg-light wrapper-border">
            <div class="container py-14 py-md-16">
                <h2 class="display-4 mb-3">How We Do It?</h2>

                <div class="row gx-lg-8 gx-xl-12 gy-6 process-wrapper line">
                    <div class="col-md-6 col-lg-3">
                        <span class="icon btn btn-circle btn-lg btn-soft-primary disabled mb-4"><span
                                class="number">01</span></span>
                        <h4 class="mb-1">Request analystics</h4>
                        <p>Analysing your Request from vanotic support</p>
                    </div>
                    <!--/column -->
                    <div class="col-md-6 col-lg-3">
                        <span class="icon btn btn-circle btn-lg btn-primary disabled mb-4"><span
                                class="number">02</span></span>
                        <h4 class="mb-1">Customer level</h4>
                        <p>Checing customer level from vanotic support</p>
                    </div>
                    <!--/column -->
                    <div class="col-md-6 col-lg-3">
                        <span class="icon btn btn-circle btn-lg btn-soft-primary disabled mb-4"><span
                                class="number">03</span></span>
                        <h4 class="mb-1">Preparing</h4>
                        <p>Preparing your request from vanotic support</p>
                    </div>
                    <!--/column -->
                    <div class="col-md-6 col-lg-3">
                        <span class="icon btn btn-circle btn-lg btn-primary disabled mb-4"><span
                                class="number">04</span></span>
                        <h4 class="mb-1">Finalizing</h4>
                        <p>Finalizing your request from vanotic support</p>
                    </div>
                    <!--/column -->
                </div>
                <!--/.row -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /section -->

        <jet-dialog-modal :show="showmodalstate">
            <template #title></template>
            <template #content>
                <jet-form-section @submitted="insertData">
                    <template #title>Request for quotation</template>
                    <template #form>
                        <div class="row">
                            <div class="mt-3">
                                <jet-label for="rname" value="Fulle name" />
                                <jet-input id="rname" v-model="form.rname" type="text" class="mt-1 block w-full"
                                    ref="rname" autocomplete="true" />
                                <jet-input-error :message="form.errors.rname" class="mt-2" />
                            </div>

                            <div class="mt-3">
                                <jet-label for="remail" value="Your email" />
                                <jet-input id="remail" v-model="form.remail" type="email" class="mt-1 block w-full"
                                    ref="remail" autocomplete="true" />
                                <jet-input-error :message="form.errors.remail" class="mt-2" />
                            </div>
                            <div class="mt-3">
                                <jet-label for="rphone" value="Phone number " />
                                <jet-input id="rphone" v-model="form.rphone" type="text" class="mt-1 block w-full"
                                    ref="rphone" autocomplete="true" />
                                <jet-input-error :message="form.errors.rphone" class="mt-2" />
                            </div>
                            <div class="mt-3">
                                <jet-label for="rcontent" value="Request message" />
                                <textarea id="rcontent" v-model="form.rcontent" type="text" class="
                    border-gray-300
                    focus:border-indigo-300
                    focus:ring
                    focus:ring-indigo-200
                    focus:ring-opacity-50
                    rounded-md
                    shadow-sm
                    mt-1
                    block
                    w-full
                  " rows="5" ref="rcontent" autocomplete="true" />
                                <jet-input-error :message="form.errors.rcontent" class="mt-2" />
                            </div>
                        </div>
                    </template>
                    <hr />
                    <template #actions>
                        <!-- <jet-action-message :on="form.recentlySuccessful" class="mr-3">Saved.</jet-action-message>

                        <jet-button
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >Save</jet-button>-->
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                            {{ form.progress.percentage }}%
                        </progress>
                        <jet-button :on="form.recentlySuccessful" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">Send request</jet-button>
                    </template>
                </jet-form-section>
            </template>

            <template #footer>
                <jet-secondary-button @click="showModalNewIntro">Cancel</jet-secondary-button>
            </template>
        </jet-dialog-modal>
    </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
import singleProjectIntroVue from "./Partials/singleProjectIntro.vue";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

export default {
    props: ["project", "asset"],
    components: {
        Link,
        singleProjectIntroVue,
        JetInputError,
        JetButton,
        JetActionMessage,
        JetLabel,
        JetDialogModal,
        JetFormSection,
        JetSecondaryButton,
        JetInput,
    },
    data() {
        return {
            requestSent: false,
            requestErr: false,
            showmodalstate: false,
            form: this.$inertia.form({
                rname: null,
                remail: null,
                rphone: null,
                rcontent: null,
                object_ids: [],
            }),
        };
    },
    methods: {
        RemoveProductForQuot($item) {
            this.$store.commit("RemoveProductForQuot", $item);
            this.selected = false;
        },
        showModalNewIntro() {
            this.showmodalstate = this.showmodalstate ? false : true;
        },
        insertData() {
            if (this.rfq.length > 0) {
                this.rfq.forEach((e) => this.form.object_ids.push(e.id));
            }
            this.form.post(route("rfqstore"), {
                onSuccess: () => {
                    this.form.reset(), (this.showmodalstate = false);
                    this.requestSent = true;
                },
                onError: () => {
                    requestErr = true;
                    this.form.reset();
                },
            });
        },
    },
    computed: {
        rfq() {
            return this.$store.getters.getproductsForQuot;
        },
    },
};
</script>

<style scoped>
.hero-slider-wrapper .hero-slider .owl-slide.bg-overlay-400:before {
    background: transparent !important;
}
</style>
