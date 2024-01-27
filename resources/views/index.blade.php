@extends('master')

@section('content')


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
                @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">$ {{ $product->price }}</p>
                            <input type="hidden" name="product_id" class="product-id" value="{{ $product->id }}">
                            <a  class="btn btn-primary addToCart">Add to Cart</a>
                        </div>
                    </div>
                </div>
            @endforeach
            
                <!-- Repeat the above card structure for each product -->
            </div>
        </section>
    </div>

@endsection

@push('js')
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


    $('.addToCart').click(function(){
        var productId = $(this).closest('.card-body').find('.product-id').val();
         
        $.ajax({
            url: '{{ url("addToCart") }}/' + productId,
            type:'GET',
            processData:false,
            contentType:false,
            header:{
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
            
                if(response.success){
            Swal.fire('Success!', response.success, 'success');
               
                }else{
            Swal.fire('Error!', response.error, 'error');
                }
            console.log(response);
        },
       
        });
    });

    })
</script>
@endpush

