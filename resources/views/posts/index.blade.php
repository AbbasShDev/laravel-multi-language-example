@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-bottom-0 ">{{ __('posts.posts') }}</div>


                <div class="table-responsive">
                    <table class="table table-bordered order-left-0 border-right-0 m-0">
                        <thead class="">
                        <tr>
                            <th class="border-bottom-0">{{ __('posts.id') }}</th>
                            <th class="border-bottom-0">{{__('posts.title')}}</th>
                            <th class="border-bottom-0 text-center"
                                style="width: 70px !important;">{{__('posts.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td class="text-center">{{ $post->id }}</td>
                                <td><a href="{{ route('posts.show',  $post) }}">{{ $post->title }}</a></td>
                                <td class="text-center">
                                    <a href="{{ route('posts.edit',  $post) }}"><i
                                            class="fa fa-edit fa-fw text-info"></i></a>
                                    <a
                                        href="javascript:void(0)"
                                        onclick="if (confirm('Are you sure?')){ document.getElementById('delete-post-{{ $post->id }}').submit() }"
                                    >
                                        <i class="fa fa-trash fa-fw text-danger"></i>
                                    </a>

                                    <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                          id="delete-post-{{ $post->id }}" style="display: none !important;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
