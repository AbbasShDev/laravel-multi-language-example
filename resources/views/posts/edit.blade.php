@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-bottom-0 ">{{ __('posts.edit_post') }}</div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="m-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('posts.update', $post) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                            @foreach(config('locales.languages') as $key => $val)
                                <li class="nav-item">
                                    <a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}" id="{{ $key }}-tab"
                                       data-toggle="tab" href="#{{ $key }}" role="tab" aria-controls="{{ $key }}"
                                       aria-selected="true">{{ __('posts.'.$val['name']) }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            @foreach(config('locales.languages') as $key => $val)
                                <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : '' }}" id="{{ $key }}"
                                     role="tabpanel" aria-labelledby="{{ $key }}-tab">
                                    <div class="form-group">
                                        <label for="title_{{$key}}">{{ __('posts.title') }} ({{ $key }})</label>
                                        <input type="text" name="title[{{ $key }}]" id="title_{{$key}}"
                                               class="form-control"
                                               value="{{ old('title_'.$key, $post->getTranslation('title' , $key)) }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="body_{{$key}}">{{ __('posts.body') }} ({{ $key }})</label>
                                        <textarea name="body[{{ $key }}]" id="body_{{ $key }}"
                                                  class="form-control">{{ old('body_'.$key, $post->getTranslation('body' , $key)) }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="form-group">
                            <input type="submit" class="btn btn-info text-light" value="{{ __('posts.edit') }}">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
