<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Import the Request class

use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

use App\Models\FileUpload;
use App\Http\Requests\StoreFileUploadRequest;
use App\Http\Requests\UpdateFileUploadRequest;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\FileUploadController;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

//use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Instantiate a new ProductController instance.
     
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:create-product|edit-product|delete-product', ['only' => ['index','show']]);
       $this->middleware('permission:create-product', ['only' => ['create','store']]);
       $this->middleware('permission:edit-product', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-product', ['only' => ['destroy']]);
    }

    */

    /**
     * Display a listing of the resource.
     */


/**

    public function index(Request $request): View
    {
        $categories = Category::all(); // Assuming 'Category' is your model

        // Fetch all products
    $products = Product::latest()->paginate(10);

    // Authorize each product individually
    foreach ($products as $product) {$this->authorize('index', $product);}

    if (auth()->user()->hasRole(['Admin', 'Super Admin'])) {
            // If the user is Admin or Super Admin, fetch all products
            $products = Product::latest()->paginate(10);
        } else {
            // Otherwise, fetch products posted by the current logged-in user
            $products = Product::where('user_id', auth()->user()->id)
                ->latest()->paginate(10);
        }

    // Filter products by category if a category is selected
        if ($request->has('category')) {
            $products = $products->where('category_id', $request);
        }

    // Return the view with products data
    return view('products.index', compact('categories','products'));

    }

**/  

    public function index(Request $request): View
    {
        // Fetch all categories
        $categories = Category::all();

        // Initialize the base query
        $query = auth()->user()->hasRole(['Admin', 'Super Admin']) ? Product::query() : Product::where('user_id', auth()->user()->id);

        // Filter products by category if a category is selected
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // Paginate the results
        $products = $query->latest()->paginate(10);

        // Return the view with products and categories data
        return view('products.index', compact('products', 'categories'));
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', Product::class);

        $categories = Category::all(); // Assuming 'Category' is your model
        $users = User::all(); // Assuming 'Category' is your model
        return view('products.create', compact('categories', 'users'));
        
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
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'image' => $imageName, // Add the original name field or null
                'amount' => $request->amount, // Add the amount field
                'targeted_number' => $request->targeted_number, // Add the targeted_number field
                'user_id' => auth()->user()->id,
                'agent_id' => $request->agent_id,
                'customer_id' => $request->customer_id,
            ]);

            // Handle single file FileUpload

            /*
            if ($request->hasFile('file_name')) {
                $file = $request->file('file_name');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('uploads', $fileName, 'public');

                // Save file information in the Fileupload table
                Fileupload::create([
                    'file_name' => $fileName,
                    'product_id' => $product->id,
                ]);
            }
            */

            //-----------



            // Handle file upload
            if ($request->hasFile('file_name')) {
                foreach ($request->file('file_name') as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('uploads', $fileName, 'public');

            // Save file information in the Fileupload table
                    Fileupload::create([
                        'file_name' => $fileName,
                        'product_id' => $product->id,
                    ]);
                }
            }          


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
        $this->authorize('show', $product);
        
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
        $this->authorize('update', $product);

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
        $this->authorize('delete', $product);
        $product->delete();
        return redirect()->route('products.index')
                ->withSuccess('Product is deleted successfully.');
    }
}