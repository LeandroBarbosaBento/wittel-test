<template>
    <div
      v-if="show"
      class="fixed inset-1 flex justify-center items-center"
    >
        <div class="bg-white rounded-lg shadow-2xl p-6 w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Add Customer</h2>
            <form @submit.prevent="addCustomer">
                <div class="mb-4">
                    <label class="block mb-1">Name</label>
                    <input
                    v-model="form.name"
                    type="text"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                    required
                    />
                </div>
                <div class="mb-4">
                    <label class="block mb-1">CPF</label>
                    <input
                    v-model="form.cpf"
                    type="text"
                    maxlength="11"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                    required
                    />
                </div>
                <div class="mb-4">
                    <label class="block mb-1">Birth Date</label>
                    <input
                    v-model="form.birthDate"
                    type="date"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                    required
                    />
                </div>
                <div class="mb-4">
                    <label class="block mb-1">Household Income</label>
                    <input
                    v-model="form.householdIncome"
                    type="number"
                    min="0"
                    step="0.01"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                    />
                </div>

                <div class="flex justify-end gap-2">
                    <button
                    type="button"
                    class="px-4 py-2 rounded border"
                    @click="resetForm"
                    >
                    Cancel
                    </button>
                    <button
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                    >
                    Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
const props = defineProps({
    show: {
        type: Boolean,
        default: false
    }
});
const emit = defineEmits(['close']);

const form = ref({
    name: '',
    cpf: '',
    birthDate: '',
    householdIncome: ''
})

const addCustomer = () => {
    const newCustomer = {
        name: form.value.name,
        cpf: form.value.cpf,
        birthDate: form.value.birthDate,
        householdIncome: form.value.householdIncome,
        registeredAt: new Date().toLocaleDateString()
    }
    customers.value.push(newCustomer)
    resetForm()
}

const resetForm = () => {
    form.value = {
        name: '',
        cpf: '',
        birthDate: '',
        householdIncome: ''
    }
    emit("close")
}

</script>
