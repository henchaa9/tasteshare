@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Autorizācijas panelis') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Tu esi ielogojies!') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(function() {
        window.location.href = "/";
    }, 2000); // Redirect after 3 seconds (adjust the time as needed)
</script>
@endsection
