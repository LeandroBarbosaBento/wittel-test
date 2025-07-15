<template>
    <div class="relative">
        <div class="bg-white rounded shadow-md border border-gray-200 my-8 p-4 flex justify-between items-center" >
            <div>
                <p class="font-semibold">{{ customer.name }}</p>
                <p class="text-sm text-gray-600">CPF: {{ customer.cpf }}</p>
            </div>
            <span
                class="min-w-20 p-1 font-semibold rounded-md flex items-center justify-center text-center text-sm"
                :class="customerClass"
            >
                {{
                    customer.household_income.toLocaleString('pt-BR',{
                        style: 'currency',
                        currency: 'BRL'
                    })
                }}
            </span>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    customer: {
        type: Object,
        required: true
    },
});

const emit = defineEmits(['update:modelValue']);

const customerClass = computed(() => {
    if(props.customer.household_income <= 980) {
        return 'text-green-600 bg-green-200';
    } else if (props.customer.household_income <= 2500) {
        return 'text-yellow-600 bg-yellow-200';
    } else {
        return 'text-red-600 bg-red-200';
    }
});

</script>
