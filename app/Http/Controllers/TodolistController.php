<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    
    public function index()
    {
        $todolists = Todolist::orderBy('completed')->get();
        return view('home', compact('todolists'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'task' => 'required',
        ]);

        Todolist::create($data);
        return back();
    }

    public function completed($id) {
        $todolist = Todolist::find($id);
        if($todolist->completed){
            $todolist->update(['completed' => false]);
            return redirect()->back()->with('success', "Todo marked as incomplete!");
        }else {
            $todolist->update(['completed' => true]);
            return redirect()->back()->with('success', "Todo marked as complete!");
        }
    }

    public function destroy($id)
    {
        $todolist = Todolist::find($id);
        $todolist->delete();
        return redirect()->back()->with('success', "Todo deleted successfully!");

    }
}
