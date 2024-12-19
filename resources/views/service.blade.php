@extends('layouts.navbar')
<link rel="stylesheet" href="{{ asset('css/table.css') }}">
@section('title', 'service')

@section('content')
<h1>All Services</h1>
<table id="example" class="data_table" style="width:100%">
            <div class="button-div">
                    <a href="{{ route("service.add", ["category_id" => $category_id]) }}" class="button" >Add service</a>
                  </div>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
        </table>
        <link rel="stylesheet" href="{{asset('css/table.css')}}">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function () {
                var table = $('#example').DataTable({
                    processing: true,


                    ajax: {
                        url: '{{ route("service.index", ["category_id" => $category_id]) }}',
                        type: 'GET',
                        dataSrc: 'data',
                    },
                    // $('#example').on('xhr.dt', function (e, settings, json) {
                    // if (json.data.length === 0) {
                    //     alert('No services found.');
                    // }
                    // });
            columns: [
                { data: 'id' },


                { data: 'title' },
                { data: 'description' },
                {
                    "data": "id",
                    "bSortable": false,
                    "mRender": function (data) {
                      return '<a class="edit-button-table" href="/service_edit/'+data+'">Edit</a>';
                    }
                },
                {
                    "data": "id",
                    "bSortable": false,
                    "mRender": function (data) {
                      return `
                          <button class="delete-button-table" data-id="${data}">Delete</button>
                      `;
                    }
                },

            ]
        });

        // Handling Delete button click event
        $('#example').on('click', '.delete-button-table', function() {
            var serviceId = $(this).data('id');

            if (confirm('Are you sure you want to delete this service?')) {
                $.ajax({
                    url: '/service_destroy/' + serviceId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        alert('service deleted successfully');
                        table.ajax.reload(); // Reload DataTable
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            }
        });
    });

</script>

@endsection

