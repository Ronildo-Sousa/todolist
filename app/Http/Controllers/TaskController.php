<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'DESC')->get();

        return $tasks;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = filter_var($request->content, FILTER_SANITIZE_STRING);

        if (!empty($task)) {
            Task::insert([
                'content' => $task,
                'status' => 'pending'
            ]);
            return 'Tarefa inserida com sucesso.';
        }
        return 'Tarefa não pode estar em branco.';
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!empty($task)) {
            $task->update($request->all());
            return 'Tarefa alterada com sucesso.';
        }
        return 'Tarefa não pode ser encontrada.';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!empty($task)) {
            $task->delete();
            return 'Tarefa removida com sucesso.';
        }
        return 'Tarefa não pode ser encontrada.';
    }
}
