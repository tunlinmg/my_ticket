@extends('layouts.app')

@section('title', 'Create Page')

@section('content')
<div class="container col-md-8 col-md-offset-2">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    
@endif

    @if (session('status'))
    <div class="alert alert-success">
        {{session('status')}}

    </div>
@endif



    <div class="well well bs-component">
        <!-- form method="post" class="form-horizontal" -->
            <form method="post" action="{{ url('/create') }}" class="form-horizontal">

            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <fieldset>
                <legend>Submit a new ticket</legend>
                <div class="form-group">
                    <label for="title" class="col-lg-2 control-label">Title</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                    </div>
                </div>
                <div class="form-group">
                    <label for="content" class="col-lg-2 control-label">Content</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" id="content" rows="3" name="content" placeholder="Content"></textarea>
                        <span class="help-block">Feel free to ask us any questions.</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button class="btn btn-default">Cancel</button>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection