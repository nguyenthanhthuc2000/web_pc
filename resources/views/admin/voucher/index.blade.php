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
                                        <th  class="text-center">Giảm</th>
                                        <th class="text-center">Hình thức</th>
                                        <th class="text-center">Đã dùng</th>
                                        <th class="text-center">Còn lại</th>
                                        <th  class="text-center">Trạng thái</th>
                                        <th class="text-right">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if($vouchers->count() > 0)
                                        @foreach($vouchers as $voucher)
                                            <tr>
                                                <td class="text-nowrap">
                                                    <div>{{$voucher->name}}</div>
                                                </td>
                                                <td>{{$voucher->code}}</td>
                                                <th  class="text-center">{{number_format($voucher->number, 0,',','.')}}</th>
                                                <th class="text-center">
                                                    @if($voucher->type == 1)
                                                        %
                                                    @else
                                                        VNĐ
                                                    @endif
                                                </th>
                                                <td class="text-center">
                                                    {{number_format($voucher->total, 0,',','.')}}
                                                </td>
                                                <td  class="text-center">
                                                    {{number_format($voucher->used, 0,',','.')}}
                                                </td>
                                                <td  class="text-center">
                                                    <input type="checkbox" {{$voucher->status == 1 ? 'checked' : ''}}  class="status" data-id="{{$voucher->id}}">

                                                </td>
                                                <td class="text-right">
                                                    <a href="{{ route('voucher.edit', $voucher->id) }}" class=" btn-border btn-custom  btn btn-warning">Sửa</a>
                                                    <button type="button" class="btn-border btn-custom btn btn-danger btn-delete"
                                                            data-url="{{ route('voucher.destroy', $voucher->id) }}"
                                                    >Xóa
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8">
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

@push('js')
    <script>
        // trạng thái
        $('.status').click(function(){
            let status = 0;
            if(!$(this).prop('checked') ? status = 0 : status = 1);
            var id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:window.route('voucher.status'),
                method:'POST',
                data:{status:status, id:id},
                success:function(data){

                }
            })
        })

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
