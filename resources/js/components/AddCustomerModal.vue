<template>
    <div
      v-if="show"
      class="fixed inset-1 flex justify-center items-center"
    >
        <Loader v-if="isLoading" />
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
        <notification
            v-if="notification.message"
            :type="notification.type"
            :message="notification.message"
            @close="resetForm"
        />
    </div>
</template>
<script setup>
import { ref } from 'vue';
import { storeCustomer } from '../services';
import Notification from './Notification.vue';
import Loader from './Loader.vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false
    }
});
const emit = defineEmits(['close']);
const notification = ref({
    type: "",
    message: ""
})
const isLoading = ref(false);

const form = ref({
    name: '',
    cpf: '',
    birthDate: '',
    householdIncome: 0
})

const addCustomer = async () => {
    const newCustomer = {
        name: form.value.name,
        cpf: form.value.cpf,
        birth_date: form.value.birthDate,
        household_income: form.value.householdIncome,
    }

    try {
        isLoading.value = true;
        const data = await storeCustomer(newCustomer);
        console.log("Customer added:", data);
        resetForm();
        notification.value = {
            type: 'success',
            message: 'Customer added successfully!'
        };
        emit('update-list');
    } catch (error) {
        console.error('Error adding customer:', error);
        console.log(error);
        console.log(error.response.data.message);

        notification.value = {
            type: 'error',
            message: error.response.data.message || 'Failed to add customer.'
        };
    } finally {
        isLoading.value = false;
    }
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
