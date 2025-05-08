<script setup lang="ts">
import WebContent from '@/components/web/WebContent.vue';
import WebFooter from '@/components/web/WebFooter.vue';
import WebNav from '@/components/web/WebNav.vue';
import WebNavigator from '@/components/web/WebNavigator.vue';
import WebShell from '@/components/web/WebShell.vue';

const props = defineProps({
    isDashboard: Boolean, // The entire people list (fetched from backend)
    breadcrumbs: {
        type: Array,
        default: () => [],
    },
});
console.log('WebContentLayout breadcrumbs', props.breadcrumbs);
</script>

<template>
    <WebShell>
        <WebContent :isDashboard="props.isDashboard">
            <WebNav />
            <!-- <WebNavigator v-if="!props.breadcrumbs" :breadcrumbs="props.breadcrumbs" /> -->
            <WebNavigator v-if="!props.isDashboard"  :breadcrumbs="props.breadcrumbs"/>
            <slot />
        </WebContent>
        <WebFooter />
    </WebShell>
</template>

<style scoped></style>
