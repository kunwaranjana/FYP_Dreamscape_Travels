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
            <h2>Update Package form</h2>
            <form class="data-form" action="{{ route('package.update', $package->id) }}"  method="POST" enctype="multipart/form-data" required>
                @csrf
                @method('PUT')

                   <!-- Title Field -->
                   <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $package->title) }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Description Field -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control">{{ old('description', $package->description) }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Image Field -->
                <div class="mb-3">
                    <label for="img" class="form-label">Image</label>
                    <input type="file" name="img" id="img" class="form-control">
                    @error('img')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <!-- Destination Field -->
                <div class="mb-3">
                    <label for="destination" class="form-label">Destination</label>
                    <input type="text" name="destination" id="destination" class="form-control" value="{{ old('destination', $package->destination) }}">
                    @error('destination')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Price Field -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $package->price) }}" step="0.01">
                    @error('price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Duration Field -->
                <div class="mb-3">
                    <label for="duration" class="form-label">Duration (days)</label>
                    <input type="number" name="duration" id="duration" class="form-control" value="{{ old('duration', $package->duration) }}">
                    @error('duration')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
        
                {{-- buttons field --}}
                <div class="field">
                    <div class="field-btn">
                        <button type="button" onclick="window.history.back()" class="back-button">Back</button>
                        <button type="submit" class="add-button">Update</button>
                    </div>   
                </div>
    

            </form>
        </div>
    </div>
@endsection
