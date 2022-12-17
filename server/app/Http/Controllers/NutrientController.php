<?php

namespace App\Http\Controllers;

use App\Http\Resources\NutrientResource;
use App\Models\Nutrient;
use Illuminate\Http\Request;

class NutrientController extends Controller
{
    public function index()
    {
        return NutrientResource::collection(Nutrient::all());
    }

    public function show(Nutrient $nutrient)
    {
        return new NutrientResource($nutrient);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $nutrient = Nutrient::create($request->all());

        return [
            "status" => 1,
            "data" => $nutrient
        ];
    }

    public function update(Request $request, Nutrient $nutrient)
    {
        $nutrient->update($request->all());

        return [
            "status" => 1,
            "data" => $nutrient,
            "msg" => "Nutrient successfully updated"
        ];
    }

    public function destroy(Nutrient $nutrient)
    {
        $nutrient->delete();
        return [
            "status" => 1,
            "data" => $nutrient,
            "msg" => "Nutrient deleted successfully"
        ];
    }

    public function restore($id)
    {
        Nutrient::withTrashed()->findOrFail($id)->restore();

        return [
            "status" => 1,
            "msg" => "Nutrient restored successfully"
        ];
    }
}
