<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Pieslēgšanās</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Muli'>

</head>
<body>

<div class="pt-5">
  <h1 class="text-center">Pieslēgšanās</h1>
  
<div class="container">
                <div class="row">
                    <div class="col-md-5 mx-auto">
                        <div class="card card-body">
                                                    
                            <form id="submitForm" action="/login" method="post" data-parsley-validate="" data-parsley-errors-messages-disabled="true" novalidate="" _lpchecked="1"><input type="hidden" name="_csrf" value="7635eb83-1f95-4b32-8788-abec2724a9a4">
                                <div class="form-group required">
                                    <lSabel for="username">Lietotājvārds/e-pasts</lSabel>
                                    <input type="text" class="form-control text-lowercase" id="username" required="" name="username" value="">
                                </div>                    
                                <div class="form-group required">
                                    <label class="d-flex flex-row align-items-center" for="password">Parole 
                                        <a class="ml-auto border-link small-xl" href="/forget-password">Aizmirsi paroli?</a></label>
                                    <input type="password" class="form-control" required="" id="password" name="password" value="">
                                </div>
                                <div class="form-group mt-4 mb-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="remember-me" name="remember-me" data-parsley-multiple="remember-me">
                                        <label class="custom-control-label" for="remember-me">Atcerēties</label>
                                    </div>
                                </div>
                                <div class="form-group pt-1">
                                    <button class="btn btn-primary btn-block" type="submit">Pieslēgties</button>
                                </div>
                            </form>
                            <p class="small-xl pt-3 text-center">
                                <span class="text-muted">Neesi biedrs?</span>
                                <a href="/registreties">Reģistrējies</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
</div>
<!-- partial -->
  
</body>
</html>
