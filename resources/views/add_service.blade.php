<!-- resources/views/service_add.blade.php -->
@extends('layouts.navbar')

@section('name', 'Add service')

@section('content')
<div class="add-service-container">
    <h1>Add service</h1>
<form method="POST" action="{{ route('service.store') }}" enctype="multipart/form-data">
    @csrf
    @method('POST')

    <!-- حقل مخفي للـ category_id -->
    <div class="form-group">
    <input type="hidden" name="category_id" value="{{ $category_id }}">
    </div>
    <!-- إدخال العنوان -->
     <div class="form-group">
            <label for="title_ar">Title in Arabic</label>
            <input type="text" id="title_ar" name="title_ar"">
        </div>
        <div class="form-group">
            <label for="title_en">Title in English</label>
            <input type="text" id="title_en" name="title_en" ">
        </div>

        <!-- إدخال الوصف -->
        <div class="form-group">
            <label for="description_ar">Description in Arabic</label>
            <textarea id="description_ar" name="description_ar" rows="4"></textarea>
        </div>
        <div class="form-group">
            <label for="description_en">Description in English</label>
            <textarea id="description_en" name="description_en" rows="4"></textarea>
        </div>

    <!-- الأزرار -->
    <div class="form-buttons">
        <button type="submit" class="btn-submit">Save</button>
        <a href="{{ route('service.index', ['category_id' => $category_id]) }}" class="btn-cancel">Cancel</a>
    </div>
</form>

</div>

@endsection

<style>
/* add service Form Styling */
.add-service-container {
    max-width: 600px;
    margin: 0 auto;
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
}

input[type="text"],
textarea,
input[type="file"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

textarea {
    resize: vertical;
}

.image-preview-container {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.image-preview-container img {
    width: 150px;
    height: 150px;
    object-fit: cover; /* يجعل الصورة مربعة وتملأ الإطار */
    border: 1px solid #ddd;
    border-radius: 4px;
}

.form-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.btn-submit,
.btn-cancel {
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    font-size: 14px;
    cursor: pointer;
}

.btn-submit {
    background-color: #28a745;
    color: white;
}

.btn-submit:hover {
    background-color: #218838;
}

.btn-cancel {
    background-color: #dc3545;
    color: white;
}

.btn-cancel:hover {
    background-color: #c82333;
}
</style>

<script>
    // JavaScript function to preview the new image
    function previewImage(event) {
        const input = event.target;
        const reader = new FileReader();
        const preview = document.getElementById('new-icon-preview');
        const currenticon = document.getElementById('current-icon');

        reader.onload = function () {
            // Hide the current icon and show the new one
            if (currenticon) currenticon.style.display = 'none';
            preview.style.display = 'block';
            preview.src = reader.result;
        };

        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
