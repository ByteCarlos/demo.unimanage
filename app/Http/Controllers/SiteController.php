<?php

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
class SiteController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function projects() {
        $projects = DB::table('project')
            ->select('project.id as id',
                    'project.name as name', 
                    'project.project_cod as project_cod', 
                    'project.description as description', 
                    'project.delivery_date as delivery_date', 
                    'team.name as team_name')
            ->join('team', 'project.id', '=', 'team.project_fk')
            ->get();
        $instructors = DB::table('instructor')
                    ->select('*')
                    ->get();
        return view('projetos', ['projects' => $projects, 'instructors' => $instructors]);
    }

    public function events() {
        return view('eventos');
    }

    public function about() {
        return view('sobre');
    }

    public function store(Request $request): RedirectResponse
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
        }
 
        return redirect('/projetos');
    }
}
