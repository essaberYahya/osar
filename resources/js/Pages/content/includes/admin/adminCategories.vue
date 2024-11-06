<template>
    <div class="container">
        <button class="btn btn-xs btn-primary mt-3 mb-3" @click="NewCategoryModal(true)"
            v-if="access_right != null && access_right.write">
            <i class="uil uil-pen mr-2"></i> Create new category
        </button>
        <span class="badge bg-orange rounded-pill mb-3" v-else>
            <i class="uil uil-minus-circle mr-2"></i>Not alowed to add service
        </span>
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
                    <categorymanagementrowVue :access_right="access_right" v-for="category in categories"
                        :key="category.id" :item="category"></categorymanagementrowVue>
                </tbody>
            </div>
        </div>
        <!-- popup for new services -->
        <jet-dialog-modal v-if="access_right != null && access_right.write" :show="NewCategoryModalState">
            <template #content>
                <jet-form-section @submitted="createNewCategory">
                    <template #form>
                        <div class="row">
                            <div class="mt-3">
                                <jet-label for="name" value="General name" />
                                <jet-input id="name" v-model="form.name" type="text" class="mt-1 block w-full"
                                    ref="title" autocomplete="true" placeholder="General name" />
                                <jet-input-error :message="form.errors.name" class="mt-2" />
                            </div>
                            <div class="mt-3">
                                <jet-label for="description" value="Service descriptions" />
                                <textarea id="description" v-model="form.description" type="text"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                    rows="5" ref="description" autocomplete="true" />
                                <jet-input-error :message="form.errors.description" class="mt-2" />
                            </div>
                            <div class="mt-3">
                                <jet-label for="icon" value="General icon" />
                                <jet-input id="icon" v-model="form.icon" type="text" class="mt-1 block w-full"
                                    ref="icon" autocomplete="true" placeholder="UI-UX Icon name" />
                                <jet-input-error :message="form.errors.icon" class="mt-2" />
                            </div>
                            <div class="mt-3">
                                <jet-label for="color" value="General Color" />
                                <jet-input id="color" v-model="form.color" type="text" class="mt-1 block w-full"
                                    ref="color" autocomplete="true" placeholder="General color" />
                                <jet-input-error :message="form.errors.color" class="mt-2" />
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
                <jet-secondary-button @click="NewCategoryModal(false)">Cancel</jet-secondary-button>
            </template>
        </jet-dialog-modal>
        <!-- pop up update category -->
        <jet-dialog-modal v-if="access_right != null && access_right.editText" :show="UpdateCategoryModalState">
            <template #content>
                <jet-form-section @submitted="UpdateOldCategory">
                    <template #form>
                        <div class="row">
                            <div class="mt-3">
                                <jet-label for="ename" value="General Title" />
                                <jet-input id="ename" v-model="eform.ename" type="text" class="mt-1 block w-full"
                                    ref="ename" autocomplete="true" placeholder="General Title" />
                                <jet-input-error :message="eform.errors.ename" class="mt-2" />
                            </div>
                            <div class="mt-3">
                                <jet-label for="edescription" value="Service descriptions" />
                                <textarea id="edescription" v-model="eform.edescription" type="text"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                    rows="5" ref="edescription" autocomplete="true" />
                                <jet-input-error :message="eform.errors.edescription" class="mt-2" />
                            </div>
                            <div class="mt-3">
                                <jet-label for="eicon" value="General icon" />
                                <jet-input id="eicon" v-model="eform.eicon" type="text" class="mt-1 block w-full"
                                    ref="eicon" autocomplete="true" placeholder="UI-UX Icon name" />
                                <jet-input-error :message="eform.errors.eicon" class="mt-2" />
                            </div>
                            <div class="mt-3">
                                <jet-label for="ecolor" value="General Color" />
                                <jet-input id="ecolor" v-model="eform.ecolor" type="text" class="mt-1 block w-full"
                                    ref="ecolor" autocomplete="true" placeholder="General color" />
                                <jet-input-error :message="eform.errors.ecolor" class="mt-2" />
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
        <!-- pop up delete category -->
        <jet-dialog-modal v-if="access_right != null && access_right.delete" :show="cDeleteCategoryModalState">
            <template #content>
                <jet-form-section @submitted="deleteCategory">
                    <template #form>
                        Are you sure you want to delete this category?
                        <br />Please to confirm you would like to permanently delete your account.
                        <div class="alert alert-warning mt-3">
                            <i class="uil uil-exclamation-triangle mr-2"></i> All related project and post will
                            automaticly deleted !
                        </div>
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
import JetDialogModal from '@/Jetstream/DialogModal.vue'
import JetActionMessage from '@/Jetstream/ActionMessage.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetFormSection from '@/Jetstream/FormSection.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import inputFileVue from '../../../../Jetstream/inputFile.vue'
import categorymanagementrowVue from './rows/categorymanagementrow.vue'




