<div class="row">
    @foreach ($product as $value)
    <div class="col-xl-5 col-lg-5 col-md-6">
        <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active"> <img class="d-block w-100" height="400px" src="{{ $value->imgSP1 }}" alt="First slide"> </div>
                <div class="carousel-item"> <img class="d-block w-100" height="400px" src="{{ $value->imgSP2 }}" alt="Second slide"> </div>
                <div class="carousel-item"> <img class="d-block w-100" height="400px" src="{{ $value->imgSP3 }}" alt="Third slide"> </div>
            </div>
            <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                <span class="sr-only">Next</span>
            </a>
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-1" data-slide-to="0" class="active">
                    <img class="d-block w-100 img-fluid" src="{{ $value->imgSP1 }}" alt="" />
                </li>
                <li data-target="#carousel-example-1" data-slide-to="1">
                    <img class="d-block w-100 img-fluid" src="{{ $value->imgSP2 }}" alt="" />
                </li>
                <li data-target="#carousel-example-1" data-slide-to="2">
                    <img class="d-block w-100 img-fluid" src="{{ $value->imgSP3 }}" alt="" />
                </li>
            </ol>
        </div>
    </div>
    <div class="col-xl-7 col-lg-7 col-md-6">
        <div class="single-product-details">
            <h2>Fachion Lorem ipsum dolor sit amet</h2>
            <h5> <del>$ 60.00</del> $40.79</h5>
            <p class="available-stock"><span> More than 20 available / <a href="#">8 sold </a></span>
                <p>
                    <h4>Short Description:</h4>
                    <p>Nam sagittis a augue eget scelerisque. Nullam lacinia consectetur sagittis. Nam sed neque id eros fermentum dignissim quis at tortor. Nullam ultricies urna quis sem sagittis pharetra. Nam erat turpis, cursus in ipsum at,
                        tempor imperdiet metus. In interdum id nulla tristique accumsan. Ut semper in quam nec pretium. Donec egestas finibus suscipit. Curabitur tincidunt convallis arcu. </p>
                    <ul>
                        <li>
                            <div class="form-group quantity-box">
                                <label class="control-label">Quantity</label>
                                <input class="form-control" value="1" min="1" max="20" type="number" id="countBuy">
                            </div>
                        </li>
                    </ul>

                    <div class="price-box-bar">
                        <div class="cart-and-bay-btn">
                            <input type="hidden" value="{{ $value->id }}" id="idProduct">
                            <a class="btn hvr-hover" style="color: #ffffff;" id="addProduct">Add to cart</a>
                        </div>
                    </div>

                    <div class="add-to-btn">
                        <div class="add-comp">
                            <a class="btn hvr-hover" href="#"><i class="fas fa-heart"></i> Add to wishlist</a>
                            <a class="btn hvr-hover" href="#"><i class="fas fa-sync-alt"></i> Add to Compare</a>
                        </div>
                    </div>
        </div>
    </div>
    @endforeach
</div>