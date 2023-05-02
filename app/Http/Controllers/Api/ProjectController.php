<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;

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
        return response()->json(compact('projects'));
    }

    public function show($slug)
    {
        // Query per il progetto -> JOIN delle table type e technologies
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();
        // Cerca la colonna slug sul DB dove il valore corrisponde allo slug che arriva dall'API.

        $project->image = $project->getImageUri();
        $project->text = $project->text;

        // SE non ci sono risultati -> errore 404
        if (!$project) return response(null, 404);

        return response()->json($project);
    }


    public function getProjectsByType($type_id)
    {
        // Prendo tutti i progetti
        $projects = Project::where('type_id', $type_id)
            ->where('is_published', true)
            ->with('type', 'technologies')
            ->orderBy('updated_at', 'DESC')
            ->paginate(6);

        // Prendo il type_id relativo ad ogni progetto.
        $type = Type::find($type_id);

        //// Per ogni progetto che ho recuperato prendo l'immagine:
        foreach ($projects as $project) {
            $project->image = $project->getImageUri();
        }
        // Mi passo entrambe le info con compact
        return response()->json(compact('projects', 'type'));
    }
}
