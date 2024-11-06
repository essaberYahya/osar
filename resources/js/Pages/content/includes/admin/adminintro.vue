<template>
    <div class="container">
        <button class="btn btn-xs btn-success mt-3 mb-3" @click="showModalNewIntro(true)" v-if="access_right.write">
            <i class="uil uil-pen mr-2"></i> Create new intro
        </button>
        <span class="badge bg-orange rounded-pill mb-3" v-else>
            <i class="uil uil-minus-circle mr-2"></i>Not alowed to add intro
        </span>
        <div class="row">
            <div class="table table-hover">
                <thead>
                    <tr>
                        <th>Picture</th>
                        <th>Title</th>
                        <th>description</th>
                        <th>html part</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <intrromanagementrowVue :saccess_rigth="access_right" :asset="asset" v-for="item in intros"
                        :key="item.id" :item="item"></intrromanagementrowVue>
                </tbody>
            </div>
        </div>
        <jet-dialog-modal v-if="access_right != null && access_right.write" :show="showmodalstate">
            <template #content>
                <jet-form-section @submitted="inserthata">
                    <template #form>
                        <div class="row">
                            <div class="mb-2">
                                <jet-label for="gtitle" value="Title" />
                                <jet-input id="gtitle" v-model="form.gtitle" type="text" class="mt-1 block w-full"
                                    ref="gtitle" autocomplete="true" />
                                <jet-input-error :message="form.errors.gtitle" class="mt-2" />
                            </div>
                            <div class="mb-2">
                                <jet-label for="gdescription" value="Description" />
                                <jet-input id="gdescription" v-model="form.gdescription" type="text"
                                    class="mt-1 block w-full" ref="gdescription" autocomplete="true" />
                                <jet-input-error :message="form.errors.gdescription" class="mt-2" />
                            </div>
                            <div class="mb-5">
                                <jet-label for="ghtmlpart" value="Content" />
                                <QuillEditor theme="snow" v-model="form.ghtmlpart" />
                               
                            
                                <jet-input-error :message="form.errors.ghtmlpart" class="mt-2" />
                            </div>
                            <div class="cla mt-3">
                                <jet-label for="gbackgrundimg" value="Cover" />
                                <inputFileVue id="intropicture" @input="form.intropicture = $event.target.files[0]"
                                    v-model="form.intropicture" title="Select intro picture"></inputFileVue>
                                <jet-input-error :message="form.errors.intropicture" class="mt-2" />
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
                <jet-secondary-button @click="showModalNewIntro(false)">Cancel</jet-secondary-button>
            </template>
        </jet-dialog-modal>

        <jet-dialog-modal v-if="access_right != null && access_right.editText" :show="editModalState">
            <template #content>
                <jet-form-section @submitted="updateData">
                    <template #form>
                        <div class="row">
                            <div class>
                                <jet-label for="egtitle" value="General title" />
                                <jet-input id="egtitle" v-model="sform.egtitle" type="text" class="mt-1 block w-full"
                                    ref="gtitle" autocomplete="true" />
                                <jet-input-error :message="sform.errors.egtitle" class="mt-2" />
                            </div>
                            <div class>
                                <jet-label for="egdescription" value="General description" />
                                <jet-input id="egdescription" v-model="sform.egdescription" type="text"
                                    class="mt-1 block w-full" ref="gdescription" autocomplete="true" />
                                <jet-input-error :message="sform.errors.egdescription" class="mt-2" />
                            </div>
                            <div class>
                                <jet-label for="eghtmlpart" value="Html section" />
                                <textarea id="eghtmlpart" v-model="sform.eghtmlpart" type="text"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                    rows="5" ref="eghtmlpart" autocomplete="true" />
                                <jet-input-error :message="sform.errors.eghtmlpart" class="mt-2" />
                            </div>
                            <div class="cla mt-2">
                                <jet-label for="egbackgrundimg" value="Intro picture" />
                                <inputFileVue id="eintropicture" @input="sform.eintropicture = $event.target.files[0]"
                                    v-model="sform.eintropicture" title="Select intro picture"></inputFileVue>
                                <jet-input-error :message="sform.errors.eintropicture" class="mt-2" />
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

                        <jet-button :on="form.recentlySuccessful" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">Save</jet-button>
                    </template>
                </jet-form-section>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeEditModal">Cancel</jet-secondary-button>
            </template>
        </jet-dialog-modal>

        <jet-dialog-modal v-if="access_right != null && access_right.delete" :show="DeleteIntroModalState">
            <template #content>
                <jet-form-section @submitted="deleteIntro">
                    <template #form>
                        Are you sure you want to delete this intro?
                        <br />Please enter your password to confirm you would like to permanently delete your account.
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
import JetDialogModal from '@/Jetstream/DialogModal.vue'
import JetActionMessage from '@/Jetstream/ActionMessage.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetFormSection from '@/Jetstream/FormSection.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import inputFileVue from '../../../../Jetstream/inputFile.vue'


