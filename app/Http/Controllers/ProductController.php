<?php

namespace App\Http\Controllers;

use App\Models\Category;


use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Instantiate a new ProductController instance.
     */
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:create-product|edit-product|delete-product', ['only' => ['index','show']]);
       $this->middleware('permission:create-product', ['only' => ['create','store']]);
       $this->middleware('permission:edit-product', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-product', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('products.index', [
            'products' => Product::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all(); // Assuming 'Category' is your model
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
    */ 
    public function store(StoreProductRequest $request): RedirectResponse
    {
        try {
        // IMAGE UPLOAD HANDLING (before product creation)
            $image = $request->file('image');
            $imageName = null;

            if ($image) {
                //$imagePath = $image->store('public/product_images');
                //$request->merge(['image' => $imagePath]);
                //$originalName = $image->getClientOriginalName();
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('public/product_images', $imageName);
            }

        // PRODUCT CREATION WITH IMAGE PATH (if applicable)
            Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'image' => $imageName, // Add the original name field or null
            ]);
            return redirect()->route('products.create')
                ->withSuccess('New product is added successfully.');
        } catch (\Exception $exception) {
            // Log the error for debugging
            Log::error('Error creating product: ' . $exception->getMessage());

            // Redirect back to the create form with a clear error message
            return redirect()->back()->withErrors(['error' => 'Failed to create product. Please try again.']);
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        //$categories = Category::all();

        return view('products.show', [
            'product' => $product,
            //'categories' => $categories,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        // Retrieve categories
        $categories = Category::all();

        // Pass $categories and $product to the view
        return view('products.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);

        //return view('products.edit', ['product' => $product]);
    }

    //Update the specified resource in storage.


    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        try {
            // Delete the old image file if it exists
            if ($product->image) {
                $filePath = 'public/images/' . $product->image;

                // Check if the file exists before attempting deletion
                if (Storage::exists($filePath)) {
                    // Attempt to delete the file
                    Storage::delete($filePath);
                }
            }

            // Handle image upload for the new image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('public/product_images', $imageName);
            } else {
                $imageName = $product->image;
            }

            // Update product attributes
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'image' => $imageName,
            ]);

            return redirect()->back()->withSuccess('Product is updated successfully.');
        } catch (\Exception $exception) {
            // Log the error for debugging
            Log::error('Error updating product: ' . $exception->getMessage());

            // Redirect back to the edit form with a clear error message
            return redirect()->back()->withErrors(['error' => 'Failed to update product. Please try again.']);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('products.index')
                ->withSuccess('Product is deleted successfully.');
    }
}