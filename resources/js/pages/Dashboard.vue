<template>
    <div>
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-8 border-b border-gray-200 py-4 gap-2">
            <h1 class="text-3xl font-bold text-center sm:text-left">Dashboard </h1>
            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto text-xl text-center font-semibold">
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

        <button
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 cursor-pointer w-full sm:w-auto"
            @click="getData"
        >
            GetData
        </button>

    </div>
</template>
<script setup>
import { ref, watch } from "vue";
import { getReport } from '../services';

const selectedPeriod = ref("all");

watch(selectedPeriod, (newVal) => {
    getData();
});

const getData = async () => {
    try {
        const data = await getReport(selectedPeriod.value);
        console.log(data);
    } catch (error) {
        console.error(error);
    }
}
</script>