export default defineComponent({

    props: ["intros", "asset", "access_right"],
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
        
    },
    data() {
        return {
            editorToolbar: [
        ['bold', 'italic', 'underline', 'strike'],
        ['link', 'image'],
        ['orderedList', 'unorderedList'],
        ['quote'],
        ['code', 'codeblock'],
        ['align', 'indent'],
      ],
            showmodalstate: false,
            eshowmodalstate: false,
            editing: false,
            sform: this.$inertia.form({
                egtitle: '',
                egdescription: '',
                eghtmlpart: '',
                eintropicture: null,
                eid: null
            }),
            form: this.$inertia.form({
                gtitle: '',
                gdescription: '',
                ghtmlpart: '',
                intropicture: null
            }),
            dform: this.$inertia.form({
                did: null
            }),

        }
    },
    methods: {
        showModalNewIntro(state) {
            this.showmodalstate = state;
        },
        closeModal(state) {
            this.showmodalstate = state;
        },
        inserthata() {
            this.form.post(route('newintro'), {
                errorBag: 'addintro',
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset()
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
                    if (this.form.errors.intropicture) {
                        this.form.reset('intropicture', 'HTML part ')
                        this.$refs.intropicture.focus()
                    }

                }
            })
        },
        updateData() {
            this.sform.post(route('updateIntro'), {
                errorBag: 'updateIntro',
                preserveScroll: true,
                onSuccess: () => {
                    this.$store.commit("EndSetEditedIntro");
                    this.sform.reset()
                },
                onError: () => {
                    if (this.form.errors.egtitle) {
                        this.form.reset('egtitle', 'egtitle')
                        this.$refs.egtitle.focus()
                    }
                    if (this.form.errors.egdescription) {
                        this.form.reset('egdescription', 'egdescription')
                        this.$refs.egdescription.focus()
                    }
                    if (this.form.errors.eghtmlpart) {
                        this.form.reset('eghtmlpart', 'HTML part ')
                        this.$refs.eghtmlpart.focus()
                    }
                    if (this.form.errors.eintropicture) {
                        this.form.reset('eintropicture', 'HTML part ')
                        this.$refs.eintropicture.focus()
                    }

                }
            })
        },
        deleteIntro() {
            this.dform.delete(route("deleteIntro", {
                errorBag: 'deleteIntro',
                preserveScroll: true,
                onSuccess: () => {
                    this.dform.reset();
                    this.$store.commit("EndDeleteIntro");
                },
                onError: () => { }
            }))
        },
        closeEditModal() {
            this.$store.commit("EndSetEditedIntro");
        },
        closeDeleteModal() {
            this.$store.commit("EndDeleteIntro");
        }
    },
    watch: {
        eintro: function () {
            if (this.eintro) {
                this.sform.eid = this.eintro.id;
                this.sform.egtitle = this.eintro.title;
                this.sform.egdescription = this.eintro.description;
                this.sform.eghtmlpart = this.eintro.htmlPart;
            }
        },
        dintroid: function () {
            if (this.dintroid != null) {
                this.dform.did = this.dintroid
            }
        }
    },
    computed: {
        casset() {
            return this.$store.getters.GetAsset
        },
        eintro() {
            return this.$store.getters.GetEditedIntro
        },
        editModalState() {
            return this.$store.getters.EditIntroModalState
        },
        DeleteIntroModalState() {
            return this.$store.getters.DeleteIntroModalState
        },
        dintroid() {
            return this.$store.getters.GetIdIntroToDelete
        }
    }
})
</script>
