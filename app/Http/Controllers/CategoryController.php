<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
class CategoryController extends Controller
{
    /**
     * Instantiate a new ProductController instance.
     */
    public function __construct()
    {
       $this->middleware('auth');
       /** $this->middleware('permission:create-category|edit-category|delete-category, ['only' => ['index','show']]);
       
       $this->middleware('permission:create-category', ['only' => ['create','store']]);
       $this->middleware('permission:edit-category', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-category', ['only' => ['destroy']]);
       */
    }


    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        //$categories = Category::latest()->paginate(10); // Retrieve categories
        //return view('categories.index', compact('categories')); // Pass to the view

        return view('categories.index', [
            'categories' => Category::latest()->paginate(10)
        ]);

        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
            {
        return view('categories.create');
    }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
        return view('categories.show', [
            'category' => $category
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
