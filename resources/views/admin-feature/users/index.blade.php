@extends('layouts.default')
@section('title', 'Users')
@section('content')
@section('title', 'Users')
@section('content')
    <h1>User List</h1>
    <div class="mt-5 d-flex justify-content-end">
        <a href="/registered-users" class="btn btn-primary me-3">New Registered User</a>
        <a href="/user-deleted" class="btn btn-secondary">View Banned User</a>
    </div>
    <div class="mt-5">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <div class="my-5">
        <table class="table">
            <thead>
                <th>No.</th>
                <th>Username</th>
                <th>Phone</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($users as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->username }}</td>
                        <td>
                            @if ($item->phone)
                                {{ $item->phone }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="/user-detail/{{ $item->username }}">Detail</a>
                            <a class="btn btn-sm btn-danger" href="/user-delete/{{ $item->username }}">Ban</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@endsection
