<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonController extends Controller
{
    public function home(Request $request){
        return Inertia::render('Webpage',[
            'isDashboard' => true,
            'logo' => asset('images/blood-donation.png'),
            'bgSlider' => asset('images/1.jpg'),
        ]);
    }
    public function about(Request $request){
        return Inertia::render('web/AboutUs',[
            'isDashboard' => false,
            'logo' => asset('images/blood-donation.png'),
            'bgSlider' => asset('images/1.jpg'),
        ]);
    }

    public function contact(Request $request){
        return Inertia::render('web/ContactUs',[
            'isDashboard' => false,
            'logo' => asset('images/blood-donation.png'),
            'bgSlider' => asset('images/1.jpg'),
        ]);
    }
}
