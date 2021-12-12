@extends('admin.layout.content')
@section('title')
    Chi tiết hóa đơn
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="d-flex" style="justify-content: space-between">
                    <div class=" mt-5">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Hóa đơn: {{strtoupper($order->order_code)}}</li>
                            <li class="breadcrumb-item ">Khách hàng: {{$order->name}}</li>
                        </ul>
                    </div>
                    <div class=" mt-5">
                        <p>Ngày lập: {{$order->created_at}}</p>
                    </div>
                </div>
            </div>
            <div class="">
                <form action="">
                    <input type="text" id="" class="id-order" value="{{$order->id}}" hidden>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="0" value="0"  {{$order->status == 0 ? 'checked' : ''}}>
                        <label class="form-check-label txt0" for="0"> Chờ xử lí  </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="1" value="1" {{$order->status == 1 ? 'checked' : ''}}>
                        <label class="form-check-label txt1" for="1"> Đang xử lí  </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="2" value="2" {{$order->status == 2 ? 'checked' : ''}}>
                        <label class="form-check-label txt2" for="2"> Hoàn thành </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="3" value="3"  {{$order->status == 3 ? 'checked' : ''}}>
                        <label class="form-check-label txt3" for="3"> Hủy </label>
                    </div>
                </form>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-center">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Hình ảnh</th>
                                        <th class="text-center">Giá (VNĐ)</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-right">Thành tiền (VNĐ)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $total = 0;
                                    ?>
                                    @foreach($orderDetail as $pro)
                                            <tr>
                                                <td class="text-nowrap">
                                                    <div>{{$pro->product->id}}</div>
                                                </td>
                                                <td class="text-nowrap">{{$pro->product->name}}</td>
                                                <td class="text-nowrap">

                                                    @if($pro->product->image1 != null)
                                                        <img src="{{asset('upload/products/'.$pro->product->image1)}}"
                                                             alt="" class="img-admin" >
                                                    @else
                                                        <img src="{{asset('images/noimage.png')  }}"  class="img-admin" >
                                                    @endif

                                                </td>
                                                <td class="text-center">
                                                    {{ number_format( $pro->product->price,0,',','.')}}
                                                </td>
                                                <td class="text-center">
                                                    {{ $pro->quantily }}
                                                </td>
                                                <td class="text-right">
                                                    <?php
                                                    $subtotal = $pro->quantily * $pro->product->price;
                                                    $total += $subtotal;
                                                    ?>
                                                    {{ number_format( $subtotal,0,',','.')}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @if($pro->voucher_id == null)
                                        <tr>
                                            <td colspan="6" class="text-right" style="    border: none;">
                                                <p>Tổng thanh toán:  {{ number_format( $total ,0,',','.')}} vnđ</p>
                                            </td>
                                        </tr>
                                    @else
                                        <tr style="    border: none;">
                                            <?php
                                            $code = $pro->voucher;
                                            if($code->type == 2){
                                                $giam = $code->number;
                                            }
                                            else{
                                                $giam = ($total / 100) *  $code->number;
                                            }
                                            $totalVoucher = $total - $giam;
                                            ?>
                                            <td colspan="5" class="text-right" style="    border: none;">
                                                <p>Tổng tiền</p>
                                            </td>
                                            <td colspan="1" class="text-right" style="    border: none;">
                                                <p>{{ number_format( $total,0,',','.')}} vnđ</p>
                                            </td>
                                        </tr>
                                        <tr style="    border: none;">

                                            <td colspan="5"  class="text-right" style="    border: none;">
                                                <p>Giảm giá ({{$code->code}})</p>
                                            </td>

                                            <td colspan="1"  class="text-right" style="    border: none;">
                                            <p>  {{ number_format( $giam,0,',','.')}} vnđ</p>
                                            </td>
                                        </tr>
                                        <tr style="    border: none;">
                                            <td colspan="5" class="text-right" style="    border: none;">
                                                <p>Tổng thanh toán</p>
                                            </td>
                                            <td colspan="1" class="text-right" style="    border: none;">
                                                <p>{{ number_format( $totalVoucher,0,',','.')}} vnđ</p>
                                            </td>
                                        </tr>
                                    @endif
                                        <tr style="    border: none;" class="text-right">
                                            <td colspan="5" style="    border: none;">
                                                <p>Địa chỉ nhận hàng</p>
                                            </td>
                                            <td colspan="1" style="    border: none;">
                                                <p>{{$order->address}}</p>
                                            </td>
                                        </tr>
                                    <tr style="    border: none;" class="text-right">
                                        <td colspan="5" style="    border: none;">
                                            <p>Ghi chú</p>
                                        </td>
                                        <td colspan="1" style="    border: none;">
                                            <p>{{$order->note != '' ? $order->note : '...'}}</p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('.form-check-input').click(function(e){
            var idRadio = $(this).val();
            e.preventDefault();

            if(confirm("Xác nhận cập nhật trạng thái đơn hàng?")){

             const x = $(this).val();
             const status = $(this).val();
             const id = $('.id-order').val();
             const txt_status = $(".txt"+x).text();
             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
             $.ajax({
                 url: window.route('order.status'),
                 method:'POST',
                 data:{status:status, id:id, txt_status:txt_status},
                 success:function(data){
                    $('input[type=radio]').prop("checked", "fasle")
                    $('#'+idRadio).prop("checked", "true")
                 }
             })
            }
         })
</script>
@endpush
