<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import WebLayout from '@/layouts/WebLayout.vue';
import type { BreadcrumbItem } from '@/types';

const props = defineProps({
    isDashboard: Boolean, // The entire people list (fetched from backend)
});

const breadcrumbs = [
    {
        title: 'Contact Us',
        href: '/contact',
    },
];

</script>

<template>
    <Head title="Contact Us" />
    <WebLayout :isDashboard="props.isDashboard" :breadcrumbs="breadcrumbs">
        <h1>This is Contact Us Page...</h1>
    </WebLayout>
</template>

<style scoped>

</style>
