<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkExpiredDate')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $todos = Todo::with('user')->whereUserId(auth()->user()->id)->get();
        return view('todo.home' , compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $data = $request->validate(
            [
                'title' => ['required' , 'string'],
                'content' => ['required' , 'string' , 'min:10'],
                'image' => ['required' , 'image' , 'mimes:png,jpeg,jpg'],
                'start_date' => ['required' , 'date' , 'date_format:Y-m-d' , 'after_or_equal:' . date('Y-m-d')],
                'end_date' => ['required' , 'date' , 'date_format:Y-m-d' , 'after:start_date'],
            ]);


        $path = Storage::disk('public')->put('images' , $request->file('image'));

        Auth::user()->todos()->create([
            'title' => $request->title,
            'content' => $request->input('content'),
            'img_path' => $path,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        session()->flash('success' , 'Todo is inserted' );
        return redirect()->route('todos.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $todo = Todo::findOrFail($id);
        $todo->delete();
        Storage::disk('public')->delete($todo->img_path);
        session()->flash('success' , 'Task is deleted' );
        return redirect()->route('todos.index');

    }
}
