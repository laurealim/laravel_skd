<script setup lang="ts">
import WebLayout from '@/layouts/WebLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    isDashboard: Boolean, // The entire people list (fetched from backend)
});

const breadcrumbs = [
    {
        title: 'Contact Us',
        href: '/contact',
    },
];

const form = useForm({
    name: '',
    phone: '',
    email: '',
    title: '',
    description: '',
});

const submitForm = () => {
    if (!form.name || !form.phone || !form.email || !form.title || !form.description) {
        alert('All fields are required. Please fill out the entire form.');
        return;
    }

    form.post('/contact', {
        onSuccess: () => {
            alert('Form submitted successfully!');
            form.reset();
        },
    });
};
</script>

<template>
    <Head title="Contact Us" />
    <WebLayout :isDashboard="props.isDashboard" :breadcrumbs="breadcrumbs">
        <section class="border-b bg-white py-8 dark:bg-black dark:text-gray-200">
            <div class="container mx-auto flex flex-wrap pb-12">
                <h2 class="my-2 w-full text-center text-5xl leading-tight font-bold text-gray-800 max-lg:text-4xl max-md:text-3xl dark:text-gray-100">
                    Contact Us
                </h2>
                <div class="mb-4 w-full">
                    <div
                        class="gradient mx-auto my-0 h-1 w-64 rounded-t from-gray-400 via-gray-600 to-gray-400 py-0 opacity-25 dark:bg-gradient-to-r dark:opacity-100"
                    ></div>
                </div>
                <div class="flex w-full flex-shrink flex-grow flex-col md:w-1/3 mx-auto max-w-4xl rounded-lg bg-gray-100 dark:bg-gray-800 p-6  max-lg:ml-5 max-lg:mr-5 shadow-md text-gray-800 dark:text-gray-300">
                    <form @submit.prevent="submitForm" class="space-y-4 flex justify-center flex-col">
                        <div>
                            <label for="name" class="block text-sm font-medium">Name</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                v-model="form.name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            />
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium">Phone</label>
                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                v-model="form.phone"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            />
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium">Email</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                v-model="form.email"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            />
                        </div>
                        <div>
                            <label for="title" class="block text-sm font-medium">Title</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                v-model="form.title"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            />
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium">Description</label>
                            <textarea
                                id="description"
                                name="description"
                                v-model="form.description"
                                rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            ></textarea>
                        </div>
                        <div class="flex items-center justify-center">
                            <button
                                type="submit"
                                class="w-3/12 max-lg:w-3/12 border border-indigo-400 rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700 focus:ring-2  focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none"
                            >
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </WebLayout>
</template>

<style scoped>
/* Add any additional styling if needed */
</style>
