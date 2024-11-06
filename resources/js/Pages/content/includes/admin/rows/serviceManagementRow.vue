<template>
    <tr>
        <td>
            <img :src="asset + item.icon" class="imgRowDef" :alt="item.title" srcset />
        </td>
        <td>
            <jet-input :id="'title' + item.id" type="text" :value="item.color" class="mt-1 block w-full" ref="title" />
        </td>
        <td>
            <jet-input :id="'title' + item.id" type="text" :value="item.title" class="mt-1 block w-full"
                ref="description" />
        </td>
        <td>
            <jet-input :id="'description' + item.id" type="text" :value="item.description" class="mt-1 block w-full"
                ref="htmlPart" />
        </td>
        <td>
            <button v-if="access_right != null && access_right.editText" class="badge bg-primary rounded-pill mb-3 mt-3"
                @click="handleEditAction">
                <span>Edit</span>
            </button>
            <span v-else class="badge bg-orange rounded-pill mb-3  mt-3"><i class="uil uil-minus-circle"></i>Not
                alowed</span>
        </td>
        <td>
            <button v-if="access_right != null && access_right.delete" class="badge bg-danger rounded-pill mb-3 mt-3"
                @click="handleDeleteService">
                <span>Delete</span>
            </button>
            <span v-else class="badge bg-orange rounded-pill mb-3  mt-3"><i class="uil uil-minus-circle"></i>Not
                alowed</span>
        </td>
    </tr>
</template>
<script>
import JetInput from '@/Jetstream/Input.vue'

export default {
    props: ["item", "asset", "access_right"],
    components: {
        JetInput
    },
    data() {
        return {
            confirmingUserDeletion: false,
        }
    },
    methods: {
        handleEditAction() {
            this.$store.commit("StartSetEditServiceState", this.item);
        },
        handleDeleteService() {
            this.$store.commit("StartDeleteService", this.item.id);
        }
    }
}
</script>
