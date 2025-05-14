<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import axios from 'axios';

import CategoryCard from '@/components/app/CategoryCard.vue';
import PeopleTable from '@/components/app/PeopleTable.vue';
import PeopleTableDark from '@/components/app/PeopleTableDark.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const page = usePage();
const people = page.props.people;

onMounted(() => {
    axios.post('http://127.0.0.1:8001/api/login', {
        name: 'dc_gopalganj',
        password: 'password'
    })
    .then(loginResponse => {
        console.log(loginResponse.data);
        const token = "87|xrpOyyAvKwQX3PJHaAvnZzJKyUuki3ovxbAHGppH6ee38ae4";
        console.log('Login Successful, Token:', token);

        axios.get('http://127.0.0.1:8001/api/get_blood_group_data', {
            headers: {
                Authorization: `Bearer ${token}`,
                Accept: 'application/json'
            }
        })
        .then(response => {
            console.log('Fetched Data:', response.data);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    })
    .catch(error => {
        console.error('Login Error:', error);
    });
});

</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <CategoryCard category="Work" :people="people"/>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <CategoryCard category="Friends" :people="people"/>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <CategoryCard category="Others" :people="people"/>
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <PeopleTable :people="people"/>
            </div>
        </div>
    </AppLayout>
</template>
