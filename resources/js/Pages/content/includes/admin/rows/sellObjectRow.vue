<template>
    <tr :class="selected ? 'selected' : ''">
        <td>
            <img :src="asset + item.pictureCover" class="imgRowDef" :alt="item.title" srcset />
        </td>
        <td>
            <jet-input :id="'title' + item.id" type="text" :value="item.title" class="mt-1 block w-full" ref="title" />
        </td>
        <td>
            <span class="badge bg-success rounded-pill mb-3 mt-3"><i class="uil uil-clock-two"></i>{{ item.category.name
                }}</span>
        </td>

        <td>
            <span v-if="item.startAt != null" class="badge bg-warning rounded-pill mb-3 mt-3"><i
                    class="uil uil-clock-two"></i>{{ item.startAt
                }}</span>
            <span v-else class="badge bg-warning rounded-pill mb-3 mt-3"><i class="uil uil-clock-two"></i>open</span>
        </td>
        <td>
            <span v-if="item.EndDate != null" class="badge bg-primary rounded-pill mb-3 mt-3"><i
                    class="uil uil-clock-two"></i>{{ item.EndDate
                }}</span>
            <span v-else class="badge bg-primary rounded-pill mb-3 mt-3"><i class="uil uil-clock-two"></i>open</span>
        </td>
        <td>
            <button v-if="saccess_rigth != null && saccess_rigth.editText"
                class="badge bg-primary rounded-pill mb-3 mt-3" @click="handleEditAction">
                <span>Edit</span>
            </button>
            <span class="badge bg-orange rounded-pill mb-3 mt-3" v-else><i class="uil uil-minus-circle"></i>Not
                alowed</span>
        </td>
        <td>
            <button v-if="saccess_rigth != null && saccess_rigth.delete" class="badge bg-danger rounded-pill mb-3 mt-3"
                @click="handleDelete">
                <span>Delete</span>
            </button>
            <span class="badge bg-orange rounded-pill mb-3 mt-3" v-else><i class="uil uil-minus-circle"></i>Not
                alowed</span>
        </td>
    </tr>
</template>
<script>
import JetInput from "@/Jetstream/Input.vue";

export default {
    props: ["item", "asset", "saccess_rigth", "selected"],
    components: {
        JetInput,
    },
    data() {
        return {
            confirmingUserDeletion: false,
        };
    },
    created() { },
    methods: {
        handleEditAction() {
            this.$store.commit("startEditObjectState", this.item);
        },
        handleDelete() {
            this.$store.commit("SetProjectObjIdToDelete", this.item.id);
        },
        pricingHandling() {
            this.$store.commit("SetPps", this.item);
        },
    },
};
</script>
<style scoped>
tr.selected {
    background: #cbe0e7;
}
</style>
