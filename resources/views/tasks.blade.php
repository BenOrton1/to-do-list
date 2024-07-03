<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MLP To-Do</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        <div class="container">
            <img class="logo" src="{{ asset('assets/logo.png') }}" alt="Logo">
        </div>
    </header>
    <div class="container">
        <div class="row">

            <div class="col-lg-4">
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" id="task_name" class="form-control" name="name" placeholder="Insert task name">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                </form>
            </div>
            <div class="col-lg-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Task</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td class="w-80 fw-light {{ $task->done ? 'text-decoration-line-through' : '' }}">{{ $task['name'] }}</td>
                            <td>
                                <div>
                                    @unless($task->done)
                                    <form method="POST" action="{{ route('tasks.markAsDone', $task) }}" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm white">&#10004;</button>
                                    </form>
                                    @endunless
                                    <form method="POST" action="{{ route('tasks.destroy', $task) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm white">&cross;</button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <footer>
        <p class="text-center">Copyright &#169; 2020 All Rights Reseved</p>
    </footer>

</body>

</html>