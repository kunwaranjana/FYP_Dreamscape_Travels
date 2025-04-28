@extends('admin.inc.main')  
@section('container')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <div class="table-container">
       <div class="table-head">
        <h2>Package Details</h2>
        <a href="{{ route('package.create') }}" class="add-button">Add Package</a>
       </div>

        {{-- <table class="table table-secondary table-hover table-bordered table-sm table-responsive-sm"> --}}
        <table>
        <thead>
            <tr>
                <th>SN</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Destination</th>
                <th>Price</th>
                <th>Duration</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            {{-- yo packages xai tya contoller ma index() ma variable ra compact ma packages lekeko vayera yeh tai lekeko 
            ani as pachi ko package xai j name diye ni vo --}}
            @foreach($packages as $package)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $package->title }}</td>
                    <td class="truncate-description">{{ $package->description }}</td>
                    <td><img src="{{ asset('uploads/' . $package->img) }}" width="100"></td>
                    <td>{{ $package->destination }}</td>
                    <td>Rs {{ $package->price }}</td>
                    <td>{{ $package->duration }} days</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('package.edit', $package->id) }}" class="edit-btn">Edit</a>
                            <form action="{{ route('package.destroy', $package->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dlt-btn" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
       </table>
       {{-- for pagination --}}
       <div class="pagination-wrapper">
        {{ $packages->links() }}
        </div>

        {{-- <div class="pagination-section">
            <div class="result-text">
                Showing {{ $packages->firstItem() }} to {{ $packages->lastItem() }} of {{ $packages->total() }} results
            </div> --}}
        
            {{-- <div class="custom-pagination">
                {{ $packages->links() }}
            </div>
        </div> --}}




        </div>
        

        
        
        
    </div> 

@endsection






