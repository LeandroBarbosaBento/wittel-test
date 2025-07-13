<template>
    <div class="max-w-6xl mx-auto p-6 mt-5">
        <div class="flex justify-between items-center mb-8 border-b border-gray-200 py-4">
            <h1 class="text-3xl font-bold">Customers</h1>
            <button
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 cursor-pointer"
                @click="showModal = true"
            >
                + Add Customer
            </button>
        </div>

        <div class="mb-6">
            <form @submit.prevent="onSearch" class="flex gap-2 justify-end my-3">
                <input
                    v-model="searchTerm"
                    type="text"
                    placeholder="Search by name..."
                    class="flex-1 border border-gray-300 px-3 py-2 rounded max-w-1/4"
                />
                <button
                    type="submit"
                    class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800"
                >
                    Search
                </button>
            </form>
        </div>

        <div v-if="customers.length" class="bg-white rounded shadow divide-y p-2">
            <div
                v-for="(customer, index) in customers"
                :key="index"
                class="p-4 flex justify-between items-center"
            >
                <div>
                    <p class="font-semibold">{{ customer.name }}</p>
                    <p class="text-sm text-gray-600">CPF: {{ customer.cpf }}</p>
                </div>
                <div class="text-sm text-gray-500">
                    Registered: {{ customer.registeredAt }}
                </div>
            </div>
            <Pagination
                @update:modelValue="onChangePage"
                :model-value="1"
                :total-pages="10"
            />

        </div>
        <div v-else class="text-gray-500 text-center mt-8">
            No customers registered.
        </div>

        <Modal
            :show="showModal"
            @close="showModal = false"
        />
    </div>
</template>

<script setup>
import { ref } from 'vue';
import Modal from '../components/Modal.vue';
import Pagination from '../components/Pagination.vue';

const showModal = ref(false);
const searchTerm = ref("");
const customers = ref([
    {
        name: "Nome do cliente",
        cpf: "123456",
        registeredAt: "10/06/2025"
    },
    {
        name: "Nome do cliente",
        cpf: "123456",
        registeredAt: "10/06/2025"
    },
    {
        name: "Nome do cliente",
        cpf: "123456",
        registeredAt: "10/06/2025"
    },
    {
        name: "Nome do cliente",
        cpf: "123456",
        registeredAt: "10/06/2025"
    }
]);

const onSearch = () => {
    console.log("onSearch");
    console.log(searchTerm.value);
}

const onChangePage = (newPage) => {
    console.log("onChangePage");
    console.log(newPage);
}
</script>
