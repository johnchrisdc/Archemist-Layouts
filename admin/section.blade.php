<html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <title>{{config('app.name')}} - Section</title>

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
            <a href="../admin" class="breadcrumb grey-text">Home</a>
            <a href="#" class="breadcrumb black-text">Sections</a>
          </div>
        </div>
      </nav>
    </br></br>
      <div class="row">
        @if (count($errors) > 0)
          @foreach ($errors->all() as $error)
              <script>
                Materialize.toast('{{ $error }}', 3000, 'rounded');
              </script>

          @endforeach
        @endif
        <a href="#add_section">
          <div class="col s12 m4">
            <div class="card small white waves-effect">
              <div class="valign-wrapper " style="height: 100%">
                  <div class="valign" style="width:100%">

                    <div class="center-align">
                        <img src="../images/add (1).png"/>
                      </br>
                        <div class="black-text menu-item">Add section</div>
                        <div class="grey-text submenu-item">Create a new section</div>
                    </div>

                  </div>
              </div>
            </div>
          </div>
        </a>

        @if (count($sections) > 0)
          @foreach ($sections as $section)
              <a href="section/{{$section->id}}">
                <div class="col s12 m4">
                  <div class="card small waves-effect {{ ($section->is_active == 1) ? 'white' : 'grey lighten-2' }}">
                    <div class="valign-wrapper " style="height: 100%">
                        <div class="valign" style="width:100%">

                          <div class="center-align">
                              <img src="../images/star.png"/>
                              <div class="black-text menu-item">{{$section->grade_level}} {{$section->name}}</div>
                              <div class="grey-text submenu-item">{{ $section->teacher_info != null ? $section->teacher_info->name : ''}}</div>
                          </div>

                        </div>
                    </div>
                  </div>
                </div>
              </a>
          @endforeach
        @endif
    </div>
    </div>




    <div id="add_section" class="modal">
        <div class="modal-content">
          <h5>Create new section</h5>
          <div class="row">
            <form class="col s12" action="../admin/section/add" method="POST">
              {{ csrf_field() }}
              <div class="row">
                <div class="input-field col s4">
                  <input id="grade_level" name="grade_level" type="text" class="validate" required>
                  <label for="grade_level">Grade Level</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s8">
                  <input id="name" type="text" name="name" class="validate" required>
                  <label for="name">Name</label>
                </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn waves-effect waves-light" type="submit" name="action">Create
          </button>
        </div>
        </form>
      </div>
    </body>
  </html>
