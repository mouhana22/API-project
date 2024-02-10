<?php

/**
 * Mouhana Almouhana
 * MouhanaAlmouhana@gmail.com
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

//Implement controller methods for each route (in routes/api.php) to handle the operations.
class PropertyController extends Controller
{
    /**
     * return all properties.
     */
    public function index()
    {
        return Property::all();
    }

    /**
     * Store a newly created Property.
     */
    public function store(Request $request)
    {
        $property = Property::create($request->all());
        return response()->json($property, 201);
    }

    /**
     * return the specified Property.
     */
    public function show($id)
    {
        $property = Property::find($id);
        return response()->json($property);
    }

    /**
     * Update the specified Property.
     */
    public function update(Request $request, string $id)
    {
        $property = Property::find($id);
        $property->update($request->all());

        return response()->json($property, 200);
    }

    /**
     * delete the specified Property.
     */
    public function destroy(string $id)
    {
        $property = Property::find($id);
        $property->delete();

        return response()->json(null, 204);
    }
}
