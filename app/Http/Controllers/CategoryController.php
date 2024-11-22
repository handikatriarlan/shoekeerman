<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::query()
            ->withCount('products')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhere('slug', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate(10);

        $categories->appends($request->all());

        return view('admin.category', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'name' => ['required', 'max:255'],
                'description' => 'nullable',
            ]);

            Category::create($validated);

            DB::commit();

            return redirect()->back()
                ->with('success', 'Category created successfully');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()
                ->with('error', 'Category creation failed: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Category $category)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'name' => ['required', 'max:255'],
                'description' => 'nullable',
            ]);

            $category->update($validated);

            DB::commit();

            return redirect()->back()
                ->with('success', 'Category updated successfully');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()
                ->with('error', 'Category update failed: ' . $e->getMessage());
        }
    }

    public function destroy(Category $category)
    {
        try {
            DB::beginTransaction();

            $category->delete();

            DB::commit();

            return redirect()->back()
                ->with('success', 'Category deleted successfully');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()
                ->with('error', 'Category deletion failed: ' . $e->getMessage());
        }
    }
}
