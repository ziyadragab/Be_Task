@extends('master')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8 table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (auth()->user()->carts as $cart)
                    <tr>
                        <td class="align-middle">
                            <div class="d-flex align-items-center">
                                {{ $cart->product->name }}
                            </div>
                        </td>
                        <td class="align-middle">${{ $cart->product->price }}</td>
                        <td class="align-middle">
                            <div class="input-group quantity" style="width: 100px;">
                                <input type="number" id="quantity_{{ $cart->id }}"
                                    value="1" data-price="{{ $cart->product->price }}"
                                    data-cart-id="{{ $cart->id }}" oninput="calculateTotal(this)">
                            </div>
                            
                        </td>
                        <td class="align-middle">
                            <span id="total_{{ $cart->id }}">${{ $cart->product->price }}</span>
                        </td>
                        <td class="align-middle">
                            <form action="{{ route('cart.delete',$cart) }}" method="post">
                                @csrf
                                <button class="btn btn-sm btn-danger" type="submit">
                                    delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No items in the cart.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            
            <form action="{{ route('order.store') }}" method="post">
                @csrf
                <div class="card mb-3">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Add To Order</h5>
                    </div>
                    <div class="card-body">
                       
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
            
                     
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}" required>
                            @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="zip_code">ZIP Code</label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ old('zip_code') }}" required>
                            @error('zip_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                      
                        <div class="d-flex justify-content-between mb-3">
                            <h5>Sub Total</h5>
                            <h5 id="overallTotal">$0</h5>
                            <input type="hidden" name="total_price" id="hiddenTotal" value="0">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>

<script>
  
    function calculateTotal(element) {
        var quantity = parseInt(element.value);
        var price = parseFloat(element.getAttribute('data-price'));
        var cartId = element.getAttribute('data-cart-id');

        
        if (isNaN(quantity) || quantity < 1) {
            quantity = 1;
        }

        var total = quantity * price;
        document.getElementById('total_' + cartId).innerText = '$' + total.toFixed(2);

        updateOverallTotal();
    }

 
    function updateOverallTotal() {
        var overallTotal = 0;

        $('.quantity input').each(function () {
            var cartId = $(this).attr('id').split('_')[1];
            var total = parseFloat($('#total_' + cartId).text().replace('$', ''));

            if (!isNaN(total)) {
                overallTotal += total;
            }
        });

        $('#overallTotal').text('$' + overallTotal.toFixed(2));
        $('#hiddenTotal').val(overallTotal.toFixed(2));
    }

   
    $('.quantity input').val(1).trigger('change');

    updateOverallTotal();
</script>


@endsection
