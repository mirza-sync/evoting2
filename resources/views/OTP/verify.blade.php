@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Enter OTP</div>
    
                    @if($errors->count() > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        {{ $error }}
                        @endforeach
                    </div>
                    @endif
                    
                    @if(session('message'))
                    <div class="alert alert-success alert-info-style1">
                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                            </button>
                        
                            {{session('message')}}</p>
                    </div>
                    @endif
    
                    <div class="card-body">
                        <form action="/verifyOTP" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="otp">Your OTP</label>
                                <input type="text" name="OTP" id="otp" class="form-control" required>
                            </div>
                                <input type="submit" value="Verify" class="btn btn-info">
                        </form>
                    </div>
                    
                    <div class="container mb-4">
                        <form action="/resend_otp" method="post">
                        @csrf
                        <input type="submit" class="btn btn-sm btn-dark mr-4" value="Resend OTP via">
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="via" id="sms" value="sms">
                            <label class="form-check-label" for="sms">SMS</label>
                            </div>
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="via" id="email" value="email" checked>
                            <label class="form-check-label" for="email">Email</label>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection