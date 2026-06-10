<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate(["category" => ["required", "min:3", "max:16"]]);
        Category::create(["name" => $validated["category"], "user_id" => Auth::id()]);

        return redirect()->back()->with("success", "Category created.");
    }
}
