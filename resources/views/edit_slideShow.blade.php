<!-- resources/views/slideShow_edit.blade.php -->
@extends('layouts.navbar')

@section('name', 'Edite Slide Show')

@section('content')
<div class="edit-slideShow-container">
    <h1>Edit slideShow</h1>
    <form method="POST" action="  /slideShow_update/{{$slideShow->id}}" enctype="multipart/form-data">
        @csrf
        @method('POST')



        <!-- إدخال الصورة -->
        <div class="form-group">
            <label for="photo">photo</label>
            <input type="file" id="photo" name="photo" accept="image/*" onchange="previewImage(event)">

            <p>Current photo:</p>
                            @if($slideShow->photo)
                    <img id="current-photo" src="{{url('storage/' . str_replace('public/', '', $slideShow->photo))}}" alt="slideShow Photo">
                @endif
            <div class="image-preview-container">

                <img id="new-photo-preview" src="#" alt="New photo Preview" style="display: none;">
            </div>
        </div>

        <!-- الأزرار -->
        <div class="form-buttons">
            <button type="submit" class="btn-submit">Save</button>
            <a href="/slideShow_update/{{$slideShow->id}}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

@endsection

<style>
/* Edit slideShow Form Styling */
.edit-slideShow-container {
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
        const preview = document.getElementById('new-photo-preview');
        const currentphoto = document.getElementById('current-photo');

        reader.onload = function () {
            // Hide the current photo and show the new one
            if (currentphoto) currentphoto.style.display = 'none';
            preview.style.display = 'block';
            preview.src = reader.result;
        };

        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
