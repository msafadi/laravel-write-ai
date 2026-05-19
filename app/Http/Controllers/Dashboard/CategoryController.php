<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::withCount('posts')->get();

        return view('dashboard.categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')->get();

        return view('dashboard.categories.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'name' => $request->post('name'),
            'slug' => Str::slug($request->post('name')),
            'description' => $request->post('description'),
        ]);

        $category = Category::create($request->all());

        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $category = Category::withCount(['posts','children'])->findOrFail($id);
        $posts = $category->posts()->latest()->paginate(10);
        $subCategories = $category->children;

        return view('dashboard.categories.show', [
            'category' => $category,
            'subCategories' => $subCategories,
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $category = Category::findOrFail($id);
        $parentCategories = Category::whereNull('parent_id')->get();

        return view('dashboard.categories.edit', [
            'category' => $category,
            'parentCategories' => $parentCategories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);

        return redirect()->route('dashboard.categories.index');
    }
}
