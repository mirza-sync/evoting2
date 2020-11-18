@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form action="/votes/cast" method="post">
                    @csrf
                    <div class="card-header">Cast Your Votes</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <td>ID</td>
                                    <td>Name</td>
                                    <td>CGPA</td>
                                    <td>Manifesto</td>
                                    <td>Faculty</td>
                                    <td>Vote</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($candidates)>0)
                                    @foreach ($candidates as $candidate)
                                    <tr>
                                        <td>{{$candidate->id}}</td>
                                        <td>{{$candidate->name}}</td>
                                        <td>{{$candidate->cgpa}}</td>
                                        <td>{{$candidate->manifesto}}</td>
                                        <td>{{$candidate->faculty}}</td>
                                        <td><input type="checkbox" name="candidatesArr[]" value="{{$candidate->id}}"></td>
                                    </tr>
                                    @endforeach
                                @else
                                    No candidates found!
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success font-weight-bold">VOTE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
