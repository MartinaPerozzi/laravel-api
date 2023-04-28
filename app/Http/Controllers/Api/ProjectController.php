<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where('is_published', true)
            ->orderBy('updated_at', 'DESC')
            ->paginate(8);
        // Controllando tutti i progetti, invoco il getter dell'image scritto nel Model
        foreach ($projects as $project) {
            $project->text = $project->getAbstract();
            // if ($project->image) $project->image = url('storage/' . $project->image);
            $project->image = $project->getImageUri();
        }
        return response()->json($projects);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // Query per il progetto -> JOIN delle table type e technologies
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();

        $project->image = $project->getImageUri();
        $project->text = $project->text;

        // SE non ci sono risultati -> errore 404
        if (!$project) return response(null, 404);

        return response()->json($project);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
