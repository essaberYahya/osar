<template>
    <div class="container">
        <div class="boxactions d-flex" style="gap: 15px" v-if="access_right.write && this.sells.data.length > 0">
            <button class="btn btn-xs rounded-pill btn-primary mt-3 mb-3" @click="showModalNewIntro(true)">
                <i class="uil uil-pen mr-2"></i> Create
            </button>
            <jet-input id="gtitle" v-model="keyworld" type="text" class="mt-4 block w-full spinput" ref="gtitle"
                v-on:keyup.enter="lookfordata" autocomplete="true" />
        </div>
        <div v-if="searching" class="justify-center">
            <spinnerVue></spinnerVue>
        </div>
        <span class="badge bg-orange rounded-pill mb-3" v-else-if="!access_right.write">
            <i class="uil uil-minus-circle mr-2"></i>Not alowed to add intro
        </span>
        <div class="row" v-if="data != null">
            <div class="table-responsive" v-if="this.data.data.length > 0">
                <table class="table table-hover">
                    <tbody>
                        <sellObjectRowVue v-for="so in this.data.data" :key="so.id" :item="so" :asset="asset"
                            :saccess_rigth="access_right" :selected="true"></sellObjectRowVue>
                    </tbody>
                </table>
                <div v-if="this.data.last_page > 1" class="container mt-5">
                    <div class="text-center">
                        <ul class="d-flex justify-center">
                            <li>
                                <span @click="fetchResult(this.data.first_page_url)"
                                    class="badge rounded-pill bg-blue mr-2">First</span>
                            </li>
                            <li v-for="(lab, i) in this.data.links" :key="i">
                                <span @click="fetchResult(lab.url)" :href="lab.url"
                                    class="badge rounded-pill bg-blue mr-2"
                                    v-if="i > 1 && i < this.data.links.length - 1">{{ lab.label }}</span>
                            </li>

                            <li>
                                <span @click="fetchResult(this.data.last_page_url)"
                                    class="badge rounded-pill bg-blue">Last</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container text-center" v-else>
                <emtyDataVue :title="'No Product object exists for' + this.keyworld"
                    description="No Product exists intro database , try to insert a one by click on new Product">
                </emtyDataVue>
            </div>
        </div>

        <div class="row mt-10">
            <div class="table-responsive" v-if="this.sells.data.length > 0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Picture</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Start at</th>
                            <th>End at</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <sellObjectRowVue v-for="so in sells.data" :key="so.id" :item="so" :asset="asset"
                            :saccess_rigth="access_right" :selected="false"></sellObjectRowVue>
                    </tbody>
                </table>
            </div>
            <div v-if="sells.last_page > 1" class="container mt-5">
                <div class="text-center">
                    <ul class="d-flex justify-center">
                        <li>
                            <Link :href="sells.first_page_url" class="badge rounded-pill bg-blue mr-2">First</Link>
                        </li>
                        <li v-for="(lab, i) in sells.links" :key="i">
                            <Link :href="lab.url" class="badge rounded-pill bg-blue mr-2"
                                v-if="i > 1 && i < sells.links.length - 1">{{ lab.label }}</Link>
                        </li>

                        <li>
                            <Link :href="sells.last_page_url" class="badge rounded-pill bg-blue">Last</Link>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container text-center" v-if="this.sells.data.length == 0">
                <emtyDataVue title="No Product object exists"
                    description="No Product exists intro database , try to insert a one by click on new Product">
                </emtyDataVue>
                <button class="btn btn-xs rounded-pill btn-primary mt-3 mb-3" @click="showModalNewIntro(true)"
                    v-if="access_right.write">
                    <i class="uil uil-pen mr-2"></i> Create new product
                </button>
            </div>
        </div>

        <!-- new sell popup -->
        <jet-dialog-modal v-if="access_right != null && access_right.write" :show="showmodalstate">
            <template #content>
                <jet-form-section @submitted="inserthata">
                    <template #title></template>
                    <template #form>
                        <div class="row">
                            <div class="mt-3 col-md-6 col-12">
                                <jet-label for="gtitle" value="General title" />

                                <jet-input id="gtitle" v-model="form.gtitle" type="text" class="mt-1 block w-full"
                                    ref="gtitle" autocomplete="true" />
                                <jet-input-error :message="form.errors.gtitle" class="mt-2" />
                            </div>
                            <div class="mt-3 col-md-6 col-12">
                                <jet-label for="gdescription" value="General description" />
                                <jet-input id="gdescription" v-model="form.gdescription" type="text"
                                    class="mt-1 block w-full" ref="gdescription" autocomplete="true" />
                                <jet-input-error :message="form.errors.gdescription" class="mt-2" />
                            </div>
                            <div class="mt-3 col-12">
                                <jet-label for="category" value="Category" />
                                <vSelect :options="categories" label="name" :reduce="(cat) => cat.id"
                                    v-model="form.category" ref="category" class="
                    rounded
                    border-gray-300
                    text-indigo-600
                    shadow-sm
                    focus:border-indigo-300
                    focus:ring
                    focus:ring-indigo-200
                    focus:ring-opacity-50
                  " />
                                <jet-input-error :message="form.errors.category" class="mt-2" />
                            </div>

                            <div class="cla mt-2 col-md-6 col-12">
                                <jet-label for="gbackgrundimg" value="Intro picture" />
                                <inputFileVue id="cover" @input="form.cover = $event.target.files[0]"
                                    v-model="form.cover" title="Select intro picture"></inputFileVue>
                                <jet-input-error :message="form.errors.cover" class="mt-2" />
                            </div>
                            <div class="cla mt-2 col-md-6 col-12">
                                <jet-label for="Album" value="Album" />
                                <inputFileVue id="Album" @input="form.album = $event.target.files" v-model="form.album"
                                    title="Select object sell album " :multi="true"></inputFileVue>
                                <jet-input-error :message="form.errors.album" class="mt-2" />
                            </div>
                            <div class="mt-3 col-md-12 col-12">
                                <jet-label for="ghtmlpart" value="Html section" />
                                <textarea id="ghtmlpart" v-model="form.ghtmlpart" type="text" class="
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
                  " rows="5" ref="ghtmlpart" autocomplete="true" />
                                <jet-input-error :message="form.errors.ghtmlpart" class="mt-2" />
                            </div>
                            <div class="mt-3 col-md-6 col-12">
                                <jet-label for="startat" value="General Start at time" />
                                <jet-input id="startat" v-model="form.startat" type="datetime-local"
                                    class="mt-1 block w-full" ref="startat" autocomplete="true" />
                                <jet-input-error :message="form.errors.startat" class="mt-2" />
                            </div>
                            <div class="mt-3 col-md-6 col-12">
                                <jet-label for="endat" value="General end at time" />
                                <jet-input id="endat" v-model="form.endat" type="datetime-local"
                                    class="mt-1 block w-full" ref="endat" autocomplete="true" />
                                <jet-input-error :message="form.errors.endat" class="mt-2" />
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
                            :disabled="form.processing">Save</jet-button>
                    </template>
                </jet-form-section>
            </template>

            <template #footer>
                <jet-secondary-button @click="showModalNewIntro(false)">Cancel</jet-secondary-button>
            </template>
        </jet-dialog-modal>


        <!-- update sell popup -->
        <jet-dialog-modal v-if="access_right != null && access_right.editText" :show="editModalState">
            <template #title></template>
            <template #content>
                <jet-form-section @submitted="updateData">
                    <template #title>Update product</template>
                    <template #form>
                        <div class="row">
                            <div class="mt-3 col-12 col-md-6">
                                <jet-label for="egtitle" value="General title" />
                                <jet-input id="egtitle" v-model="eform.egtitle" type="text" class="mt-1 block w-full"
                                    ref="egtitle" autocomplete="true" />
                                <jet-input-error :message="eform.errors.egtitle" class="mt-2" />
                            </div>
                            <div class="mt-3 col-12 col-md-6">
                                <jet-label for="egdescription" value="General description" />
                                <jet-input id="egdescription" v-model="eform.egdescription" type="text"
                                    class="mt-1 block w-full" ref="egdescription" autocomplete="true" />
                                <jet-input-error :message="form.errors.egdescription" class="mt-2" />
                            </div>
                            <div class="mt-3 col-12">
                                <jet-label for="ecategory" value="eCategory" />
                                <vSelect :options="categories" label="name" :reduce="(cat) => cat.id"
                                    v-model="eform.ecategory" ref="category" class="
                    rounded
                    border-gray-300
                    text-indigo-600
                    shadow-sm
                    focus:border-indigo-300
                    focus:ring
                    focus:ring-indigo-200
                    focus:ring-opacity-50
                  " />
                                <jet-input-error :message="eform.errors.ecategory" class="mt-2" />
                            </div>

                            <div class="cla mt-2 col-12 col-md-6">
                                <jet-label for="egbackgrundimg" value="Intro picture" />
                                <inputFileVue id="ecover" @input="eform.ecover = $event.target.files[0]"
                                    v-model="eform.ecover" title="Select intro picture"></inputFileVue>
                                <jet-input-error :message="eform.errors.ecover" class="mt-2" />
                            </div>
                            <div class="cla mt-2 col-md-6 col-12">
                                <jet-label for="eAlbum" value="Album" />
                                <inputFileVue id="eAlbum" @input="eform.ealbum = $event.target.files"
                                    v-model="eform.ealbum" title="Select object sell album " :multi="true">
                                </inputFileVue>
                                <jet-input-error :message="eform.errors.ealbum" class="mt-2" />
                            </div>
                            <div class="mt-3 col-12">
                                <jet-label for="eghtmlpart" value="Html section" />
                                <textarea id="eghtmlpart" v-model="eform.eghtmlpart" type="text" class="
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
                  " rows="5" ref="eghtmlpart" autocomplete="true" />
                                <jet-input-error :message="eform.errors.eghtmlpart" class="mt-2" />
                            </div>
                            <div class="mt-3 col-12 col-md-6">
                                <jet-label for="estartat" value="General Start at time" />
                                <jet-input id="estartat" v-model="eform.estartat" type="datetime-local"
                                    class="mt-1 block w-full" ref="estartat" autocomplete="true" />
                                <jet-input-error :message="eform.errors.estartat" class="mt-2" />
                            </div>
                            <div class="mt-3 col-12 col-md-6">
                                <jet-label for="eendat" value="General end at time" />
                                <jet-input id="eendat" v-model="eform.eendat" type="datetime-local"
                                    class="mt-1 block w-full" ref="eendat" autocomplete="true" />
                                <jet-input-error :message="eform.errors.eendat" class="mt-2" />
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
                            :disabled="form.processing">Save</jet-button>
                    </template>
                </jet-form-section>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeEditModal">Cancel</jet-secondary-button>
            </template>
        </jet-dialog-modal>

        <!-- delete sell popup -->
        <jet-dialog-modal v-if="access_right != null && access_right.delete" :show="GetModalDeleteState">
            <template #content>
                <jet-form-section @submitted="deleteObj">
                    <template #title>Delete product </template>
                    <template #form>
                        Are you sure you want to delete this product?
                        <br />Please enter your password to confirm you would like to
                        permanently delete your account.
                    </template>
                    <hr />
                    <template #actions>
                        <!-- <jet-action-message :on="form.recentlySuccessful" class="mr-3">Saved.</jet-action-message>

                        <jet-button
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >Save</jet-button>-->

                        <jet-button :on="form.recentlySuccessful"
                            :class="{ 'opacity-25': form.processing } + 'btn btn-danger'"
                            :disabled="form.processing">Delete</jet-button>
                    </template>
                </jet-form-section>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeDeleteModal">Cancel</jet-secondary-button>
            </template>
        </jet-dialog-modal>

        <!-- delete sell plan popup -->
        <jet-dialog-modal v-if="access_right != null && access_right.delete" :show="PpToDeleteModalState">
            <template #content>
                <jet-form-section @submitted="deletePp">
                    <template #title>Delete E-earning plan</template>
                    <template #form>
                        Are you sure you want to delete this E-earning plan?
                        <br />Please confirm you would like to permanently delete your
                        account.
                    </template>
                    <hr />
                    <template #actions>
                        <!-- <jet-action-message :on="form.recentlySuccessful" class="mr-3">Saved.</jet-action-message>

                        <jet-button
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >Save</jet-button>-->

                        <jet-button :on="form.recentlySuccessful"
                            :class="{ 'opacity-25': form.processing } + 'btn btn-danger'"
                            :disabled="form.processing">Delete</jet-button>
                    </template>
                </jet-form-section>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeDeletePpModal">Cancel</jet-secondary-button>
            </template>
        </jet-dialog-modal>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import intrromanagementrowVue from "./rows/intrromanagementrow.vue";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import inputFileVue from "../../../../Jetstream/inputFile.vue";
