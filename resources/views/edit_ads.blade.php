<!-- resources/views/ads_edit.blade.php -->
@extends('layouts.navbar')

@section('title', 'Edit Ads')

@section('content')
<div class="edit-ads-container">
    <h1>Edit ads</h1>
    <form method="POST" action=" /ads_update/{{$ads->id}}" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <!-- إدخال العنوان -->
        <div class="form-group">
            <label for="title_ar">Title in Arabic</label>
            <input type="text" id="title_ar" name="title_ar" value="{{ $ads->title_ar }}">
        </div>
        <div class="form-group">
            <label for="title_en">Title in English</label>
            <input type="text" id="title_en" name="title_en" value="{{ $ads->title_en }}">
        </div>

        <!-- إدخال الوصف -->
        <div class="form-group">
            <label for="description_ar">Description in Arabic</label>
            <textarea id="description_ar" name="description_ar" rows="4">{{ $ads->description_ar }}</textarea>
        </div>
        <div class="form-group">
            <label for="description_en">Description in English</label>
            <textarea id="description_en" name="description_en" rows="4">{{ $ads->description_en }}</textarea>
        </div>

        <!-- إدخال الصورة -->
        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" id="photo" name="photo" accept="image/*" onchange="previewImage(event)">

            <p>Current Photo:</p>
            <div class="image-preview-container">
                @if($ads->photo)
                    <img id="current-photo" src="{{url('storage/' . str_replace('public/', '', $ads->photo))}}" alt="ads Photo">
                @endif
                <img id="new-photo-preview" src="#" alt="New Photo Preview" style="display: none;">
            </div>
        </div>

        <!-- الأزرار -->
        <div class="form-buttons">
            <button type="submit" class="btn-submit">Save</button>
            <a href="{{ route('ads.show') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

@endsection

<style>
/* Edit ads Form Styling */
.edit-ads-container {
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
        const currentPhoto = document.getElementById('current-photo');

        reader.onload = function () {
            // Hide the current photo and show the new one
            if (currentPhoto) currentPhoto.style.display = 'none';
            preview.style.display = 'block';
            preview.src = reader.result;
        };

        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
