@extends('front.master')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="col-md-12">
                <h2 style="text-align: center; color: darkred; font-weight: bold">Shopping Cart</h2>
            </div>
            <br/>
            <table class="table table-bordered">
                <tr class="bg-dark" style="color: white">
                    <th>Sl</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
                @php($i = 1)
                @php($total = 0)
                @php($sum = 0)
                @foreach($cartProducts as $key => $cartProduct)
                    <tbody>
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td width="10%">
                            <img src="{{ asset('product-images/'.$cartProduct->options->image) }}" style="width: 50px; height: 50px;">
                        </td>
                        <td width="15%">{{ $cartProduct->name }}</td>
                        <td width="20%">
                            <form action="{{ url('/update-cart') }}" method="post">
                                @csrf
                            <input type="hidden" name="rowId" id="rowId" value="{{ $cartProduct->rowId }}">
                            <input type="hidden" id="proId" value="{{ $cartProduct->id }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input id="updateproductQty" style="height: 30px; margin-bottom: 10px; max-width: 100%; text-align: center" name="qty" type="number" value="{{$cartProduct->qty}}"  class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" name="btn" value="">Update</button>
                                    </div>
                                </div>
                            </form>
                        </td>
                        <td>{{ number_format($cartProduct->price, 2) }}Tk.</td>
                        <td>{{ number_format($total = $cartProduct->qty * $cartProduct->price, 2) }}Tk.</td>
                        <td>
                            <a href="{{ url('/product-delete/'.$cartProduct->rowId) }}" class="btn btn-danger">
                                Remove
                            </a>
                        </td>
                    </tr>
                    </tbody>
                    <?php $sum = $sum+$total; ?>
                @endforeach
            </table>
            <br/>
            <div class="col-md-12">
                <h2 style="text-align: center; color: darkred; font-weight: bold">Products Total Price</h2>
            </div>
            <br/>
            <table class="table table-bordered">
                <tr>
                    <td>Total Items Price</td>
                    <td>{{ number_format($sum, 2) }}Tk.</td>
                </tr>
                <tr>
                    <td>Items VAT Price.</td>
                    <td>{{ $vat = 0 }}Tk.</td>
                </tr>
                <tr>
                    <td>Grand Total Price.</td>
                    <td>{{ number_format($sum+$vat, 2) }}Tk.</td>
                </tr>
            </table>
            <br/>
            <div class="col-md-12">
                <a href="{{ url('/') }}" class="btn btn-primary">Continue Shopping</a>
                <a href="{{ url('/checkout') }}" class="btn btn-success float-right">Checkout</a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            <?php for ($i = 1; $i < 30; $i++){?>
                $('#updateproductQty-{{ $i }}').on('change keyup', function (){

                    let newQty = $('#updateproductQty-{{ $i }}').val();
                    let rowId = $('#rowId-{{ $i }}').val();
                    let proId = $('#proId-{{ $i }}').val();
                    console.log(rowId)
                    if (newQty <= 0){
                        alert('Enter a valid number')
                    }else {
                        $.ajax({
                            type: 'get',
                            dataType: 'html',
                            url: '{!! url('/update-cart-product') !!}/' + proId,
                            data: 'qty' + newQty + '& rowId' + rowId + '& proId' + proId,
                            success:function (response){
                                console.log(response);
                            }
                        });
                    }

                });
            <?php } ?>
        });
    </script>
    <script>
        function removeCart(id) {
            $.ajax({
                type:'get',
                url: '{!! url('/remove-cart') !!}',
                datatype: 'html',
                data:{'id':id},
                success:function (data) {
                    window.location.reload();
                }
            });
        }
    </script>
@endsection
