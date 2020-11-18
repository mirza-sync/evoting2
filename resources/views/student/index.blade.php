@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-12">
            {{-- <a href="/students/generate" class="btn btn-success mb-2">Generate Students</a> --}}
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Matric No.</td>
                        <td>Phone No.</td>
                        <td>Email</td>
                        <td>Faculty</td>
                        <td>Has Voted</td>
                    </tr>
                </thead>
                <tbody>
                    @if (count($students)>0)
                        @foreach ($students as $student)
                        <tr>
                            <td>{{$student->id}}</td>
                            <td>{{$student->name}}</td>
                            <td>{{$student->matric_no}}</td>
                            <td>{{$student->phone_no}}</td>
                            <td>{{$student->email}}</td>
                            <td>{{$student->faculty}}</td>
                            @if ($student->has_voted == 1)
                                <td>Yes</td>
                            @else
                                <td>No</td>
                            @endif
                        </tr>
                        @endforeach
                    @else
                        No students found!
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
