@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Jauna recepte | TasteShare</title>
        <!-- bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    </head>
    <body class="antialiased">
    <div class="container">
        <h2>Pievienot jaunu recepti</h2>
        <a>*Obligātie lauki</a>
        <form method="post" action="{{ route('saglabatRecepti') }}">
            {{ csrf_field() }}
            <label class="d-block mt-3 font-weight-bolder" for="nosaukums" style="font-size:1.1rem">Nosaukums*</label>
            <input class="mb-4 w-50 p-1" type="text" name="nosaukums" id="" required>
            
            <label class="d-block font-weight-bolder" for="apraksts" style="font-size:1.1rem">Apraksts*</label>
            <textarea class="mb-4 p-1 w-50" name="apraksts" id="" cols="20" rows="10" required></textarea>

            <label class="d-block font-weight-bolder" for="sagatavosanasLaiks" style="font-size:1.1rem">Sagatavošanās laiks (min.)*</label>
            <input class="mb-4 p-1" type="number" name="sagatavosanasLaiks" id="" required>

            <label class="d-block font-weight-bolder" for="pagatavosanasLaiks" style="font-size:1.1rem">Pagatavošanas laiks (min.)*</label>
            <input class="mb-4 p-1" type="number" name="pagatavosanasLaiks" id="" required>

            <label class="d-block font-weight-bolder" for="porcijas" style="font-size:1.1rem">Porciju skaits*</label>
            <input class="mb-4 p-1" type="number" name="porcijas" id="" required>

            <label class="d-block font-weight-bolder" for="pagatavosana" style="font-size:1.1rem">Pagatavošana*</label>
            <textarea class="mb-4 p-1 w-50 d-block" name="pagatavosana" id="" cols="20" rows="10" required></textarea>

            <label class="d-block font-weight-bolder" for="foto" style="font-size:1.1rem">Saite uz attēlu</label>
            <input class="mb-4 p-1 d-block w-50" type="url" name="foto" id="">

            <label class="d-block font-weight-bolder" for="ispublic" style="font-size:1.1rem">Privāts/Publisks ieraksts</label>
            <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="ispublic" name="ispublic" checked>
            <label class="custom-control-label" for="ispublic"></label>
            </div>
    
            <div class="mt-5">
    <p>
        <button type="submit" class="btn btn-primary d-inline mb-3">Pievienot</button>
        <button type="reset" class="btn btn-danger d-inline mb-3">Dzēst</button>
    </p>
</div>
    </form>
</div>

<!-- Include Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</body>
</html>
@endsection