@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-bottom-0 ">{{ $post->title }}</div>
                <div class="card-body">{{ $post->body }}</div>
            </div>
        </div>
    </div>
@endsection
