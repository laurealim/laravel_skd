<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DonorController extends Controller
{
    public function searchDonor()
    {
        return inertia('web/DonorSearch');
    }

    public function becomeDonor()
    {
        return inertia('web/DonorForm');
    }

    /**
     * Store a newly created donor in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|max:255',
            'division' => 'required|max:255',
            'district' => 'required|max:255',
            'upazilla' => 'required|max:255',
            'union' => 'required|max:255',
            'word' => 'required|max:255',
            'address' => 'nullable|string',
            'phone' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!is_numeric($value) || strlen($value) !== 11) {
                    $fail('The phone number must be an 11-digit numerical value.');
                }
            }],
            'nid_or_birth_certificate' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!is_numeric($value) || !in_array(strlen($value), [10, 13, 17])) {
                    $fail('The NID/Birth Certificate must be a numerical value with 10, 13, or 17 digits.');
                }
            }],
            'blood_group' => 'required|string|max:3',
        ]);

        $donor = Donor::create($validated);

        return response()->json(['message' => 'Donor information saved successfully!', 'donor' => $donor], 201);
    }

    /**
     * Search donors by blood group, division, district (required), and optionally upazilla, union, word.
     * Returns paginated donor data for table display.
     */
    public function search(Request $request)
    {
        $validated = $request->validate([
            'blood_group' => 'required|string|max:3',
            'division' => 'required',
            'district' => 'required',
            'upazilla' => 'nullable',
            'union' => 'nullable',
            'word' => 'nullable',
            'page' => 'nullable|integer|min:1',
            'per_page' => 'required|integer',
        ]);

        $query = Donor::query();
        $query->where('blood_group', $validated['blood_group'])
            ->where('division', $validated['division'])
            ->where('district', $validated['district']);
        if (!empty($validated['upazilla'])) {
            $query->where('upazilla', $validated['upazilla']);
        }
        if (!empty($validated['union'])) {
            $query->where('union', $validated['union']);
        }
        if (!empty($validated['word'])) {
            $query->where('word', $validated['word']);
        }

        $perPage = 10;
        if(isset($validated['per_page'])){
            $perPage = $validated['per_page'];
        }
        $donors = $query->select(['id', 'name', 'blood_group', 'phone as mobile', 'division', 'district', 'upazilla', 'union', 'word', 'gender'])
            ->orderByDesc('id')
            ->paginate($perPage);

        return response()->json($donors);
    }

    public function getDivisions()
    {
        $divisions = DB::table('addr_divisions_tb')->get();
        return response()->json($divisions);
    }

    public function getDistricts($divisionId = null)
    {
        if ($divisionId){
            $districts = DB::table('addr_districts_tb')->where('division_id', $divisionId)->get();
        }else {
            $districts = DB::table('addr_districts_tb')->get();
        }
        return response()->json($districts);
    }

    public function getUpazilas($districtId=null)
    {
        if ($districtId) {
            $upazilas = DB::table('addr_upazilas_tb')->where('district_id', $districtId)->get();
        }else {
            $upazilas = DB::table('addr_upazilas_tb')->get();
        }
        return response()->json($upazilas);
    }

    public function getUnions($upazilaId=null)
    {
        if ($upazilaId) {
            $unions = DB::table('addr_unions_tb')->where('upazilla_id', $upazilaId)->get();
        }else {
            $unions = DB::table('addr_unions_tb')->get();
        }
        return response()->json($unions);
    }
}
