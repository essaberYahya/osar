<template>
    <tr>
        <td>
            <img :src="asset + item.cover" class="imgRowDef" :alt="item.title" srcset />
        </td>
        <td>
            <jet-input :id="'title' + item.id" type="text" :value="item.title" class="mt-1 block w-full" ref="title" />
        </td>
        <td>
            <jet-input :id="'description' + item.id" type="text" :value="item.description" class="mt-1 block w-full"
                ref="description" />
        </td>
        <td>
            <jet-input :id="'htmlPart' + item.id" type="text" :value="item.category.name" class="mt-1 block w-full"
                ref="htmlPart" />
        </td>
        <td>
            <jet-input :id="'htmlPart' + item.id" type="text" :value="item.htmlPart" class="mt-1 block w-full"
                ref="htmlPart" />
        </td>
        <td>
            <CheckboxVue :id="'htmlPart' + item.id" v-model="item.hidden" class="mt-1 block w-full" ref="htmlPart" />
        </td>
        <td>
            <button v-if="access_right != null && access_right.editText" class="badge bg-primary rounded-pill mb-3 mt-3"
                @click="handleEditAction">
                <span>Edit</span>
            </button>
            <span v-else class="badge bg-orange rounded-pill mb-3 mt-3">
                <i class="uil uil-minus-circle"></i>Not alowed
            </span>
        </td>
        <td>
            <button v-if="access_right != null && access_right.delete" class="badge bg-danger rounded-pill mb-3 mt-3"
                @click="handleDeleteProject">
                <span>Delete</span>
            </button>
            <span v-else class="badge bg-orange rounded-pill mb-3 mt-3">
                <i class="uil uil-minus-circle"></i>Not alowed
            </span>
        </td>
    </tr>
</template>
<script>
import JetInput from '@/Jetstream/Input.vue'
import CheckboxVue from '../../../../../Jetstream/Checkbox.vue'

export default {
    props: ["item", "asset", "access_right"],
    components: {
        JetInput,

    },
    data() {
        return {
            confirmingUserDeletion: false,
        }
    },
    methods: {
        handleEditAction() {
            this.$store.commit("StartSetEditProjectState", this.item);
        },
        handleDeleteProject() {
            this.$store.commit("StartDeleteProject", this.item.id);
        }
    }
}
</script>
