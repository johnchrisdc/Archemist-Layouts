<html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../../../css/materialize.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <title>{{config('app.name')}} - Questions Stage {{$stage}}</title>

    </head>

    <body class="grey lighten-3">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="../../../js/bin/materialize.js"></script>

      <script>
          $( document ).ready(function() {
              $(".dropdown-button").dropdown();
              $('.modal').modal();
              $('select').material_select();
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
          <a href="../../teacher" class="brand-logo">{{config('app.name')}}</a>
          <ul class="right">
            <li><a class="dropdown-button" href="#!" data-activates="dropdown1">{{ Auth::user()->name }}<i class="material-icons right">arrow_drop_down</i></a></li>
          </ul>
        </div>
      </nav>
    </div>
  </br>
  @if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <script>
          Materialize.toast('{{ $error }}', 3000, 'rounded');
        </script>

    @endforeach
  @endif
    <div class="container">
      <nav class="grey lighten-3" style="    box-shadow: none;">
        <div class="nav-wrapper">
          <div class="col s12">
            <a href="../../../admin" class="breadcrumb grey-text">Home</a>
            <a href="../../../admin/teacher/{{$teacher->teacher_info->employee_id}}?#quizzes" class="breadcrumb grey-text">{{$teacher->name}}</a>
            <a href="#" class="breadcrumb black-text">Stage {{$stage}}</a>
          </div>
        </div>
      </nav>
    </br></br>
    <div class="black-text menu-item">Stage {{$stage}} Questions</div>

    <div class="row">

        @if (count($questions) > 0)
          @foreach ($questions as $question)
              <a href="#question_modal">
                <div class="col s12 m4">
                  <div class="card small white waves-effect ">
                    <div class="valign-wrapper " style="height: 100%">
                        <div class="valign" style="width:100%">

                          <div class="center-align">
                              <img src="../../../images/note.png"/>
                              </br>
                              <div class="black-text menu-item">{{$question->title}}</div>
                              <?php
                                  if ($question->answer == 'a') {
                                      $answer = $question->choice_1;
                                  }
                                  if ($question->answer == 'b') {
                                      $answer = $question->choice_2;
                                  }
                                  if ($question->answer == 'c') {
                                      $answer = $question->choice_3;
                                  }
                                  if ($question->answer == 'd') {
                                      $answer = $question->choice_4;
                                  }
                                ?>

                              <div class="black-text sub-menu-item">{{$answer}}</div>

                            </br>
                              <!-- <a href="#question_{{$question->id}}" download class="waves-effect waves-light btn">Edit</a> -->
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
              </a>

              <div id="question_{{$question->id}}" class="modal modal-fixed-footer">
                <div class="modal-content">
                  <span class="card-title menu-item">Edit Question</span>
                  </br></br>
                  <form class="col s12" action="../../teacher/editquestion/{{$question->id}}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="input-field col s12">
                        <input placeholder="Question" value="{{$question->title}}" id="question" name="title" type="text" class="validate" required>
                        <label for="title">Question</label>
                      </div>
                    </div>
                    <span class="card-title sub-menu-item">Choices</span></br></br>
                    <div class="row">
                      <div class="input-field col s12">
                        <input placeholder="Choice A" value="{{$question->choice_1}}" id="choice_a" name="choice_a" type="text" class="validate" required>
                        <label for="title">Choice A</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input placeholder="Choice B" value="{{$question->choice_2}}" id="choice_b" name="choice_b" type="text" class="validate" required>
                        <label for="title">Choice B</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input placeholder="Choice C" value="{{$question->choice_3}}" id="choice_c" name="choice_c" type="text" class="validate" required>
                        <label for="title">Choice C</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input placeholder="Choice D" value="{{$question->choice_4}}" id="choice_d" name="choice_d" type="text" class="validate" required>
                        <label for="title">Choice D</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <select name="answer">
                          <option {{ $question->answer == 'a' ? "selected='selected'" : ""}} value="a">Choice A</option>
                          <option {{ $question->answer == 'b' ? "selected='selected'" : ""}} value="b">Choice B</option>
                          <option {{ $question->answer == 'c' ? "selected='selected'" : ""}} value="c">Choice C</option>
                          <option {{ $question->answer == 'd' ? "selected='selected'" : ""}} value="d">Choice D</option>
                        </select>
                        <label>Answer</label>
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button class="btn waves-effect waves-light btn-flat" type="submit" name="action">Update
                  </button>
                  <a href="#delete_{{$question->id}}" class="btn btn-flat red-text modal-action modal-close">DELETE</a>
                </div>
                </form>

              </div>

              <!-- Modal Structure -->
              <div id="delete_{{$question->id}}" class="modal">
                <div class="modal-content">
                  <span class="card-title menu-item">Delete</span>
                  <p>Are you sure you want to delete {{$question->title}}?</p>
                </div>
                <div class="modal-footer">
                  <form action="../../teacher/editquestion/{{$question->id}}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="delete">
                  <button class="btn waves-effect waves-light btn-flat red-text" type="submit" name="action">DELETE
                  </button>
                  </form>
                </div>
              </div>

              <div id="question_modal" class="modal">
                <div class="modal-content">
                  <h4>Question</h4>
                  <p>{{$question->title}}</p>

                  <p>A. {{$question->choice_1}}</p>
                  <p>B. {{$question->choice_2}}</p>
                  <p>C. {{$question->choice_3}}</p>
                  <p>D. {{$question->choice_4}}</p>

                  <p>Answer - {{title_case($question->answer)}}</p>
                </div>
                <div class="modal-footer">
                  <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Dismiss</a>
                </div>
              </div>


              @endforeach
              @else
              <div class="black-text sub-menu-item">No questions found</div>

              <script>
              $(document).ready(function(){
                $('#no_data_modal').modal('open');

              });
              </script>

              <div id="no_data_modal" class="modal modal-fixed-footer">
                <div class="modal-content">
                  <h4>No questions found</h4>
                  <p>There is no question available</p>
                </div>
                <div class="modal-footer">
                  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Dismiss</a>
                </div>
              </div>
            @endif

    </div>
    </div>
    </body>
  </html>
