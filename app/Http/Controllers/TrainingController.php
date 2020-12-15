<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
}
