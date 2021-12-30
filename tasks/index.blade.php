

<!DOCTYPE html>
<html>

<head>
    <title>To-Do List</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }
    </style>

</head>

<body>

    <!-- container -->
    <div class="container">


        <div class="page-header">
            <h1>To-Do List</h1>
            <hr style="border-top:1px dotted #ccc;"/>
            <h3>Your Task</h3>
            @auth('tasks')
                {{ 'Welcome , '.auth('tasks')->user()->name}}
            @endauth

            <br>

            <!-- {{  session()->get('Message')  }}

             @php
                //   session()->forget(['Message']);
                // session()->flush();
             @endphp -->


        </div>

         <br>
         <div class="btn-group me-2">
         @auth('tasks')
                <a href="{{url('/tasks/create')}}" class='btn btn-primary m-r-1em'>Add New Task</a>
                <a href="{{url('/')}}" class='btn btn-danger m-r-1em'>LogOut</a>
        @endauth
        <a href="{{url('login')}}" class='btn btn-primary m-r-1em'>Login</a>
        </div>
<br><br>




        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>ID</th>
                <th>title</th>
                <th>description</th>
                <th>start time</th>
                <th>end time</th>
                <th>Image</th>
                <th>action</th>
            </tr>


            @foreach ($data as $key => $value)

           <tr>
                 <td>{{$value->id}}</td>
                 <td>{{$value->title}}</td>
                 <td>{{$value->description}}</td>
                 <td>{{$value->start_time}}</td>
                 <td>{{$value->end_time}}</td>
                 <td> <img src="{{asset('tasksimages/'.$value->image)}}" alt="" height="50px" width="50px">  </td>
                 <td>
                 <a href='' data-toggle="modal" data-target="#modal_single_del{{$key}}" class='btn btn-danger m-r-1em'>Remove </a>
                 <a href="{{url('/tasks/'. $value->id .'/edit')}}" class='btn btn-primary m-r-1em'>Edit</a>
                </td>
           </tr>


           <div class="modal" id="modal_single_del{{$key}}" tabindex="-1" role="dialog">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title">delete confirmation</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                                 </button>
                                  </div>

                                  <div class="modal-body">
                                    Remove {{ $value->title  }} !!!!
                                  </div>
                                  <div class="modal-footer">
                                      <form action="{{url('/tasks/'.$value->id)}}" method="post">
                                            @csrf
                                            @method('delete')

                                          <div class="not-empty-record">
                                              <button type="submit" class="btn btn-primary">Delete</button>
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>

           @endforeach

            <!-- end table -->
        </table>

    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->

</body>

</html>




