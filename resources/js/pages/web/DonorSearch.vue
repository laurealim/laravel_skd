<script setup lang="ts">
import WebLocation from '@/components/web/WebLocation.vue';
import { fetchLocationMaps } from '@/composables/useLocationMaps';
import WebLayout from '@/layouts/WebLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const props = defineProps({
    isDashboard: Boolean, // The entire people list (fetched from backend)
});
const breadcrumbs = [
    // {
    //     title: 'Home',
    //     href: '/web',
    // },
    {
        title: 'Search Donor',
        href: '/search_donar',
    },
];

interface DonorForm {
    division: string;
    district: string;
    upazilla: string;
    union: string;
    word: string;
    bloodGroup: string;
}

interface ValidationErrors {
    division?: string;
    district?: string;
    upazilla?: string;
    union?: string;
    word?: string;
    bloodGroup?: string;
}

interface DonorResult {
    id: number;
    name: string;
    blood_group: string;
    mobile: string;
    division: string;
    district: string;
    upazila: string;
    union: string;
    word: string;
    gender: string;
}

const form = ref<DonorForm>({
    division: '' as any,
    district: '' as any,
    upazilla: '' as any,
    union: '' as any,
    word: '' as any,
    bloodGroup: '',
});

// Validation errors
const errors = ref<ValidationErrors>({});

const donorResults = ref<DonorResult[]>([]);
const pagination = ref({
    current_page: 1,
    last_page: 1,
    per_page: 10,
    total: 0,
});

const perPageOptions = [25, 50, 75, 100];
const perPage = ref<number>(25);

// Fix: use string keys for maps
const divisionMap = ref<Record<string, string>>({});
const districtMap = ref<Record<string, string>>({});
const upazillaMap = ref<Record<string, string>>({});
const unionMap = ref<Record<string, string>>({});

const fetchLocationMaps = async () => {
    const [divisions, districts, upazilas, unions] = await Promise.all([
        axios.get('/api/divisions'),
        axios.get('/api/districts/0'),
        axios.get('/api/upazilas/0'),
        axios.get('/api/unions/0'),
    ]);
    divisionMap.value = {};
    for (const d of divisions.data) divisionMap.value[String(d.id)] = d.name;
    districtMap.value = {};
    for (const d of districts.data) districtMap.value[String(d.id)] = d.name;
    upazillaMap.value = {};
    for (const u of upazilas.data) upazillaMap.value[String(u.id)] = u.name;
    unionMap.value = {};
    for (const u of unions.data) unionMap.value[String(u.id)] = u.name;
};

onMounted(() => {
    fetchLocationMaps();
});

const submitForm = async (page = 1) => {
    errors.value = {};
    // Required: bloodGroup, division, district
    if (!form.value.division) {
        errors.value.division = 'Division is required';
    }
    if (!form.value.district) {
        errors.value.district = 'District is required';
    }
    if (!form.value.bloodGroup) errors.value.bloodGroup = 'Blood group is required';
    if (Object.keys(errors.value).length > 0) {
        toast.error('Please fix the validation errors before searching.');
        return;
    }

    console.log('Form submitted:', form.value);
    console.log('PerPage Value:', perPage.value);
    // Prepare search payload
    const payload = {
        division: form.value.division,
        district: form.value.district,
        upazilla: form.value.upazilla,
        union: form.value.union,
        word: form.value.word,
        blood_group: form.value.bloodGroup,
        page,
        per_page: perPage.value,
    };
    try {
        const response = await axios.post('/api/donor/search', payload);
        donorResults.value = response.data.data;
        pagination.value = {
            current_page: response.data.current_page,
            last_page: response.data.last_page,
            per_page: perPage.value,
            total: response.data.total,
        };
        if (donorResults.value.length === 0) {
            toast.info('No donors found for the selected criteria.');
        }
    } catch (err: any) {
        let msg = 'Search failed.';
        if (err?.response?.data?.message) {
            msg = err.response.data.message;
        }
        toast.error(msg);
        donorResults.value = [];
    }
};

