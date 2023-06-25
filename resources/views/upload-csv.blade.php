@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Upload CSV</h2>
		
		@if (session('success'))
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
		@endif


        <form method="POST" action="{{ route('upload.csv') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="csv_file">CSV File</label>
                <input type="file" name="csv_file" id="csv_file" class="form-control">
                @error('csv_file')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
@endsection
