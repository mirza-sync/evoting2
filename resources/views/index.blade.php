@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Welcome {{Auth::user()->name}}</h5>
                    <ul>
                        <li>You will be voting candidates from your own faculty</li>
                        <li>You can only vote 2 candidates</li>
                    </ul>
                </div>
                <div class="card-footer">
                    @if ($vote_status == 0)
                        <h4>Voting is closed</h4>
                    @else
                        @if (Auth::user()->has_voted == 0)
                            <span>Your still haven't voted.</span>
                            <a href="/votes" class="btn btn-success float-right">VOTE NOW</a>
                        @else
                            <span>Your have voted. Thank you</span>
                            <a href="/votes/view/{{Auth::user()->id}}" class="btn btn-success float-right">VIEW VOTE</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