export default defineComponent({

    props: ["categories", "access_right"],
    components: {
        AppLayout,
        JetInputError,
        JetButton,
        JetActionMessage,
        JetLabel,
        Welcome,
        JetInput,
        JetDialogModal,
        JetFormSection,
        JetSecondaryButton,
        inputFileVue,
        categorymanagementrowVue
    },
    data() {
        return {
            NewCategoryModalState: false,
            UpdateCategoryModalState: false,
            cDeleteCategoryModalState: false,
            form: this.$inertia.form({
                icon: '',
                name: '',
                description: '',
                color: null,
            }),
            eform: this.$inertia.form({
                eicon: '',
                ename: '',
                edescription: '',
                ecolor: null,
                eid: null
            }),
            dform: this.$inertia.form({
                did: null
            })
        }
    },
    methods: {
        NewCategoryModal(state) {
            this.NewCategoryModalState = state;
        },
        UpdateCategoryModal(state) {
            this.UpdateCategoryModalState = state;
        },
        createNewCategory() {
            this.form.post(route("newCategory", {
                errorBag: 'newCategory',
                preserveScroll: true,
                onSuccess: () => {
                    this.NewCategoryModal(false);
                },
                onerror: () => {

                }
            }))
        },
        UpdateOldCategory() {
            this.eform.post(route("updateCategory", {
                errorBag: 'updateCategory',
                preserveScroll: true,
                onSuccess: () => {
                    this.$store.commit("EndSetEditCategoryState");
                },
                onerror: () => {

                }
            }))
        },
        deleteCategory() {
            this.dform.delete(route('deletCategory'), {
                onSuccess: () => {
                    this.closeDeleteModal();
                },
                onerror: () => {

                }
            })
        },
        closeEditModal() {
            this.$store.commit("EndSetEditCategoryState");
        },
        closeDeleteModal() {
            this.$store.commit("EndDeleteCategory");
        }
    },
    watch: {
        editPopUpState: function () {
            this.UpdateCategoryModal(this.editPopUpState)
        },
        editedCategory: function () {
            this.eform.ename = this.editedCategory.name;
            this.eform.ecolor = this.editedCategory.color;
            this.eform.eicon = this.editedCategory.icon;
            this.eform.edescription = this.editedCategory.description;
            this.eform.eid = this.editedCategory.id;
        },
        DeleteCategoryModalState: function () {
            this.cDeleteCategoryModalState = this.DeleteCategoryModalState
        },
        dCategoryid: function () {
            this.dform.did = this.dCategoryid
        }
    },
    computed: {
        editPopUpState() {
            return this.$store.getters.editCategoryPopupState
        },
        editedCategory() {
            return this.$store.getters.editedCategory
        },
        DeleteCategoryModalState() {
            return this.$store.getters.DeleteCategoryModalState
        },
        dCategoryid() {
            return this.$store.getters.GetIdCategoryToDelete
        }
    }
})
</script>
