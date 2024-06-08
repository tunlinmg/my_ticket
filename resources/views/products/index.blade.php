@extends('layouts.app')
@section('content')

<div class="row">
        <!--sidebar -->
        @include("products.categories_sidebar")
        
        <!-- nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">       

            <div class="card-header">Categories</div>
            <div class="sidebar-sticky">
                <a href="{{ route('products.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('products.index') ? 'active' : '' }}">
                All Products</a>
            </div>

            <div class="sidebar-sticky">
                @foreach ($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->id]) }}" class="list-group-item list-group-item-action {{ request('category') == $category->id ? 'active' : '' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </nav -->
        <!-- Main Content 
        
        <div role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 content">-->
        <div role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="card">    
                
                <div class="card-header">Product List</div>
                    <div class="card-body">
                        @can('create-product')
                            <a href="{{ route('products.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Product</a>
                        @endcan
                        <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="datatable">
                            <thead>
                                <tr id="hidden">
                                <th scope="col">S#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Targeted Number</th>
                                <th scope="col">Amount</th>
                                <th scope="col">User_id</th>
                                <th scope="col">Action</th>
                                </tr>
                                <tr id="show">
                                <td scope="col">S#</td>
                                <td scope="col">Name</td>
                                <td scope="col">Description</td>
                                <th scope="col">Targeted Number</th>
                                <th scope="col">Amount</th>
                                <th scope="col">User_id</th>

                                <td scope="col">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                <tr>
                                    <td scope="row"><span>ID : </span>{{ $loop->iteration }}</td>
                                    <td><span>Name</span>{{ $product->name }}</td>


                                    <td><span>Decription</span>{!! html_entity_decode($product->description) !!}</td>
                                    <!--td><span>Decription</span>{{ $product->description }}</td -->
                                    <td><span>Targeted Number</span>{{ $product->targeted_number }}</td>
                                    <td><span>Amount</span>{{ $product->amount }}</td>
                                    <td><span>User_id</span>{{ $product->user->name }} </td>
                                    <td><span>Action</span> 
                                        <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                                            @can('edit-product')
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                            @endcan

                                            @can('delete-product')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this product?');"><i class="bi bi-trash"></i> Delete</button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <td colspan="4">
                                        <span class="text-danger">
                                            <strong>No Product Found!</strong>
                                        </span>
                                    </td>
                                @endforelse
                            </tbody>
                        </table>
                        </div>

                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>  

<script>
    new DataTable('#datatable', {
        initComplete: function () 
        {
            this.api()
                .columns()
                .every(function () {
                    let column = this;
                    let title = column.header().textContent;
     
                    // Check if the current column is the ID column
                    if (title !== 'S#') {
                        // Create input element
                        let input = document.createElement('input');
                        input.placeholder = title;
                        column.header().replaceChildren(input);
     
                        // Event listener for user input
                        input.addEventListener('keyup', () => {
                            if (column.search() !== this.value) {
                                column.search(input.value).draw();
                            }
                        });
                    }
                });
        }
    });
</script>
@endsection