<?php

namespace App\Http\Controllers;

use App\Http\Resources\NutrientResource;
use App\Models\Nutrient;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use App\Enums\UnitEnum;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request)
    {
        $messages = array(
            'unit' => 'Unit should be one of: [' . implode(', ', UnitEnum::values()) . '].'
        );

        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|numeric',
            'carbs_in_hundred' => 'required|numeric',
            'unit' => [new Enum(UnitEnum::class)],
            'standard_amount' => 'numeric',
        ], $messages);

        $category = Category::find($request->category_id);

        if (isset($category->id)) {
            $nutrient = Nutrient::create($request->all());

            return [
                "status" => 1,
                "data" => $nutrient
            ];
        };

        return [
            "status" => 0,
            "message" => "Category not found."
        ];
    }

    public function update(Request $request, Nutrient $nutrient)
    {
        $messages = array(
            'unit' => 'Unit should be one of: [' . implode(', ', UnitEnum::values()) . '].'
        );
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|numeric',
            'carbs_in_hundred' => 'required|numeric',
            'unit' => [new Enum(UnitEnum::class)],
            'standard_amount' => 'numeric',
        ], $messages);

        $category = Category::find($request->category_id);

        if (isset($category->id)) {
            $nutrient->update($request->all());

            return [
                "status" => 1,
                "data" => $nutrient,
                "msg" => "Nutrient successfully updated"
            ];
        };

        return [
            "status" => 0,
            "msg" => "Category not found."
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
