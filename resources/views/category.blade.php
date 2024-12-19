@extends('layouts.navbar')
<link rel="stylesheet" href="{{ asset('css/table.css') }}">
@section('title', 'Category')

@section('content')
<h1>All Categories</h1>
<table id="example" class="data_table" style="width:100%">
            <div class="button-div">
                    <a href="category_add" class="button" >Add category</a>
                  </div>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th></th>
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
                url: '{{ route("category.index") }}',
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
                      return '<a class="edit-button-table" href="/category_edit/'+data+'">Edit</a>';
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
                {
        "data": "id",
        "bSortable": false,
        "mRender": function (data) {
            return `<a class="services-button-table" href="/service_page/${data} ">Services</a> `;
        }
    },
            ]
        });

        // Handling Delete button click event
        $('#example').on('click', '.delete-button-table', function() {
            var categoryId = $(this).data('id');

            if (confirm('Are you sure you want to delete this category?')) {
                $.ajax({
                    url: '/category_destroy/' + categoryId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        alert('Category deleted successfully');
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
<style>
/* زر الخدمات */
.services-button-table {
    display: inline-block;
    padding: 5px 10px;
    color: white;
    background-color: #007bff; /* لون أزرق */
    border: none;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
    transition: background-color 0.3s;
}

.services-button-table:hover {
    background-color: #0056b3; /* لون أزرق أغمق عند التمرير */
}
</style>
