@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Product Information
                </div>
                <div class="float-end">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">

                    <div class="row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $product->name }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Description:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $product->description }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="category" class="col-md-4 col-form-label text-md-end text-start"><strong>Category:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $product->category->name }}

                        </div>
                    </div>


                    <!--  div class="row">
                        <label for="image" class="col-md-4 col-form-label text-md-end text-start"><strong>Image:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                             <img src="{{ asset('storage/product_images/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="max-width: 100%;" >
                            
                        </div>
                    </div -->

                    <!-- normal image-->

                    <div class="row">
                        <label for="image" class="col-md-4 col-form-label text-md-end text-start"><strong>Image:</strong></label>
                        <div class="col-md-6">
                            <!-- Image clickable to open modal -->
                            <img src="{{ asset('storage/product_images/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#imageModal">

                            <!-- Modal for large image -->
                            <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="imageModalLabel">{{ $product->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ asset('storage/product_images/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}" style="max-width: 100%;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label for="category" class="col-md-4 col-form-label text-md-end text-start"><strong>Image:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">

                            {{ $product->category->name }}
                        </div>
                    </div>

                    <hr>

                    <!-- Comment section -->
                    <ul class="list-group">
                      <li class="list-group-item active">
                        <b>Comments ({{ count($product->comments) }})</b>
                      </li>
                      @foreach($product->comments as $comment)
                        <li class="list-group-item">
                            <a href="{{url("/comments/destroy/$comment->id")}}" class="btn-close float-end"> </a> 

                            {{ $comment->content }}

                            <div class="small mt-2">
                              By <b> {{ $comment->user->name}} </b>
                              {{$comment->created_at->diffForHumans()}}
                            </div>
                        </li>
                      @endforeach
                    </ul>

                    @auth
                    <form action="{{ route('comments.store') }}" method="post">
                      @csrf
                      <input type="hidden" name="product_id" value="{{ $product->id }}">
                      <textarea name="content" class="form-control mb-2" placeholder="New Comment"></textarea>
                      <input type="submit" value="Add Comment" class="btn btn-secondary">
                    </form>
                    @endauth
        
            </div>
        </div>
    </div>    
</div>
    
@endsection