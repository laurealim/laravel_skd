<template>
    <!-- <div> -->
    <div class="col-span-full p-1 md:col-span-3">
        <label for="division" class="mb-2 block text-sm font-medium text-gray-800 dark:text-gray-200"> Division</label>
        <select
            v-model="selectedDivision"
            id="division"
            :class="['block w-full rounded-lg border  bg-gray-50 p-2.5 text-sm dark:bg-gray-700 dark:placeholder-gray-400',errors.division ? 'border-red-500 text-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-200 focus:border-gray-500 focus:ring-gray-500']"
        >
            <option value="">--- Select Division ---</option>
            <option v-for="division in divisions" :key="division.id" :value="division.id">
                {{ division.name }}
            </option>
        </select>
        <p v-if="errors.division" class="text-sm text-red-500">{{ errors.division }}</p>
    </div>
    <div class="col-span-full p-1 md:col-span-3">
        <label for="district" class="mb-2 block text-sm font-medium text-gray-800 dark:text-gray-200"> District</label>
        <select
            v-model="selectedDistrict"
            id="district"
            :class="['block w-full rounded-lg border  bg-gray-50 p-2.5 text-sm dark:bg-gray-700 dark:placeholder-gray-400',errors.district ? 'border-red-500 text-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-200 focus:border-gray-500 focus:ring-gray-500']"
        >
            <option value="">--- Select District ---</option>
            <option v-if="selectedDivision" v-for="district in districts" :key="district.id" :value="district.id">
                {{ district.name }}
            </option>
        </select>
        <p v-if="errors.district" class="text-sm text-red-500">{{ errors.district }}</p>
    </div>
    <div class="col-span-full p-1 md:col-span-3">
        <label for="upazila" class="mb-2 block text-sm font-medium text-gray-800 dark:text-gray-200"> Upazilla</label>
        <select
            v-model="selectedUpazila"
            id="upazila"
            :class="['block w-full rounded-lg border  bg-gray-50 p-2.5 text-sm dark:bg-gray-700 dark:placeholder-gray-400',errors.upazilla ? 'border-red-500 text-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-200 focus:border-gray-500 focus:ring-gray-500']"
        >
            <option value="">--- Select Upazila ---</option>
            <option v-if="selectedDistrict && selectedDivision" v-for="upazila in upazilas" :key="upazila.id" :value="upazila.id">
                {{ upazila.name }}
            </option>
        </select>
        <p v-if="errors.upazilla" class="text-sm text-red-500">{{ errors.upazilla }}</p>
    </div>
    <div class="col-span-full p-1 md:col-span-3">
        <label for="union" class="mb-2 block text-sm font-medium text-gray-800 dark:text-gray-200"> Union</label>
        <select
            v-model="selectedUnion"
            id="union"
            :class="['block w-full rounded-lg border  bg-gray-50 p-2.5 text-sm dark:bg-gray-700 dark:placeholder-gray-400',errors.union ? 'border-red-500 text-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-200 focus:border-gray-500 focus:ring-gray-500']"
        >
            <option value="">--- Select Union ---</option>
            <option v-if="selectedDistrict && selectedDivision && selectedUpazila" v-for="union in unions" :key="union.id" :value="union.id">
                {{ union.name }}
            </option>
        </select>
        <p v-if="errors.union" class="text-sm text-red-500">{{ errors.union }}</p>
    </div>
    <div class="col-span-full p-1 md:col-span-3">
        <label for="word" class="mb-2 block text-sm font-medium text-gray-800 dark:text-gray-200"> Word No.</label>
        <select
            v-model="selectWord"
            id="word"
            :class="['block w-full rounded-lg border  bg-gray-50 p-2.5 text-sm dark:bg-gray-700 dark:placeholder-gray-400',errors.word ? 'border-red-500 text-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-200 focus:border-gray-500 focus:ring-gray-500']"
        >
            <option value="">--- Select Word ---</option>
            <option v-for="word in 30" :key="word" :value="word">
                {{ word }}
            </option>
        </select>
        <p v-if="errors.word" class="text-sm text-red-500">{{ errors.word }}</p>
    </div>
    <!-- <div>
            <label for="division" class="block text-sm font-medium">Division</label>
            <select v-model="selectedDivision" id="division" class="w-full rounded-md border-gray-300 shadow-sm">
                <option value="">Select Division</option>
                <option v-for="division in divisions" :key="division.id" :value="division.id">
                    {{ division.name }}
                </option>
            </select>
        </div> -->

    <!-- <div v-if="selectedDivision">
            <label for="district" class="block text-sm font-medium">District</label>
            <select v-model="selectedDistrict" id="district" class="w-full rounded-md border-gray-300 shadow-sm">
                <option value="">Select District</option>
                <option v-for="district in districts" :key="district.id" :value="district.id">
                    {{ district.name }}
                </option>
            </select>
        </div> -->

    <!-- <div v-if="selectedDistrict">
            <label for="upazila" class="block text-sm font-medium">Upazila</label>
            <select v-model="selectedUpazila" id="upazila" class="w-full rounded-md border-gray-300 shadow-sm">
                <option value="">Select Upazila</option>
                <option v-for="upazila in upazilas" :key="upazila.id" :value="upazila.id">
                    {{ upazila.name }}
                </option>
            </select>
        </div> -->

    <!-- <div v-if="selectedUpazila">
            <label for="union" class="block text-sm font-medium">Union</label>
            <select v-model="selectedUnion" id="union" class="w-full rounded-md border-gray-300 shadow-sm">
                <option value="">Select Union</option>
                <option v-for="union in unions" :key="union.id" :value="union.id">
                    {{ union.name }}
                </option>
            </select>
        </div> -->
    <!-- </div> -->
