@extends('layouts.app')
@section('title', 'Ticket Details')

@section('content')
<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-body">
            <p><strong>Title:</strong> {!! $ticket->title !!} </p>
            <p><strong>Status:</strong> {{ $ticket->status ? 'Pending' : 'Answered' }}</p>
            <p><strong>Content:</strong> {!! $ticket->content !!}</p>

            <!-- Add more details as needed -->

        </div>
        <a href="{{ url('/edit/'. $ticket->slug) }}" class="btn btn-info">edit</a>

        <form method="POST" action="{{ route('tickets.destroy', ['slug' => $ticket->slug]) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-info" onclick="return confirm('Are you sure you want to delete this ticket?')">Delete</button>
            </form>



    </div>
</div>
@endsection