@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>You've voted for :</h3></div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Faculty</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($candidates)>0)
                                @foreach ($candidates as $candidate)
                                <tr>
                                    <td>{{$candidate->id}}</td>
                                    <td>{{$candidate->name}}</td>
                                    <td>{{$candidate->faculty}}</td>
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
    </div>
</div>
@endsection
