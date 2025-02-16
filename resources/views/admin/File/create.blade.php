@extends('admin.inc.main')
@section('container')


<main class="container my-3">
    <a href="{{route('file.index')}}" class="btn btn-primary my-3">Back</a>
    <form action="{{route('file.store')}}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation shadow p-3" novalidate>
      @csrf


        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">File create</h5>
                <a href="" class="btn btn-primary">Manage</a>
            </div>

            <div class="card-body">
               
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Title</label>
                        <input type="text" name="title" class="form-control" id="basic-default-fullname" />
                        {{-- added --}}
                        <input type="text" class="form-control d-none" id="validationCustom03" name="user_id"  value="{{auth()->user()->id}}" required >
                    </div>


                    <div class="mb-3">
                        <label class="form-label" for="basic-default-company">Image</label>
                        <input type="file" name="img" class="form-control" id="basic-default-company" />
                    </div>

                    <button class="btn btn-primary" type="submit" name="submit">Submit form</button>

                  
              
            </div>
        </div>

    </form>
</main>


@endsection