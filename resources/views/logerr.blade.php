<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="modal-header">
      <div class="row">
        <div class="col-sm-12">
          <h1>
			{{$status}}
          </h1>
        </div>
      </div>
    </div>
  </div>
  <script>
  setTimeout(function(){ window.location.href='{{URL::to("/logout")}}'; }, 4000);
  </script>
