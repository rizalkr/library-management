@extends('layouts.default')
@section('title', 'Categories')
@section('content')
    <h1>Add New Category</h1>
    <div class="mt-5 w-50">
        @if ($errors->any())
            <div class="alert alert-info">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('category.store')}}" method="post">
            @csrf
            <div>
                <input type="text" name="name" id="name" class="form-control" placeholder="Category Name">
            </div>
            <div class="mt-3">
                <button class="btn btn-success" type="submit">Save</button>
            </div>
        </form>
    </div>
@endsection
