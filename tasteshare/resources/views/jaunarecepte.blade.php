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
    <div class="container-fluid sticky-top">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <span class="navbar-brand mb-0 h1">TasteShare</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Sākums <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="" role="button" data-toggle="dropdown" aria-expanded="false">
                    Receptes
                    </a>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Jauna recepte</a>
                    <a class="dropdown-item" href="#">Manas receptes</a>
                    <a class="dropdown-item" href="#">Mīļākas receptes</a>
                    </div>
                </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Pelmeņu zupa..." aria-label="Search">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Meklēt</button>
                </form>
                <a class="btn btn-light ml-4 my-sm-0" type="button" href="login">Ielogoties</a>
                <a class="btn btn-light ml-2 my-sm-0" type="button" href="register">Reģistrēties</a>
            </div>
        </nav> 
    </div> 
    <div class="container">
        <form method="post" action="{{ route('saglabatRecepti') }}">
            {{ csrf_field() }}
            <label class="d-block mt-3 font-weight-bolder" for="nosaukums" style="font-size:1.1rem">Nosaukums</label>
            <input class="mb-4 w-50 p-1" type="text" name="nosaukums" id="" required>
            
            <label class="d-block font-weight-bolder" for="apraksts" style="font-size:1.1rem">Apraksts</label>
            <textarea class="mb-4 p-1 w-50" name="apraksts" id="" cols="20" rows="10" required></textarea>

            <label class="d-block font-weight-bolder" for="sagatavosanasLaiks" style="font-size:1.1rem">Sagatavošanās laiks (min)</label>
            <input class="mb-4 p-1" type="number" name="sagatavosanasLaiks" id="" required>

            <label class="d-block font-weight-bolder" for="pagatavosanasLaiks" style="font-size:1.1rem">Pagatavošanas laiks (min)</label>
            <input class="mb-4 p-1" type="number" name="pagatavosanasLaiks" id="" required>

            <label class="d-block font-weight-bolder" for="porcijas" style="font-size:1.1rem">Porciju skaits</label>
            <input class="mb-4 p-1" type="number" name="porcijas" id="" required>

            <label class="d-block font-weight-bolder" for="pagatavosana" style="font-size:1.1rem">Pagatavošana</label>
            <textarea class="mb-4 p-1 w-50 d-block" name="pagatavosana" id="" cols="20" rows="10" required></textarea>

            <label class="d-block font-weight-bolder" for="foto" style="font-size:1.1rem">Saite uz attēlu</label>
            <input class="mb-4 p-1 d-block w-50" type="url" name="foto" id="">

            <button type="submit" class="btn btn-primary d-inline mb-3">Pievienot</button>
            <button type="reset" class="btn btn-danger d-inline mb-3">Dzēst</button>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    </body>
</html>