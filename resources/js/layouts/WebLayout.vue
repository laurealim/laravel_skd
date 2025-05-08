<script setup lang="ts">
import WebContentLayout from '@/layouts/web/WebContentLayout.vue';

const props = defineProps({
    isDashboard: Boolean, // The entire people list (fetched from backend)
    breadcrumbs: {
        type: Array,
        default: () => [],
    },
});

console.log('WebLayout breadcrumbs', props.breadcrumbs);
</script>

<template>
    <div
        id="content_body"
        class="gradient font-sanspro from-gray-700 to-gray-900 leading-normal tracking-normal text-white dark:bg-black dark:bg-linear-to-bl"
    >
        <WebContentLayout :isDashboard="props.isDashboard" :breadcrumbs="props.breadcrumbs">
            <slot />
        </WebContentLayout>
    </div>
</template>

<style scoped></style>
