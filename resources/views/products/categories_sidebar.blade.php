<!-- resources/views/products/_sidebar.blade.php -->
<nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">       

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
        </nav>
