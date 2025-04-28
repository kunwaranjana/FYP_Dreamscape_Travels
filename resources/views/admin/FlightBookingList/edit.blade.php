@extends('admin.inc.main')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@section('container')
<div class="content">
    <div class="form-containerr">
        <h2>Update Passenger Name</h2>
        <form class="data-form" action="{{ route('passenger.update', $passenger->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Passenger Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $passenger->name) }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="field">
                <div class="field-btn">
                    <button type="button" onclick="window.history.back()" class="back-button">Back</button>
                    <button type="submit" class="add-button">Update</button>
                </div>   
            </div>
            
    </div>
</div>
@endsection
