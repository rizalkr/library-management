@extends('layouts.default')

@section('title', 'Delete book')
@section('content')

    <h2>Are sure to delete this book  => {{ $book->title }}?</h2>
    <div class="mt-5">
        <a href="/book/destroy/{{ $book->id }}" class="btn btn-danger me-3">Sure</a>
        <a href="/categories" class="btn btn-primary">Cancel</a>
    </div>
@endsection
