<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-main table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Images</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carts as $cart)
                        <tr>
                            <td class="thumbnail-img">
                                <a href="/client/detail/{{ $cart->idProduct }}">
                                    <img class="img-fluid" src="{{ $cart->imageProduct }}" alt="" />
                                </a>
                            </td>
                            <td class="name-pr">
                                <a href="#">
                                    {{ $cart->nameProduct }}
                                </a>
                            </td>
                            <td class="price-pr">
                                <p>$ {{ $cart->priceProduct }}</p>
                            </td>
                            <td class="quantity-box">
                                <input type="hidden" id="idChange{{ $cart->id }}" value="{{ $cart->id }}">
                                <input type="number" id="changeCountBuy{{ $cart->id }}" value="{{ $cart->count }}" max="15" min="1" step="1" class="c-input-text qty text">
                            </td>
                            <td class="remove-pr">
                                <input type="hidden" id="idDelete{{ $cart->id }}" value="{{ $cart->id }}">
                                <a style="cursor: pointer;" id="clickDelete{{ $cart->id }}"><i class="fas fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row my-5">
        <div class="col-lg-8 col-sm-12"></div>
        <div class="col-lg-4 col-sm-12">
            <div class="order-box">
                <div class="d-flex gr-total">
                    <h5>Grand Total</h5>
                    <div class="ml-auto h5"> $ {{ $total }} </div>
                </div>
                <hr>
            </div>
        </div>
        <div class="col-12 d-flex shopping-box">
            @if (isset($_SESSION['user']))
            <input type="hidden" id="checkID" value="{{ $_SESSION['idUser'] }}">
            <a id="checkOrder" value="123123" class="ml-auto btn hvr-hover" style="padding: .8rem 4rem !important; cursor: pointer; color: #ffffff;">Checkout</a>
            @else
            <a href="/client/login" class="ml-auto btn hvr-hover" style="padding: .8rem 4rem !important">Checkout</a>
            @endif
        </div>
    </div>

</div>