@extends('layout.master')

@section('title', 'Edit Page')

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
        {{ session('status') }}
    </div>
    @endif

    <div class="well well bs-component">
        <form method="post" action="{{ url('/edit/' . $ticket->slug) }}" class="form-horizontal">
            @csrf
            <fieldset>
                <legend>Edit Ticket</legend>
                <div class="form-group">
                    <label for="title" class="col-lg-2 control-label">Title</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $ticket->title }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="content" class="col-lg-2 control-label">Content</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" id="content" rows="3" name="content" placeholder="Content">{{ $ticket->content }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-lg-2 control-label">Status</label>
                    <div class="col-lg-10">
                        <input type="checkbox" id="status" name="status" {{ $ticket->status ? 'checked' : '' }}> ticket is pending
                    </div>
                </div>
                <span class="help-block">Feel free to ask us any questions.</span>

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
