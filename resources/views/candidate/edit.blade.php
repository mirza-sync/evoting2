@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Candidate</div>
                <div class="card-body">
                    <form method="POST" action="/candidates/{{$candidate->id}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Candidate Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $candidate->name }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">CGPA</label>

                            <div class="col-md-6">
                                <input id="cgpa" type="text" class="form-control" name="cgpa" value="{{ $candidate->cgpa }}" required>
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
                            <label class="col-md-4 col-form-label text-md-right">Manifesto</label>

                            <div class="col-md-6">
                                <textarea id="manifesto" type="text" class="form-control" name="manifesto" required>{{ $candidate->manifesto }}</textarea>
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
