<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use File;
use Storage;
use App\Http\Requests\StoreTrainingRequest;
use Mail;
use Notification;
use App\Notifications\DeleteTrainingNotification;
use App\Notifications\CreateTrainingNotification;

use App\Models\Training; // define ni kalau xnak pgl \App\Models\Trainings() setiap kali nak guna ***

class TrainingController extends Controller
{
    public function index(Request $request){

        if($request->keyword){
            $search = $request->keyword;

            //$trainings = Training::where('title','LIKE','%'.$search.'%') -- ni utk all users
            //blh buat mcm ni jgk utk tgk user yg authenticate utk buat search -- authenticate user only
            $trainings = auth()->user()->trainings()->where('title','LIKE','%'.$search.'%')
                ->orWhere('trainer','LIKE','%'.$search.'%')
                ->orderBy('created_at','desc')
                ->paginate(5);
            //tp bila guna orderBy- make sure value ada, if no value akan error--so kena set default value
        } 
        else{
            $user = auth()->user(); // yg ni tambah sebab nk display training of one user only [get current authenticate user]
            $trainings = $user->trainings()->paginate(5);
        }
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

    public function store(StoreTrainingRequest $request){ 
        // $this->validate(
        //     $request,
        //     [
        //         'title' => 'required|min:5',
        //         'description' => 'required',
        //         'attachment' => 'required|mimes:pdf'
        //     ]
        //     );
        
        //Request $request amk data dari form create
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

        //nak send email to user --setup kat bahagian .env, copy dari mailtrap.io utk testing = integrations - laravel
        // Mail::send('email.training-created', [
        //     'title'=>$training->title,
        //     'description'=>$training->description
        // ], function ($message){
        //     $message->to('norma_mn@gapps.kptm.edu.my');
        //     $message->subject('Training Created using Inline Mail');
        // });

        //send emel to user using mailable class
        // Mail::to('norma_mn@gapps.kptm.edu.my')->send(new \App\Mail\TrainingCreated()); -- copy then paste pd SendEmailJob

        //dispatch to job queue -- optimize time for frontend process
        dispatch(new \App\Jobs\SendEmailJob($training));

        //tambah notification
        $user = auth()->user();
        Notification::send($user, new CreateTrainingNotification());

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
        $training->update($request->only('title', 'description', 'trainer',));

        if($request->hasFile('attachment')){
            //rename file -cth : letak id - tarikh.jpg
            $filename = $training->id.'-'.date("Y-m-d").'.'.$request->attachment->getClientOriginalExtension();

            //store file on storage
            Storage::disk('public')->put($filename, File::get($request->attachment));

            //update row with filename
            $training->update(['attachment'=>$filename]);
        }

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
        //tambah notification
        $user = auth()->user();
        Notification::send($user, new DeleteTrainingNotification());

        if ($training->attachment != null){
            Storage::disk('public')->delete($training->attachment);
        }
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
