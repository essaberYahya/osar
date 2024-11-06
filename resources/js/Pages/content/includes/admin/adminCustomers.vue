<template>
    <div class="container">
        <button class="btn btn-primary rounded-pill me-1 mb-2 mb-md-0" @click="showModalNewIntro(true)"
            v-if="access_right.write">
            <i class="uil uil-pen mr-2"></i> Create new customer
        </button>
        <span class="badge bg-orange rounded-pill mb-3" v-else>
            <i class="uil uil-minus-circle mr-2"></i>Not alowed to add intro
        </span>
        <div class="row">
            <div class="table table-hover">
                <thead>
                    <tr>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <customerRowVue :saccess_rigth="access_right" :asset="asset" v-for="item in customers"
                        :key="item.id" :item="item"></customerRowVue>
                </tbody>
            </div>
        </div>
        <jet-dialog-modal v-if="access_right != null && access_right.write" :show="showmodalstate">
            <template #title>create new customer</template>
            <template #content>
                <jet-form-section @submitted="inserthata">
                    <template #title>New customer</template>
                    <template #form>
                        <div class="row">
                            <div class>
                                <jet-label for="name" value="General title" />
                                <jet-input id="name" v-model="form.name" type="text" class="mt-1 block w-full"
                                    ref="gtitle" autocomplete="true" />
                                <jet-input-error :message="form.errors.name" class="mt-2" />
                            </div>
                            <div class>
                                <jet-label for="description" value="General description" />
                                <textarea
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                    id="description" v-model="form.description" type="text" ref="gdescription"
                                    autocomplete="true" />
                                <jet-input-error :message="form.errors.description" class="mt-2" />
                            </div>

                            <div class="cla mt-2">
                                <jet-label for="logo" value="Intro picture" />
                                <inputFileVue id="logo" @input="form.logo = $event.target.files[0]" v-model="form.logo"
                                    title="Select intro picture"></inputFileVue>
                                <jet-input-error :message="form.errors.logo" class="mt-2" />
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

        <jet-dialog-modal v-if="access_right != null && access_right.editText" :show="eshowmodalstate">
            <template #title>Edit customer details</template>
            <template #content>
                <jet-form-section @submitted="updateData">
                    <template #title>Edit customer details</template>
                    <template #form>
                        <div class="row">
                            <div class>
                                <jet-label for="ename" value="General title" />
                                <jet-input id="ename" v-model="sform.ename" type="text" class="mt-1 block w-full"
                                    ref="gtitle" autocomplete="true" />
                                <jet-input-error :message="sform.errors.ename" class="mt-2" />
                            </div>
                            <div class>
                                <jet-label for="edescription" value="General description" />
                                <textarea id="edescription" v-model="sform.edescription" type="text"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                    ref="gdescription" rows="5" autocomplete="true" />
                                <jet-input-error :message="sform.errors.edescription" class="mt-2" />
                            </div>
                            <div class="cla mt-2">
                                <jet-label for="elogo" value="Intro picture" />
                                <inputFileVue id="elogo" @input="sform.elogo = $event.target.files[0]"
                                    v-model="sform.elogo" title="Select intro picture"></inputFileVue>
                                <jet-input-error :message="sform.errors.elogo" class="mt-2" />
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

        <jet-dialog-modal v-if="access_right != null && access_right.delete" :show="deleteModalState">
            <template #content>
                <jet-form-section @submitted="deleteCustomer">
                    <template #title>Delete customer</template>
                    <template #form>
                        Are you sure you want to delete this customer?
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
import customerRowVue from './rows/customerRow.vue'



export default defineComponent({

    props: ["customers", "asset", "access_right"],
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
        customerRowVue
    },
    data() {
        return {
            showmodalstate: false,
            eshowmodalstate: false,
            deleteModalState: false,
            editing: false,
            sform: this.$inertia.form({
                ename: '',
                edescription: '',
                elogo: null,
                eid: null
            }),
            form: this.$inertia.form({
                name: '',
                description: '',
                logo: null
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
            this.form.post(route('newCustomer'), {
                errorBag: 'newCustomer',
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset(),
                        this.showmodalstate = false;
                },
                onError: () => {
                    if (this.form.errors.name) {
                        this.form.reset('gtitle', 'gtitle')
                        this.$refs.gtitle.focus()
                    }
                    if (this.form.errors.description) {
                        this.form.reset('description', 'description')
                        this.$refs.gdescription.focus()
                    }
                    if (this.form.errors.logo) {
                        this.form.reset('logo', 'logo')
                        this.$refs.intropicture.focus()
                    }

                }
            })
        },
        updateData() {
            this.sform.post(route('updateCustomer'), {
                errorBag: 'updateCustomer',
                preserveScroll: true,
                onSuccess: () => {
                    this.$store.commit("EndSetEditCustomerState");
                    this.sform.reset()
                },
                onError: () => {
                    if (this.form.errors.ename) {
                        this.form.reset('egtitle', 'gtitle')
                        this.$refs.egtitle.focus()
                    }
                    if (this.form.errors.edescription) {
                        this.form.reset('edescription', 'description')
                        this.$refs.egdescription.focus()
                    }
                    if (this.form.errors.elogo) {
                        this.form.reset('elogo', 'elogo')
                        this.$refs.intropicture.focus()
                    }
                }
            })
        },
        deleteCustomer() {
            this.dform.delete(route("deletCustomer", {
                errorBag: 'deletCustomer',
                preserveScroll: true,
                onSuccess: () => {
                    this.dform.reset();
                    this.$store.commit("EndDeleteCustomer");
                },
                onError: () => { }
            }))
        },
        closeEditModal() {
            this.$store.commit("EndSetEditCustomerState");
        },
        closeDeleteModal() {
            this.$store.commit("EndDeleteCustomer");
        }
    },
    watch: {
        eCustomer: function () {
            if (this.eCustomer) {
                this.sform.eid = this.eCustomer.id;
                this.sform.ename = this.eCustomer.name;
                this.sform.edescription = this.eCustomer.description;
            }
        },
        editModalState() {
            this.eshowmodalstate = this.editModalState
        },
        dCustomerid: function () {
            if (this.dCustomerid != null) {
                this.dform.did = this.dCustomerid
            }
        },
        DeleteCustomerModalState: function () {
            this.deleteModalState = this.DeleteCustomerModalState;
        }
    },
    computed: {
        asset() {
            return this.$store.getters.GetAsset
        },
        eCustomer() {
            return this.$store.getters.GetEditedCustomer
        },
        editModalState() {
            return this.$store.getters.editCustomerPopupState
        },
        DeleteCustomerModalState() {
            return this.$store.getters.DeleteCustomerModalState
        },
        dCustomerid() {
            return this.$store.getters.GetIdCustomerToDelete
        }
    }
})
</script>
