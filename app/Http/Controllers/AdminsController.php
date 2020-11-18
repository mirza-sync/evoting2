<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\User;
use App\Candidate;
use Hash;
use DB;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        //Get status of voting
        $admin = Admin::find(1);
        $vote_status = $admin->open_vote;

        // Get users of each faculty
        $fskm = User::where('faculty','FSKM')->get();
        $fpa = User::where('faculty','FPA')->get();

        $fskmCount = 0;
        foreach ($fskm as $x) {
            if($x->has_voted == 1){
                $fskmCount++;   // Count number of FSKM voters
            }
        }
        $fpaCount = 0;
        foreach ($fpa as $y) {
            if($y->has_voted == 1){
                $fpaCount++;    // Count number of FPA voters
            }
        }
        // Count number of votes of each candidates, and arrange in descending order
        $votes = Candidate::select('candidates.name', DB::raw('COUNT(votes.student_id) as count'))->join('votes','candidates.id','=','votes.candidate_id')->orderBy('count','desc')->groupBy('name')->get();
        return view('test-admin-home')->with(compact('fskm', 'fpa', 'fskmCount', 'fpaCount', 'vote_status'))->with('votes', $votes);
    }

    public function openVote()
    {
        // Get all students
        $students = User::all();
        
        foreach($students as $student) {
            $student->votesMany()->sync([]);  // Empty the votes bridge
            $student->has_voted = 0;   // Set vote status to No
            $student->save();
        }

        $admin = Admin::find(1);
        $admin->open_vote = 1;  // Set vote status to Open
        $admin->save();

        $vote_status = 1;
        return redirect('admin/home')->with(compact('vote_status'));
    }

    public function closeVote()
    {
        $admin = Admin::find(1);
        $admin->open_vote = 0;  // Set vote status to Closed
        $admin->save();

        return redirect('admin/home');
    }
}
