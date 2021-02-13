@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header border-bottom-0 ">{{ __('posts.create_post') }}</div>

                    <div class="card-body">

                        <form action="{{ route('posts.store') }}" method="POST">
                            @csrf

                            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                @foreach(config('locales.languages') as $key => $val)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}" id="{{ $key }}-tab" data-toggle="tab" href="#{{ $key }}" role="tab" aria-controls="{{ $key }}" aria-selected="true">{{ __('posts.'.$val['name']) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                @foreach(config('locales.languages') as $key => $val)
                                    <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : '' }}" id="{{ $key }}" role="tabpanel" aria-labelledby="{{ $key }}-tab">
                                        <div class="form-group">
                                            <label for="title.{{$key}}">{{ __('posts.title') }} ({{ $key }})</label>
                                            <input type="text" name="title[{{ $key }}]" id="title.{{$key}}"  class="form-control" value="{{ old('title'.$key) }}">
                                            @error('title'.$key)
                                            <span>{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="body.{{$key}}">{{ __('posts.body') }} ({{ $key }})</label>
                                            <textarea name="body[{{ $key }}]" id="body.{{ $key }}" class="form-control" >{{ old('body'.$key) }}</textarea>
                                            @error('title'.$key)
                                            <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                            <div class="form-group">
                                <input type="submit" class="btn btn-info text-light" value="{{ __('posts.create') }}">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
