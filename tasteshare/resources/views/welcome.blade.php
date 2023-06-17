<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TasteShare</title>
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
                    <a class="nav-link" href="">Sākums <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    Receptes
                    </a>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="jaunarecepte">Jauna recepte</a>
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
        <div class="row">
            <div class="col" style="width: 600px">
                <div class="card m-2">
                    <img src="https://media-cdn.tripadvisor.com/media/photo-s/0d/e8/76/f5/the-terrible-risotto.jpg" class="card-img-top" alt="..." style="height: 300px">
                    <div class="card-body">
                        <h4 class="card-title mb-1">Risotto Maskačkas stilā</h5>
                        <h5 class="card-title">Tatjana</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, cum in. Accusantium deleniti similique ad harum nemo, a ab possimus voluptatibus qui debitis beatae alias quis? Error quidem eius rerum.</p>
                        <button type="button" class="d-inline btn btn-outline-danger">Patīk</button>
                        <button type="button" class="d-inline btn btn-outline-danger ml-1">Saglabāt</button> 
                    </div>
                </div>
                <div class="card m-2">
                    <img src="https://i0.wp.com/www.garsigalatvija.lv/wp-content/uploads/2012/02/Pupinzupa_VO_3110810_1280.jpg?resize=1080%2C809" class="card-img-top" alt="..." style="height: 300px">
                    <div class="card-body">
                        <h4 class="card-title mb-1">Pupu zupa bez pupām</h5>
                        <h5 class="card-title">Bonifācijs</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, cum in. Accusantium deleniti similique ad harum nemo, a ab possimus voluptatibus qui debitis beatae alias quis? Error quidem eius rerum.</p>
                        <button type="button" class="d-inline btn btn-outline-danger">Patīk</button>
                        <button type="button" class="d-inline btn btn-outline-danger ml-1">Saglabāt</button> 
                    </div>
                </div>
            </div>
            <div class="col" style="width: 600px">
                <div class="card m-2">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHwqbFXhX6z_1csQJwwaOKsMpxsuznWqAhZw&usqp=CAU" class="card-img-top" alt="..." style="height: 300px">
                    <div class="card-body">
                        <h4 class="card-title mb-1">Pelmeņu ieberziens</h5>
                        <h5 class="card-title">Markuss</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, cum in. Accusantium deleniti similique ad harum nemo, a ab possimus voluptatibus qui debitis beatae alias quis? Error quidem eius rerum.</p>
                        <button type="button" class="d-inline btn btn-warning">Rediģēt</button>
                        <button type="button" class="d-inline btn btn-danger ml-1">Dzēst</button> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    </body>
</html>
