<template>
    <div class="flex justify-center items-center space-x-2 mt-6 py-3">
        <button
            @click="changePage(1)"
            :disabled="currentPage === 1"
            class="px-3 py-1 border rounded disabled:opacity-50 enabled:cursor-pointer"
        >
            « First
        </button>

        <button
            @click="changePage(currentPage - 1)"
            :disabled="currentPage === 1"
            class="px-3 py-1 border rounded disabled:opacity-50 enabled:cursor-pointer"
        >
            ‹ Prev
        </button>

        <span class="px-4 text-sm text-gray-700">
            Page {{ currentPage }} of {{ totalPages }}
        </span>

        <button
            @click="changePage(currentPage + 1)"
            :disabled="currentPage === totalPages"
            class="px-3 py-1 border rounded disabled:opacity-50 enabled:cursor-pointer"
        >
            Next ›
        </button>

        <button
            @click="changePage(totalPages)"
            :disabled="currentPage === totalPages"
            class="px-3 py-1 border rounded disabled:opacity-50 enabled:cursor-pointer"
        >
            Last »
        </button>
    </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    modelValue: {
        type: Number,
        required: true
    },
    totalPages: {
        type: Number,
        required: true
    }
})

const emit = defineEmits(['update:modelValue'])

const currentPage = computed(() => props.modelValue)

const changePage = (page) => {
    if (page >= 1 && page <= props.totalPages) {
        emit('update:modelValue', page)
    }
}
</script>
