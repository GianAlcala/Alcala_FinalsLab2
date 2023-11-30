<!-- resources/views/posts/edit.blade.php -->

<div class="container">
        <h2>Edit Post</h2>

        <form action="{{ route('posts.update', $post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="PostName">Post Name:</label>
            <input type="text" name="PostName" value="{{ $post->PostName }}" required>

            <label for="PostImage">Post Image:</label>
            <input type="file" name="PostImage" accept="image/*" id="imageInput" onchange="previewImage()">

            <!-- Current Image Preview -->
            <p><strong>Current Image:</strong></p>
            <img src="{{ asset('storage/' . $post->PostImage) }}" alt="Current Image" style="max-width: 100%;">

            <!-- Image Preview for New Image -->
            <p><strong>New Image Preview:</strong></p>
            <img id="imagePreview" src="#" alt="Preview" style="max-width: 300px; max-height: 300px; display: none;">

            <!-- Add other fields as needed -->

            <button type="submit">Update</button>
        </form>
    </div>

    <script>
        function previewImage() {
            var preview = document.getElementById('imagePreview');
            var fileInput = document.getElementById('imageInput');

            // Ensure it's an image file
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>