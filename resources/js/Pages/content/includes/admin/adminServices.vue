<template>
    <div class="container">
        <button class="btn btn-xs btn-primary mt-3 mb-3" @click="NewServiceModal(true)"
            v-if="access_right != null && access_right.write"><i class="uil uil-pen mr-2"></i> Create new
            service</button>
        <span class="badge bg-orange rounded-pill mb-3" v-else><i class="uil uil-minus-circle mr-2"></i>Not alowed to
            add service</span>
        <div class="row">
            <div class="table table-hover">
                <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Color</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <serviceManagementRowVue :asset="asset" :access_right="access_right" v-for="service in services"
                        :key="service.id" :item="service"></serviceManagementRowVue>
                </tbody>
            </div>
        </div>
        <!-- popup for new services -->
        <jet-dialog-modal v-if="access_right != null && access_right.write" :show="NewServiceModalState">
            <template #content>
                <jet-form-section @submitted="createNewService">
                    <template #title>New service</template>
                    <template #form>
                        <div class="row">
                            <div class="cla">
                                <jet-label for="icon" value="icon" />
                                <inputFileVue id="icon" @input="form.icon = $event.target.files[0]" v-model="form.icon"
                                    title="Select icon"></inputFileVue>
                                <jet-input-error :message="form.errors.icon" class="mt-2" />
                            </div>
                            <div class="mt-3">
                                <jet-label for="color" value="General Color" />
                                <jet-input id="color" v-model="form.color" type="text" class="mt-1 block w-full"
                                    ref="color" autocomplete="true" placeholder="General color" />
                                <jet-input-error :message="form.errors.color" class="mt-2" />
                            </div>
                            <div class="mt-3">
                                <jet-label for="title" value="General Title" />
                                <jet-input id="title" v-model="form.title" type="text" class="mt-1 block w-full"
                                    ref="title" autocomplete="true" placeholder="General Title" />
                                <jet-input-error :message="form.errors.title" class="mt-2" />
                            </div>
                            <div class="mt-3">
                                <jet-label for="description" value="Service descriptions" />
                                <textarea id="description" v-model="form.description" type="text"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                    rows="5" ref="description" autocomplete="true" />
                                <jet-input-error :message="form.errors.description" class="mt-2" />
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

                        <jet-button :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">Save</jet-button>
                    </template>
                </jet-form-section>
            </template>

            <template #footer>
                <jet-secondary-button @click="NewServiceModal(false)">Cancel</jet-secondary-button>
            </template>
        </jet-dialog-modal>
        <!-- pop up update service -->
        <jet-dialog-modal v-if="access_right != null && access_right.editText" :show="UpdateerviceModalState">
            <template #title>create new service</template>
            <template #content>
                <jet-form-section @submitted="UpdateOldService">
                    <template #title>Edit service</template>
                    <template #form>
                        <div class="row">
                            <div class="cla">
                                <jet-label for="eicon" value="icon" />
                                <inputFileVue id="eicon" @input="eform.eicon = $event.target.files[0]"
                                    v-model="form.icon" title="Select eicon"></inputFileVue>
                                <jet-input-error :message="eform.errors.eicon" class="mt-2" />
                            </div>
                            <div class="mt-3">
                                <jet-label for="ecolor" value="General Color" />
                                <jet-input id="ecolor" v-model="eform.ecolor" type="text" class="mt-1 block w-full"
                                    ref="ecolor" autocomplete="true" placeholder="General color" />
                                <jet-input-error :message="eform.errors.ecolor" class="mt-2" />
                            </div>
                            <div class="mt-3">
                                <jet-label for="etitle" value="General Title" />
                                <jet-input id="etitle" v-model="eform.etitle" type="text" class="mt-1 block w-full"
                                    ref="etitle" autocomplete="true" placeholder="General Title" />
                                <jet-input-error :message="eform.errors.etitle" class="mt-2" />
                            </div>
                            <div class="mt-3">
                                <jet-label for="edescription" value="Service descriptions" />
                                <textarea id="edescription" v-model="eform.edescription" type="text"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                    rows="5" ref="edescription" autocomplete="true" />
                                <jet-input-error :message="eform.errors.edescription" class="mt-2" />
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

                        <jet-button :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">Save</jet-button>
                    </template>
                </jet-form-section>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeEditModal">Cancel</jet-secondary-button>
            </template>
        </jet-dialog-modal>
        <!-- pop up delete service -->
        <jet-dialog-modal v-if="access_right != null && access_right.delete" :show="DeleteSerModalState">
            <template #content>
                <jet-form-section @submitted="deleteService">
                    <template #title>Delete service</template>
                    <template #form>
                        Are you sure you want to delete this service? <br> Please to confirm you would like to
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
import JetDialogModal from '@/Jetstream/DialogModal.vue'
import JetActionMessage from '@/Jetstream/ActionMessage.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetFormSection from '@/Jetstream/FormSection.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import inputFileVue from '../../../../Jetstream/inputFile.vue'
import serviceManagementRowVue from './rows/serviceManagementRow.vue'



export default defineComponent({

    props: ["services", "access_right", "asset"],
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
        serviceManagementRowVue
    },
    data() {
        return {
            NewServiceModalState: false,
            UpdateerviceModalState: false,
            DeleteSerModalState: false,
            form: this.$inertia.form({
                icon: null,
                title: '',
                description: '',
                color: null,
            }),
            eform: this.$inertia.form({
                eicon: null,
                etitle: '',
                edescription: '',
                ecolor: null,
                eid: null
            }),
            dform: this.$inertia.form({
                dsid: null
            })
        }
    },
    methods: {
        NewServiceModal(state) {
            this.NewServiceModalState = state;
        },
        UpdateServiceModal(state) {
            this.UpdateerviceModalState = state;
        },
        createNewService() {
            this.form.post(route("newservice", {
                errorBag: 'newservice',
                preserveScroll: true,
                onSuccess: () => {
                    this.NewServiceModal(false);
                },
                onerror: () => {

                }
            }))
        },
        UpdateOldService() {
            this.eform.post(route("updateservice", {
                errorBag: 'updateservice',
                preserveScroll: true,
                onSuccess: () => {
                    this.$store.commit("EndSetEditServiceState");
                },
                onerror: () => {

                }
            }))
        },
        deleteService() {
            this.dform.delete(route('deleteervice'), {
                onSuccess: () => {
                    this.closeDeleteModal();
                },
                onerror: () => {

                }
            })
        },
        closeEditModal() {
            this.$store.commit("EndSetEditServiceState");
        },
        closeDeleteModal() {
            this.$store.commit("EndDeleteService");
        }
    },
    watch: {
        editPopUpState: function () {
            this.UpdateServiceModal(this.editPopUpState)
        },
        editedServices: function () {
            this.eform.etitle = this.editedServices.title;
            this.eform.ecolor = this.editedServices.color;
            this.eform.eicon = this.editedServices.icon;
            this.eform.edescription = this.editedServices.description;
            this.eform.eid = this.editedServices.id;
        },
        DeleteServiceModalState: function () {
            this.DeleteSerModalState = this.DeleteServiceModalState
        },
        dServiceid: function () {
            this.dform.dsid = this.dServiceid
        }
    },
    computed: {
        editPopUpState() {
            return this.$store.getters.editServicePopupState
        },
        editedServices() {
            return this.$store.getters.editedServices
        },
        DeleteServiceModalState() {
            return this.$store.getters.DeleteServiceModalState
        },
        dServiceid() {
            return this.$store.getters.GetIdServiceToDelete
        }
    }
})
</script>