import sellObjectRowVue from "./rows/sellObjectRow.vue";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import planpricerowVue from "./rows/planpricerow.vue";
import emtyDataVue from "../Partials/emtyData.vue";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import spinnerVue from "../Partials/spinner.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    props: ["sells", "asset", "access_right", "categories", "robj"],
    components: {
        AppLayout,
        JetInputError,
        JetButton,
        JetActionMessage,
        JetLabel,
        Welcome,
        JetInput,
        intrromanagementrowVue,
        JetDialogModal,
        JetFormSection,
        JetSecondaryButton,
        inputFileVue,
        sellObjectRowVue,
        vSelect,
        planpricerowVue,
        emtyDataVue,
        spinnerVue,
        Link,
    },
    data() {
        return {
            showmodalstate: false,
            eshowmodalstate: false,
            editing: false,
            showPlanmodalstate: true,
            pricingSwitcherActive: "pricing-switcher-active",
            pricingShowList: true,
            keyworld: null,
            eform: this.$inertia.form({
                egtitle: "",
                egdescription: "",
                eghtmlpart: "",
                ecover: null,
                eendat: null,
                estartat: null,
                ecategory: null,
                eid: null,
                ealbum: null,
            }),
            form: this.$inertia.form({
                gtitle: "",
                gdescription: "",
                ghtmlpart: "",
                cover: null,
                endat: null,
                startat: null,
                category: null,
                album: null,
            }),
            dform: this.$inertia.form({
                did: null,
            }),
            plan: this.$inertia.form({
                name: null,
                description: null,
                html: null,
                price: null,
                icon: null,
                objectid: null,
            }),
            ddplan: this.$inertia.form({
                objectid: null,
            }),
            data: null,
            searching: false,
        };
    },
    methods: {
        showModalNewIntro(state) {
            this.showmodalstate = state;
        },
        closeModal(state) {
            this.showmodalstate = state;
        },
        inserthata() {
            this.form.post(route("newsellobject"), {
                errorBag: "newsellobject",
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset(), (this.showmodalstate = false);
                },
                onError: () => {
                    if (this.form.errors.gtitle) {
                        this.form.reset("gtitle", "gtitle");
                        this.$refs.gtitle.focus();
                    }
                    if (this.form.errors.gdescription) {
                        this.form.reset("gdescription", "gdescription");
                        this.$refs.gdescription.focus();
                    }
                    if (this.form.errors.ghtmlpart) {
                        this.form.reset("ghtmlpart", "HTML part ");
                        this.$refs.ghtmlpart.focus();
                    }
                    if (this.form.errors.intropicture) {
                        this.form.reset("intropicture", "HTML part ");
                        this.$refs.intropicture.focus();
                    }
                },
            });
        },
        fetchResult($url) {
            this.searching = true;
            axios
                .get($url)
                .then((result) => {
                    this.data = result.data.data;
                    this.searching = false;
                })
                .catch((err) => {
                    this.searching = false;
                });
        },
        lookfordata() {
            this.searching = true;
            axios
                .get("/api/v1/psearch/" + this.keyworld)
                .then((result) => {
                    this.data = result.data.data;
                    this.searching = false;
                })
                .catch((err) => {
                    this.searching = false;
                });
        },
        insertPP() {
            this.plan.post(route("newpps"), {
                errorBag: "newpps",
                preserveScroll: true,
                onSuccess: (data) => {
                    this.pricingShowList = true;
                    this.plan.reset();
                    this.priceplan.pps.push(data.props.flash.success);
                    this.plan.objectid = this.ppobjectid;
                },
                onError: () => {
                    if (this.plan.errors.name) {
                        this.plan.reset("name", "title");
                        this.$refs.name.focus();
                    }
                    if (this.plan.errors.description) {
                        this.plan.reset("description", "description");
                        this.$refs.gdescription.focus();
                    }
                    if (this.plan.errors.icon) {
                        this.plan.reset("icon", "icon");
                        this.$refs.icon.focus();
                    }
                    if (this.plan.errors.html) {
                        this.plan.reset("html", "HTML part ");
                        this.$refs.html.focus();
                    }
                    if (this.plan.errors.price) {
                        this.plan.reset("price", "price part ");
                        this.$refs.price.focus();
                    }
                },
            });
        },
        updateData() {
            this.eform.post(route("updateellobject"), {
                errorBag: "updateellobject",
                preserveScroll: true,
                onSuccess: () => {
                    this.eform.reset();
                    this.$store.commit("EndEditObjectState");
                },
                onError: () => {
                    if (this.eform.errors.egtitle) {
                        this.eform.reset("egtitle", "gtitle");
                        this.$refs.gtitle.focus();
                    }
                    if (this.eform.errors.egdescription) {
                        this.eform.reset("egdescription", "gdescription");
                        this.$refs.gdescription.focus();
                    }
                    if (this.eform.errors.eghtmlpart) {
                        this.eform.reset("eghtmlpart", "HTML part ");
                        this.$refs.ghtmlpart.focus();
                    }
                    if (this.eform.errors.eintropicture) {
                        this.eform.reset("eintropicture", "HTML part ");
                        this.$refs.intropicture.focus();
                    }
                },
            });
        },
        deleteObj() {
            this.dform.delete(route("deleteObj"), {
                errorBag: "deleteObj",
                preserveScroll: true,
                onSuccess: () => {
                    this.dform.reset();
                    this.closeDeleteModal();
                },
                onError: () => { },
            });
        },
        endPricingManage() {
            this.$store.commit("endPricingManage");
        },
        closeEditModal() {
            this.$store.commit("EndEditObjectState");
        },
        closeDeleteModal() {
            this.$store.commit("EndProjectObjIdToDelete");
        },
        closeDeletePpModal() {
            this.$store.commit("EndPpsDelete");
        },
        switcher() {
            this.pricingShowList
                ? (this.pricingShowList = false)
                : (this.pricingShowList = true);
        },
        deletePp() {
            this.ddplan.post(route("deletepp"), {
                onSuccess: () => {
                    var index = this.priceplan.pps.findIndex(
                        (obj) => obj.id == this.ddplan.objectid
                    );
                    this.priceplan.pps.splice(index, 1);
                    this.ddplan.reset();
                },
                onError: () => { },
            });
        },
    },
    watch: {
        eObjectSell: function () {
            /**
                   *   eform: this.$inertia.form({
                          egtitle: '',
                          egdescription: '',
                          eghtmlpart: '',
                          ecover: null,
                          eendat: null,
                          estartat: null,
                          ecategory: null
                  }),
                   */
            if (this.eObjectSell != null) {
                this.eform.eid = this.eObjectSell.id;
                this.eform.egtitle = this.eObjectSell.title;
                this.eform.egdescription = this.eObjectSell.description;
                this.eform.eghtmlpart = this.eObjectSell.htmlPart;
                this.eform.eendat = this.eObjectSell.EndDate;
                this.eform.estartat = this.eObjectSell.startAt;
                this.eform.ecategory = this.eObjectSell.category_id;
            }
        },
        GetObjToDelete: function () {
            if (this.GetObjToDelete != null) {
                this.dform.did = this.GetObjToDelete;
            }
        },
        ppobjectid() {
            if (this.ppobjectid != null) {
                this.plan.objectid = this.ppobjectid;
            }
        },
        PpIdToDelete() {
            if (this.ppobjectid != null) {
                this.ddplan.objectid = this.PpIdToDelete;
            }
        },
    },
    computed: {
        asset() {
            return this.$store.getters.GetAsset;
        },
        eObjectSell() {
            return this.$store.getters.GetObjectSellToUpdate;
        },
        editModalState() {
            return this.$store.getters.EditobjectsellModalState;
        },
        priceplan() {
            return this.$store.getters.getPricingPlan;
        },
        ppPopupState() {
            return this.$store.getters.getPricingPlan;
        },
        ppobjectid() {
            return this.$store.getters.getPricingPlanobjectid;
        },
        GetModalDeleteState() {
            return this.$store.getters.GetModalDeleteState;
        },
        GetObjToDelete() {
            return this.$store.getters.GetObjToDelete;
        },
        PpIdToDelete() {
            return this.$store.getters.GetPpIdToDelete;
        },
        PpToDeleteModalState() {
            return this.$store.getters.GetPpToDeleteModalState;
        },
    },
});
</script>
