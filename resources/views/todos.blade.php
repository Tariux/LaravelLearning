<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="preconnect" href="//fdn.fontcdn.ir">
    <link rel="preconnect" href="//v1.fontapi.ir">
    <link href="https://v1.fontapi.ir/css/Vazir" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ URL::asset('/css/main.css') }}" />

    <title>Todo's list</title>
</head>
<body class="container">
    <div class="head">
        {{
            $user_data
        }}
        <h1>Add todo:</h1>
        <br>
        <form action={{route('todo.store')}} method="POST">
            @csrf
            <input type="text" name="title" placeholder="Enter title here">
            <input type="text" name="author" value="{{$user_data->email}}" hidden>
            <textarea name="description" cols="30" rows="10"></textarea>

            <input type="text" name="done" value="0" hidden>
            <input type="submit" class="save" value="Save">
        </form>
    
    </div>
    @if ($todos->isEmpty())
        <h3>Not found!</h3>
    @endif
    @foreach ($todos as $todo)
        <div class="todo">
            
            <h2>{{$todo->title}}</h2>
            
            <h5>{{$todo->description}}</h5>
            <br>
            <p>{{$todo->author}}</p>
            <br>
            <label for="">Done: </label><input onchange="update_done(this.checked , {{$todo->id}})" class="todo_done" style="margin: 0;" name="done" type="checkbox" {{($todo->done) ? 'checked' : ''}} >
            <br>
            <input class="delete" type="submit" onclick="delete_todo({{$todo->id}} , this)" value="delete">

        </div>
    @endforeach
</body>

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>
<script>
    function update_done(status , id) {
        console.log(status);
       $.ajax({
          type:'POST',
          url:'/update_todo_done',
          data: {
            "_token": "{{ csrf_token() }}",
            "id": id,
            "done": status
          },
          
          success:function(data) {
             //$("#msg").html(data.msg);
             console.log(data);
          }
       });
    }

    function delete_todo(id , element) {

       $.ajax({
          type:'POST',
          url:'/delete_todo',
          data: {
            "_token": "{{ csrf_token() }}",
            "id": id,
          },
          
          success:function(data) {
             //$("#msg").html(data.msg);
             element.parentElement.remove()

             console.log(data);
          }

       });

    }
 </script>

</html>