<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\Project;
use App\Models\Event;
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

    public function events() {
        $events = Event::all();
        $projects = Project::all();
        return view('eventos', ['projects' => $projects, 'events' => $events]);
    }

    public function about() {
        return view('sobre');
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
}
