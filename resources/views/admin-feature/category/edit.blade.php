@extends('layouts.default')
@section('title', 'Categories')
@section('content')
    <h1>Edit Category</h1>
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
        <form action="/category/edit/{{ $category->id }}" method="post">
            @csrf
            @method('PUT')
            <div>
                <input type="text" name="name" id="name" class="form-control" placeholder="Categor Name"
                    value="{{ $category->name }}">
            </div>
            <div class="mt-3">
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </form>
    </div>
@endsection
