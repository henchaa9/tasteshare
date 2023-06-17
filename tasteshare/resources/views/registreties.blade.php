<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Reģistrācija</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Muli'>

</head>
<body>
<div class="container-fluid">
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
            <span class="navbar-brand mb-0 h1">TasteShare</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Sākums <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
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
                <button class="btn btn-light ml-4 my-sm-0" type="submit">Ielogoties</button>
                <button class="btn btn-light ml-2 my-sm-0" type="submit">Reģistrēties</button>
                </form>
                
            </div>
        </nav> 
    </div> 
<div class="pt-5">
  <h1 class="text-center">Reģistrācija</h1>
  
<div class="container">
    <div class="row">
      <div class="col-md-5 mx-auto">
        <div class="card card-body">  
          <form id="submitForm" action="/register" method="post" data-parsley-validate="" data-parsley-errors-messages-disabled="true" novalidate="" _lpchecked="1"><input type="hidden" name="_csrf" value="7635eb83-1f95-4b32-8788-abec2724a9a4">
              <!-- Vārds -->
              <div class="form-group required">
                  <label class="form-label" for="registerName">Vārds</label>
                  <input type="text" id="registerName" class="form-control" />

              </div>

              <!-- Uzvārds -->
              <div class="form-group required">
                  <label class="form-label" for="registerLastName">Uzvārds</label>
                  <input type="text" id="registerLastName" class="form-control" />

              </div>

              <!-- Lietotājvārds -->
              <div class="form-outline mb-4">
                  <label class="form-label" for="registerUsername">Lietotājvārds</label>
                  <input type="text" id="registerUsername" class="form-control" />

              </div>

              <!-- Epasts -->
              <div class="form-outline mb-4">
                <label class="form-label" for="registerEmail">Epasts</label>
                  <input type="email" id="registerEmail" class="form-control" />

              </div>

              <!-- Parole -->
              <div class="form-outline mb-4">
                  <label class="form-label" for="registerPassword">Parole</label>
                  <input type="password" id="registerPassword" class="form-control" />
              </div>

              <!-- Atkārtot paroli -->
              <div class="form-outline mb-4">
                  <label class="form-label" for="registerRepeatPassword">Atkārtot paroli</label>
                  <input type="password" id="registerRepeatPassword" class="form-control" />

              </div>


              <!-- Poga -->
              <button type="submit" class="btn btn-primary btn-block mb-3">Reģistrēties</button>
              </form>
              <p class="small-xl pt-3 text-center">
              <span class="text-muted">Esi jau reģistrējies?</span>
              <a href="/ielogoties">Pieslēdzies</a>
              </p>  
          </div>
        </div>
      </div>
  </div>
</body>
</html>
