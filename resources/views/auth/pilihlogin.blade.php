
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
          <form>
            <h1>Login As</h1>
            <form>
              <style >
                .pic2, #change:hover .pic1{
                   display:none
                }
                .pic1, #change:hover .pic2{
                   display:block
                }
              </style>
            <div class="form-group col-md-6 col-sm-6 col-xs-12">
              <a href="{{ url ('pusat') }}" id="change">
                      <img src="images/pusat.jpg" class="pic1 img-circle img-responsive center-block"><img src="images/pusat1.jpg" class="pic2 img-circle img-responsive center-block"><br>
                    </a>
                  </div>
                  <div class="form-group col-md-6 col-sm-6 col-xs-12">
              <a href="{{ url ('cabang') }}" id="change">
                    <img src="images/cabang.jpg" class="pic1 img-circle img-responsive center-block"><img src="images/cabang1.jpg" class="pic2 img-circle img-responsive center-block"><br>
                  </a>
                </div>
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
