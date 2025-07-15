<template>
    <div class="flex flex-col sm:flex-row justify-center items-center gap-2 mt-6 py-3">
        <button
            @click="changePage(1)"
            :disabled="currentPage === 1"
            class="px-3 py-1 border rounded disabled:opacity-50 enabled:cursor-pointer w-full sm:w-auto"
        >
            « First
        </button>

        <button
            @click="changePage(currentPage - 1)"
            :disabled="currentPage === 1"
            class="px-3 py-1 border rounded disabled:opacity-50 enabled:cursor-pointer w-full sm:w-auto"
        >
            ‹ Prev
        </button>

        <span class="px-4 text-sm text-gray-700 w-full text-center sm:w-auto sm:text-left">
            <span class="hidden sm:inline">Page {{ currentPage }} of {{ totalPages }}</span>
            <span class="sm:hidden">Pg {{ currentPage }}/{{ totalPages }}</span>
        </span>

        <button
            @click="changePage(currentPage + 1)"
            :disabled="currentPage === totalPages"
            class="px-3 py-1 border rounded disabled:opacity-50 enabled:cursor-pointer w-full sm:w-auto"
        >
            Next ›
        </button>

        <button
            @click="changePage(totalPages)"
            :disabled="currentPage === totalPages"
            class="px-3 py-1 border rounded disabled:opacity-50 enabled:cursor-pointer w-full sm:w-auto"
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
