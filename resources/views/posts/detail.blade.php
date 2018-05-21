@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center text-muted">{{ __("Respuestas al debate :name" , ['name' => $post->title]) }}</h1>
            <h4>{{ __("Autor del debate") }}: {{ $post->owner->name }}</h4>

            <a href="/forums/{{ $post->forum->slug }}" class="btn btn-info pull-right">
                {{ __("Volver al foro :name", ['name' => $post->forum->name]) }}
            </a>
            <div class="clearfix"></div>
            <br />
            @forelse($replies as $reply)
                <div class="card">
                    <div class="card-header card-header-reply">
                        <p>{{ __("Respuesta de") }}: {{ $reply->author->name }}</p>
                    </div>

                    <div class="card-body">
                        <div class="col-md-8 pull-left">
                            {{ $reply->reply }}
                        </div>
                        <div class="col-md-4 pull-right">
                            @if($reply->attachment)
                                <img src="{{ $reply->pathAttachment() }}" class="img-responsive img-rounded" />
                            @endif
                        </div>
                    </div>

                    @if($reply->isAuthor())
                        <div class="panel-footer">
                            <form method="POST" action="{{ route('replies.delete' , [$reply->id]) }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" name="deleteReply" class="btn btn-danger">
                                    {{ __("Eliminar respuesta") }}
                                </button>
                            </form>
                        </div>
                    @endif

                </div>
                <br />
            @empty
                <div class="alert alert-danger">
                    {{ __('No hay ninguna Respuesta en este momento') }}
                </div>
            @endforelse

            @if($replies->count())
                {{ $replies->links() }}
            @endif

            @Logged()
            <h3 class="text-muted">{{ __("Añadir una nueva respuesta al post :name", ['name' => $post->name]) }}</h3>
            @include('partials.errors')

            <form method="POST" action="/replies" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="post_id" value="{{ $post->id }}" />

                <div class="form-group">
                    <label for="reply" class="col-md-12 control-label">{{ __("Respuesta") }}</label>
                    <textarea id="reply" class="form-control" name="reply">{{ old('reply') }}</textarea>
                </div>

                <label class="btn btn-warning" for="file">
                    <input id="file" name="file" type="file" style="display:none;">
                    {{ __("Añadir archivo") }}
                </label>

                <button type="submit" name="addReply" class="btn btn-default">{{ __("Añadir respuesta") }}</button>
            </form>
            @else
                @include('partials.login_link' , ['message' => __("Inicia sesion para responder")])
            @endLogged()
        </div>
    </div>
@endsection