<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->withCount('posts')
            ->withSum('posts', 'views')
            ->orderByDesc('posts_count')
            ->get()
            ->map(function (Category $category): Category {
                $category->setAttribute('post_count', $category->posts_count);
                $category->setAttribute('total_views', (int) ($category->posts_sum_views ?? 0));

                return $category;
            });

        return view('dashboard.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function search(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $query = Category::query()->withCount('posts');

        if ($q !== '') {
            $query->where('name', 'like', "%{$q}%");
            $limit = 10;
        } else {
            $limit = 5; // show top 5 when no query (e.g. on focus)
        }

        $results = $query
            ->orderByDesc('posts_count')
            ->orderBy('name')
            ->limit($limit)
            ->get(['id', 'name']);

        return response()->json($results);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create', [
            'category' => new Category(),
            'superCategories' => Category::query()
                ->orderBy('name', 'asc')
                ->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,active,archived'],
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
        ]);

        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($request->post('name')),
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
            'parent_id' => $validated['parent_id'] ?? null,
        ]);

        return redirect()
            ->route('dashboard.categories.index')
            ->with('status', 'Category created!');
    }

    public function show(int $id, string $slug = '')
    {
        $category = Category::query()
            ->withCount('posts')
            ->withSum('posts', 'views')
            ->findOrFail($id);

        $category->setAttribute('post_count', $category->posts_count);
        $category->setAttribute('total_views', (int) ($category->posts_sum_views ?? 0));

        return view('dashboard.categories.show', [
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $category = Category::findOrFail($id);
        $superCategories = Category::query()
            ->where('id', '!=', $id)
            ->orderBy('name', 'asc')
            ->get();

        return view('dashboard.categories.create', [
            'category' => $category,
            'superCategories' => $superCategories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'in:draft,active,archived'],
            'parent_id' => ['nullable', 'integer', 'exists:categories,id', Rule::notIn([$id])],
        ]);

        $category->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'] ?? $category->status,
            'parent_id' => $validated['parent_id'] ?? null,
        ]);

        return redirect()
            ->route('dashboard.categories.index')
            ->with('status', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()
            ->route('dashboard.categories.index')
            ->with('status', 'Category deleted!');
    }

    public function archive(int $id)
    {
        $category = Category::findOrFail($id);
        $category->update(['status' => 'archived']);

        return redirect()
            ->route('dashboard.categories.index')
            ->with('status', 'Category archived!');
    }

    public function unArchive(int $id)
    {
        $category = Category::findOrFail($id);
        $category->update(['status' => 'active']);

        return redirect()
            ->route('dashboard.categories.index')
            ->with('status', 'Category activated!');
    }
}
