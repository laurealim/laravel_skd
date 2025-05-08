<script setup lang="ts">
import { SidebarInset } from '@/components/ui/sidebar';
import WebHeader from '@/components/web/WebHeader.vue';

const props = defineProps({
    isDashboard: Boolean,
    breadcrumbs: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <WebHeader v-if="props.isDashboard">
        <slot />
    </WebHeader>
   <!-- <main v-else class="mx-auto flex h-full w-full max-w-7xl flex-1 flex-col gap-4 rounded-xl"> -->
        <slot />
   <!-- </main> -->
</template>

<style scoped></style>
