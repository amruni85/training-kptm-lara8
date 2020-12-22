<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use File;
use Storage;

use App\Models\Training; // define ni kalau xnak pgl \App\Models\Trainings() setiap kali nak guna ***

class TrainingController extends Controller
{
    public function index(){
        $user = auth()->user(); // yg ni tambah sebab nk display training of one user only
        $trainings = $user->trainings()->paginate(5);

        //query trainings from trainings table using model
        //$trainings = \App\Models\Training::all();
       // $trainings = \App\Models\Training::paginate(5); //by default akan display 15 lists per page..kalau nak customize cth display 5 shj letak (5)

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

        if($request->hasFile('attachment')){
            //rename file -cth : letak id - tarikh.jpg
            $filename = $training->id.'-'.date("Y-m-d").'.'.$request->attachment->getClientOriginalExtension();

            //store file on storage
            Storage::disk('public')->put($filename, File::get($request->attachment));

            //update row with filename
            $training->update(['attachment'=>$filename]);
        }

        //then return to index page or redirect to mana2 page
        //return redirect()->back();

        //guna alert
        return redirect()
            ->route('traininglist')
            ->with([
                'alert-type' => 'alert-success',
                'alert' => 'Your training has been saved.'
            ]);
    }

    public function show($id)
    {
        //find id on table using model
        $training = Training::find($id);

        //dd($training);

        //return to view
        return view('trainings.show', compact('training'));
    }

/*    public function edit($id)
    {
        //find id
        $training = Training::find($id);

        //then retun to view
        return view('trainings.edit', compact('training'));
    }
*/
    //guna binding - instantiate training instead of id -- pd route pass training shj
    public function edit(Training $training)
    {
        //find id
       // $training = Training::find($id); -- xperlu find bila instantiate sebab dh bind dlm $training

        //then retun to view
        return view('trainings.edit', compact('training'));
    }
/*
    public function update($id, Request $request) //Request $request - data dari form edit utk diterima
    {
        //find id
        $training = Training::find($id);

        //update training with edited attributes
        //method 1 blh guna POPO
        //method 2 guna mass assignment
        $training->update($request->only('title', 'description', 'trainer'));

        //return to trainings
        return redirect()->route('traininglist');
    }
*/
    public function update(Training $training, Request $request) //Request $request - data dari form edit utk diterima
    {
        //find id
        // $training = Training::find($id);

        //update training with edited attributes
        //method 1 blh guna POPO
        //method 2 guna mass assignment
        $training->update($request->only('title', 'description', 'trainer'));

        //return to trainings
        //return redirect()->route('traininglist');

        //guna alert
        return redirect()
            ->route('traininglist')
            ->with([
                'alert-type' => 'alert-primary',
                'alert' => 'Your training has been updated.'
            ]);
    }

    public function delete (Training $training)
    {
        $training->delete();

       // return redirect()->route('traininglist');

        //guna alert
        return redirect()
            ->route('traininglist')
            ->with([
                'alert-type' => 'alert-danger',
                'alert' => 'Your training has been deleted.'
            ]);
    }
}
