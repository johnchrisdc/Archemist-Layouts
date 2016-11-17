<!DOCTYPE html>
<html lang="en">
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/bin/materialize.js"></script>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>{{config('app.name')}} - Login</title>

    <style>
    html, body {
        overflow: auto;
        height: 100%;
        font-family: 'Open Sans', sans-serif;
    }
    </style>

</head>
<body>
  <nav>
    <div class="nav-wrapper">
      <a href="" class="brand-logo">
          {{config('app.name')}}
      </a>
    </div>
  </nav>
  <div class="container">

    <div class="valign-wrapper" style="height:100%;">
        <div class="valign" style="width:100%">

          <div class="center-align">
            <div class="row">
              <div class="col s12 m6 offset-m3">
                <div class="card-panel white">
                  <div class="row">
                   <form class="col s12" method="POST" action="{{ url('/login') }}">
                     {{ csrf_field() }}
                     <div class="row">
                       <div class="input-field col s12">
                         <input placeholder="Username" id="username" name="username" type="text" class="validate">
                       </div>
                       @if ($errors->has('username'))
                           <span class="help-block">
                               <strong>{{ $errors->first('username') }}</strong>
                           </span>
                       @endif
                     </div>
                     <div class="row">
                       <div class="input-field col s12">
                         <input placeholder="Password" id="password" name="password" type="password" class="validate">
                       </div>
                       @if ($errors->has('password'))
                           <span class="help-block">
                               <strong>{{ $errors->first('password') }}</strong>
                           </span>
                       @endif
                     </div>
                     <button class="btn waves-effect waves-light" type="submit" name="action">Log in
                    </button>
                   </form>
                 </div>


                </div>
              </div>
            </div>
          </div>

        </div>
    </div>

  </div>
</body>
</html>
