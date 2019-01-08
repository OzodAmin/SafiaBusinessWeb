@extends('admin.layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Order #{{ $order->id }}&nbsp;<a href="{!! route('orders.index') !!}" class="btn btn-default">Cancel</a>
        </div>
        <div class="panel-body">
            {!! Form::model($order, ['route' => ['orders.update', $order->id], 'method' => 'patch']) !!}

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th class="col-sm-2"></th>
                    <th class="col-sm-4">Product</th>
                    <th class="col-sm-2">Price</th>
                    <th class="col-sm-1">Quantity</th>
                    <th class="col-sm-2">Total</th>
                    <th class="col-sm-1"></th>
                </tr>
                </thead>
                <tbody>

                @foreach($order->products as $product)
                    <tr class="products-users">
                        <td class="col-sm-2">
                            @if ($product->featured_image)
                                {{ Html::image('uploads/product/admin_'.$product->featured_image) }}
                            @else
                                {{ Html::image('img/320.jpg') }}
                            @endif
                        </td>
                        <td class="col-sm-4">
                            {{ $product->translate('ru')->title }}
                        </td>
                        <td class="col-sm-2">
                            <span id="price_{{ $product->id }}">{{ $product->price }}</span>&nbsp;Сум
                            <p>{{ $product->min_order }}
                                &nbsp;{{ $product->measure->translate($locale)->title_short }}</p>
                        </td>
                        <td class="col-sm-1">
                            <input type="text" name="quantity[]" value="{{ $product->pivot->quantity }}"
                                   onchange="qtyChange({{ $product->id }}, this.value)"
                                   onkeypress="javascript:return isNumber(event)">
                            <input type="hidden" name="ptoduct_id[]" value="{{ $product->id }}">
                            &nbsp;
                            {{ $product->measure->translate('ru')->title_short }}
                        </td>
                        <td class="col-sm-2">
                            <span id="total_{{ $product->id }}" class="prices">
                                {{ $product->price * $product->pivot->quantity }}
                            </span>
                            &nbsp;Сум
                        </td>
                        <td class="col-sm-1">
                            <a class="btn btn-danger" onclick="deleteProduct(<?= $order->id.','.$product->id; ?>)">
                                <i class="fa fa-btn fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="col-sm-2">
                        Customer:
                    </td>
                    <td colspan="4">
                        {{ $order->user->companyName }}&nbsp;({{ $order->user->companyLegalName }})
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-2">
                        Created at:
                    </td>
                    <td colspan="4">
                        <?= date("d.m.Y", strtotime($order->created_at)); ?>
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-2">
                        Prefered time:
                    </td>
                    <td colspan="4">
                        {{ $order->prefered_time }}
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-2">
                        Note:
                    </td>
                    <td colspan="4">
                        {{ $order->note }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="2">
                        <?php $statusArray = [Order::NEW_ORDER => 'New', Order::ACCEPTED_ORDER => 'Accepted', Order::DECLINED_ORDER => 'Declined']; ?>
                        {!! Form::select('status', $statusArray, null, ['class' => 'form-control']) !!}
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>
                        Total:
                    </td>
                    <td>
                        <input id="cartTotal" name="total_price" type="text" value="{{ $order->total_price }}" readonly>
                        &nbsp;Cум
                    </td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        <a href="{!! route('orders.index') !!}" class="btn btn-default">Cancel</a>
                    </td>
                </tr>


                </tbody>
            </table>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function deleteProduct(orderId, productId){
            $.ajax({
                type: "GET",
                url: "{{url('backend/removeProductFromOrder')}}?orderId=" + orderId + "&productId=" + productId,
                success: function (res) {
                    if (res) {
                        //swal(nameProduct, "is added to cart !", "success");
                    }
                }
            });
        }
        function qtyChange(id, val) {
            var price = Number($('#price_' + id).text());
            var result = val * price;
            $('#total_' + id).text(result);
            calculate();
        }

        function isNumber(evt) {
            var iKeyCode = (evt.which) ? evt.which : evt.keyCode
            if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
                return false;

            return true;
        }

        function calculate() {
            var divs = document.getElementsByClassName("prices");
            var totalCartPrice = 0;
            for (var i = 0; i < divs.length; i += 1) {
                totalCartPrice += Number(divs[i].innerHTML);
            }
            $('#cartTotal').val(totalCartPrice);
        }
    </script>

@endsection