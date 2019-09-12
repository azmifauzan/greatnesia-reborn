<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Greatnesia.id - Login</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
  <form class="form-signin" method="POST" action="/admin/login">
  {{ csrf_field() }}
  <h1 class="h3 mb-3 font-weight-normal">Greatnesia</h1>
  @if(isset($alert))
  <div class="alert alert-danger">
    <div class="alert-title">{{$alert}}</div>
  </div>
  @endif
  @if($errors->any())
  <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
        <div class="alert-title">{{$error}}</div>
      @endforeach
  </div>
  @endif
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2019 Greatnesia</p>
</form>
</body>
</html>