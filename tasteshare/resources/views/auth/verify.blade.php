@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Apstipriniet savu e-pasta adresi') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Apstiprinājuma saite ir aizsūtīta uz jūsu e-pastu.') }}
                        </div>
                    @endif

                    {{ __('Pirms nākamajiem soļiem, lūdzu, pārbaudiet, vai esat saņēmis apstiprinājuma e-pastu.') }}
                    {{ __('Ja nesaņēmāt e-pastu') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Spiediet šeit pēc vēlviena pieprasījuma') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
