<html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <title>{{config('app.name')}} - Sections</title>

    </head>

    <body class="grey lighten-3">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="../js/bin/materialize.js"></script>

      <script>
          $( document ).ready(function() {
              $(".dropdown-button").dropdown();
              $('.modal').modal();
          });
      </script>

      <ul id="dropdown1" class="dropdown-content">
        <li><a href="#modal_account" >{{ Auth::user()->name }}</a></li>
        <li><a href="{{ url('/logout') }}"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form></li>
      </ul>

      <div class="navbar-fixed">
      <nav>
        <div class="nav-wrapper">
          <a href="../admin" class="brand-logo">{{config('app.name')}}</a>
          <ul class="right">
            <li><a class="dropdown-button" href="#!" data-activates="dropdown1">{{ Auth::user()->name }}<i class="material-icons right">arrow_drop_down</i></a></li>
          </ul>
        </div>
      </nav>
    </div>
  </br>
    <div class="container">
      <nav class="grey lighten-3" style="    box-shadow: none;">
        <div class="nav-wrapper">
          <div class="col s12">
            <a href="../teacher" class="breadcrumb grey-text">Home</a>
            <a href="#" class="breadcrumb black-text">Stages</a>
          </div>
        </div>
      </nav>
    </br></br>
    <div class="black-text menu-item">Stages</div>

    <div class="row">

      <a href="../teacher/questions/1">
        <div class="col s12 m4">
          <div class="card small white waves-effect">
            <div class="valign-wrapper " style="height: 100%">
                <div class="valign" style="width:100%">

                  <div class="center-align">
                      <img src="../images/1.png"/>
                      <div class="black-text menu-item">Stage 1</div>
                  </div>

                </div>
            </div>
          </div>
        </div>
      </a>

      <a href="../teacher/questions/2">
        <div class="col s12 m4">
          <div class="card small white waves-effect">
            <div class="valign-wrapper " style="height: 100%">
                <div class="valign" style="width:100%">

                  <div class="center-align">
                      <img src="../images/2.png"/>
                      <div class="black-text menu-item">Stage 2</div>
                  </div>

                </div>
            </div>
          </div>
        </div>
      </a>

      <a href="../teacher/questions/3">
        <div class="col s12 m4">
          <div class="card small white waves-effect">
            <div class="valign-wrapper " style="height: 100%">
                <div class="valign" style="width:100%">

                  <div class="center-align">
                      <img src="../images/3.png"/>
                      <div class="black-text menu-item">Stage 3</div>
                  </div>

                </div>
            </div>
          </div>
        </div>
      </a>

      <a href="../teacher/questions/4">
        <div class="col s12 m4">
          <div class="card small white waves-effect">
            <div class="valign-wrapper " style="height: 100%">
                <div class="valign" style="width:100%">

                  <div class="center-align">
                      <img src="../images/4.png"/>
                      <div class="black-text menu-item">Stage 4</div>
                  </div>

                </div>
            </div>
          </div>
        </div>
      </a>

      <a href="../teacher/questions/5">
        <div class="col s12 m4">
          <div class="card small white waves-effect">
            <div class="valign-wrapper " style="height: 100%">
                <div class="valign" style="width:100%">

                  <div class="center-align">
                      <img src="../images/5.png"/>
                      <div class="black-text menu-item">Stage 5</div>
                  </div>

                </div>
            </div>
          </div>
        </div>
      </a>

    </div>


    </div>
    </body>
  </html>
