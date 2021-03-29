
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Aking | </title>


  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">


  <script src="js/jquery.min.js"></script>
</head>

<body style="background:#F7F7F7;">

  <div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
      <div id="login" class="animate form">
        <section class="login_content">
          <form action="{{ url('CabangLogin') }}" method="POST">
            <h1>Login Form</h1>
            <div>
              <input type="text" name="cabang_username" class="form-control" placeholder="Username" required />
            </div>
            <div>
              <input type="password" name="cabang_password" class="form-control" placeholder="Password" required />
            </div>
            <div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button class="btn btn-default" href="index.html">Log in</button>
              <!-- <a class="reset_pass" href="#">Lost your password?</a> -->
            </div>
            <div class="clearfix"></div>
            <div class="separator">
            </div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
    </div>
  </div>

</body>

</html>
