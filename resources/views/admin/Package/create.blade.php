@extends('admin.inc.main')  


{{-- @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}



@section('container')

    <div class="content">
        <div class="form-containerr">
            <h2>Add Package</h2>
            <form  class="data-form" action="{{ route('package.store') }}" method="POST" enctype="multipart/form-data" required>
                @csrf

            {{--  boostrap--}}
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="img" class="form-label">Image</label>
                    <input type="file" name="img" id="img" class="form-control">
                    @error('img')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="destination" class="form-label">Destination</label>
                    <input type="text" name="destination" id="destination" class="form-control" value="{{ old('destination') }}">
                    @error('destination')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

            
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" >
                    @error('price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

            
                <div class="mb-3">
                    <label for="duration" class="form-label">Duration (days)</label>
                    <input type="number" name="duration" id="duration" class="form-control" value="{{ old('duration') }}">
                    @error('duration')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                            
        
                <div class="field">
                    <div class="field-btn">
                        <button type="button" onclick="window.history.back()" class="back-button">Back</button>
                        <button type="submit" class="add-button">Add</button>
                    </div>   
                </div>
    

            </form>
        </div>
    </div>
@endsection
