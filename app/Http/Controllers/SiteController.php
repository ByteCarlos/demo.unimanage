<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\Project;
use App\Models\Event;
use App\Models\Task;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
class SiteController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function projects() {
        $projects = Project::all();
        $instructor = Instructor::all();
        return view('projetos', ['projects' => $projects, 'instructors' => $instructor]);
    }

    public function storeProject(Request $request): RedirectResponse
    {
        $project = new Project;
        $project->project_cod = $request->project_cod;
        $project->name = $request->project_name;
        $project->description = $request->project_description;
        $project->delivery_date = $request->project_delivery_date;
        if($project->save()) {
            $team = new Team;
            $team->name = $request->team_name;
            $team->orientador_fk = $request->project_instructor;
            $team->project_fk = $project->id;
            if($team->save()) {
                return redirect('/projetos');
            }
        }
    }

    public function editProject($id)
    {
        $project = Project::findOrFail($id);
        return response()->json($project);
    }

     public function updateProject(Request $request, $id)
     {
         $project = Project::find($id);
 
         $project->project_cod = $request->input('project_cod');
         $project->name = $request->input('project_name');
         $project->description = $request->input('project_description');
         $project->delivery_date = $request->input('project_delivery_date');
        
         $project->save();
 
         return redirect()->route('projetos.index')->with('success', 'Projeto atualizado com sucesso!');
     }

    public function deleteProject($id)
    {
        $project = Project::find($id);
        if($project->delete()) {
            return redirect('/projetos')->with('success', 'Projeto excluído com sucesso!');;
        }
    }

    // CRUD eventos
    public function events() {
        $events = Event::all();
        $projects = Project::all();
        return view('eventos', ['projects' => $projects, 'events' => $events]);
    }

    public function storeEvent(Request $request): RedirectResponse
    {
        $event = new Event;
        $event->date = $request->event_date;
        $event->name = $request->event_name;
        $event->location = $request->event_location;
        $event->project_fk = $request->project_event;
        if($event->save()) {
            return redirect('/eventos');
        }
    }

    public function editEvent($id)
    {
        $event = Event::findOrFail($id);
        return response()->json($event);
    }

     public function updateEvent(Request $request, $id)
     {
         $event = Event::find($id);
 
         $event->name = $request->input('event_name');
         $event->date = $request->input('event_date');
         $event->location = $request->input('event_location');
         $event->project_fk = $request->input('project_event');
        
         $event->save();
 
         return redirect()->route('eventos.index')->with('success', 'Projeto atualizado com sucesso!');
     }

    public function deleteEvent($id)
    {
        $event = Event::find($id);
        if($event->delete()) {
            return redirect('/projetos')->with('success', 'Evento excluído com sucesso!');;
        }
    }

    // CRUD Tarefas
    public function tasks() {
        $tasks = Task::all();
        $projects = Project::all();
        return view('tarefas', ['projects' => $projects, 'tasks' => $tasks]);
    }

    public function storeTask(Request $request): RedirectResponse
    {
        $task = new Task;
        $task->name = $request->task_name;
        $task->project_fk = $request->project_task;
        if($task->save()) {
            return redirect('/tarefas');
        }
    }

    public function editTask($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

     public function updateTask(Request $request, $id)
     {
         $task = Task::find($id);
 
         $task->name = $request->input('task_name');
         $task->project_fk = $request->input('project_task');
        
         $task->save();
 
         return redirect()->route('tarefas.index')->with('success', 'Tarefa atualizada com sucesso!');
     }

    public function deleteTask($id)
    {
        $task = Task::find($id);
        if($task->delete()) {
            return redirect('/tarefas')->with('success', 'Tarefa excluída com sucesso!');;
        }
    }
}
