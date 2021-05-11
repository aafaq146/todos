<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    public function index(){

    	return view('todo.index')->with('todos',Todo::all());
    }

    public function show(Todo $todo){

    	return view('todo.show')->with('todo',$todo);

    }

    public function create(){

    	return view('todo.create');
    }

    public function store(){

    	$this->validate(request(),[
            
            'name' => 'required|min:6|max:12',
            'description' => 'required'

    	]);


    	$data=request()->all();

    	$todo=new Todo();

    	$todo->name=$data['name'];
    	$todo->description=$data['description'];
    	$todo->completeed=false;

    	$todo->save();

    	session()->flash('success','Todo Created Successfully');

    	return redirect('/todos');

    }

    public function edit(Todo $todo){


          return view('todo.edit')->with('todo',$todo);


    }

    public function update(Todo $todo){

    	$this->validate(request(),[
            
            'name' => 'required|min:6|max:12',
            'description' => 'required'

    	]);

         $data=request()->all();



         $todo->name = $data['name'];
         $todo->description = $data['description'];

         $todo->save();

         session()->flash('success','Todo Updated Successfully.');

         return redirect('/todos');

    }

    public function destroy(Todo $todo){


        $todo->delete();

        session()->flash('success','Todo deleted Successfully');

        return redirect('/todos');

    }

    public function complete (Todo $todo){

    	$todo->completeed=true;

    	$todo->save();

    	session()->flash('success','Todo Completed successfully');

    	return redirect('/todos');

    }
}
