@extends('layouts.default')
{{-- @dd($user) --}}
@section('title','Delete User')
@section('content')
<h2>Are sure to ban this user?  {{$user->username}}</h2>
<div class="mt-5">
    <a href="/user-destroy/{{$user->username}}" class="btn btn-danger me-3">Sure</a>
    <a href="/users" class="btn btn-primary">Cancel</a>
</div>
@endsection
    
