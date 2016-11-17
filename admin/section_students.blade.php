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
            <a href="../../admin" class="breadcrumb grey-text">Home</a>
            <a href="../section" class="breadcrumb grey-text">Sections</a>
            <a href="#" class="breadcrumb black-text">{{$section->grade_level}} - {{$section->name}}</a>
          </div>
        </div>
      </nav>
    </br></br>
      <div class="black-text menu-item" style="font-size: 20px;">{{$section->grade_level}} - {{$section->name}}</div>
      <div class="black-text sub-menu-item">{{ $section->teacher_info != null ? $section->teacher_info->name : 'No teacher assigned'}}</div>
      <a href="#edit_section" class="waves-effect waves-light btn accent-3">Edit</a>
      @if ($section->is_active == 1)
        <a href="#modal_delete" class="waves-effect waves-light btn red lighten-1">Set as inactive</a>
      @else
        <a href="#modal_delete" class="waves-effect waves-light btn green lighten-1">Set as active</a>
      @endif
      </br></br>
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

                              <div class="grey-text submenu-item">
                                @if($student->is_confirmed == 0)
                                - Pending
                                @endif
                              </div>
                              <div class="grey-text submenu-item">{{$student->student_id}}</div>

                            </br>
                            <a href="#modal_remove_{{$student->id}}" class="waves-effect waves-light btn red lighten-1">Remove</a>
                          </div>

                        </div>
                    </div>
                  </div>
                </div>
              </a>

              <div id="modal_remove_{{$student->id}}" class="modal">
                  <div class="modal-content">
                    <h5>Remove student</h5>
                    <div class="row">
                      <form class="col s12" action="../../admin/sectionremovestudent/{{$section->id}}/{{$student->student_id}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete">
                        <p>Are you sure you want to remove student {{$student->name}} from section {{$section->name}} ?</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn waves-effect waves-light red" type="submit" name="action">DELETE
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
            <h5>Change status</h5>
            <div class="row">
              <form class="col s12" action="../sectionedit/{{$section->id}}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="delete">
                <p>Are you sure you want to change status of {{$section->grade_level}} {{$section->name}} ?</p>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn waves-effect waves-light red" type="submit" name="action">Change
            </button>
          </div>
          </form>
        </div>

        <div id="inactive_modal" class="modal modal-fixed-footer">
          <div class="modal-content">
            <h4>Inactive</h4>
            <p>This section is inactive, some functionalities are disabled</p>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Dismiss</a>
          </div>
        </div>
        @if ($section->is_active == 0)
          <script>
          $(document).ready(function(){
            // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
            $('#inactive_modal').modal('open');

          });
          </script>
        @endif

    </body>
  </html>
