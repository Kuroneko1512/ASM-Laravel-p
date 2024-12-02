@extends('client.layouts.master')

@section('title', 'Shop Single')

@section('contents')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="index.html">Home</a>
                    <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">{{ $product->name }}</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="/client/images/cloth_1.jpg" alt="Image" class="img-fluid" />
                </div>
                <div class="col-md-6">
                    <h2 class="text-black">{{ $product->name }}</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, vitae, explicabo? Incidunt
                        facere, natus soluta dolores iusto! Molestiae expedita veritatis nesciunt
                        doloremque sint asperiores fuga voluptas, distinctio, aperiam, ratione dolore.
                    </p>
                    <p class="mb-4">
                        Ex numquam veritatis debitis minima quo error quam eos dolorum quidem perferendis. Quos repellat
                        dignissimos minus, eveniet nam voluptatibus molestias omnis reiciendis
                        perspiciatis illum hic magni iste, velit aperiam quis.
                    </p>
                    <p><strong class="text-primary h4">{{ number_format($product->price, 0, ',', '.') }} VND</strong></p>
                    <div class="mb-1 d-flex">
                        <label for="option-sm" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2" style="top: -2px; position: relative"><input type="radio"
                                    id="option-sm" name="shop-sizes" /></span>
                            <span class="d-inline-block text-black">Small</span>
                        </label>
                        <label for="option-md" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2" style="top: -2px; position: relative"><input type="radio"
                                    id="option-md" name="shop-sizes" /></span>
                            <span class="d-inline-block text-black">Medium</span>
                        </label>
                        <label for="option-lg" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2" style="top: -2px; position: relative"><input type="radio"
                                    id="option-lg" name="shop-sizes" /></span>
                            <span class="d-inline-block text-black">Large</span>
                        </label>
                        <label for="option-xl" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2" style="top: -2px; position: relative"><input type="radio"
                                    id="option-xl" name="shop-sizes" /></span>
                            <span class="d-inline-block text-black">Extra Large</span>
                        </label>
                    </div>
                    {{-- <div class="mb-5">
                        <div class="input-group mb-3" style="max-width: 120px">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                            </div>
                            <input type="text" class="form-control text-center" value="1" placeholder=""
                                aria-label="Example text with button addon" aria-describedby="button-addon1" />
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <p><a href="cart.html" class="buy-now btn btn-sm btn-primary">Add To Cart</a></p> --}}
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="variant_id" value="{{ $defaultVariant->id ?? '' }}">
                    
                        <!-- Giữ nguyên phần quantity selection hiện tại -->
                        <div class="mb-5">
                            <div class="input-group mb-3" style="max-width: 120px">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                                </div>
                                <input type="text" name="quantity" class="form-control text-center" value="1"
                                    min="1" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                                </div>
                            </div>
                        </div>
                    
                        <button type="submit" class="buy-now btn btn-sm btn-primary">Add To Cart</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- featured products --}}
    @include('client.components.featured-product', ['products' => $featuredProducts])

@endsection
