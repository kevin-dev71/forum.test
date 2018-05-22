<form method="POST" action="/forums/search">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-xs-12">
            <div class="input-group input-group-lg">
                <input type="text" name="search" value="{{ session('search') }}" class="form-control" />
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-primary">{{ __("Buscar") }}</button>
                    <a href="{{ route('forums.clear_search') }}" class="btn btn-default">
                        {{ __("Limpiar") }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>