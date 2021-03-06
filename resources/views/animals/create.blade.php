<!-- inherit master template app.blade.php -->
@extends('layouts.app')

@section('columns', '6')
@section('title', 'Add Animal')

<!-- define the content section -->
@section('content')
    @include('elements.session_alerts')
    <div style="background-color:#FCD5CE" class="card">
        <!-- Define the form -->
        <div class="card-body">
            <form class="form-horizontal form-div" method="POST" action="{{ url('animals') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-8 form-label">
                    <label>Animal Name</label>
                    <br />
                    <input type="text" name="name" placeholder="Animal Name" />
                </div>

                <div class="col-md-8 form-label">
                    <label>Date of Birth</label>
                    <br />
                    <input type="date" name="date_of_birth" placeholder="yyyy-mm-dd" />
                </div>

                <div class="col-md-8 form-label">
                    <label>Type</label>
                    <br />
                    @include('elements.select_animal_type', ['type' => '', 'onchange' => '', 'showall' => false])
                </div>

                <div class="col-md-8 form-label">
                    <label>Description</label>
                    <br />
                    <textarea rows="4" cols="55" name="description" placeholder="Description for the animal. Max 256 characters."></textarea>
                </div>

                <div style="margin-bottom:10px;" class="col-md-8 form-label">
                    <label>Image</label>
                    <br />
                    <input type="file" accept="image/*" name="images[]" placeholder="Image file" multiple />
                </div>

                <div class="col-md-8 col-md-offset-2">
                    <a href="{{ route('animals.index') }}" class="btn btn-pink" role="button">Back to the list</a>
                    <input type="submit" class="btn btn-green" />
                    <input type="reset" class="btn btn-red" onclick="return confirm('Are you sure you want to reset the form?')" />
                </div>
            </form>
        </div>
    </div>
@endsection