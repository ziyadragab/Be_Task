<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        nav {
            display: flex;
            justify-content: center;
            background-color: #555;
            padding: 10px;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 0 10px;
        }

        nav a:hover {
            background-color: #777;
        }

        section {
            padding: 20px;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <header>
        <h1>Task</h1>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Task</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('registerForm')}}">Sign In</a>
                    </li>
                    @endguest

                    @auth
                    <li class="nav-item">
                        <a type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            data-bs-whatever="@mdo">Create New Product</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link">User :{{auth()->user()->name}}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="">Carts(0)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('logout')}}">Sign Out</a>
                    </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id='productForm' action="{{ route('storeProduct') }}" method="POST">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="recipient-name" name="name">
                            <span id="nameError" class="text-danger error-message"></span>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-price" class="col-form-label">Price</label>
                            <input type="text" class="form-control" id="recipient-price" name="price">
                            <span id="priceError" class="text-danger error-message"></span>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Description:</label>
                            <textarea class="form-control" id="message-text" name="description"></textarea>
                            <span id="descriptionError" class="text-danger error-message"></span>
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <span id="imageError" class="text-danger error-message"></span>

                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Category</label>
                            <select name="category_id" class="form-control" id="category_id">
                                <option value="">__Select__</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <span id="categoryError" class="text-danger error-message"></span>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id='createProduct' class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>


    <div id="products-container">
        <section class="container mt-4">
            <h2>Products</h2>
            <div class="row">
                <!-- Sample card for demonstration purposes -->
                @foreach ($products as $product )
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{asset('storage/'.$product->image)}}" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">{{$product->name}}</h5>
                            <p class="card-text">{{$product->description}}</p>
                            <p class="card-text"> ${{$product->price}}</p>
                            <a href="#" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- Repeat the above card structure for each product -->
            </div>
        </section>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @include('sweetalert::alert')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function(){
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $('#createProduct').click(function(){

            $('.error-message').html('');
            var form = $('#productForm');
            var formData=new FormData(form[0]);
            var url = form.attr('action');
            var method = form.attr('method');
            console.log(formData);
            $.ajax({
                url: url,
                type: method,
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {

                     form[0].reset();
                     Swal.fire('Success!', response.message, 'success');
                     $('#exampleModal').modal('hide');
                     window.location.reload();
                },
                error: function(error) {

                    if (error) {
                            $('#nameError').html(error.responseJSON.errors.name);
                            $('#priceError').html(error.responseJSON.errors.price);
                            $('#descriptionError').html(error.responseJSON.errors.description);
                            $('#imageError').html(error.responseJSON.errors.image);
                            $('#categoryError').html(error.responseJSON.errors.category_id);
                }
            }
            });
        });
        })
    </script>
</body>

</html>