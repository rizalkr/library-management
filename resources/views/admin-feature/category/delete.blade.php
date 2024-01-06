@extends('layouts.default')

@section('title', 'Delete Category')
@section('content')
    <h2>Are sure to delete this category {{ $category->name }}?</h2>
    <div class="mt-5">
        <a href="/category/destroy/{{ $category->name }}" class="btn btn-danger me-3">Sure</a>
        <a href="/categories" class="btn btn-primary">Cancel</a>
    </div>
@endsection
