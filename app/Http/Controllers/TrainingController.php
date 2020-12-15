<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use App\Models\Training; // define ni kalau xnak pgl \App\Models\Trainings() setiap kali nak guna ***

class TrainingController extends Controller
{
    public function index(){
        //query trainings from trainings table using model
        $trainings = \App\Models\Training::all();

       // dd($trainings); //dd = dump n die

        //retun to view with $trainings
        //resources/views/trainings/index.blade.php
        return view('trainings.index', compact('trainings'));
    }

    public function create(){
        //return training create form
        // means - dlm resources/views/trainings/create.blade.php
        return view('trainings.create');
    }

    public function store(Request $request){ //Request $request amk data dari form create
        //dd($request->all()); // yang ni nak dump dulu nak tgk btl ke semua data dipegang

        //save data yang di keyin dari create form to trainings table
        //$training = \App\Models\Trainings(); ***

        //Method 1 - POPO - Plain Old PHP Object
        $training = new Training();
        $training->title = $request->title;
        $training->description = $request->description;
        $training->trainer = $request->trainer;
        $training->user_id = auth()->user()->id;
        $training->save();

        //then return to index page or redirect to mana2 page
        return redirect()->back();
    }
}
