@extends('admin.layout.content')
@section('title')
    Đơn hàng
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12 mt-5">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Đơn hàng</li>
                        </ul>
                    </div>
                </div>
            </div>
            @include('notification')
            <div class="row">
                <div class="top-nav-search" style="margin: 0 0 20px 15px;">
                    <form style="margin: 0" method="get" action="{{ route('order.index') }}">
                        @csrf
                        <input type="text" class="form-control" name="order_code" placeholder="Mã hóa đơn">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="col-md-12 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-center">
                                    <thead>
                                    <tr>
                                        <th>Mã HD</th>
                                        <th>Khách hàng</th>
                                        <th>SĐT</th>
                                        <th>Ngày dặt</th>
                                        <th class="text-center">Tổng</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-right">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if($orders->count() > 0)
                                        @foreach($orders as $order)
                                        <tr>
                                            <td class="text-nowrap">
                                                <div>{{strtoupper($order->order_code)}}</div>
                                            </td>
                                            <td >{{$order->name}}</td>
                                            <td>
                                                {{$order->phone}}
                                            </td>
                                            <td>{{$order->created_at}}</td>
                                            <td class="text-center">{{number_format($order->total,0,',','.')}}</td>
                                            <td class="text-center">
                                                @if($order->status == 0)
                                                    Chờ xử lí
                                                @elseif($order->status == 1)
                                                    Đang xử lí
                                                @elseif($order->status == 2)
                                                    Hoàn thành
                                                @else
                                                    Đã hủy
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <a href="{{ route('order.detail', $order->id) }}" class=" btn-border btn-custom  btn btn-warning">Xem</a>
                                                @if(Auth::user()->level == 1)
                                                    <button type="button" class="btn-border btn-custom btn btn-danger btn-delete"
                                                            data-url="{{ route('order.destroy', $order->id) }}"
                                                    >Xóa
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">
                                                Không có dữ liệu
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                <div style="float: right" class="mr-4 mt-2">
                                    {{ $orders->links() }}
                                </div>
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

        //xóa
        $('.btn-delete').click(function(){
            var url = $(this).data('url');
            Swal.fire({
              title: 'Bạn có chắc xóa không?',
              text: "Bạn sẽ không thể khôi phục điều này!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ok, Xóa',
              cancelButtonText: 'Hủy'
            }).then((result) => {
              if (result.isConfirmed) {
                   window.location.href = url;
              }
            })

        })
    </script>
@endpush
