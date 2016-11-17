<html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../../css/materialize.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <title>{{config('app.name')}} - {{$teacher->name}}</title>

    </head>

    <body class="grey lighten-3">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="../../js/bin/materialize.js"></script>

      <script>
          $( document ).ready(function() {
              $(".dropdown-button").dropdown();
              $('.modal').modal();
              $('.datepicker').pickadate({
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 90 // Creates a dropdown of 15 years to control year
              });
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
            <a href="../admin" class="breadcrumb grey-text">Home</a>
            <a href="../teacher" class="breadcrumb grey-text">Teachers</a>
            <a href="#" class="breadcrumb black-text">{{$teacher->name}}</a>
          </div>
        </div>
      </nav>
    </br></br>

        <div class="black-text menu-item" style="font-size: 20px;">{{$teacher->name}}</div>
        <div class="black-text sub-menu-item">{{$teacher->teacher_info->employee_id}}</div>
        <a href="#modal_edit" class="waves-effect waves-light btn">Change password</a>

        @if ($teacher->teacher_info->is_active == 1)
          <a href="#modal_delete" class="waves-effect waves-light btn red lighten-1">Set as inactive</a>
        @else
          <a href="#modal_delete" class="waves-effect waves-light btn green lighten-1">Set as active</a>
        @endif
        </br></br>
        <div class="black-text menu-item">Sections</div>

        <div class="row">
          @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <script>
                  Materialize.toast('{{ $error }}', 3000, 'rounded');
                </script>

            @endforeach
          @endif
            <a href="{{ ($teacher->teacher_info->is_active == 1) ? '#sections_modal' : '#' }}">
              <div class="col s12 m4">
                <div class="card small waves-effect {{ ($teacher->teacher_info->is_active == 1) ? 'white' : 'grey lighten-2' }}">
                  <div class="valign-wrapper " style="height: 100%">
                      <div class="valign" style="width:100%">

                        <div class="center-align">
                            <img src="../../images/add (1).png"/>
                          </br>
                            <div class="black-text menu-item">Add section</div>
                            <div class="grey-text submenu-item">Add section to the teacher</div>
                        </div>

                      </div>
                  </div>
                </div>
              </div>
            </a>

            @if (count($teacher->sections) > 0)
              @foreach ($teacher->sections as $section)
                  @if ($section->is_active == 1)
                    <a href="../section/{{$section->id}}">
                  @else
                    <a href="#">
                  @endif

                    <div class="col s12 m4">
                      <div class="card small waves-effect {{ ($section->is_active == 1) ? 'white' : 'grey lighten-2' }}">
                        <div class="valign-wrapper " style="height: 100%">
                            <div class="valign" style="width:100%">

                              <div class="center-align">
                                  <img src="../../images/star.png"/>
                                  </br>
                                  <div class="black-text menu-item">{{$section->grade_level}}</div>
                                  <div class="black-text sub-menu-item">{{$section->name}}</div>
                                </br>
                                <a href="#modal_remove_{{$section->id}}" class="waves-effect waves-light btn red lighten-1">Remove</a>
                              </div>

                            </div>
                        </div>
                      </div>
                    </div>
                  </a>

                  <div id="modal_remove_{{$section->id}}" class="modal">
                      <div class="modal-content">
                        <h5>Remove section</h5>
                        <div class="row">
                          <form class="col s12" action="../../admin/sectionremovefromteach/{{$section->id}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="delete">
                            <p>Are you sure you want to remove section {{$section->name}} from teacher {{$teacher->name}} ?</p>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button class="btn waves-effect waves-light red" type="submit" name="action">DELETE
                        </button>
                      </div>
                      </form>
                    </div>
              @endforeach
            @endif
        </div>

      </br></br>
      <div class="black-text menu-item">Files</div>
      <div class="row">
          @if (count($files) > 0)
            @foreach ($files as $file)
                <a >
                  <div class="col s12 m4">
                    <div class="card small white waves-effect ">
                      <div class="valign-wrapper " style="height: 100%">
                          <div class="valign" style="width:100%">

                            <div class="center-align">
                                <img src="../../images/folder.png"/>
                                </br>
                                <div class="black-text menu-item">{{$file->name}}</div>
                                <div class="black-text sub-menu-item">{{$file->file}}</div>
                              </br>
                              <a href="../../files/{{$file->file}}" class="waves-effect waves-light btn">Download</a>
                              <a href="#modal_remove_{{$file->file}}" class="waves-effect waves-light btn red">Delete</a>
                            </div>

                          </div>
                      </div>
                    </div>
                  </div>
                </a>

                <div id="modal_remove_{{$file->file}}" class="modal">
                    <div class="modal-content">
                      <h5>Remove section</h5>
                      <div class="row">
                        <form class="col s12" action="../../admin/deletefile/{{$teacher->teacher_info->employee_id}}/{{$file->id}}" method="POST">
                          {{ csrf_field() }}
                          <input type="hidden" name="_method" value="delete">
                          <p>Are you sure you want to delete {{$file->name}}? This cannot be undone.</p>
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
            <div class="black-text sub-menu-item">No files found</div>
          @endif
      </div>


    </br></br>
    <div class="black-text menu-item" id="quizzes">Quizzes</div>

    <div class="row">

      <a href="../questions/{{$teacher->id}}/1">
        <div class="col s12 m4">
          <div class="card small white waves-effect">
            <div class="valign-wrapper " style="height: 100%">
                <div class="valign" style="width:100%">

                  <div class="center-align">
                      <img src="../../images/1.png"/>
                      <div class="black-text menu-item">Stage 1</div>
                  </div>

                </div>
            </div>
          </div>
        </div>
      </a>

      <a href="../questions/{{$teacher->id}}/2">
        <div class="col s12 m4">
          <div class="card small white waves-effect">
            <div class="valign-wrapper " style="height: 100%">
                <div class="valign" style="width:100%">

                  <div class="center-align">
                      <img src="../../images/2.png"/>
                      <div class="black-text menu-item">Stage 2</div>
                  </div>

                </div>
            </div>
          </div>
        </div>
      </a>

      <a href="../questions/{{$teacher->id}}/3">
        <div class="col s12 m4">
          <div class="card small white waves-effect">
            <div class="valign-wrapper " style="height: 100%">
                <div class="valign" style="width:100%">

                  <div class="center-align">
                      <img src="../../images/3.png"/>
                      <div class="black-text menu-item">Stage 3</div>
                  </div>

                </div>
            </div>
          </div>
        </div>
      </a>

      <a href="../questions/{{$teacher->id}}/4">
        <div class="col s12 m4">
          <div class="card small white waves-effect">
            <div class="valign-wrapper " style="height: 100%">
                <div class="valign" style="width:100%">

                  <div class="center-align">
                      <img src="../../images/4.png"/>
                      <div class="black-text menu-item">Stage 4</div>
                  </div>

                </div>
            </div>
          </div>
        </div>
      </a>

      <a href="../questions/{{$teacher->id}}/5">
        <div class="col s12 m4">
          <div class="card small white waves-effect">
            <div class="valign-wrapper " style="height: 100%">
                <div class="valign" style="width:100%">

                  <div class="center-align">
                      <img src="../../images/5.png"/>
                      <div class="black-text menu-item">Stage 5</div>
                  </div>

                </div>
            </div>
          </div>
        </div>
      </a>

    </div>

    </div>

    <div id="sections_modal" class="modal">
      <div class="modal-content">
        <h5>Add section</h5>
        <div class="row">

          @if (count($available_sections) > 0)
            @foreach ($available_sections as $section)
                <div class="col s12 m4">
                  <div class="card white xsmall">
                    <div class="valign-wrapper " style="height: 100%">
                        <div class="valign waves-dark" style="width:100%">

                          <div class="center-align">
                              <img src="../../images/star.png"/>
                              </br>
                              <div class="black-text menu-item">{{$section->grade_level}}</div>
                              <div class="black-text sub-menu-item">{{$section->name}}</div>
                              </br>
                              <form action="/archemist/admin/teacher/{{$teacher->teacher_info->employee_id}}/{{$section->id}}" method="POST">
                                {{ csrf_field() }}
                                <button class="btn waves-effect waves-light blue accent-4" type="submit" name="action">Add
                                </button>
                              </form>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
            @endforeach
          @endif

        </div>
      </div>
    </div>

    <div id="modal_edit" class="modal">
        <div class="modal-content">
          <h5>Change password</h5>
          <div class="row">
            <form class="col s12" action="../../admin/teacheredit/{{$teacher->teacher_info->employee_id}}" method="POST">
              {{ csrf_field() }}
              <div class="row">
                <div class="input-field col s4">
                  <input id="password" name="password" type="password" class="validate" required>
                  <label for="grade_level">New password</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s4">
                  <input id="password-confirm" name="password_confirmation" type="password" class="validate" required>
                  <label for="grade_level">Confirm new password</label>
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
              <form class="col s12" action="../../admin/teacheredit/{{$teacher->teacher_info->employee_id}}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="delete">
                <p>Are you sure you want to change status of teacher {{$teacher->name}} ?</p>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn waves-effect waves-light red" type="submit" name="action">CHANGE
            </button>
          </div>
          </form>
        </div>



        <div id="inactive_modal" class="modal modal-fixed-footer">
          <div class="modal-content">
            <h4>Inactive</h4>
            <p>This teacher is inactive, adding of section for this teacher is disabled</p>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Dismiss</a>
          </div>
        </div>
        @if ($teacher->teacher_info->is_active == 0)
          <script>
          $(document).ready(function(){
            // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
            $('#inactive_modal').modal('open');

          });
          </script>
        @endif
    </body>
  </html>
