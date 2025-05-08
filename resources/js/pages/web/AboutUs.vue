<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import WebLayout from '@/layouts/WebLayout.vue';
const props = defineProps({
    isDashboard: Boolean, // The entire people list (fetched from backend)
});
const breadcrumbs = [
    // {
    //     title: 'Home',
    //     href: '/web',
    // },
    {
        title: 'About Us',
        href: '/about',
    },
];
</script>

<template>
    <Head title="About Us" />
    <WebLayout :isDashboard="props.isDashboard" :breadcrumbs="breadcrumbs">
        <section class="border-b bg-white py-8 dark:bg-black dark:text-gray-200">
            <div class="container mx-auto flex flex-wrap pb-12">
                <h2 class="my-2 w-full text-center text-5xl leading-tight font-bold text-gray-800 max-lg:text-4xl max-md:text-3xl dark:text-gray-100">
                    Title
                </h2>
                <div class="mb-4 w-full">
                    <div
                        class="gradient mx-auto my-0 h-1 w-64 rounded-t from-gray-400 via-gray-600 to-gray-400 py-0 opacity-25 dark:bg-gradient-to-r dark:opacity-100"
                    ></div>
                </div>
                <div class="flex w-full flex-shrink flex-grow flex-col p-6 md:w-1/3">
                    <div class="flex-1 overflow-hidden rounded-t rounded-b-none bg-white shadow dark:bg-neutral-600">
                        <a href="#" class="flex flex-wrap no-underline hover:no-underline">
                            <div class="mt-2 w-full px-6 text-xl font-bold text-gray-800 dark:text-gray-300">Lorem ipsum dolor sit amet.</div>
                            <p class="mb-5 px-6 text-base text-gray-800 dark:text-gray-400">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at ipsum eu nunc commodo posuere et sit amet ligula.
                            </p>
                        </a>
                    </div>
                    <div class="mt-auto flex-none overflow-hidden rounded-t-none rounded-b bg-white p-6 shadow">
                        <div class="flex items-center justify-start">
                            <button
                                class="gradient focus:shadow-outline mx-auto my-6 transform rounded-full from-gray-400 to-gray-800 px-8 py-4 font-bold text-white shadow-lg transition duration-300 ease-in-out hover:scale-105 hover:underline focus:outline-none lg:mx-0 dark:bg-linear-to-bl"
                            >
                                Action 1
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex w-full flex-shrink flex-grow flex-col p-6 md:w-1/3">
                    <div class="flex-1 overflow-hidden rounded-t rounded-b-none bg-white shadow dark:bg-neutral-600">
                        <a href="#" class="flex flex-wrap no-underline hover:no-underline">
                            <div class="mt-2 w-full px-6 text-xl font-bold text-gray-800 dark:text-gray-300">Lorem ipsum dolor sit amet.</div>
                            <p class="mb-5 px-6 text-base text-gray-800 dark:text-gray-400">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at ipsum eu nunc commodo posuere et sit amet ligula.
                            </p>
                        </a>
                    </div>
                    <div class="mt-auto flex-none overflow-hidden rounded-t-none rounded-b bg-white p-6 shadow">
                        <div class="flex items-center justify-start">
                            <button
                                class="gradient focus:shadow-outline mx-auto my-6 transform rounded-full from-gray-400 to-gray-800 px-8 py-4 font-bold text-white shadow-lg transition duration-300 ease-in-out hover:scale-105 hover:underline focus:outline-none lg:mx-0 dark:bg-linear-to-bl"
                            >
                                Action 2
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex w-full flex-shrink flex-grow flex-col p-6 md:w-1/3">
                    <div class="flex-1 overflow-hidden rounded-t rounded-b-none bg-white shadow dark:bg-neutral-600">
                        <a href="#" class="flex flex-wrap no-underline hover:no-underline">
                            <div class="mt-2 w-full px-6 text-xl font-bold text-gray-800 dark:text-gray-300">Lorem ipsum dolor sit amet.</div>
                            <p class="mb-5 px-6 text-base text-gray-800 dark:text-gray-400">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at ipsum eu nunc commodo posuere et sit amet ligula.
                            </p>
                        </a>
                    </div>
                    <div class="mt-auto flex-none overflow-hidden rounded-t-none rounded-b bg-white p-6 shadow">
                        <div class="flex items-center justify-start">
                            <button
                                class="gradient focus:shadow-outline mx-auto my-6 transform rounded-full from-gray-400 to-gray-800 px-8 py-4 font-bold text-white shadow-lg transition duration-300 ease-in-out hover:scale-105 hover:underline focus:outline-none lg:mx-0 dark:bg-linear-to-bl"
                            >
                                Action 3
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </WebLayout>
</template>

<style scoped></style>