const changePage = (page: number) => {
    if (page !== pagination.value.current_page && page > 0 && page <= pagination.value.last_page) {
        submitForm(page);
    }
};
</script>

<template>
    <Head title="Search Donor" />
    <WebLayout :isDashboard="props.isDashboard" :breadcrumbs="breadcrumbs">
        <section class="flex flex-col items-center justify-center bg-white py-8 dark:bg-black dark:text-gray-200">
            <h2 class="my-2 w-full text-center text-5xl leading-tight font-bold text-gray-800 max-lg:text-4xl max-md:text-3xl dark:text-gray-100">
                Search Donor
            </h2>
            <div class="mb-4 w-full">
                <div
                    class="gradient mx-auto my-0 h-1 w-3/7 rounded-t from-gray-400 via-gray-600 to-gray-400 py-0 opacity-25 dark:bg-gradient-to-r dark:opacity-100"
                ></div>
            </div>
            <div class="card card-dash w-6/7 bg-gray-100 text-gray-800 shadow-xl dark:bg-gray-600 dark:text-gray-300">
                <div class="card-body rounded-2xl bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-300">
                    <fieldset class="grid grid-cols-12 gap-6 rounded-md bg-gray-100 p-6 text-gray-800 shadow-sm dark:bg-gray-800 dark:text-gray-300">
                        <div class="col-span-full space-y-2">
                            <p class="font-bold">Search Fields</p>
                        </div>
                        <div class="col-span-full p-1 md:col-span-4 lg:col-span-3">
                            <label for="bloodGroup" class="mb-2 block text-sm font-medium text-gray-800 dark:text-gray-200"> Blood Group</label>
                            <select
                                v-model="form.bloodGroup"
                                id="bloodGroup"
                                :class="[
                                    'block w-full rounded-lg border bg-gray-50 text-sm dark:bg-gray-700 dark:placeholder-gray-400',
                                    errors.bloodGroup
                                        ? 'border-red-500 text-red-500 focus:border-red-500 focus:ring-red-500'
                                        : 'border-gray-300 text-gray-800 focus:border-gray-500 focus:ring-gray-500 dark:border-gray-600 dark:text-gray-200',
                                ]"
                            >
                                <option value="">--- Select One ---</option>
                                <option value="A+">A+(ve)</option>
                                <option value="A-">A-(ve)</option>
                                <option value="B+">B+(ve)</option>
                                <option value="B-">B-(ve)</option>
                                <option value="AB+">AB+(ve)</option>
                                <option value="AB-">AB-(ve)</option>
                                <option value="O+">O+(ve)</option>
                                <option value="O-">O-(ve)</option>
                            </select>
                            <p v-if="errors.bloodGroup" class="text-sm text-red-500">{{ errors.bloodGroup }}</p>
                        </div>
                        <WebLocation
                            v-model:divisionId="form.division"
                            v-model:districtId="form.district"
                            v-model:upazilaId="form.upazilla"
                            v-model:unionId="form.union"
                            v-model:wordId="form.word"
                            :errors="errors"
                        />
                        <div class="col-span-full p-1 md:col-span-4 lg:col-span-3">
                            <label for="bloodGroup" class="mb-2 block text-sm font-medium text-gray-100 dark:text-gray-800">Search</label>
                            <button
                                type="button"
                                @click="() => submitForm(1)"
                                class="w-full rounded-lg bg-gray-800 px-5 py-2.5 text-center text-sm font-medium text-white shadow-md transition duration-300 ease-in-out hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-500"
                            >
                                Search
                            </button>
                        </div>
                    </fieldset>
                    <fieldset v-if="donorResults.length > 0" class="grid grid-cols-12 gap-6 rounded-md bg-gray-100 p-6 text-gray-800 shadow-sm dark:bg-gray-800 dark:text-gray-300 mt-8">
                        
                        <div class="col-span-full space-y-2">
                            <p class="font-bold">Search Result</p>
                        </div>
                        <div class="col-span-full flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <label for="perPage" class="text-sm font-medium w-fit">Show</label>
                                <select id="perPage" v-model.number="perPage" @change="submitForm(1)" class="rounded w-32 border-gray-300 px-2 py-1 text-sm">
                                    <option v-for="opt in perPageOptions" :key="opt" :value="opt">{{ opt }}</option>
                                </select>
                                <span class="w-full text-sm">Data</span>
                            </div>
                        </div>
                        <div class="col-span-full overflow-x-auto">
                            
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-200">
                                            #
                                        </th>
                                        <th class="px-4 py-2 text-left text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-200">
                                            Name
                                        </th>
                                        <th class="px-4 py-2 text-left text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-200">
                                            Blood Group
                                        </th>
                                        <th class="px-4 py-2 text-left text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-200">
                                            Mobile
                                        </th>
                                        <th class="px-4 py-2 text-left text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-200">
                                            Division
                                        </th>
                                        <th class="px-4 py-2 text-left text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-200">
                                            District
                                        </th>
                                        <th class="px-4 py-2 text-left text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-200">
                                            Upazila
                                        </th>
                                        <th class="px-4 py-2 text-left text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-200">
                                            Union
                                        </th>
                                        <th class="px-4 py-2 text-left text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-200">
                                            Word
                                        </th>
                                        <th class="px-4 py-2 text-left text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-200">
                                            Gender
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(donor, idx) in donorResults"
                                        :key="donor.id"
                                        class="bg-white even:bg-gray-50 dark:bg-gray-800 dark:even:bg-gray-900"
                                    >
                                        <td class="px-4 py-2">{{ (pagination.current_page - 1) * pagination.per_page + idx + 1 }}</td>
                                        <td class="px-4 py-2">{{ donor.name }}</td>
                                        <td class="px-4 py-2">{{ donor.blood_group }}</td>
                                        <td class="px-4 py-2">{{ donor.mobile }}</td>
                                        <td class="px-4 py-2">{{ divisionMap[String(donor.division)] || donor.division }}</td>
                                        <td class="px-4 py-2">{{ districtMap[String(donor.district)] || donor.district }}</td>
                                        <td class="px-4 py-2">{{ upazillaMap[String(donor.upazila)] || donor.upazila }}</td>
                                        <td class="px-4 py-2">
                                            {{
                                                String(donor.union) === '-1'
                                                    ? 'City Corporation'
                                                    : String(donor.union) === '-2'
                                                        ? 'Pourosova'
                                                        : unionMap[String(donor.union)] || donor.union
                                            }}
                                        </td>
                                        <td class="px-4 py-2">{{ donor.word }}</td>
                                        <td class="px-4 py-2">{{ donor.gender }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-span-full w-full mt-4 flex items-center justify-between">
                            <button
                                class="rounded bg-gray-200 px-3 py-1 text-gray-700 disabled:opacity-50 dark:bg-gray-700 dark:text-gray-200"
                                :disabled="pagination.current_page === 1"
                                @click="changePage(pagination.current_page - 1)"
                            >
                                Previous
                            </button>
                            <span class=" text-sm">Page {{ pagination.current_page }} of {{ pagination.last_page }}</span>
                            <button
                                class="rounded bg-gray-200 px-3 py-1 text-gray-700 disabled:opacity-50 dark:bg-gray-700 dark:text-gray-200"
                                :disabled="pagination.current_page === pagination.last_page"
                                @click="changePage(pagination.current_page + 1)"
                            >
                                Next
                            </button>
                        </div>
                    </fieldset>
                </div>
            </div>
        </section>
    </WebLayout>
</template>

<style scoped></style>
