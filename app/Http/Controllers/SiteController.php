<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
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

    public function store(Request $request) {
        DB::table('project')->insert([[
            'project_cod' => $request->project_cod,
            'name' => $request->project_name,
            'description' => $request->project_description,
            'delivery_date' => $request->project_delivery_date
        ],
        ]);

        $project = DB::table('project')
            ->select('project.id')
            ->where('project_cod', '=', $_POST['project_cod'])
            ->get();

        DB::table('team')->insert([[
            'name' => $_POST['team_name'],
            'orientador_fk' => $_POST['project_instructor'],
            'project_fk' => $project->id
        ],
        ]);
        return $this->projects();
    }
}
