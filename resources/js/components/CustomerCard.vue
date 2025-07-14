<template>
    <div class="relative">


        <div class="bg-white rounded shadow-md border border-gray-200 my-8 p-4 flex justify-between items-center" >
            <div>
                <p class="font-semibold">{{ customer.name }}</p>
                <p class="text-sm text-gray-600">CPF: {{ customer.cpf }}</p>
            </div>
            <span
                class="p-1 bg-blue-100 text-blue-800 font-bold rounded-md flex items-center justify-center text-center text-sm"
                :class="customerClass"
            >
                {{ customer.household_income.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }) }}
            </span>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    customer: {
        type: Object,
        required: true
    },
})

const emit = defineEmits(['update:modelValue']);

const currentPage = computed(() => props.modelValue);

const changePage = (page) => {
    emit('update:modelValue', page);
}

const customerClass = computed(() => {
    if(props.customer.household_income <= 980) {
        return 'text-green-600 bg-green-200';
    } else if (props.customer.household_income <= 2500) {
        return 'text-yellow-600 bg-yellow-200';
    } else {
        return 'text-red-600 bg-red-200';
    }
})

</script>
