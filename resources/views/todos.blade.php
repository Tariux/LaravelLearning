<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ URL::asset('/css/main.css') }}" />

    <title>Todo's list</title>
</head>
<body>
    <div class="head">
        <h1>List index here:</h1>
        <form action={{route('todo.store')}} method="POST">
            @csrf
            <input type="text" name="title" placeholder="Enter title here">
            <input type="text" name="done" value="0" hidden>
            <input type="submit" value="Save">
        </form>
    
    </div>
    @if ($todos->isEmpty())
        <h3>Not found!</h3>
    @endif
    @foreach ($todos as $todo)
        <div class="todo">
            
            <h2>{{$todo->title}}</h2>
            
            <h5>{{$todo->description}}</h5>
            <p>{{$todo->author}}</p>
  
            <input onchange="update_done(this.checked , {{$todo->id}})" class="todo_done" style="margin: 0;" name="done" type="checkbox" {{($todo->done) ? 'checked' : ''}} >
            
            <input type="submit" onclick="delete_todo({{$todo->id}} , this)" value="delete">

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