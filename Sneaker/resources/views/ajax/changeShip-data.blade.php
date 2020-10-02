<div class="order-box">
    <div class="title-left">
        <h3>Your order</h3>
    </div>
    <div class="d-flex">
        <div class="font-weight-bold">Product</div>
        <div class="ml-auto font-weight-bold">Total</div>
    </div>
    <hr class="my-1">
    <div class="d-flex">
        <h4>Sub Total</h4>
        <div class="ml-auto font-weight-bold"> $ {{ $total }} </div>
    </div>
    <hr class="my-1">
    <div class="d-flex">
        <h4>Shipping Cost</h4>
        @if ( $priceShip == 0)
            <div class="ml-auto font-weight-bold"> Free </div>
        @else
            <div class="ml-auto font-weight-bold">$ {{ $priceShip }} </div>
        @endif
    </div>
    <hr>
    <div class="d-flex gr-total">
        <h5>Grand Total</h5>
        <div class="ml-auto h5">
            <input type="hidden" value="{{ $total }}" name="total">
            $ {{ $total }}
        </div>
    </div>
    <hr>
</div>