<template>
    <div>
        <jet-form-section @submitted="updatePlatformInformation">
            <template #title>Platform informations</template>

            <template #description>Update your platform information and email address.</template>

            <template #form>
                <!-- Name -->
                <div class="row">
                    <div class="col-12 col-md-6 mt-2 sm:col-span-4">
                        <jet-label icon="uil uil-facebook-f" for="facebook" value="facebook" />
                        <jet-input id="facebook" type="text" class="mt-1 block w-full" v-model="form.facebook"
                            autocomplete="name" />
                        <jet-input-error :message="form.errors.facebook" class="mt-2" />
                    </div>

                    <div class="col-12 col-md-6 mt-2 ">
                        <jet-label icon="uil uil-instagram" for="instagram" value="instagram" />
                        <jet-input id="instagram" type="text" class="mt-1 block w-full" v-model="form.instagram"
                            autocomplete="instagram" />
                        <jet-input-error :message="form.errors.instagram" class="mt-2" />
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                        <jet-label icon="uil uil-twitter" for="twitter" value="twitter" />
                        <jet-input id="twitter" type="text" class="mt-1 block w-full" v-model="form.twitter"
                            autocomplete="twitter" />
                        <jet-input-error :message="form.errors.twitter" class="mt-2" />
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                        <jet-label icon="uil uil-phone-alt" for="phone" value="phone" />
                        <jet-input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone"
                            autocomplete="phone" />
                        <jet-input-error :message="form.errors.phone" class="mt-2" />
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                        <jet-label icon="uil uil-phone-volume" for="fix" value="fix" />
                        <jet-input id="fix" type="text" class="mt-1 block w-full" v-model="form.fix"
                            autocomplete="fix" />
                        <jet-input-error :message="form.errors.fix" class="mt-2" />
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                        <jet-label icon="uil uil-map-marker-edit" for="adress" value="adress" />
                        <jet-input id="adress" type="text" class="mt-1 block w-full" v-model="form.adress"
                            autocomplete="adress" />
                        <jet-input-error :message="form.errors.adress" class="mt-2" />
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                        <jet-label icon="uil uil-envelope" for="whatsapp" value="whatsapp" />
                        <jet-input id="whatsapp" type="text" class="mt-1 block w-full" v-model="form.whatsapp"
                            autocomplete="whatsapp" />
                        <jet-input-error :message="form.errors.whatsapp" class="mt-2" />
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                        <jet-label icon="uil uil-envelope" for="email" value="email" />
                        <jet-input id="email" type="text" class="mt-1 block w-full" v-model="form.email"
                            autocomplete="email" />
                        <jet-input-error :message="form.errors.email" class="mt-2" />
                    </div>
                    <div class="col-12 mt-2">
                        <jet-label icon="uil uil-presentation-minus" for="content" value="content" />
                        <textarea
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                            rows="5" id="content" type="text" v-model="form.content" autocomplete="content" />
                        <jet-input-error :message="form.errors.content" class="mt-2" />
                    </div>
                </div>
            </template>

            <template #actions>
                <jet-action-message :on="form.recentlySuccessful" class="mr-3">Saved.</jet-action-message>

                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</jet-button>
            </template>
        </jet-form-section>
    </div>
</template>
<script>
import { defineComponent } from 'vue'
import JetButton from '@/Jetstream/Button.vue'
import JetFormSection from '@/Jetstream/FormSection.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetActionMessage from '@/Jetstream/ActionMessage.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'

export default defineComponent({
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
    },

    props: ['setting'],

    data() {
        return {
            set: this.setting,
            form: this.$inertia.form({
                facebook: null,
                whatsapp: null,
                instagram: null,
                twitter: null,
                phone: null,
                fix: null,
                adress: null,
                email: null,
                content: null,
                id: null,
                isnew: false
            }),

            photoPreview: null,
        }
    },
    created() {
        this.init();
    },
    methods: {
        updatePlatformInformation() {
            this.form.post(route('updateSettings', {
                onSuccess: () => {

                },
                onError: () => {

                }
            }))
        },
        init() {
            if (this.setting != null) {
                this.form.facebook = this.setting.facebook;
                this.form.whatsapp = this.setting.whatsapp
                this.form.instagram = this.setting.instagram
                this.form.twitter = this.setting.twitter
                this.form.phone = this.setting.phone
                this.form.fix = this.setting.fix
                this.form.adress = this.setting.adress
                this.form.email = this.setting.email
                this.form.content = this.setting.content
                this.form.isnew = false;
                this.form.id = this.setting.id
            } else {
                this.form.isnew = true;
            }
        }
    },
    watch: {
        set: function () {
            this.form.facebook = this.setting.facebook;
        }
    }
})
</script>
