<html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <title>{{config('app.name')}} - Student</title>

    </head>

    <body class="grey lighten-3">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="../js/bin/materialize.js"></script>

      <script>
          $( document ).ready(function() {
              $(".dropdown-button").dropdown();
              $('select').material_select();
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
            <a href="#" class="breadcrumb black-text">Students</a>
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
                        <div class="black-text menu-item">Add student</div>
                        <div class="grey-text submenu-item">Add a new student</div>
                    </div>

                  </div>
              </div>
            </div>
          </div>
        </a>

        @if (count($students) > 0)
          @foreach ($students as $student)
              <a href="">
                <div class="col s12 m4">
                  <div class="card small white waves-effect">
                    <div class="valign-wrapper " style="height: 100%">
                        <div class="valign" style="width:100%">

                          <div class="center-align">
                              <img src="../images/id-card.png"/>
                              </br>
                              <div class="black-text menu-item">{{$student->name}}</div>
                                @if($student->section != null)
                                    <div class="black-text sub-menu-item">
                                        {{$student->section->grade_level}} - {{$student->section->name}}
                                        @if($student->is_confirmed == 0)
                                        - Pending
                                        @endif
                                    </div>

                                    @else
                                    <a href="#add_to_section_{{$student->id}}" class="waves-effect waves-light btn btn-flat">Set section</a>
                                    </br>
                                @endif
                              </br>
                              @if ($student->is_active == 1)
                                <a href="#modal_status_{{$student->id}}" class="waves-effect waves-light btn red lighten-1">Set as inactive</a>
                              @else
                                <a href="#modal_status_{{$student->id}}" class="waves-effect waves-light btn green lighten-1">Set as active</a>
                              @endif
                            </br>
                            </br>
                              <a href="#modal_remove_{{$student->id}}" class="waves-effect waves-light btn red lighten-1">Delete</a>
                          </div>

                        </div>
                    </div>
                  </div>
                </div>
              </a>

              <div id="modal_status_{{$student->id}}" class="modal">
                <div class="modal-content">
                  <h5>Change status</h5>
                  <div class="row">
                    <form class="col s12" action="../admin/student/changestatus/{{$student->student_id}}" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="_method" value="delete">
                      <p>Are you sure you want to change the status of student {{$student->name}}?</p>
                  </div>
                </div>
                <div class="modal-footer">
                  <button class="btn waves-effect waves-light red" type="submit" name="action">Change
                  </button>
                </div>
                </form>
              </div>


              <div id="add_to_section_{{$student->id}}" class="modal">
                <div class="modal-content">
                  <h5>Add to section</h5>
                  <div class="row">
                    <form class="col s12" action="../admin/sectionaddstudent/{{$student->student_id}}" method="POST">
                      {{ csrf_field() }}
                      <div class="input-field col s12">
                        <select name="section_id">
                          <option value="" disabled selected>Select section</option>
                          @foreach ($sections as $section)
                            <option value="{{$section->id}}">{{$section->grade_level}} {{$section->name}}</option>
                          @endforeach
                        </select>
                        <label>Select section</label>
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button class="btn waves-effect waves-light" type="submit" name="action">ADD
                  </button>
                </div>
                </form>
              </div>

              <div id="modal_remove_{{$student->id}}" class="modal">
                <div class="modal-content">
                  <h5>Delete student</h5>
                  <div class="row">
                    <form class="col s12" action="../admin/student/delete/{{$student->student_id}}" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="_method" value="delete">
                      <p>Are you sure you want to delete student {{$student->name}}? This cannot be undone.</p>
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
    </div>




    <div id="add_section" class="modal">
        <div class="modal-content">
          <h5>Add new student</h5>
          <div class="row">
            <form class="col s12" action="../admin/student/add" method="POST">
              {{ csrf_field() }}
              <div class="row">
                <div class="input-field col s4">
                  <input id="student_id" name="student_id" type="text" class="validate" required>
                  <label for="grade_level">Student ID</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s8">
                  <input id="name" type="text" name="name" class="validate" required>
                  <label for="name">Name</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s8">
                  <input type="date" class="datepicker" name="birthday" value="<?php echo date("d F, Y"); ?>">
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <select name="section_id">
                    <option value="" disabled selected>Choose section</option>
                    @if (count($sections) > 0)
                      @foreach ($sections as $section)
                          <option value="{{$section->id}}">{{$section->name}}</option>
                      @endforeach
                    @endif
                  </select>
                  <label>Section</label>
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
