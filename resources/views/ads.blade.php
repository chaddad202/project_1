@extends('layouts.navbar')
<link rel="stylesheet" href="{{ asset('css/table.css') }}">
@section('title', 'Category')

@section('content')
     <h1>All Ads</h1>
        <table id="example" class="data_table" style="width:100%">
            <div class="button-div">
                    <a href="ads_add" class="button" >Add Ads</a>
                  </div>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
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
                url: '{{ route("ads.index") }}',
                type: 'GET',
                dataSrc: 'data',
            },
            columns: [
                { data: 'id' },
                {
                    data: 'photo',
                    render: function (data, type, row) {
                                return `<img src="${data}" alt="Image" style="width: 50px; height: 50px; border-radius: 5px;">`;
                    }
                },
                { data: 'title' },
                { data: 'description' },
                {
                    "data": "id",
                    "bSortable": false,
                    "mRender": function (data) {
                      return '<a class="edit-button-table" href="/ads_edit/'+data+'">Edit</a>';
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
            var adsId = $(this).data('id');

            if (confirm('Are you sure you want to delete this category?')) {
                $.ajax({
                    url: '/ads_destroy/' + adsId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        alert('Ads deleted successfully');
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
