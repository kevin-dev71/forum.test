@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center text-muted">{{ __('Foros') }}</h1>

            @include('partials.forums.search')

            <hr />

            @forelse($forums as $forum)
                <div class="card">
                    <div class="card-header card-header-forum">
                        <a href="/forums/{{ $forum->slug }}" >{{ $forum->name }}</a>
                        <span class="pull-right">
                            {{ __("Posts") }}: {{ $forum->posts_count }},
                            {{ __("Respuestas") }}: {{ $forum->replies_count }}
                        </span>
                    </div>

                    <div class="card-body">
                        {{ $forum->description }}
                    </div>
                </div>
                <br />
            @empty
                <div class="alert alert-danger">
                    {{ __('No hay ningun foro en este momento') }}
                </div>
            @endforelse

            @if($forums->count())
                {{ $forums->links() }}
            @endif

            <h2>{{ __("Añadir un nuevo foro") }}</h2>
            <hr />

            @include('partials.errors')

            <form method="POST" action="/forums">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name" class="col-md-12 control-label">{{ __("Nombre") }}</label>
                    <input id="name" class="form-control" name="name" value="{{ old('name') }}"/>
                </div>
                <div class="form-group">
                    <label for="description" class="col-md-12 control-label">{{ __("Descripción") }}</label>
                    <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>
                </div>
                <button type="submit" name="addForum" class="btn btn-default">
                    {{ __("Añadir foro") }}
                </button>
            </form>
        </div>
    </div>
@endsection