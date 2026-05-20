<x-layout title="Edit Category">
   @include('dashboard.categories.create', [
    'category' => $category,
    'parents' => $parents,
    'action' => route('dashboard.categories.update', $category->id),
    'method' => 'PUT',
])
</x-layout>
