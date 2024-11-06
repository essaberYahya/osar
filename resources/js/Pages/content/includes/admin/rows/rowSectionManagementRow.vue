<template>
    <tr>
        <td>
            <img :src="asset + item.picture" class="imgRowDef" :alt="item.title" srcset />
        </td>
        <td>
            <jet-input :id="'title' + item.id" type="text" :value="item.title" class="mt-1 block w-full" ref="title" />
        </td>
        <td>
            <jet-input :id="'description' + item.id" type="text" :value="item.description" class="mt-1 block w-full"
                ref="description" />
        </td>
        <td>
            <jet-input :id="'htmlPart' + item.id" type="text" :value="item.htmlPart" class="mt-1 block w-full"
                ref="htmlPart" />
        </td>
        <td>
            <span class="badge bg-blue rounded-pill mt-3" v-if="item.leftToRight">Normal</span>
            <span class="badge bg-leaf rounded-pill mt-3" v-else>Reverse</span>
        </td>
        <td>
            <button v-if="saccess_rigth != null && saccess_rigth.editText"
                class="badge bg-primary rounded-pill mb-3 mt-3" @click="handleEditAction"> <span>Edit</span></button>
            <span class="badge bg-orange rounded-pill mb-3  mt-3" v-else> <i class="uil uil-minus-circle"></i> Not
                alowed</span>
        </td>
        <td>
            <button v-if="saccess_rigth != null && saccess_rigth.delete" class="badge bg-danger rounded-pill mb-3 mt-3"
                @click="handleDeleteRowSection"><span>Delete</span></button>
            <span class="badge bg-orange rounded-pill mb-3  mt-3" v-else><i class="uil uil-minus-circle"></i> Not
                alowed</span>
        </td>
    </tr>
</template>
<script>
import JetInput from '@/Jetstream/Input.vue'
import CheckboxVue from '../../../../../Jetstream/Checkbox.vue'

export default {
    props: ["item", "asset", "saccess_rigth"],
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
            this.$store.commit("StartSetEditrowsectionState", this.item);
        },
        handleDeleteRowSection() {
            this.$store.commit("StartDeleterowsection", this.item.id);
        }
    }
}
</script>
