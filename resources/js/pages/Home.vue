<template>
    <div class="max-w-6xl mx-auto px-6">
        <Loader v-if="isLoading" />
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-8 border-b border-gray-200 py-4 gap-2">
            <h1 class="text-3xl font-bold text-center sm:text-left">Customers</h1>
            <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                <button
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 cursor-pointer w-full sm:w-auto"
                    @click="showModal = true"
                >
                    + Add Customer
                </button>
            </div>
        </div>

        <div class="mb-6">
            <form
                @submit.prevent="onSearch"
                class="flex flex-col sm:flex-row gap-2 justify-end my-3 p-2 sm:p-0"
            >
                <input
                    v-model="searchTerm"
                    type="text"
                    placeholder="Search by name..."
                    class="border border-gray-300 px-3 py-2 rounded w-full sm:w-1/4"
                />
                <div class="flex gap-2">
                    <button
                        type="submit"
                        class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800 cursor-pointer w-full sm:w-auto"
                    >
                        Search
                    </button>
                    <button
                        type="button"
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 cursor-pointer w-full sm:w-auto"
                        @click="searchTerm = ''; onSearch()"
                    >
                        Clear
                    </button>
                </div>
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
import { getCustomers } from '../services';
import Loader from "../components/Loader.vue";

const showModal = ref(false);
const searchTerm = ref(null);
const customers = ref([]);
const pagination = ref({
    currentPage: 1,
    totalPages: 1
});
const isLoading = ref(false);

const onSearch = () => {
    pagination.value.currentPage = 1;
    if(!searchTerm.value) searchTerm.value = null;
    listCustomers();
}

const onChangePage = (newPage) => {
    pagination.value.currentPage = newPage;
    listCustomers();
}

const listCustomers = async () => {
    try {
        isLoading.value = true;
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
    } finally {
        isLoading.value = false;
    }
}

onMounted(() => {
    listCustomers();
});
</script>
