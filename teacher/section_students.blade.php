<html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../../css/materialize.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <title>{{config('app.name')}} - {{$section->grade_level}} {{$section->name}}</title>

    </head>

    <body class="grey lighten-3">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="../../js/bin/materialize.js"></script>

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
          <a href="../../admin" class="brand-logo">{{config('app.name')}}</a>
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
            <a href="../../teacher" class="breadcrumb grey-text">Home</a>
            <a href="../sections" class="breadcrumb grey-text">Sections</a>
            <a href="#" class="breadcrumb black-text">{{$section->grade_level}} - {{$section->name}}</a>
          </div>
        </div>
      </nav>

    </br></br>
      <div class="black-text menu-item" style="font-size: 20px;">{{$section->grade_level}} - {{$section->name}}</div>
      <div class="black-text sub-menu-item">{{ $section->teacher_info != null ? $section->teacher_info->name : 'No teacher assigned'}}</div>
      </br>
      <div class="black-text menu-item">Students</div>
      <div class="row">
        @if (count($errors) > 0)
          @foreach ($errors->all() as $error)
              <script>
                Materialize.toast('{{ $error }}', 3000, 'rounded');
              </script>

          @endforeach
        @endif

        @if (count($students) > 0)
          @foreach ($students as $student)
              <a >
                <div class="col s12 m4">
                  <div class="card small white waves-effect">
                    <div class="valign-wrapper " style="height: 100%">
                        <div class="valign" style="width:100%">

                          <div class="center-align">
                              <img src="../../images/id-card.png"/>
                              <div class="black-text menu-item">{{$student->name}}</div>
                              <div class="grey-text submenu-item">{{$student->student_id}}</div>
                            </br>
                            @if (!$student->is_confirmed)
                              <a href="#modal_confirm_{{$student->id}}" class="waves-effect waves-light btn green lighten-1">Confirm</a>
                            @endif
                          </div>

                        </div>
                    </div>
                  </div>
                </div>
              </a>

              <div id="modal_confirm_{{$student->id}}" class="modal">
                  <div class="modal-content">
                    <h5>Confirm student</h5>
                    <div class="row">
                      <form class="col s12" action="../../teacherconfirmstudent/{{$student->student_id}}" method="POST">
                        {{ csrf_field() }}
                        <p>Confirm that {{$student->name}} from {{$section->grade_level}} - {{$section->name}} is your student?</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn waves-effect waves-light green" type="submit" name="action">Confirm
                    </button>
                  </div>
                  </form>
                </div>
          @endforeach
          @else
          <div class="black-text sub-menu-item">No students found</div>
        @endif
    </div>
    </div>

    <div id="edit_section" class="modal">
        <div class="modal-content">
          <h5>Edit section</h5>
          <div class="row">
            <form class="col s12" action="../sectionedit/{{$section->id}}" method="POST">
              {{ csrf_field() }}
              <div class="row">
                <div class="input-field col s4">
                  <input value="{{$section->grade_level}}" id="grade_level" name="grade_level" type="text" class="validate" required>
                  <label for="grade_level">Grade Level</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s8">
                  <input value="{{$section->name}}" id="name" type="text" name="name" class="validate" required>
                  <label for="name">Name</label>
                </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn waves-effect waves-light" type="submit" name="action">Update
          </button>
        </div>
        </form>
      </div>

      <div id="modal_delete" class="modal">
          <div class="modal-content">
            <h5>Delete user</h5>
            <div class="row">
              <form class="col s12" action="../sectionedit/{{$section->id}}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="delete">
                <p>Are you sure you want to delete {{$section->grade_level}} {{$section->name}} ?</p>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn waves-effect waves-light red" type="submit" name="action">DELETE
            </button>
          </div>
          </form>
        </div>


    </body>
  </html>
