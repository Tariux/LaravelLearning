<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TodoListController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_data = Auth::user();
        $todos = TodoList::all()->where('author' , $user_data->email)->sortByDesc('created_at');
        return view('todos' , compact('todos' , 'user_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
        ]);

        TodoList::create($request->all());
        return redirect()->route('todo.index')->with('success','Product deleted successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function show(TodoList $todoList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function edit(TodoList $todoList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function update()
    {

        $_POST['done'] = ($_POST['done'] == "true") ? true : false;

        $model = TodoList::find($_POST['id']);
        $model->done = $_POST['done'];
        $model->save();

        return response()->json(array('message'=> 'updated'), 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $todo = TodoList::firstWhere('id', $_POST['id']);
        $todo->delete();
        //return redirect()->route('todo.index')->with('success','Product deleted successfully');
        return response()->json(array('message'=> 'deleted'), 200);

    }
    
}
