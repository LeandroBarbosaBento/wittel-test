<template>
    <transition name="fade">
        <div
            v-if="visible"
            class="fixed top-4 right-4 min-w-[300px] px-4 py-4 rounded-lg shadow-xl text-white z-50"
            :class="[typeClass]"
        >
            {{ message }}
        </div>
    </transition>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';

const props = defineProps({
    type: {
        type: String,
        default: 'success',
        validator: v => ['error', 'warning', 'success'].includes(v)
    },
    message: {
        type: String,
        required: true
    },
    duration: {
        type: Number,
        default: 300000 // ms
    }
});

const visible = ref(true);

const typeClass = {
    success: 'bg-green-600',
    error: 'bg-red-600',
    warning: 'bg-yellow-500 text-black'
}[props.type];

onMounted(() => {
    setTimeout(() => visible.value = false, props.duration);
});

watch(() => props.message, () => {
    visible.value = true;
    setTimeout(() => visible.value = false, props.duration);
});
</script>

<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>
