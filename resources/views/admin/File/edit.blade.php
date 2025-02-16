@extends('admin.inc.main')
@section('container')


<main class="container my-3">
    <a href="{{route('file.index')}}" class="btn btn-primary my-3">Back</a>
    {{-- <form action="{{route('file.store')}}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation shadow p-3" novalidate> --}}
    <form action="{{ route('file.update', $file->id) }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation shadow p-3" novalidate>
      @csrf
      @method('PUT')


        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">File create</h5>
                <a href="" class="btn btn-primary">Manage</a>
            </div>
            
            <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Title</label>
                        <input type="text" name="title" class="form-control" id="basic-default-fullname" value="{{$file->title}}"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-company">Image</label>
                        <input type="file" name="img" class="form-control" id="basic-default-company" >
                    </div>

                    <button class="btn btn-primary" type="submit" name="submit">Submit form</button>

                    {{-- value="{{$file->img}}" --}}

            </div>
      
        </div>

    </form>
</main>


@endsection