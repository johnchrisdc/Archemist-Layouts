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
            <a href="#" class="breadcrumb black-text">Files</a>
          </div>
        </div>
      </nav>
    </br></br>
    <div class="black-text menu-item">Files</div>

    @if (count($errors) > 0)
      @foreach ($errors->all() as $error)
          <script>
            Materialize.toast('{{ $error }}', 3000, 'rounded');
          </script>

      @endforeach
    @endif

    <div class="row">
        <a href="#add_file_modal">
          <div class="col s12 m4">
            <div class="card small white waves-effect ">
              <div class="valign-wrapper " style="height: 100%">
                  <div class="valign" style="width:100%">

                    <div class="center-align">
                        <img src="../images/add (1).png"/>
                      </br>
                        <div class="black-text menu-item">Add file</div>
                        <div class="grey-text submenu-item">Upload files</div>
                    </div>

                  </div>
              </div>
            </div>
          </div>
        </a>

        @if (count($files) > 0)
          @foreach ($files as $file)
              <a href="#">
                <div class="col s12 m4">
                  <div class="card small white waves-effect ">
                    <div class="valign-wrapper " style="height: 100%">
                        <div class="valign" style="width:100%">

                          <div class="center-align">
                              <img src="../images/folder.png"/>
                              </br>
                              <div class="black-text menu-item">{{$file->name}}</div>
                              <div class="black-text sub-menu-item">{{$file->file}}</div>

                            </br>
                              <a href="../files/{{$file->file}}?dl=1" download class="waves-effect waves-light btn">Download</a>
                              <a href="#modal_delete_{{$file->id}}" class="waves-effect waves-light btn red">Delete</a>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
              </a>



              <div id="modal_delete_{{$file->id}}" class="modal">
                <div class="modal-content">
                  <h5>Change status</h5>
                  <div class="row">
                    <form class="col s12" action="../teacher/file/{{$file->id}}}}" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="_method" value="delete">
                      <p>Are you sure you want to delete {{$file->name}} ?</p>
                  </div>
                </div>
                <div class="modal-footer">
                  <button class="btn waves-effect waves-light red" type="submit" name="action">Delete
                  </button>
                </div>
                </form>
              </div>
              @endforeach
            @endif

        <div id="add_file_modal" class="modal modal-fixed-footer">
          <div class="modal-content">
            <h4>Add new file</h4>
            <div class="row">
              <form class="col s12" action="../teacher/addfile" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                  <div class="input-field col s6">
                    <input placeholder="Name" id="name" name="name" type="text" class="validate" required>
                    <label for="name">Name</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <div class="file-field input-field">
                    <div class="btn">
                        <span>File</span>
                        <input type="file" required name='file'>
                      </div>
                      <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                      </div>
                    </div>
                  </div>
                </div>
            </div>


          </div>
          <div class="modal-footer">
            <button class="btn waves-effect waves-light" type="submit" name="action">Add
            </button>
          </div>
          </form>
        </div>


    </div>
    </div>
    </body>
  </html>
