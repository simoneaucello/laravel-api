<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Functions\Helper;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;
use App\Models\Technology;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (isset($_GET['toSearch'])) {
            $projects = Project::where('title', 'LIKE', '%' . $_GET['toSearch'] . '%')->paginate(15);

            $count_search = Project::where('title', 'LIKE', '%' . $_GET['toSearch'] . '%')->count();
        } else {

            $projects = Project::orderBy('id', 'desc')->paginate(15);
            $count_search = Project::count();
        }

        return view('admin.projects.index', compact('projects', 'count_search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technologies = Technology::all();
        $types = Type::all();
        $add_mod_btn = 'AGGIUNGI';
        $mod_add_project = 'Inserisci nuovo progetto:';
        $method = 'POST';
        $route = route('admin.projects.store');
        $project = null;
        // stampo il form di creazione nuovo fumetto
        return view('admin.projects.create-edit', compact('method', 'route', 'project', 'mod_add_project', 'types', 'add_mod_btn', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request->all();
        // verifico l'esistenza della chiave 'image' in form_data
        if (array_key_exists('image', $form_data)) {
            //salvo l'immagine nello storage e ottengo il percorso
            $image_path = Storage::put('uploads', $form_data['image']);

            // ottengo il nome originale dell'img
            $original_name = $request->file('image')->getClientOriginalName();
            $form_data['image'] = $image_path;
            $form_data['image_original_name'] = $original_name;
        }



        $new_project = new Project();

        $form_data['slug'] = Helper::generateSlug($form_data['title'], Project::class);
        $new_project->fill($form_data);
        $new_project->save();

        return redirect()->route('admin.projects.show', $new_project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $technologies = Technology::all();
        $types = Type::all();
        $add_mod_btn = 'MODIFICA';
        $mod_add_project = 'Modifica progetto:';
        $method = 'PUT';
        // $project = null;
        $route = route('admin.projects.update', $project);
        return view('admin.projects.create-edit', compact('method', 'route', 'project', 'mod_add_project', 'types', 'add_mod_btn', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_data = $request->all();

        if ($form_data['title'] != $project->title) {
            $form_data['slug'] = Helper::generateSlug($form_data['title'], Project::class);
        } else {
            $form_data['slug'] = $project->slug;
        }

        if (array_key_exists('image', $form_data)) {
            //salvo l'immagine nello storage e ottengo il percorso
            $image_path = Storage::put('uploads', $form_data['image']);


            // ottengo il nome originale dell'img
            $original_name = $request->file('image')->getClientOriginalName();
            $form_data['image'] = $image_path;
            $form_data['image_original_name'] = $original_name;
        }

        // effettua il fill dei dati e li salva aggiornando il db
        $project->update($form_data);

        if (array_key_exists('technologies', $form_data)) {
            // aggiorno tutte le relazioni eliminando quelle che eventualmente non ci sono più

            // sync accetta un array sincronizzando tutte le relazioni
            $project->technologies()->sync($form_data['technologies']);
        } else {
            // se non sono presenti id dentro tags elimino tutte le relazioni con tags
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('delete', 'Il progetto ' . $project->title . ' è stato eliminato correttamente.');
    }
}
