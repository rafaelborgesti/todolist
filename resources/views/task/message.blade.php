@if ( $errors->any() )
<div class="row">
    <div class="col-md-12">
        <div align="center" class="alert p-0 alert-danger" role="alert">
            @foreach ( $errors->all() as $error )
                {{ $error }}
            @endforeach
        </div>
    </div>
</div>
@endif

@if (Session::has('flash_message'))
<div class="row">
    <div class="col-md-12">
        <div align="center" class="alert p-0 {{ Session::get('flash_message')['class'] }}">
            {{ Session::get('flash_message')['message'] }}
        </div>
    </div>
</div>
@endif

