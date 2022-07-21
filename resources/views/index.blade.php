<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <style>
        body{
            height:100vh;
            padding: 50px;
        }
        .border-none{
            border: none !important;
            background : transparent !important;
        }

        .icon{
            border: none !important;
            background : transparent !important;
            color : #000;
        }
        .card-body {
            height : 400px !important;
        }

        .input-group-append{
            margin-left : 5px;
        }

        .todo {
            /* background : skyblue; */
            padding : 10px;
            border-radius : 4px;
        }

        .table td, .table th {
            padding: 0.75rem;
            vertical-align: top;
            border-top: none;
        }

        .table {
            height: 350px;
        }
        
        .data{
            overflow-y: scroll;
            height: 355px;
        }

    </style>
</head>
<body>
    <input type="hidden" id="csrfToken" value="{{ csrf_token() }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>To Do List</h3>
                    </div>
                    <div class="card-body">
                        <div class="data">
                            <table class="table no-border" id="todo-table">
                                <tbody>
                                    @if (sizeof($datas) > 0)
                                        @foreach ($datas as $data)
                                            <tr>
                                                <td>
                                                    <span class="todo">{{$data->description}}</span><br>
                                                    <span style="font-size:8px; padding-left:2px">{{date('d M Y h:i a', strtotime($data->created_at))}}</span>
                                                </td>
                                                <td>
                                                    <button type="button" onclick="deleteData('{{$data->id}}')" 
                                                    class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form action="{{ route ('todo') }}" method="post">@csrf
                            <div class="form-body">
                                <div class="input-group mb-3">
                                    <textarea class="form-control border-none" placeholder="what's on your mind" 
                                    aria-label="what's on your mind" aria-describedby="basic-addon2" name="todo" id="todo" cols="30" rows="1"></textarea>
                                    <div class="input-group-append">
                                        <button type="submit" class="icon" type="button"><i class="fa fa-paper-plane"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function deleteData(id) {
            // if (confirm('Are you sure you want to delete this?')) {
            // Save it!
                if (id != '') {
                    $.ajax({
                        url : "{{ route ('tododelete') }}",
                        type: 'DELETE',
                        data : {
                            "_token": $('#csrfToken').val(),
                            'id' : id,
                        },

                        success : function(){
                            location.reload();
                        },

                        error : function (e) {
                            // alert('An error occurred.');
                            location.reload();
                        }
                    });
                }else{
                    alert('An error occurred.')
                }
            // } else {
            // // Do nothing!
            //     alert('No action taken.')
            // }
        }
    </script>
</body>
</html>