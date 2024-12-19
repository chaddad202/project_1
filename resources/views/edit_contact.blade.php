<!-- resources/views/contact_edit.blade.php -->
@extends('layouts.navbar')

@section('name', 'Edite Contact')

@section('content')
<div class="edit-contact-container">
    <h1>Edit Contact</h1>
    <form method="POST" action="  /contact_update/{{$contact->id}}" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <!-- إدخال العنوان -->
        <div class="form-group">
            <label for="name_ar">name in Arabic</label>
            <input type="text" id="name_ar" name="name_ar" value="{{ $contact->name_ar }}">
        </div>
        <div class="form-group">
            <label for="name_en">name in English</label>
            <input type="text" id="name_en" name="name_en" value="{{ $contact->name_en }}">
        </div>

        <div class="form-group">
            <label for="link">Link</label>
            <input type="text" id="link" name="link" value="{{ $contact->link }}">
        </div>


        <!-- إدخال الصورة -->
        <div class="form-group">
            <label for="icon">Icon</label>
            <input type="file" id="icon" name="icon" accept="image/*" onchange="previewImage(event)">

            <p>Current Icon:</p>
                            @if($contact->photo)
                    <img id="current-photo" src="{{url('storage/' . str_replace('public/', '', $contact->photo))}}" alt="Contact Photo">
                @endif
            <div class="image-preview-container">

                <img id="new-icon-preview" src="#" alt="New icon Preview" style="display: none;">
            </div>
        </div>

        <!-- الأزرار -->
        <div class="form-buttons">
            <button type="submit" class="btn-submit">Save</button>
            <a href="/contact_update/{{$contact->id}}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

@endsection

<style>
/* Edit contact Form Styling */
.edit-contact-container {
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