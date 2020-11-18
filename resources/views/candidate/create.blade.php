@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Candidate</div>
                <div class="card-body">
                    <form method="POST" action="/candidates" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Faculty</label>

                            <div class="col-md-6">
                                <select name="faculty" id="faculty" class="form-control">
                                    <option value="FSKM">FSKM</option>
                                    <option value="FPA">FPA</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">CGPA</label>

                            <div class="col-md-6">
                                <input id="cgpa" type="text" class="form-control" name="cgpa" value="{{ old('cgpa') }}" required autofocus>

                                @if ($errors->has('cgpa'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cgpa') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Manifesto</label>

                            <div class="col-md-6">
                                <textarea id="manifesto" type="text" class="form-control" name="manifesto" required autofocus>
                                </textarea>
                            </div>
                        </div>

                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary float-right">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
