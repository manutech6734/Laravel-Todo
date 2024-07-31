<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo List</title>
    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" 
    rel="stylesheet" />
    {{-- MDB Bootstrap CSS --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css"></script>  
</head>
<body style="background-color: #363636;">
    <div class="container w-25 mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3>TO-DO List</h3>
                <form action="{{ route('store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="task" class="form-control" placeholder="Add your Todo" />
                        <button type="submit" class="btn btn-dark btn-sm px-4">Add Task</button>
                    </div>
                </form>

                @if (count($todolists))
                    <ul class="list-group list-group-flush mt-3">
                        @foreach ($todolists as $todolist)
                            <li class="list-group-item">
                                <form action="{{ route('destroy', $todolist->id) }}" method="POST">
                                    {{ $todolist ->task }}
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-link btn-sm float-end show_confirm" data-toggle="tooltip" title='Delete'>
                                        <i style="color: red;" class="fas fa-trash"></i>
                                    </button>
                                    <form action="{{ route('completed', $todolist->id) }}" method="get">
                                        <button type="" class="btn btn-link btn-sm float-end " data-toggle="tooltip" title=''>
                                <a href="{{asset('/' . $todolist->id . '/completed')}}"><i class="fas fa-check text-green-400 cursor-pointer px-2"></i></a>             
                                        </button>
                                    </form>
                                </form>
                                
                            </li>
                        @endforeach
                    </ul>
                    @else
                    <p class="text-center mt-3">No tasks!</p>
                @endif
                <br>
                <form action="{{ route('store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="input-group">
                        <button type="submit" class="btn btn-dark btn-sm px-4">All Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $('.show_confirm').click(function(e) {
        if(!confirm('Are you sure to delete this task?')) {
            e.preventDefault();
        }
    });
</script>
