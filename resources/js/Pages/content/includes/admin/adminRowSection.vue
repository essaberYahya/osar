<template>
    <div class="container">
        <button class="btn btn-xs btn-primary mt-3 mb-3" @click="showModalNewRowSection(true)"
            v-if="access_right != null && access_right.write"><i class="uil uil-pen mr-2"></i> Create new row
            section</button>
        <span class="badge bg-orange rounded-pill mb-3" v-else><i class="uil uil-minus-circle mr-2"></i>Not alowed to
            add new row section !</span>

        <div class="row">
            <div class="table table-hover">
                <thead>
                    <tr>
                        <th>Picture</th>
                        <th>Title</th>
                        <th>description</th>
                        <th>Html part</th>
                        <th>Direction</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <rowSectionManagementRowVue :saccess_rigth="access_right" :asset="asset"
                        v-for="rowsection in rowssections" :key="rowsection.id" :item="rowsection">
                    </rowSectionManagementRowVue>
                </tbody>
            </div>
        </div>

        <!-- pop up new row sections -->
        <jet-dialog-modal v-if="access_right != null && access_right.write" :show="showmodalstate">
            <template #title>Create new row section</template>
            <template #content>
                <jet-form-section @submitted="inserthata">
                    <template #title>New row section</template>
                    <template #form>
                        <div class="row">
                            <div class="mt-5">
                                <jet-label for="gtitle" value="General title" />
                                <jet-input id="gtitle" v-model="form.gtitle" type="text" class="mt-1 block w-full"
                                    ref="gtitle" autocomplete="true" />
                                <jet-input-error :message="form.errors.gtitle" class="mt-2" />
                            </div>
                            <div class="mt-5">
                                <jet-label for="gdescription" value="General description" />
                                <jet-input id="gdescription" v-model="form.gdescription" type="text"
                                    class="mt-1 block w-full" ref="gdescription" autocomplete="true" />
                                <jet-input-error :message="form.errors.gdescription" class="mt-2" />
                            </div>
                            <div class="mt-5">
                                <jet-label for="gcategory" value="Category" />
                                <vSelect :options="options" label="display" :reduce="p => p.value"
                                    v-model="form.leftToRight" ref="gcategory"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                <jet-input-error :message="form.errors.gcategory" class="mt-2" />
                            </div>
                            <div class="mt-5">
                                <jet-label for="ghtmlpart" value="Html section" />
                                <textarea id="ghtmlpart" v-model="form.ghtmlpart" type="text"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                    rows="5" ref="ghtmlpart" autocomplete="true" />
                                <jet-input-error :message="form.errors.ghtmlpart" class="mt-2" />
                            </div>

                            <div class="cla mt-5">
                                <jet-label for="picture" value="cover picture" />
                                <inputFileVue id="picture" @input="form.picture = $event.target.files[0]"
                                    v-model="form.picture" title="Select cover picture"></inputFileVue>
                                <jet-input-error :message="form.errors.picture" class="mt-2" />
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
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{
                            form.progress.percentage }}%</progress>
                        <jet-button :on="form.recentlySuccessful" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">Save</jet-button>
                    </template>
                </jet-form-section>
            </template>

            <template #footer>
                <jet-secondary-button @click="showModalNewRowSection(false)">Cancel</jet-secondary-button>
            </template>
        </jet-dialog-modal>

        <!-- pop up edit row sections -->
        <jet-dialog-modal v-if="access_right != null && access_right.editText" :show="showEditmodalstate">
            <template #title>Edit row section</template>
            <template #content>
                <jet-form-section @submitted="updatethata">
                    <template #title>Edit row section</template>
                    <template #form>
                        <div class="row">
                            <div>
                                <jet-label for="egtitle" value="General title" />
                                <jet-input id="egtitle" v-model="eform.egtitle" type="text" class="mt-1 block w-full"
                                    ref="egtitle" autocomplete="true" />
                                <jet-input-error :message="eform.errors.egtitle" class="mt-2" />
                            </div>
                            <div class="mt-5">
                                <jet-label for="egdescription" value="General description" />
                                <jet-input id="egdescription" v-model="eform.egdescription" type="text"
                                    class="mt-1 block w-full" ref="egdescription" autocomplete="true" />
                                <jet-input-error :message="eform.errors.egdescription" class="mt-2" />
                            </div>
                            <div class="mt-5">
                                <jet-label for="egcategory" value="Category" />
                                <vSelect :options="options" label="display" :reduce="p => p.value"
                                    v-model="eform.eleftToRight" ref="egcategory"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                <jet-input-error :message="eform.errors.eleftToRight" class="mt-2" />
                            </div>
                            <div class="mt-5">
                                <jet-label for="eghtmlpart" value="Html section" />
                                <textarea id="eghtmlpart" v-model="eform.eghtmlpart" type="text"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                    rows="5" ref="eghtmlpart" autocomplete="true" />
                                <jet-input-error :message="eform.errors.eghtmlpart" class="mt-2" />
                            </div>

                            <div class="cla mt-5">
                                <jet-label for="epicture" value="cover picture" />
                                <inputFileVue id="epicture" @input="eform.epicture = $event.target.files[0]"
                                    v-model="eform.epicture" title="Edit cover picture"></inputFileVue>
                                <jet-input-error :message="eform.errors.epicture" class="mt-2" />
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
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{
                            form.progress.percentage }}%</progress>
                        <jet-button :on="form.recentlySuccessful" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">Save</jet-button>
                    </template>
                </jet-form-section>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeEditModal">Cancel</jet-secondary-button>
            </template>
        </jet-dialog-modal>

        <!-- popup delete row section -->
        <!-- pop up delete service -->
        <jet-dialog-modal v-if="access_right != null && access_right.delete" :show="cDeleteRowsectionModalState">
            <template #content>
                <jet-form-section @submitted="deleteRowService">
                    <template #title>Delete row section</template>
                    <template #form>
                        Are you sure you want to delete this row section? <br> Please to confirm you would like to
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
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import Welcome from '@/Jetstream/Welcome.vue'
import intrromanagementrowVue from './rows/intrromanagementrow.vue'
import projectManagementrowVue from './rows/projectManagementRow.vue'
import JetDialogModal from '@/Jetstream/DialogModal.vue'
import JetActionMessage from '@/Jetstream/ActionMessage.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetFormSection from '@/Jetstream/FormSection.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import inputFileVue from '../../../../Jetstream/inputFile.vue'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import rowSectionManagementRowVue from './rows/rowSectionManagementRow.vue'
export default defineComponent({

    props: ["rowssections", "asset", "categories", "access_right"],
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
        projectManagementrowVue,
        vSelect,
        rowSectionManagementRowVue,

    },
    data() {
        return {
            showmodalstate: false,
            showEditmodalstate: false,
            cDeleteRowsectionModalState: false,
            editing: false,
            form: this.$inertia.form({
                gtitle: '',
                gdescription: '',
                ghtmlpart: '',
                gcategory: null,
                picture: null,
                leftToRight: null
            }),
            eform: this.$inertia.form({
                egtitle: '',
                egdescription: '',
                eghtmlpart: '',
                epicture: null,
                eleftToRight: null,
                rsid: null
            }),
            dform: this.$inertia.form({
                drsid: null
            }),
            options: [
                {
                    id: 1,
                    value: 0,
                    display: "Normal"
                },
                {
                    id: 2,
                    value: 1,
                    display: "Reverse"
                }
            ]
        }
    },
    methods: {
        showModalNewRowSection(state) {
            this.showmodalstate = state;
        },

        closeModal(state) {
            this.showmodalstate = state;
        },
        inserthata() {
            this.form.post(route('newrowsection'), {
                errorBag: 'newrowsection',
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset(),
                        this.showmodalstate = false;
                },
                onError: () => {
                    if (this.form.errors.gtitle) {
                        this.form.reset('gtitle', 'gtitle')
                        this.$refs.gtitle.focus()
                    }
                    if (this.form.errors.gdescription) {
                        this.form.reset('gdescription', 'gdescription')
                        this.$refs.gdescription.focus()
                    }
                    if (this.form.errors.ghtmlpart) {
                        this.form.reset('ghtmlpart', 'HTML part ')
                        this.$refs.ghtmlpart.focus()
                    }
                    if (this.form.errors.picture) {
                        this.form.reset('picture', 'picture')
                        this.$refs.picture.focus()
                    }
                    if (this.form.errors.gcategory) {
                        this.form.reset('gcategory', 'Category ')
                        this.$refs.cover.focus()
                    }


                }
            })
        },
        updatethata() {
            this.eform.post(route('updaterowsection'), {
                errorBag: 'updaterowsection',
                preserveScroll: true,
                onSuccess: () => {
                    this.eform.reset(),
                        this.$store.commit("EndSetEditrowsectiontState");

                },
                onError: () => {
                    if (this.eform.errors.egtitle) {
                        this.eform.reset('egtitle', 'egtitle')
                        this.$refs.egtitle.focus()
                    }
                    if (this.eform.errors.egdescription) {
                        this.eform.reset('egdescription', 'egdescription')
                        this.$refs.egdescription.focus()
                    }
                    if (this.eform.errors.eghtmlpart) {
                        this.eform.reset('ghtmlpart', 'HTML part ')
                        this.$refs.ghtmlpart.focus()
                    }
                    if (this.eform.errors.eleftToRight) {
                        this.eform.reset('eleftToRight', 'HTML part ')
                        this.$refs.eleftToRight.focus()
                    }
                    if (this.eform.errors.egcategory) {
                        this.eform.reset('egcategory', 'eCategory ')
                        this.$refs.cover.focus()
                    }


                }
            })
        },

        deleteRowService() {
            this.dform.delete(route("deleteRowService", {
                errorBag: 'deleteRowService',
                preserveScroll: true,
                onSuccess: () => {
                    this.$store.commit("EndDeleterowsection");

                    this.dform.reset();
                },
                onError: () => { }
            }))
        },
        closeEditModal() {
            this.$store.commit("EndSetEditrowsectiontState");
        },
        closeDeleteModal() {
            this.$store.commit("EndDeleterowsection");
        }
    },
    watch: {
        erowsection: function () {
            if (this.erowsection) {
                this.eform.rsid = this.erowsection.id;
                this.eform.egtitle = this.erowsection.title;
                this.eform.egdescription = this.erowsection.description;
                this.eform.eghtmlpart = this.erowsection.htmlPart;
                this.eform.eleftToRight = this.erowsection.leftToRight
            }
        },
        drowsectionid: function () {
            if (this.dintroid != null) {
                this.dform.did = this.dintroid
            }
        },
        editModalState: function () {
            this.showEditmodalstate = this.editModalState
        },
        DeleterowsectionModals: function () {
            this.cDeleteRowsectionModalState = this.DeleterowsectionModals;
        },
        drowsectionid: function () {
            this.dform.drsid = this.drowsectionid;
        }
    },
    computed: {
        asset() {
            return this.$store.getters.GetAsset
        },
        erowsection() {
            return this.$store.getters.editedrowsection
        },
        editModalState() {
            return this.$store.getters.edirowsectitonPopupState
        },
        DeleterowsectionModals() {
            return this.$store.getters.DeleterowsectionModalState
        },
        drowsectionid() {
            return this.$store.getters.GetIdrowsectionToDelete
        }
    }
})
</script>
