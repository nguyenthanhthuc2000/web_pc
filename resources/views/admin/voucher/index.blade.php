@extends('admin.layout.content')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="d-flex" style="justify-content: space-between">
                    <div class=" mt-5">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Mã giảm giá</li>
                        </ul>
                    </div>
                    <div class=" mt-5">
                        <a href="{{ route('voucher.add') }}" class="badge badge-pill bg-success inv-badge">Thêm mới</a>
                    </div>
                </div>
            </div>
            @include('notification')
            <div class="row">
                <div class="col-md-12 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-center">
                                    <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Mã</th>
                                        <th>Giảm</th>
                                        <th>Hình thức</th>
                                        <th>Đã dùng</th>
                                        <th>Còn lại</th>
                                        <th>Trạng thái</th>
                                        <th class="text-right">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if($vouchers->count() > 0)
                                        @foreach($vouchers as $voucher)
                                            <tr>
                                                <td class="text-nowrap">
                                                    <div>{{strtoupper($voucher->name)}}</div>
                                                </td>
                                                <td>{{$voucher->voucher}}</td>
                                                <th>{{$voucher->number}}</th>
                                                <th>
                                                    @if($voucher->type == 1)
                                                        %
                                                    @else
                                                        VNĐ
                                                    @endif
                                                </th>
                                                <td>
                                                    {{number_format($voucher->total, 0,' ,',' .')}}
                                                </td>
                                                <td>
                                                    {{$voucher->used}}
                                                </td>
                                                <td>
                                                    <input type="checkbox" {{$voucher->status == 1 ? 'checked' : ''}}  class="status" data-id="{{$voucher->id}}">

                                                </td>
                                                <td class="text-right">
                                                    <a href="{{ route('voucher.edit', $voucher->id) }}" class=" btn-border btn-custom  btn btn-warning">Xem</a>
                                                    <button type="button" class="btn-border btn-custom btn btn-danger btn-delete"
                                                            data-url="{{ route('order.destroy', $voucher->id) }}"
                                                    >Xóa
                                                    </button>
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
                                    {{ $vouchers->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

