@extends('layouts.app')
@section('title', 'Index Page')
@section('content')
<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Tickets</h2>
        </div>
        @if($tickets->isEmpty())
        <p>There is no Ticket.</p>
        @else
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="tickets-table">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ticket->title }}</td>
                        <td>{{ $ticket->status ? 'Pending' : 'Answered' }}</td>
                        <td>
                            <a href="{{ url('/show', $ticket->slug) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ url('/edit', $ticket->slug) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ url('/delete', $ticket->slug) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @endif
    </div>
</div>

<script>
    $(document).ready(function () {
        var table = $('#tickets-table').DataTable({
            "order": [[0, 'asc'], [1, 'desc']], // Example sorting
            "searching": true, // Enable overall searching
            "initComplete": function () {
                this.api().columns().every(function () {
                    var column = this;
                    if (column.index() === 1) {
                        // For the "Title" column, create a text input
                        var input = $('<input type="text" placeholder="Search"/>')
                            .appendTo($(column.header()))
                            .on('keyup change', function () {
                                column.search($(this).val(), false, false, true).draw();
                            });
                    } else if (column.index() === 2) {
                        // For the "Status" column, create a select input
                        var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.header()))
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>
@endsection
