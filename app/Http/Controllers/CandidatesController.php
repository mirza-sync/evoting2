<?php

namespace App\Http\Controllers;
use App\Candidate;
use Auth;
use Hash;
use DB;
use Faker\Generator as Faker;

use Illuminate\Http\Request;

class CandidatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates = Candidate::all();
        return view('candidate.index')->with('candidates', $candidates);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('candidate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'faculty' => 'required',
            'manifesto' => 'required',
            'cgpa' => 'required',
            'name' => 'required'
        ]);

        //create 
        $candidate = new Candidate;
        $candidate-> faculty = $request->input('faculty');
        $candidate-> manifesto = $request->input('manifesto');
        $candidate-> cgpa = $request->input('cgpa');
        $candidate-> name = $request->input('name');
        $candidate->save();

        return redirect('/candidates')->with('success','Candidate Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $candidate = Candidate::find($id);
        
        //Check if candidate exists before deleting
        if (!isset($candidate)){
            return redirect('/candidates')->with('error', 'No Candidate Found');
        }

        return view('candidate.edit')->with('candidate', $candidate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'faculty' => 'required',
            'manifesto' => 'required',
            'cgpa' => 'required',
            'name' => 'required',
            'image' => 'image|nullable|max:1999'
        ]);

        $candidate = Candidate::find($id);
        $candidate->save();

        return redirect('/candidates')->with('success', 'Candidate Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $candidate = Candidate::find($id);
        
        //Check if candidate exists before deleting
        if (!isset($candidate)){
            return redirect('/candidates')->with('error', 'No candidate Found');
        }

        // // Check for correct user
        // if(auth()->user()->id !==$candidate->user_id){
        //     return redirect('/candidates')->with('error', 'Unauthorized Page');
        // }
        
        $candidate->delete();
        return redirect('/candidates')->with('success', 'Candidate Removed');
    }

    // FOR DEVELOPMENT PURPOSE ONLY
    public function generateCandidates(Faker $faker) {
        $faculties = array('FSKM', 'FPA');
        // Uncomment line below to empty candidates table before generate candidate
        // DB::raw('DELETE FROM candidates WHERE id > 0);
        for ($i=0; $i < 15 ; $i++) {    // 15 candidates
            $candidate = new Candidate;
            $candidate->name = $faker->name;    // Generate fake names
            $candidate->faculty = $faculties[array_rand($faculties)];   // Get random value from faculties array
            $candidate->cgpa = mt_rand(300, 400)/100;   // Get random value between 3.00 to 4.00
            $candidate->manifesto = $faker->text($maxNbChars = 30); // Generate random text of 30 words
            $candidate->save();
        }
        $candidates = Candidate::all();

        return redirect('admin/home')->with('candidates', $candidates);
    }
}
