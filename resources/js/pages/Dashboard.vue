<template>
    <div>
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-8 border-b border-gray-200 py-4 gap-2">
            <h1 class="text-3xl font-bold text-center sm:text-left">Dashboard </h1>
            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto text-sm text-center font-semibold">
                <span
                    :class="{
                        'border-b-3 border-orange-500 text-orange-500' : selectedPeriod === 'all'
                    }"
                    @click="selectedPeriod = 'all'"
                >
                    all
                </span>
                <span
                    :class="{
                        'border-b-3 border-orange-500 text-orange-500' : selectedPeriod === 'today'
                    }"
                    @click="selectedPeriod = 'today'"
                >
                    today
                </span>
                <span
                    :class="{
                        'border-b-3 border-orange-500 text-orange-500' : selectedPeriod === 'week'
                    }"
                    @click="selectedPeriod = 'week'"
                >
                    week
                </span>
                <span
                    :class="{
                        'border-b-3 border-orange-500 text-orange-500' : selectedPeriod === 'month'
                    }"
                    @click="selectedPeriod = 'month'"
                >
                    month
                </span>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-5 w-full">

            <report-card
                text="Average household income"
                :number="avgIncome"
                color="orange-500"
            />

            <report-card
                text="Adults with income over average"
                :number="countCustomersOverAvgIncome"
            />

            <report-card>
                <div class="flex flex-col">
                    <div class="flex items-center justify-between mb-2 w-full">
                        <div class="flex items-center">
                            <span class="w-3 h-3 rounded-full bg-red-500 mr-2"></span>
                            <span class="text-sm text-gray-700 mr-1">Class A: </span>
                        </div>
                        <span class="text-sm font-medium text-gray-800">
                            {{ countClassACustomers }} customers
                        </span>
                    </div>

                    <div class="flex items-center justify-between mb-2 w-full">
                        <div class="flex items-center">
                            <span class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></span>
                            <span class="text-sm text-gray-700 mr-1">Class B: </span>
                        </div>
                        <span class="text-sm font-medium text-gray-800">
                            {{ countClassBCustomers }} customers
                        </span>
                    </div>

                    <div class="flex items-center justify-between w-full">
                        <div class="flex items-center">
                            <span class="w-3 h-3 rounded-full bg-green-500 mr-2"></span>
                            <span class="text-sm text-gray-700 mr-1">Class C: </span>
                        </div>
                        <span class="text-sm font-medium text-gray-800">
                            {{ countClassCCustomers }} customers
                        </span>
                    </div>
                </div>
            </report-card>

        </div>
    </div>
</template>
<script setup>
import { ref, watch } from "vue";
import { getReport } from '../services';
import ReportCard from "../components/ReportCard.vue";

const selectedPeriod = ref("all");

const avgIncome = ref(0);
const countCustomersOverAvgIncome = ref(0);
const countClassACustomers = ref(0);
const countClassBCustomers = ref(0);
const countClassCCustomers = ref(0);

const getData = async () => {
    try {
        const data = await getReport(selectedPeriod.value);
        countCustomersOverAvgIncome.value = data.adults_above_avg_income;
        avgIncome.value = data.avg_income;
        countClassACustomers.value = data.class_A;
        countClassBCustomers.value = data.class_B;
        countClassCCustomers.value = data.class_C;

    } catch (error) {
        console.error(error);
    }
}

watch(selectedPeriod, () => {
    getData();
}, { immediate: true });

</script>
