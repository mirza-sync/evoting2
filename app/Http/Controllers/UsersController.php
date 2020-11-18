<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Admin;
use Auth;
use Hash;
use DB;
use Faker\Generator as Faker;

class UsersController extends Controller
{
    // public function AuthRouteAPI(Request $request){
    //     return $request->user();
    //  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = User::all();
        return view('student.index')->with('students', $students);
    }

    public function dashboard()
    {
        $admin = Admin::find(1);
        $vote_status = $admin->open_vote;
        return view('index')->with('vote_status', $vote_status);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // FOR DEVELOPMENT PURPOSE ONLY
    public function generateFakeStudents(Faker $faker) {
        $faculties = array('FSKM', 'FPA');

        //// Uncomment line below to delete all students
        // User::where('id', '!=', 0)->delete();

        // Generate 300 students
        for ($i=0; $i < 300 ; $i++) { 
            $student = new User;
            $student->name = $faker->name;
            $student->password = Hash::make('password');
            $student->matric_no = mt_rand(2011000000,2019999999);
            $student->phone_no = "0".mt_rand(110000000,199999999);
            $student->email = $faker->email;
            $student->faculty = $faculties[array_rand($faculties)];
            $student->save();
        }
        $students = User::all();

        return redirect('admin/home')->with('students');
    }
}
