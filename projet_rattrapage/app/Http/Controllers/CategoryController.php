<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());
        return redirect()->route('admin.dashboard');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return redirect()->route('admin.dashboard');
    }

    public function destroy(Category $category)
    {
        $defaultCategory = Category::firstOrCreate(
            ['name' => 'Generale'],
            ['desc' => 'Catégorie par défaut pour les événements']
        );
        $category->events()->update(['category_id' => $defaultCategory->id]);
        $category->delete();
        return redirect()->route('events.index');
    }
}
