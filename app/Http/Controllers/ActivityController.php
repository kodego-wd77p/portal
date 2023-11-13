<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // SELECT * FROM activity_portal_dev.activities;

        // $activities =  Activity::all();

        // $activities = Activity::simplePaginate(5);

        $user = auth()->user();

        $activities;
        if($user->roles_id == 1){
            $activities = DB::table('activities')->join('activity_status', 'activities.activity_status_id', '=', 'activity_status.id')->join('users', 'users.id', '=', 'activities.owner')->select('activities.*', 'activity_status.status', 'users.name')->get();
        }else{
            $activities = DB::table('activities')->join('activity_status', 'activities.activity_status_id', '=', 'activity_status.id')->join('users', 'users.id', '=', 'activities.owner')->where('activities.owner', '=', $user->id)->select('activities.*', 'activity_status.status', 'users.name')->get();
        }

        return view('activities.index',
        [
        'activities' => $activities,
        'user' => $user
        ]);
        
    }

    public function show($id)
    {
        // SELECT * FROM activity_portal_dev.activities WHERE id = 1;
        $activity = Activity::find($id);

        $user = auth()->user();

        return view('activities.show',
        [
            'activity' => $activity,
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedInput = $request -> validate
        ([
            'title' => ['required', 'string', 'max:255'],
            'description' => 'required',
            'activity_status_id',
            'file' => 'required|image',
            'owner'
        ]);

        $validatedInput['file'] = $request->file('file')->store('public/images');

        $validatedInput['activity_status_id'] = 3;

        $user = auth()->user();
        $validatedInput['owner'] = $user->id;

        $activity = Activity::create($validatedInput);

        return redirect('/activity/'.$activity->id)->with('success', 'Successfully created!');
    }

    public function complete($id, Request $request)
    {
       $validatedInputs = $request->validate
        ([
            'activity_status_id'
        ]);

        $validatedInputs['activity_status_id'] = 1;

        $activity = Activity::where('id', $id)->update($validatedInputs);

        return redirect('/activities')->with('success', 'Update complete!');
    }

    public function incomplete($id, Request $request)
    {
       $validatedInputs = $request->validate
        ([
            'activity_status_id'
        ]);

        $validatedInputs['activity_status_id'] = 2;

        $activity = Activity::where('id', $id)->update($validatedInputs);

        return redirect('/activities')->with('success', 'Update complete!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // SELECT * FROM activity_portal_dev.activities WHERE id = 1;
        $activity = Activity::find($id);

        return view('activities.edit',
        [
            'activity' => $activity
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $validatedInputs = $request->validate
        ([
            'title' => ['required', 'string', 'max:255'],
            'description' => 'required',
            'activity_status_id',
            'file' => 'required|image'
        ]);

        $validatedInputs['file'] = $request->file('file')->store('public/images');

        $validatedInputs['activity_status_id'] = 3;

        $activity = Activity::where('id', $id)->update($validatedInputs);

        return redirect('/activities')->with('success', 'Edit success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // DELETE FROM activities WHERE id = 10;

        Activity::where('id',$id)->delete();

        return redirect('/activities')->with('success', 'Deleted!');
    }
}
