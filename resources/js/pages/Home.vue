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

            <button
                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-blue-700 cursor-pointer"
                @click="test"
            >
                test
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
                    class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800 cursor-pointer"
                >
                    Search
                </button>
                <button
                    type="button"
                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 cursor-pointer"
                    @click="searchTerm = ''; onSearch()"
                >
                    Clear
                </button>
            </form>
        </div>

        <div v-if="customers.length">
            <customer-card
                v-for="(customer, index) in customers"
                :key="index"
                :customer="customer"
            />
            <pagination
                @update:modelValue="onChangePage"
                :model-value="pagination.currentPage"
                :total-pages="pagination.totalPages"
            />

        </div>
        <div v-else class="text-gray-500 text-center mt-8">
            No customers registered.
        </div>

        <add-customer-modal
            :show="showModal"
            @close="showModal = false"
            @update-list="listCustomers"
        />
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import AddCustomerModal from '../components/AddCustomerModal.vue';
import Pagination from '../components/Pagination.vue';
import CustomerCard from '../components/CustomerCard.vue';
import { getCustomers } from '../service';

const showModal = ref(false);
const searchTerm = ref("");
const customers = ref([]);
const pagination = ref({
    currentPage: 1,
    totalPages: 1
});

const onSearch = () => {
    pagination.value.currentPage = 1;
    listCustomers();
}

const onChangePage = (newPage) => {
    pagination.value.currentPage = newPage;
    listCustomers();
}

function test() {
    console.log(customers.value);
    console.log(pagination.value);
}

const listCustomers = async () => {
    try {
        const params = {
            page: pagination.value.currentPage,
            search: searchTerm.value
        };
        const data = await getCustomers(params);
        customers.value = data.data;
        pagination.value.currentPage = data.meta.current_page;
        pagination.value.totalPages = data.meta.last_page;

    } catch (error) {
        console.error("Error fetching customers:", error);
    }
}

onMounted(() => {
    listCustomers();
});
</script>
