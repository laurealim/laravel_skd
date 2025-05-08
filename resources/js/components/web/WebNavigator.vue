<script setup lang="ts">
import WebBreadcrumbs from '@/components/web/WebBreadcrumbs.vue';

const props = defineProps({
    breadcrumbs: {
        type: Array,
        default: () => [],
    },
});

console.log('WebNavigator breadcrumbs', props.breadcrumbs);
console.log(props.breadcrumbs.length);
console.log(props.breadcrumbs[0]);
console.log(props.breadcrumbs);

</script>

<template>
    <section id="navigator" class="dark:bg-black bg-transparent">
        <div class="mx-auto max-w-7xl pt-12 md:pt-14 lg:pt-18">
            <div class="path max-lg:pl-10 pl-15 dark:text-gray-200 pr-5 pt-2.5 pb-2.5 mb-1 text-4xl font-bold underline decoration-1 decoration-gray-600 underline-offset-4 dark:decoration-gray-200">
                <template v-if="props.breadcrumbs && props.breadcrumbs.length > 0">
                    <WebBreadcrumbs :breadcrumbs="props.breadcrumbs" />
                </template>
            </div>
        </div>
    </section>
</template>

<style scoped>
</style>
