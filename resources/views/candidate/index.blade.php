@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-12">
            {{-- <a href="/candidates/generate" class="btn btn-success mb-2">Generate Candidates</a> --}}
            <a href="/candidates/create" class="btn btn-success mb-2">Create Candidates</a>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <td style="width: 5%">ID</td>
                        <td>Image</td>
                        <td>Name</td>
                        <td>CGPA</td>
                        <td>Faculty</td>
                        <td>Manifesto</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @if (count($candidates)>0)
                        @foreach ($candidates as $candidate)
                        <tr>
                            <td style="width: 5%">{{$candidate->id}}</td>
                            <td>{{$candidate->name}}</td>
                            <td>{{$candidate->cgpa}}</td>
                            <td>{{$candidate->faculty}}</td>
                            <td>{{$candidate->manifesto}}</td>
                            <td>
                                <a href="/candidates/{{$candidate->id}}/edit" class="btn btn-primary">Edit</a>
                                <form action="/candidates/{{$candidate->id}}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        No candidates found!
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
