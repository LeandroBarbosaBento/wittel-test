<template>
    <div class="bg-white rounded-lg shadow p-4 flex justify-between items-center border border-gray-100 w-full sm:w-64">
        <slot>
            <div>
                <p :class="`text-sm text-${color} pl-4 border-l-3 border-${color} font-semibold`">
                    {{ text }}
                </p>
                <p :class="`text-3xl text-${color} font-bold p-3`">
                    {{ number }}
                </p>
            </div>
        </slot>
    </div>
</template>
<script setup>
const props = defineProps({
    text: {
        type: String,
        required: false,
    },
    number: {
        type: [ String, Number],
        required: false,
    },
    color: {
        type: String,
        default: 'gray-400'
    }
})

</script>

