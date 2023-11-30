<!-- resources/views/posts/index.blade.php -->

<!-- resources/views/posts/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Add custom styles for card height and width */
        .custom-card {
            width: 300px; /* Set your desired width */
            height: 400px; /* Set your desired height */
            margin: 20px auto; /* Center the card on the screen */
            position: relative; /* Position relative for absolute positioning */
        }

        /* Position buttons at the bottom of the card */
        .card-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
        }

        /* Set background image */
        body {
            background-image: url('/images/background.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #ffffff; /* Set text color for better visibility */
        }

        /* Center the "Create New Post" button */
        .create-post-button {
            display: flex;
            justify-content: center;
            margin: 20px 0; /* Adjust margin as needed */
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="text-center">Post List</h2>

        <div class="create-post-button">
            <a href="{{ route('posts.create') }}" class="btn btn-success">Create New Post</a>
        </div>

        @foreach($posts as $post)
            <div class="row">
                <div class="col-md-12">
                    <div class="card custom-card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title text-center">{{ $post->PostName }}</h5>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ asset('storage/' . $post->PostImage) }}" alt="Post Image" class="img-fluid mb-3 rounded">
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('posts.destroy', $post) }}" method="post" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Archive</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

</body>
</html>
