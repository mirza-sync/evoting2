@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-12">
            <div class="d-flex flex-row justify-content-end">
                @if ($vote_status == 0)
                    <span class="mt-2">Voting is currently closed</span>
                    <a href="/admin/openvote" class="btn btn-success mx-2">Open Voting</a>
                @else
                    <span class="mt-2">Voting is open</span>
                    <a href="/votes/prepare" class="btn btn-primary mx-2">Generate Votes</a>
                    <a href="/admin/closevote" class="btn btn-warning mx-2">Close Voting</a>
                @endif
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-5">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body mx-4">
                            <h2 class="card-title text-center">FSKM</h2>
                            <div class="d-flex flex-row justify-content-between">
                                <div>
                                    <h6 class="card-title text-muted">Total Students</h6>
                                    <h1>{{count($fskm)}}</h1>
                                </div>
                                <div class="float-right">
                                    <h6 class="card-title text-muted">Has Voted</h6>
                                    <h1>{{$fskmCount}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body mx-4">
                            <h2 class="card-title text-center">FPA</h2>
                            <div class="d-flex flex-row justify-content-between">
                                <div>
                                    <h6 class="card-title text-muted">Total Students</h6>
                                    <h1>{{count($fpa)}}</h1>
                                </div>
                                <div class="float-right">
                                    <h6 class="card-title text-muted">Has Voted</h6>
                                    <h1>{{$fpaCount}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <canvas id="myChart" style="height: 500px; width: 100%;"></canvas>
        </div>
    </div>
</div>

@include('script.script1') 
@endsection
