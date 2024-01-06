<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $caregories = Category::all();
        return view('admin-feature.category.index', ['categories' => $caregories]);
    }
    public function add()
    {
        return view('admin-feature.category.add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:100',
        ]);
        $category = Category::create($request->all());
        return redirect('categories')->with('status', 'Category added successfully!');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin-feature.category.edit', ['category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->name = $request->input('name');
            $category->save();

            return redirect('categories')->with('status', 'Category updated successfully!');
        }

        return redirect('categories')->with('error', 'Category not found!');
    }

    public function delete($id)
    {
        // $category = Category::where('slug', $slug)->first();
        $category = Category::find($id);
        return view('admin-feature.category.delete', ['category' => $category]);
    }

    public function destroy($name)
    {
        $category = Category::where('name', $name)->update(['deleted_at' => Carbon::now()]);
        return redirect('categories')->with('status', 'Category deleted successfully!');
    }

    public function deletedCategory()
    {
        $deletedCategories = Category::onlyTrashed()->get();
        return view('admin-feature.category.deleted-list', ['deletedCategories' => $deletedCategories]);
    }
    

    public function restore($id)
    {
        $category = Category::withTrashed()->where('id', $id)->first();
        if ($category) {
            $category->restore();
            return redirect('categories')->with('status', 'Category restored successfully!');
        } else {
            // Handle case where category doesn't exist
            return redirect('categories')->with('error', 'Category not found!');
        }
        
    }
}
