<template>
    <tr v-if="!startEditing">
        <td>
            <jet-input :id="'title' + item.id" type="text" v-model="splan.name" class="mt-1 block w-full" ref="name" />
        </td>
        <td>
            <jet-input :id="'title' + item.id" type="text" v-model="splan.description" class="mt-1 block w-full"
                ref="description" />
        </td>
        <td>
            <jet-input :id="'title' + item.id" type="text" v-model="splan.icon" class="mt-1 block w-full" ref="icon" />
        </td>
        <td>
            <jet-input :id="'title' + item.id" type="text" v-model="splan.htmlPart" class="mt-1 block w-full"
                ref="title" />
        </td>
        <td>
            <jet-input :id="'price' + item.id" type="text" v-model="splan.price" class="mt-1 block w-full"
                ref="price" />
        </td>

        <td>
            <button v-if="saccess_rigth != null && saccess_rigth.editText"
                class="badge bg-primary rounded-pill mb-3 mt-3" @click="scwitch">
                <span>Edit</span>
            </button>
            <span class="badge bg-orange rounded-pill mb-3 mt-3" v-else>
                <i class="uil uil-minus-circle"></i>Not alowed
            </span>
        </td>
        <td>
            <span style="cursor: pointer;" v-if="saccess_rigth != null && saccess_rigth.delete"
                class="badge bg-danger rounded-pill mb-3 mt-3" @click="handleDelete">
                <span>Delete</span>
            </span>
            <span class="badge bg-orange rounded-pill mb-3 mt-3" v-else>
                <i class="uil uil-minus-circle"></i>Not alowed
            </span>
        </td>
    </tr>
    <tr v-else>
        <td colspan="7">
            <form @submit.prevent="submit">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <jet-input :id="'title' + item.id" type="text" v-model="splan.name" class="mt-1 block w-full"
                            ref="name" />
                        <jet-input-error :message="splan.errors.name" class="mt-2" />
                    </div>
                    <div class="col-12 col-md-6">
                        <jet-input :id="'title' + item.id" type="text" v-model="splan.icon" class="mt-1 block w-full"
                            ref="name" />
                        <jet-input-error :message="splan.errors.icon" class="mt-2" />
                    </div>
                    <div class="col-12 col-md-6">
                        <jet-input :id="'title' + item.id" type="text" v-model="splan.price" class="mt-1 block w-full"
                            ref="price" />
                        <jet-input-error :message="splan.errors.price" class="mt-2" />
                    </div>
                    <div class="col-12 col-md-6">
                        <jet-input :id="'title' + item.id" type="text" v-model="splan.description"
                            class="mt-1 block w-full" ref="description" />
                        <jet-input-error :message="splan.errors.description" class="mt-2" />
                    </div>
                    <div class="col-12">
                        <textarea rows="5" :id="'title' + item.id" type="text" v-model="splan.htmlPart"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                            ref="htmlPart" />
                        <jet-input-error :message="splan.errors.htmlPart" class="mt-2" />
                    </div>
                    <div class="col-md-4">
                        <button @click="submit" class="btn m-3 btn-primary">Save</button>
                        <button @click="scwitch" class="btn m-3 btn-orange">End editing</button>
                    </div>

                </div>
            </form>
        </td>
    </tr>
</template>
<script>
import JetInput from '@/Jetstream/Input.vue'

export default {
    props: ["item", "asset", "saccess_rigth"],
    components: {
        JetInput
    },
    data() {
        return {
            confirmingUserDeletion: false,
            startEditing: false,
            splan: this.$inertia.form({
                eid: this.item.id,
                price: this.item.price,
                name: this.item.name,
                icon: this.item.icon,
                description: this.item.description,
                htmlPart: this.item.htmlPart,


            })
        }

    },
    methods: {
        handleEditAction() {
            this.$store.commit("StartSetEditedIntro", this.item);
        },
        handleDelete() {
            this.$store.commit("SetPpsDelete", this.item.id);
        },
        submit() {
            this.splan.post(route("updateplan"), {
                onSuccess: () => {
                    this.scwitch();
                    this.splan.rest();
                },
                onError: () => {
                    if (this.splan.errors.name) {
                        this.splan.reset('name', 'name')
                        this.$refs.name.focus()
                    }
                    if (this.splan.errors.icon) {
                        this.splan.reset('icon', 'icon')
                        this.$refs.icon.focus()
                    }
                    if (this.splan.errors.description) {
                        this.splan.reset('description', 'description')
                        this.$refs.description.focus()
                    }
                    if (this.splan.errors.htmlPart) {
                        this.splan.reset('htmlPart', 'HTML part ')
                        this.$refs.htmlPart.focus()
                    }
                    if (this.splan.errors.price) {
                        this.splan.reset('price', 'price')
                        this.$refs.price.focus()
                    }
                }
            })
        },
        scwitch() {
            this.startEditing ? this.startEditing = false : this.startEditing = true;
        }
    },
    watch: {
        TempDeleteObj: function () {
            if (this.TempDeleteObj != null) {
                console.log(this.TempDeleteObj);
                const index = this.item.pps.findIndex(obj => obj.id == this.TempDeleteObj);
                this.item.pps.slice(0, index);
            }
        }
    },
    computed: {
        TempDeleteObj() {
            return this.$store.getters.GetTempDeleteObj
        }
    }

}
</script>