</template>

<script setup lang="ts">
import axios from 'axios';
import { onMounted, ref, watch } from 'vue';

const props = defineProps({
    divisionId: {
        type: Number,
        required: false,
        default: null,
    },
    errors: {
        type: Object,
        default: () => ({}),
    },
});

// Define emits for the component
const emit = defineEmits(['update:divisionId', 'update:districtId', 'update:upazilaId', 'update:unionId', 'update:wordId']);

const divisions = ref([]);
const districts = ref([]);
const upazilas = ref([]);
const unions = ref([]);
const words = ref([]);

const selectedDivision = ref(props.divisionId || '');
const selectedDistrict = ref('');
const selectedUpazila = ref('');
const selectedUnion = ref('');
const selectWord = ref('');

const fetchDivisions = async () => {
    const response = await axios.get('/api/divisions');
    divisions.value = response.data;
};

const fetchDistricts = async (divisionId) => {
    const response = await axios.get(`/api/districts/${divisionId}`);
    districts.value = response.data;
};

const fetchUpazilas = async (districtId) => {
    const response = await axios.get(`/api/upazilas/${districtId}`);
    upazilas.value = response.data;
};

const fetchUnions = async (upazilaId) => {
    const response = await axios.get(`/api/unions/${upazilaId}`);
    unions.value = [{ id: -1, name: 'City Corporation' }, { id: -2, name: 'Pourosova' }, ...response.data];
};

// Emit changes to the parent component
watch(selectedDivision, (newDivision) => {
    if (newDivision) {
        fetchDistricts(newDivision);
        selectedDistrict.value = '';
        selectedUpazila.value = '';
        selectedUnion.value = '';
    }
    emit('update:divisionId', newDivision);
});

watch(selectedDistrict, (newDistrict) => {
    if (newDistrict) {
        fetchUpazilas(newDistrict);
        selectedUpazila.value = '';
        selectedUnion.value = '';
    }
    emit('update:districtId', newDistrict);
});

watch(selectedUpazila, (newUpazila) => {
    if (newUpazila) {
        fetchUnions(newUpazila);
        selectedUnion.value = '';
    }
    emit('update:upazilaId', newUpazila);
});

watch(selectedUnion, (newUnion) => {
    emit('update:unionId', newUnion);
});

watch(selectWord, (newWord) => {
    emit('update:wordId', newWord);
});

onMounted(() => {
    fetchDivisions();
    if (props.divisionId) {
        fetchDistricts(props.divisionId);
    }
});
</script>

<style scoped>
.location-container {
    padding: 1rem;
    background-color: #f9f9f9;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.map-container {
    overflow: hidden;
    border-radius: 0.5rem;
}
</style>
