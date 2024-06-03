<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Functions\Helper;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();

        return view('admin.types.index', compact('types'));
    }

    public function typeProjects()
    {
        $types = Type::all();
        return view('admin.types.type-projects', compact('types'));
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
        $exists = Type::where('name', $request->name)->first();
        if ($exists) {
            return redirect()->route('admin.types.index')->with('error', 'Tipologia già esistente');
        } else {
            $new = new Type();
            $new->name = $request->name;
            $new->slug = Helper::generateSlug($new->name, Type::class);
            $new->save();

            return redirect()->route('admin.types.index')->with('success', 'Tipologia inserita correttamente');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $val_data = $request->validate([
            'name' => 'required|min:2|max:20'
        ], [
            'name.required' => 'Devi inserire il nome della tipologia',
            'name.min' => 'La tipologia deve avere almeno :min caratteri',
            'name.max' => 'La tipologia non deve avere più di :max caratteri'
        ]);

        $exists = Type::where('name', $request->name)->first();
        if ($exists) {
            return redirect()->route('admin.types.index')->with('error', 'Tipologia già esistente');
        } else {

            $val_data['slug'] = Helper::generateSlug($request->name, Type::class);
            $type->update($val_data);

            return redirect()->route('admin.types.index')->with('success', 'Tipologia modificata correttamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('success', 'Tipologia eliminata correttamente');
    }
}
