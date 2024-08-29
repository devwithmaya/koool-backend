<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Liste des ingrédients',
            'ingredients' => Ingredient::orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function create()
    {
        return view('pages.forms.create-ingredient');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'name' => ['required','string'],
            'quantity' => ['required','string']
        ]);
        #dd($validated->getData());
        if ($validated->fails())
        {
            return \response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'message' => 'Bad Request',
                'errors' => $validated->errors()
            ]);
        }
        $ingredient = Ingredient::create($validated->getData());
        return \response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Recipe add successfully',
            'ingredient' => $ingredient
        ]);

    }


    /**
     * Display the specified resource.
     */
    public function show(Ingredient $ingredient)
    {
        return \response()->json([
            'message' => 'Liste des ingrédients',
            'ingredient' => $ingredient
        ], Response::HTTP_OK);
    }

    public function edit(Ingredient $ingredient)
    {
        return view('ingredients.edit-ingredient',[
            'ingredient' => $ingredient
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(),[
            'name' => ['required','string'],
            'quantity' => ['required','string']
        ]);
        //dd($validated->fails());
        if ($validated->fails())
        {
            return \response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'message' => 'Bad Request',
                'errors' => $validated->errors()
            ]);
        }
        $ingredient = Ingredient::find($id);
        $ingredient->update($request->all());
        return \response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Recipe update successfully',
            'ingredient' => $ingredient
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return \response()->json([
            'status' => Response::HTTP_NO_CONTENT,
            'message' => 'Your ingredient have been deleted with successfully'
        ]);
    }
}
