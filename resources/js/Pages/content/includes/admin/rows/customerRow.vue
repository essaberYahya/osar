<template>
    <tr>
        <td>
            <img :src="asset + item.picture" class="imgRowDef" :alt="item.name" srcset />
        </td>
        <td>
            <jet-input :id="'name' + item.id" type="text" :value="item.name" class="mt-1 block w-full" ref="title" />
        </td>
        <td>
            <jet-input :id="'description' + item.id" type="text" :value="item.description" class="mt-1 block w-full"
                ref="description" />
        </td>
        <td>
            <button v-if="saccess_rigth != null && saccess_rigth.editText"
                class="badge bg-primary rounded-pill mb-3 mt-3" @click="handleEditAction"><span>Edit</span></button>
            <span class="badge bg-orange rounded-pill mb-3  mt-3" v-else><i class="uil uil-minus-circle"></i>Not
                alowed</span>
        </td>
        <td>
            <button v-if="saccess_rigth != null && saccess_rigth.delete" class="badge bg-danger rounded-pill mb-3 mt-3"
                @click="handleDeleteIntro"><span>Delete</span></button>
            <span class="badge bg-orange rounded-pill mb-3 mt-3" v-else><i class="uil uil-minus-circle"></i>Not
                alowed</span>
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
        }
    },
    methods: {
        handleEditAction() {
            this.$store.commit("StartSetEditCustomerState", this.item);
        },
        handleDeleteIntro() {
            this.$store.commit("StartDeleteCustomer", this.item.id);
        }
    }
}
</script>
