@extends('layouts.default')
@section('title', 'Categories')
@section('content')
    <h1>List Category</h1>
    <div class="mt-5 d-flex justify-content-end">
        <a href="category/add" class="btn btn-primary me-3">Add Data</a>
        <a href="category/deleted" class="btn btn-secondary">View Deleted Data</a>
    </div>
    <div class="my-5">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <th>No. </th>
                <th>Name</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="/category/edit/{{$item->id}}">Update</a>
                            <a class="btn btn-sm btn-danger" href="/category/delete/{{$item->id}}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
