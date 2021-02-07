@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header border-bottom-0 ">Posts</div>


                        <div class="table-responsive">
                            <table class="table table-bordered order-left-0 border-right-0 m-0">
                                <thead class="">
                                <tr>
                                    <th class="border-bottom-0">ID</th>
                                    <th class="border-bottom-0">Title</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td class="text-center">{{ $post->id }}</td>
                                        <td><a href="{{ route('posts.show', ['post' => $post, 'language' => app()->getLocale()]) }}">{{ $post->title }}</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection
