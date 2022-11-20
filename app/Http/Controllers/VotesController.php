<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Candidate;

class VotesController extends Controller
{
    public function index() {
        $candidates = Candidate::all()->where('faculty',auth()->user()->faculty);
        return view('cast-votes')->with('candidates', $candidates);
    }

    public function show($student_id) {
        $candidates = User::find($student_id)->votesMany;
        return view('student.view-vote')->with('candidates', $candidates);
    }

    public function prepareVotesDB() {
        // Get all students except Ali
        $students = User::where('id','>',1);
        
        foreach($students as $student) {
            $student->votesMany()->sync([]);  // Empty the votes bridge
            $stud = User::find($student->id);
            $stud->has_voted = 0;   // Set vote status to No
            $stud->save();
        }
        // Emptying a table takes time. Laravel page will timeout after 60 seconds.
        // Hence, use return to reset the timer, and redirect back to generateRandomVotes method,
        // which will take longer to complete.
        return redirect('/votes/generate');
    }

    public function generateRandomVotes() {
        // Get random value between 0.80 - 1.00,
        // to get random percentage (To simulate that between 80% and 100% of students voted)
        $rnd = mt_rand(80, 100)/100;
        $studentCount = User::count();
        // Get number of students who voted based on percentage
        $num_voted = round((float)$studentCount * $rnd);

        // Get random students based on $num_voted, except student with id = 1
        $students = User::where('id','>',1)->get()->random($num_voted);

        // Get array id of candidates that are the same faculty with each student
        foreach($students as $student) {
            $candidates = Candidate::where('faculty', $student->faculty);
            $candidatesIDs = $candidates->pluck('id')->toArray();

            // Shuffle array
            shuffle($candidatesIDs);
            // Take the first two value in array,
            // to simulate that this student voted 2 candidates
            $votedIDs = array_slice($candidatesIDs, 0, 2);
            // Save voted id to votes bridge
            $student->votesMany()->sync($votedIDs);
            $student->has_voted = 1;
            $student->save();
        }
        return redirect('admin/home');
    }

    public function castVotes(Request $request) {
        $student_id = auth()->user()->id;
        $candidates = $request->input('candidatesArr.*');

        // Check if votes is not equal to 2, then redirect
        if(count($candidates) !== 2) {
            return redirect()->back()->withInput()->with('error', 'You must vote for 2 candidates');
        }
        
        $student = User::find($student_id);
        foreach ($candidates as $candidate) {
            $student->votesMany()->attach($candidate); // Save student's vote in votes bridge
        }
        $student->has_voted = 1;   // Set vote status to Yes
        $student->save();

        return redirect('/votes/view/'.$student->id)->with('candidates', $student->votesMany);
    }
}
