<!-- resources/views/posts/create.blade.php -->




<div class="container">
        <h2>Create New Post</h2>

        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <label for="PostName">Post Name:</label>
            <input type="text" name="PostName" required>

            <label for="PostImage">Post Image:</label>
            <input type="file" name="PostImage" accept="image/*" id="imageInput" onchange="previewImage()" required>

            <!-- Image Preview -->
            <img id="imagePreview" src="#" alt="Preview" style="max-width: 100%; display: none;">

            <!-- Add other fields as needed -->

            <button type="submit">Submit</button>
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

