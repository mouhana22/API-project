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
    
    //index function: return all properties.
    public function index()
    {
        $properties = Property::all();

        if ($properties->isEmpty()) {
            return response()->json(['message' => 'No properties found.'], 200);
        }

        return response()->json($properties, 200);
    }

    //store function: Store a newly created Property.
    public function store(Request $request)
    {

        $validatedData = $this->validatePropertyData($request);

        $property = Property::create($validatedData);

        return response()->json($property, 201);
    }


    //show function: return the specified Property by id.
    public function show($id)
    {
        $property = Property::find($id);
        if (!$property) {
            return response()->json(['error' => 'Property not found'], 404);
        }
        return response()->json($property);
    }

    
     //update function: Update the specified Property by id.
    public function update(Request $request, string $id)
    {
        
        $property = Property::find($id);

        if (!$property) {
            return response()->json(['error' => 'Property not found'], 404);
        }

        $validatedData = $this->validatePropertyData($request);
        $property->update($validatedData);

        return response()->json($property, 200);
    }

    
     //destroy function: delete the specified Property by id.
    public function destroy(string $id)
    {
        $property = Property::find($id);

        if (!$property) {
            return response()->json(['error' => 'Property not found'], 404);
        }

        $property->delete();

        return response()->json(null, 204);
    }

    //Validation function, to be used in store and update, to ensure data integrity
    private function validatePropertyData(Request $request)
    {
        try {
            return $this->validate($request, [
                'title' => 'required',
                'address' => 'required',
                'price' => 'required|numeric',
                'bedrooms' => 'required|integer',
                'bathrooms' => 'required|integer',
                'type' => 'required',
                'status' => 'required',
            ]);
        } catch (ValidationException $validationException) {
            return response()->json(['message' => 'Incorrect input', 'errors' => $validationException->errors()], 422);
        }
    }
}
