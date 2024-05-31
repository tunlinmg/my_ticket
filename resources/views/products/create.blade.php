@extends('layouts.app')

@section('content')



<div class="row justify-content-center">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    
@endif

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Add New Product
                </div>
                <div class="float-end">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="description" class="col-md-4 col-form-label text-md-end text-start">Description</label>
                        <div class="col-md-6">
                            <textarea class="text-editor form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="category" class="col-md-4 col-form-label text-md-end text-start">Category</label>
                        <div class="col-md-6">
                            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="targeted_number" class="col-md-4 col-form-label text-md-end text-start">Targeted Number</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('targeted_number') is-invalid @enderror" id="targeted_number" name="targeted_number" value="{{ old('targeted_number') }}">
                            @error('targeted_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- div class="mb-3 row">
                        <label for="agent_id" class="col-md-4 col-form-label text-md-end">Agent ID</label>
                        <div class="col-md-6">
                            <select name="agent_id" id="agent_id" class="form-control">
                                <option value="">Select Customer</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="customer_id" class="col-md-4 col-form-label text-md-end">Customer ID</label>
                        <div class="col-md-6">
                            <select name="customer_id" id="customer_id" class="form-control">
                                <option value="">Select Customer</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div -->
                    <!-- Agent or Customer ID based on user role -->
                    @if (Auth::check())
                        @if (Auth::user()->hasRole('Agent') || Auth::user()->hasRole('Admin')|| Auth::user()->hasRole('Super Admin'))
                            <!-- Agent ID (current user ID) -->
                            <input type="hidden" name="agent_id" value="{{ Auth::user()->id }}">
                            <!-- Customer ID (select option) -->
                            <div class="mb-3 row">
                                <label for="customer_id" class="col-md-4 col-form-label text-md-end text-start">Customer ID</label>
                                <div class="col-md-6">
                                    <select class="form-select @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id">
                                        <option value="">Select Customer</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @elseif (Auth::user()->hasRole('Customer'))
                            <!-- Customer ID (current user ID) -->
                            <input type="hidden" name="customer_id" value="{{ Auth::user()->id }}">
                            
                            <!-- Agent ID (select option) -->
                            <div class="mb-3 row">
                                <label for="agent_id" class="col-md-4 col-form-label text-md-end text-start">Agent ID</label>
                                <div class="col-md-6">
                                    <select class="form-select @error('agent_id') is-invalid @enderror" id="agent_id" name="agent_id">
                                        <option value="">Select Agent</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach

                                        
                                    </select>
                                </div>
                            </div>
                        @endif
                    @endif

                    <div class="mb-3 row">
                        <label for="amount" class="col-md-4 col-form-label text-md-end text-start">Amount</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}">
                            @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label for="image" class="col-md-4 col-form-label text-md-end text-start">Image</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" multiple>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    
                    <div class="mb-3 row">
                        <label for="file" class="col-md-4 col-form-label text-md-end text-start">File</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control @error('file_name') is-invalid @enderror" id="file_name" name="file_name[]" multiple>
                            @error('file_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    


                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Product">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
<script>
    ClassicEditor
    .create( document.querySelector( '.text-editor' ) )
    .catch( error => {
    console.error( error );
    });
</script>

@endsection