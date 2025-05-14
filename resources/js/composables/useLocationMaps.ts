import axios from 'axios';
import { ref } from 'vue';

// Reactive maps to store ID-to-name mappings
const divisionMap = ref({});
const districtMap = ref({});
const upazillaMap = ref({});
const unionMap = ref({});

// Fetch and populate all maps
const fetchLocationMaps = async () => {
    try {
        const [divisions, districts, upazilas, unions] = await Promise.all([
            axios.get('/api/divisions'),
            axios.get('/api/districts'), // Get all districts (assuming your backend supports this)
            axios.get('/api/upazilas'), // Get all upazilas
            axios.get('/api/unions'), // Get all unions
        ]);

        // Fill Division Map
        divisionMap.value = {};
        for (const d of divisions.data) {
            divisionMap.value[d.id] = d.name;
        }

        // Fill District Map
        districtMap.value = {};
        for (const d of districts.data) {
            districtMap.value[d.id] = d.name;
        }

        // Fill Upazila Map
        upazillaMap.value = {};
        for (const u of upazilas.data) {
            upazillaMap.value[u.id] = u.name;
        }

        // Fill Union Map
        unionMap.value = {};
        for (const u of unions.data) {
            unionMap.value[u.id] = u.name;
        }
    } catch (error) {
        console.error('Error fetching location maps:', error);
    }
};

export { districtMap, divisionMap, fetchLocationMaps, unionMap, upazillaMap };
