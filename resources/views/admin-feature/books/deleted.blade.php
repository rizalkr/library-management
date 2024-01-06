@extends('layouts.default')

@section('title','Deleted Category')
@section('content')
    <h1>Deleted Category List</h1>
    <div class="mt-5 d-flex justify-content-end">
        <a href="/books" class="btn btn-primary me-3">Back</a>
    </div>
    <div class="mt-5">
        @if (session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
        @endif
    </div>
    <div class="my-5">
        <table class="table">
            <thead>
                <th>No.</th>
                <th>Code</th>
                <th>Title</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($deletedBooks as $item)
                    <tr>
                       <td>{{$loop ->iteration}}</td> 
                       <td>{{$item ->book_code}}</td>
                       <td>{{$item ->title}}</td>
                       <td>
                            {{-- <a href="/category-deleted/{{$item->name}}">Delete</a> --}}
                            <a class="btn btn-sm btn-primary" href="/book/restore/{{$item->id}}">Restore</a>
                       </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection