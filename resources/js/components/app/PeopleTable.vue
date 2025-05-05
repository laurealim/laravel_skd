<script setup>
import { computed } from "vue";

const props = defineProps({
    people: Array, // List of people (fetched from backend)
});

// Generate a random color per category (for badges)
const categoryColors = {
    Work: "bg-blue-600 text-white",
    Friends: "bg-green-600 text-white",
    Others: "bg-gray-600 text-white",
};

const getCategoryClass = (category) => categoryColors[category] || "bg-gray-400 text-white";
</script>

<template>
    <div class="overflow-x-auto">
        <!-- Table Container -->
        <div class="max-w-full overflow-hidden rounded-3xl shadow-lg border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900">
            <table class="w-full text-left border-collapse">
                <!-- Table Header -->
                <thead class="bg-zinc-800 text-white sticky top-0 z-10">
                    <tr>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wide">#</th>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wide">Name</th>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wide">Email</th>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wide">Phone</th>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wide">Category</th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                    <tr v-for="(person, index) in people" :key="person.id" class="hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors duration-200">
                        <!-- Index -->
                        <td class="px-6 py-4 text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ index + 1 }}</td>

                        <!-- Name -->
                        <td class="px-6 py-4 text-sm font-medium text-zinc-800 dark:text-zinc-200">{{ person.name }}</td>

                        <!-- Email -->
                        <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">{{ person.email }}</td>

                        <!-- Phone -->
                        <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">{{ person.phone }}</td>

                        <!-- Category Badge -->
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase" :class="getCategoryClass(person.category)">
                                {{ person.category }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>