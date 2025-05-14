<script setup lang="ts">
import WebLocation from '@/components/web/WebLocation.vue';
import WebLayout from '@/layouts/WebLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';
import Datepicker from 'vue3-datepicker';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import Toast, { useToast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

interface DonorForm {
    name: string;
    dateOfBirth: string;
    division: number;
    district: number;
    upazilla: number;
    union: number;
    word: number;
    address: string;
    phone: string;
    gender: string;
    nidOrBirthCertificate: string;
    bloodGroup: string;
}

interface ValidationErrors {
    name?: string;
    dateOfBirth?: string;
    division?: number;
    district?: number;
    upazilla?: number;
    union?: number;
    word?: number;
    address?: string;
    phone?: string;
    gender?: string;
    nidOrBirthCertificate?: string;
    bloodGroup?: string;
}

const props = defineProps({
    isDashboard: Boolean,
});

const breadcrumbs = [
    {
        title: 'Become a Donor',
        href: '/become_donar',
    },
];

// Form fields
const form = ref<DonorForm>({
    name: '',
    dateOfBirth: '',
    division: '',
    district: '',
    upazilla: '',
    union: '',
    word: '',
    address: '',
    phone: '',
    gender: '',
    nidOrBirthCertificate: '',
    bloodGroup: '',
});

// const dateInput = ref(null);

// onMounted(() => {
//     initFlowbite();
//     if (dateInput.value) {
//         dateInput.value?.addEventListener('change', (event) => {
//             form.value.dateOfBirth = event.target.value;
//         });
//     }
// });

// Validation errors
const errors = ref<ValidationErrors>({});

// Success or error message
const message = ref('');
const messageType = ref(''); // 'success' or 'danger'

const successMessage = ref('');
const errorMessage = ref('');

const formatDate = (date: Date) => {
    if (!(date instanceof Date)) return '';
    const yyyy = date.getFullYear();
    const mm = String(date.getMonth() + 1).padStart(2, '0'); // Months start at 0
    const dd = String(date.getDate()).padStart(2, '0');
    return `${yyyy}-${mm}-${dd}`;
};

const submitForm = async () => {
    console.log('Submit button clicked');
    console.log(form.value);
    console.log(errors.value);
    // Perform validation
    errors.value = {};
    if (!form.value.name) errors.value.name = 'Name is required';
    if (!form.value.dateOfBirth) {
        errors.value.dateOfBirth = 'Date of birth is required';
    }
    if (!form.value.division || isNaN(form.value.division)) {
        errors.value.division = 0; // Set to 0 for numeric validation
    }
    if (!form.value.district || isNaN(form.value.district)) {
        errors.value.district = 0;
    }
    if (!form.value.upazilla || isNaN(form.value.upazilla)) {
        errors.value.upazilla = 0;
    }
    if (!form.value.union || isNaN(form.value.union)) {
        errors.value.union = 0;
    }
    if (!form.value.word || isNaN(form.value.word)) {
        errors.value.word = 0;
    }
    if (!form.value.address) errors.value.address = 'Address is required';
    if (!form.value.gender) errors.value.gender = 'Gender is required';
    if (!form.value.phone || !/^(?:\+?88)?01[3-9]\d{8}$/.test(form.value.phone) || ![11].includes(form.value.phone.length)) {
        errors.value.phone = 'Phone number must be a valid 11 digit Bangladeshi phone number';
    }
    if (
        !form.value.nidOrBirthCertificate ||
        !/^[0-9]+$/.test(form.value.nidOrBirthCertificate) ||
        ![10, 13, 17].includes(form.value.nidOrBirthCertificate.length)
    ) {
        errors.value.nidOrBirthCertificate = 'NID/Birth Certificate must be a numerical value with 10, 13, or 17 digits';
    }
    if (!form.value.bloodGroup) errors.value.bloodGroup = 'Blood group is required';

    if (Object.keys(errors.value).length > 0) {
        console.log('Validation errors:', errors.value);
        toast.error('Please fix the validation errors before submitting.');
        return;
    }

    // Convert camelCase to snake_case
    const snakeCaseForm = {
        name: form.value.name,
        date_of_birth: formatDate(form.value.dateOfBirth),
        division: form.value.division,
        district: form.value.district,
        upazilla: form.value.upazilla,
        union: form.value.union,
        word: form.value.word,
        address: form.value.address,
        phone: form.value.phone,
        gender: form.value.gender,
        nid_or_birth_certificate: form.value.nidOrBirthCertificate,
        blood_group: form.value.bloodGroup,
    };

    // Submit data to the server
    try {
        console.log('Submitting form data:', snakeCaseForm);
        const response = await axios.post('/api/donor', snakeCaseForm);
        console.log('Server response:', response.data);
        successMessage.value = response.data.message;
        errorMessage.value = '';
        toast.success('Donor information saved successfully!');
        form.value = {
            name: '',
            dateOfBirth: '',
            division: 0,
            district: 0,
            upazilla: 0,
            union: 0,
            word: 0,
            address: '',
            phone: '',
            gender: '',
            nidOrBirthCertificate: '',
            bloodGroup: '',
        };
    } catch (error: any) {
        console.error('Error submitting form:', error);
        errorMessage.value = error.response?.data?.message || 'An error occurred';
        successMessage.value = '';
        toast.error(errorMessage.value);
    }
};
</script>

<template>
    <Head title="Become a Donor" />
    <WebLayout :isDashboard="props.isDashboard" :breadcrumbs="breadcrumbs">
        <section class="flex flex-col items-center justify-center bg-white py-8 dark:bg-black dark:text-gray-200">
            <h2 class="my-2 w-full text-center text-5xl leading-tight font-bold text-gray-800 max-lg:text-4xl max-md:text-3xl dark:text-gray-100">
                Donor Registration Form
            </h2>
            <div class="mb-4 w-full">
                <div
                    class="gradient mx-auto my-0 h-1 w-3/7 rounded-t from-gray-400 via-gray-600 to-gray-400 py-0 opacity-25 dark:bg-gradient-to-r dark:opacity-100"
                ></div>
            </div>
            <!-- Modal for success/danger message -->
            <!-- <div v-if="message" class="mt-4">
                <div :class="messageType === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'" class="rounded-md p-4">
                    {{ message }}
                </div>
            </div>

            <div v-if="successMessage" class="alert alert-success">
                {{ successMessage }}
            </div>
            <div v-if="errorMessage" class="alert alert-danger">
                {{ errorMessage }}
            </div> -->

            <div class="card card-dash w-2/3 bg-gray-100 text-gray-800 shadow-xl dark:bg-gray-600 dark:text-gray-300">
                <div class="card-body rounded-2xl bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-300">
                    <form novalidate @submit.prevent="submitForm" class="container mx-auto flex flex-col space-y-12 text-gray-800">
                        <!-- Personal Information -->
                        <fieldset
                            class="grid grid-cols-2 gap-6 rounded-md bg-gray-100 p-6 text-gray-800 shadow-sm dark:bg-gray-800 dark:text-gray-300"
                        >
                            <div class="col-span-full space-y-2 lg:col-span-1">
                                <p class="font-bold">Personal Information</p>
                            </div>
                            <div class="col-span-full grid grid-cols-6 gap-4 lg:col-span-3">
                                <div class="col-span-full p-1 sm:col-span-3">
                                    <label for="name" class="mb-2 block text-sm font-medium text-gray-800 dark:text-gray-200">Full name:</label>
                                    <input
                                        v-model="form.name"
                                        id="name"
                                        type="text"
                                        placeholder="Full Name"
                                        :class="[
                                            'block w-full rounded-lg border bg-gray-50 p-2.5 text-sm dark:bg-gray-700 dark:placeholder-gray-400',
                                            errors.name
                                                ? 'border-red-500 text-red-500 focus:border-red-500 focus:ring-red-500'
                                                : 'border-gray-300 text-gray-800 focus:border-gray-500 focus:ring-gray-500 dark:border-gray-600 dark:text-gray-200',
                                        ]"
                                    />
                                    <p v-if="errors.name" class="text-sm text-red-500">{{ errors.name }}</p>
                                </div>
                                <div class="col-span-full p-1 sm:col-span-3">
                                    <label for="gender" class="mb-2 block text-sm font-medium text-gray-800 dark:text-gray-200"> Gender</label>
                                    <select
                                        v-model="form.gender"
                                        id="gender"
                                        :class="[
                                            'block w-full rounded-lg border bg-gray-50 p-2.5 text-sm dark:bg-gray-700 dark:placeholder-gray-400',
                                            errors.gender
                                                ? 'border-red-500 text-red-500 focus:border-red-500 focus:ring-red-500'
                                                : 'border-gray-300 text-gray-800 focus:border-gray-500 focus:ring-gray-500 dark:border-gray-600 dark:text-gray-200',
                                        ]"
                                    >
                                        <option value="">--- Select One ---</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">Others</option>
                                    </select>
                                    <p v-if="errors.gender" class="text-sm text-red-500">{{ errors.gender }}</p>
                                </div>
                                <div class="col-span-full p-1 sm:col-span-3">
                                    <label for="dateOfBirth" class="mb-2 block text-sm font-medium text-gray-800 dark:text-gray-200"
                                        >Date Of Birth:</label
                                    >
                                    <div class="relative">
                                        <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center justify-center p-3.5">
                                            <svg
                                                class="h-4 w-4 text-gray-500 dark:text-gray-400"
                                                aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"
                                                />
                                            </svg>
                                        </div>
                                        <Datepicker
                                            :class="[
                                                'block w-full rounded-lg border bg-gray-50 p-2.5 text-sm dark:bg-gray-700 dark:placeholder-gray-400',
                                                errors.dateOfBirth
                                                    ? 'border-red-500 text-red-500 focus:border-red-500 focus:ring-red-500'
                                                    : 'border-gray-300 text-gray-800 focus:border-gray-500 focus:ring-gray-500 dark:border-gray-600 dark:text-gray-200',
                                            ]"
                                            v-model="form.dateOfBirth"
                                            placeholder="Select Date"
                                        />
                                    </div>
                                    <p v-if="errors.dateOfBirth" class="text-sm text-red-500">{{ errors.dateOfBirth }}</p>
                                </div>
                                <div class="col-span-full p-1 sm:col-span-3">
                                    <label for="bloodGroup" class="mb-2 block text-sm font-medium text-gray-800 dark:text-gray-200">
                                        Blood Group</label
                                    >
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
                                <div class="col-span-full p-1 sm:col-span-3">
                                    <label for="nidOrBirthCertificate" class="mb-2 block text-sm font-medium text-gray-800 dark:text-gray-200"
                                        >NID / Birth Certificate:</label
                                    >
                                    <input
                                        id="nidOrBirthCertificate"
                                        v-model="form.nidOrBirthCertificate"
                                        type="text"
                                        placeholder="NID / Birth Certificate"
                                        :class="[
                                            'block w-full rounded-lg border bg-gray-50 text-sm dark:bg-gray-700 dark:placeholder-gray-400',
                                            errors.nidOrBirthCertificate
                                                ? 'border-red-500 text-red-500 focus:border-red-500 focus:ring-red-500'
                                                : 'border-gray-300 text-gray-800 focus:border-gray-500 focus:ring-gray-500 dark:border-gray-600 dark:text-gray-200',
                                        ]"
                                    />
                                    <p v-if="errors.nidOrBirthCertificate" class="text-sm text-red-500">{{ errors.nidOrBirthCertificate }}</p>
                                </div>
                                <div class="col-span-full p-1 sm:col-span-3">
                                    <label for="phone" class="mb-2 block text-sm font-medium text-gray-800 dark:text-gray-200">Phone:</label>
                                    <input
                                        v-model="form.phone"
                                        id="phone"
                                        type="text"
                                        placeholder="01XXXXXXXXX"
                                        :class="[
                                            'block w-full rounded-lg border bg-gray-50 text-sm dark:bg-gray-700 dark:placeholder-gray-400',
                                            errors.phone
                                                ? 'border-red-500 text-red-500 focus:border-red-500 focus:ring-red-500'
                                                : 'border-gray-300 text-gray-800 focus:border-gray-500 focus:ring-gray-500 dark:border-gray-600 dark:text-gray-200',
                                        ]"
                                    />
                                    <p v-if="errors.phone" class="text-sm text-red-500">{{ errors.phone }}</p>
                                </div>
                            </div>
                        </fieldset>
                        <!-- Address -->
                        <fieldset
                            class="grid grid-cols-2 gap-6 rounded-md bg-gray-100 p-6 text-gray-800 shadow-sm dark:bg-gray-800 dark:text-gray-300"
                        >
                            <div class="col-span-full space-y-2 lg:col-span-1">
                                <p class="font-bold">Address</p>
                            </div>
                            <div class="col-span-full grid grid-cols-6 gap-4 lg:col-span-3">
                                <WebLocation
                                    v-model:divisionId="form.division"
                                    v-model:districtId="form.district"
                                    v-model:upazilaId="form.upazilla"
                                    v-model:unionId="form.union"
                                    v-model:wordId="form.word"
                                    :errors="errors"
                                />
                            </div>
                            <div class="col-span-full p-1 sm:col-span-3">
                                <label for="address" class="mb-2 block text-sm font-medium text-gray-800 dark:text-gray-200"
                                    >Road/Holding/Village/House No. :</label
                                >
                                <input
                                    v-model="form.address"
                                    id="address"
                                    type="text"
                                    placeholder="Full Address"
                                    :class="[
                                        'block w-full rounded-lg border bg-gray-50 text-sm dark:bg-gray-700 dark:placeholder-gray-400',
                                        errors.address
                                            ? 'border-red-500 text-red-500 focus:border-red-500 focus:ring-red-500'
                                            : 'border-gray-300 text-gray-800 focus:border-gray-500 focus:ring-gray-500 dark:border-gray-600 dark:text-gray-200',
                                    ]"
                                />
                                <p v-if="errors.address" class="text-sm text-red-500">{{ errors.address }}</p>
                            </div>
                        </fieldset>
                        <div class="col-span-full flex items-center justify-center">
                            <button
                                type="submit"
                                class="gradient focus:shadow-outline mx-auto my-6 transform rounded-full from-gray-400 to-gray-800 px-8 py-4 font-bold text-white shadow-lg transition duration-300 ease-in-out hover:scale-105 hover:underline focus:outline-none lg:mx-0 dark:bg-linear-to-bl"
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
