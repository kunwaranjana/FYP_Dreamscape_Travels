@extends('admin.inc.main')

@section('container')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="table-container">
    <div class="table-head">
        {{-- <h2>User List</h2> --}}
        <span class="user-count-box">Total Users: {{ $totalUsers }}</span>
        {{-- @if ($users->onFirstPage())
            <span class="user-count-box">Total Users: {{ $totalUsers }}</span>
        @endif --}}
    </div>

    <table>
        <thead>
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Role</th>
                <th>Registered At</th>
                {{-- <th>Action</th> --}}
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->contact ?? 'N/A' }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    <td>
                        {{-- <div class="actions">
                            <a href="#" class="edit-btn">Edit</a>
                            <form action="#" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dlt-btn" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-wrapper">
        {{ $users->links() }}
        </div> 
</div>

@endsection
