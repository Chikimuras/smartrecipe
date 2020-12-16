<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::with('user')->orderBy('created_at', 'DESC')->get();

        return Inertia::render('Recipes/Index', [
            'recipes' => $recipes
        ]);
    }

    public function store (Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:155', 'min:10'],
            'desc' => ['required'],
            'ingredients' => ['required'],
            'user_id' => ['exists:users,id']
        ]);

        Recipe::create([
            'title' => $request->input('title'),
            'desc' => $request->input('desc'),
            'ingredients' => $request->input('ingredients'),
            'user_id' => auth()->user()->id
        ]);

        return Redirect::route('recipes.index');
    }
}
