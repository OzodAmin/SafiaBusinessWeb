@extends('layouts.app')
@section('title')
    User account
@endsection
@section('content')
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url({{ asset('front/images/icons/heading-bg.jpg') }});">
        <h2 class="l-text2 t-center">
            {{ $user->name }}
        </h2>
    </section>

    <!-- content page -->
    <section class="bgwhite p-t-66 p-b-38">
        <div class="container">
            <div class="row">
                <div class="col-md-4 p-b-30">
                    <div class="hov-img-zoom">
                        <img src="{{ asset('front/images/icons/account.jpg') }}" alt="IMG-ABOUT">
                    </div>
                </div>

                <div class="col-md-8 p-b-30">
                    <h3 class=" p-t-15 p-b-16">
                        {{ $user->companyName }}
                    </h3>
                    <h3 class="m-text26 p-t-15 p-b-16">
                        {{ $user->companyLegalName }}
                    </h3>
                    <h3 class="m-text26 p-t-15 p-b-16">
                        {{ $user->email }}
                    </h3>
                    <h3 class="m-text26 p-t-15 p-b-16">
                        City, District, {{ $user->address }}
                    </h3>
                    <h3 class="m-text26 p-t-15 p-b-16">
                        {{ $user->mobile }}
                    </h3>
                    <h3 class="m-text26 p-t-15 p-b-16">
                        {{ $user->phone }}
                    </h3>                   
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
        function addtocart(nameProduct, id) {

            var cartProductId = $("#cartProductId-" + id).html();

            if (typeof cartProductId == 'undefined') {
                $.ajax({
                    type: "GET",
                    url: "{{url('add-to-cart')}}?id=" + id,
                    success: function (res) {
                        if (res) {
                            swal(nameProduct, "is added to cart !", "success");
                            var cartQty = $('.cartQty').html();
                            cartQty++;
                            $('.cartQty').text(cartQty);
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        swal("Status: " + textStatus, "Error: " + errorThrown, "error");
                    }
                });
            } else {
                swal("Ooops..", "This product already in busket", "error");
            }
        };

        /*[ +/- num product ]*/
        $('.btn-num-product-down').on('click', function (e) {
            e.preventDefault();
            var numProduct = Number($(this).next().val());
            if (numProduct > 1) $(this).next().val(numProduct - 1);
        });

        $('.btn-num-product-up').on('click', function (e) {
            e.preventDefault();
            var numProduct = Number($(this).prev().prev().val());
            $(this).prev().prev().val(numProduct + 1);
        });
    </script>
@endsection