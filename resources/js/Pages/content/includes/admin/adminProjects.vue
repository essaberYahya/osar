<template>
    <div class="container">
        <button class="btn btn-xs btn-primary mt-3 mb-3" @click="showModalNewProject(true)"
            v-if="access_right != null && access_right.write"><i class="uil uil-pen mr-2"></i> Create new
            projects</button>
        <span class="badge bg-orange rounded-pill mb-3" v-else><i class="uil uil-minus-circle mr-2"></i>Not alowed to
            add project</span>
        <div class="row">
            <div class="">
                <table class="table table-hover">
                    <thead>

                        <th>Picture</th>
                        <th>Title</th>
                        <th>description</th>
                        <th>Category</th>
                        <th>Html part</th>
                        <th>Hidden</th>
                        <th>Edit</th>
                        <th>Delete</th>

                    </thead>
                    <tbody>
                        <projectManagementrowVue :asset="asset" v-for="project in projects" :key="project.id"
                            :item="project" :access_right="access_right"></projectManagementrowVue>
                    </tbody>
                </table>
            </div>
        </div>
        <jet-dialog-modal v-if="access_right != null && access_right.write" :show="showmodalstate">
            <template #title>New projects</template>
            <template #content>
                <jet-form-section @submitted="inserthata">
                    <template #title>New projects</template>
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
                                <vSelect :options="categories" label="name" :reduce="cat => cat.id"
                                    v-model="form.gcategory" ref="gcategory"
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
                            <div class="mt-5">
                                <jet-label for="hidden" value="hidden" />

                                <jet-input-error :message="form.errors.ghtmlpart" class="mt-2" />
                            </div>
                            <div class="cla mt-5">
                                <jet-label for="cover" value="cover picture" />
                                <inputFileVue id="cover" @input="form.cover = $event.target.files[0]"
                                    v-model="form.cover" title="Select cover picture"></inputFileVue>
                                <jet-input-error :message="form.errors.cover" class="mt-2" />
                            </div>

                            <div class="cla mt-5">
                                <jet-label for="album" value="Albums pirctures" />
                                <inputFileVue id="album" :multi="true" @input="form.album = $event.target.files"
                                    v-model="form.album" title="Select album pictures"></inputFileVue>
                                <jet-input-error :message="form.errors.album" class="mt-2" />
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
                <jet-secondary-button @click="showModalNewProject(false)">Cancel</jet-secondary-button>
            </template>
        </jet-dialog-modal>

        <jet-dialog-modal v-if="access_right != null && access_right.editText" :show="showEditmodalstate">
            <template #title>Edit project</template>
            <template #content>
                <jet-form-section @submitted="updatethata">
                    <template #title>Edit project</template>
                    <template #form>
                        <div class="row">
                            <div class="mt-5">
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
                                <vSelect :options="categories" label="name" :reduce="cat => cat.id"
                                    v-model="eform.egcategory" ref="egcategory"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                <jet-input-error :message="eform.errors.egcategory" class="mt-2" />
                            </div>
                            <div class="mt-5">
                                <jet-label for="eghtmlpart" value="Html section" />
                                <textarea id="eghtmlpart" v-model="eform.eghtmlpart" type="text"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                    rows="5" ref="eghtmlpart" autocomplete="true" />
                                <jet-input-error :message="eform.errors.eghtmlpart" class="mt-2" />
                            </div>

                            <div class="cla mt-5">
                                <jet-label for="ecover" value="Edit cover picture" />
                                <inputFileVue id="ecover" @input="eform.ecover = $event.target.files[0]"
                                    v-model="eform.ecover" title="Select cover picture"></inputFileVue>
                                <jet-input-error :message="eform.errors.ecover" class="mt-2" />
                            </div>

                            <div class="cla mt-5">
                                <jet-label for="ealbum" value="Albums pirctures" />
                                <inputFileVue id="ealbum" :multi="true" @input="eform.ealbum = $event.target.files"
                                    v-model="eform.ealbum" title="Select album pictures"></inputFileVue>
                                <jet-input-error :message="eform.errors.ealbum" class="mt-2" />
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
                        <progress v-if="eform.progress" :value="eform.progress.percentage" max="100">{{
                            form.progress.percentage }}%</progress>
                        <jet-button :on="eform.recentlySuccessful" :class="{ 'opacity-25': eform.processing }"
                            :disabled="eform.processing">Update</jet-button>
                    </template>
                </jet-form-section>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeEditModal">Cancel</jet-secondary-button>
            </template>
        </jet-dialog-modal>

        <jet-dialog-modal v-if="access_right != null && access_right.delete" :show="cDeleteProjectModalState">
            <template #content>
                <jet-form-section @submitted="deleteProject">
                    <template #title>Delete project</template>
                    <template #form>
                        Are you sure you want to delete this project?
                        <br />Please to confirm you would like to permanently delete your account.
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
export default defineComponent({

    props: ["projects", "asset", "categories", "access_right"],
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
        vSelect
    },
    data() {
        return {
            showmodalstate: false,
            showEditmodalstate: false,
            cDeleteProjectModalState: false,
            editing: false,
            form: this.$inertia.form({
                gtitle: '',
                gdescription: '',
                ghtmlpart: '',
                gcategory: null,
                cover: null,
                album: null
            }),
            eform: this.$inertia.form({
                egtitle: '',
                egdescription: '',
                eghtmlpart: '',
                egcategory: null,
                ecover: null,
                eid: null,
                ealbum: null
            }),
            dform: this.$inertia.form({
                dpid: null
            })
        }
    },
    methods: {
        showModalNewProject(state) {
            this.showmodalstate = state;
        },

        closeModal(state) {
            this.showmodalstate = state;
        },
        inserthata() {
            this.form.post(route('newProject'), {
                errorBag: 'newProject',
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
                    if (this.form.errors.cover) {
                        this.form.reset('cover', 'Cover ')
                        this.$refs.cover.focus()
                    }
                    if (this.form.errors.gcategory) {
                        this.form.reset('gcategory', 'Category ')
                        this.$refs.cover.focus()
                    }


                }
            })
        },
        updatethata() {
            this.eform.post(route('updateproject'), {
                errorBag: 'updateproject',
                preserveScroll: true,
                onSuccess: () => {
                    this.eform.reset(),
                        this.$store.commit("EndSetEditProjectState");

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

                    if (this.eform.errors.egcategory) {
                        this.eform.reset('egcategory', 'eCategory ')
                        this.$refs.cover.focus()
                    }


                }
            })
        },

        deleteProject() {
            this.dform.delete(route("deleteProject", {
                errorBag: 'deleteProject',
                preserveScroll: true,
                onSuccess: () => {
                    this.$store.commit("EndDeleteProject");

                    this.dform.reset();
                },
                onError: () => { }
            }))
        },
        closeEditModal() {
            this.$store.commit("EndSetEditProjectState");
        },
        closeDeleteModal() {
            this.$store.commit("EndDeleteProject");
        }
    },
    watch: {
        eProject: function () {
            if (this.eProject) {
                this.eform.eid = this.eProject.id;
                this.eform.egtitle = this.eProject.title;
                this.eform.egdescription = this.eProject.description;
                this.eform.eghtmlpart = this.eProject.htmlPart;
                this.eform.egcategory = this.eProject.category_id
            }
        },
        dProjectid: function () {
            if (this.dintroid != null) {
                this.dform.did = this.dintroid
            }
        },
        editModalState: function () {
            this.showEditmodalstate = this.editModalState
        },
        DeleteProjectModalState: function () {
            this.cDeleteProjectModalState = this.DeleteProjectModalState;
        },
        dProjectid: function () {
            this.dform.dpid = this.dProjectid;
        }
    },
    computed: {
        asset() {
            return this.$store.getters.GetAsset
        },
        eProject() {
            return this.$store.getters.editedProject
        },
        editModalState() {
            return this.$store.getters.editProjectPopupState
        },
        DeleteProjectModalState() {
            return this.$store.getters.DeleteProjectModalState
        },
        dProjectid() {
            return this.$store.getters.GetIdProjectToDelete
        }
    }
})
</script>
