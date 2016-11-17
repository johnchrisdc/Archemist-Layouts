<html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <title>{{config('app.name')}} - Admin</title>
      <style>
        .small {
          width: 100%
        }
      </style>
    </head>

    <body class="grey lighten-3">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/bin/materialize.js"></script>

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
          <a href="" class="brand-logo">{{config('app.name')}}</a>
          <ul class="right">
            <li><a class="dropdown-button" href="#!" data-activates="dropdown1">{{ Auth::user()->name }}<i class="material-icons right">arrow_drop_down</i></a></li>
          </ul>
        </div>
      </nav>
    </div>
  </br>
    <div class="container">
      <div class="row">

        <a>
          <div class="col s12 m4">
            <div class="card small white waves-effect">
              <div class="valign-wrapper " style="height: 100%">
                  <div class="valign " style="width:100%">

                    <div class="center-align">
                        <img src="images/user.png"/>
                        <div>
                            <span class="black-text menu-item">Account</span>
                        </div>
                        <div class="grey-text submenu-item">Manage your account</div>
                    </div>

                  </div>
              </div>
            </div>
          </div>
        </a>

        <a>
          <div class="col s12 m4">
            <div class="card small white waves-effect">
              <div class="valign-wrapper " style="height: 100%">
                  <div class="valign" style="width:100%">

                    <div class="center-align">
                        <img src="images/agenda.png"/>
                        <div class="black-text menu-item">Cluster</div>
                        <div class="grey-text submenu-item">Manage Cluster</div>
                    </div>

                  </div>
              </div>
            </div>
          </div>
        </a>

        <a href="admin/teacher">
          <div class="col s12 m4">
            <div class="card small white waves-effect">
              <div class="valign-wrapper " style="height: 100%">
                  <div class="valign" style="width:100%">

                    <div class="center-align">
                        <img src="images/users.png"/>
                        <div class="black-text menu-item">Teachers</div>
                        <div class="grey-text submenu-item">Manage teachers</div>
                    </div>

                  </div>
              </div>
            </div>
          </div>
        </a>

        <a href="admin/student">
          <div class="col s12 m4">
            <div class="card small white waves-effect">
              <div class="valign-wrapper " style="height: 100%">
                  <div class="valign" style="width:100%">

                    <div class="center-align">
                        <img src="images/business.png"/>
                        <div class="black-text menu-item">Students</div>
                        <div class="grey-text submenu-item">Manage students</div>
                    </div>

                  </div>
              </div>
            </div>
          </div>
        </a>

        <a href="admin/section">
          <div class="col s12 m4">
            <div class="card small white waves-effect">
              <div class="valign-wrapper " style="height: 100%">
                  <div class="valign" style="width:100%">

                    <div class="center-align">
                        <img src="images/layers.png"/>
                        <div class="black-text menu-item">Sections</div>
                        <div class="grey-text submenu-item">Manage sections</div>
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
