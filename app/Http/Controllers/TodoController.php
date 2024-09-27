<?php

namespace App\Http\Controllers;

use App\Enums\TodoStatus;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::query()
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('todos.index', [
            'todos' => $todos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            ['name' => 'required|min:3|max:30']
        );

        $request->user()->todos()->create($validated);

        return to_route('todos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        if ($request->name !== null) {
            $todo->update([
                'name' => $request->name
            ]);
        } else {
            if ($todo->status === "finished") {
                $status = TodoStatus::UNFINISHED;
            } else {
                $status = TodoStatus::FINISHED;
            }

            $todo->update([
                'status' => $status
            ]);
        }

        return to_route('todos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return to_route('todos.index');
    }
}
