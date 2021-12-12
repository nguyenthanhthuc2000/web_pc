@extends('admin.layout.content')
@section('title')
    Danh sách sản phẩm
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="d-flex" style="justify-content: space-between">
                    <div class=" mt-5">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Sản phẩm {{ isset($title) ? $title : '' }}</li>
                        </ul>
                    </div>
                    <div class=" mt-5">
                        <a href="{{ route('product.add') }}" class="badge badge-pill bg-success inv-badge">Thêm mới</a>
                    </div>
                </div>
            </div>
            @include('notification')
            <div class="row">
                <div class="top-nav-search" style="margin: 0 0 20px 15px;">
                    <form style="margin: 0" method="get" action="{{ route('product.index') }}">
                        @csrf
                        <input type="text" class="form-control" name="id" placeholder="ID sản phẩm">
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
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Hình ảnh</th>
                                        <th class="text-center">Nổi bật</th>
                                        <th class="text-center">Bán chạy</th>
                                        <th class="text-right">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($pros->count() > 0)
                                    @foreach($pros as $pro)
                                        <tr>
                                            <td class="text-nowrap">
                                                <div>{{ $pro->id }}</div>
                                            </td>
                                            <td class="text-nowrap">{{ $pro->name }}</td>
                                            <td class="text-nowrap">
                                                @if($pro->image1 != null)
                                                    <img src="{{asset('upload/products/'.$pro->image1)}}"
                                                         alt="" class="img-admin" >
                                                @else
                                                    <img src="{{asset('images/noimage.png')  }}"  class="img-admin" >
                                                @endif

                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" {{$pro->status == 1 ? 'checked' : ''}}  class="status" data-id="{{$pro->id}}">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" {{$pro->selling == 1 ? 'checked' : ''}}  class="selling" data-id="{{$pro->id}}">
                                            </td>
                                            <td class="text-right">
                                                <a href="{{ route('product.edit', $pro->id) }}" class=" btn-border btn-custom  btn btn-warning">Sửa</a>

                                                @if(Auth::user()->level == 1)
                                                    @if($pro->deleted_at == null)
                                                    <button type="button" class="btn-border btn-custom btn btn-danger btn-delete"
                                                            data-url="{{ route('product.destroy', $pro->id) }}"
                                                    >Khóa
                                                    </button>
                                                    @else
                                                        <button type="button" class="btn-border btn-custom btn btn-danger btn-restore"
                                                                data-url="{{ route('product.restore', $pro->id) }}"
                                                        >Restore
                                                        </button>
                                                    @endif
                                                        <button type="button" class="btn-border btn-custom btn btn-danger btn-force-delete"
                                                                data-url="{{ route('product.force.delete', $pro->id) }}"
                                                        >Xóa
                                                        </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">
                                                Không có dữ liệu
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                <div style="float: right" class="mr-4 mt-2">
                                    {{ $pros->links() }}
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
        // trạng thái noi bat
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
                url:window.route('product.status'),
                method:'POST',
                data:{status:status, id:id},
                success:function(data){

                }
            })
        })

        // trạng thái ban chay
        $('.selling').click(function(){
            let status = 0;
            if(!$(this).prop('checked') ? selling = 0 : selling = 1);
            var id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:window.route('product.selling'),
                method:'POST',
                data:{selling:selling, id:id},
                success:function(data){

                }
            })
        })

        //xóa
        $('.btn-delete').click(function(){
            var url = $(this).data('url');
            Swal.fire({
              title: 'Xác nhận',
              text: 'Bạn có chắc khóa không?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ok, Khóa',
              cancelButtonText: 'Hủy'
            }).then((result) => {
              if (result.isConfirmed) {
                   window.location.href = url;
              }
            })

        })

        //restore
        $('.btn-restore').click(function(){
            var url = $(this).data('url');
            Swal.fire({
              title: 'Xác nhận',
              text: 'Khôi phục sản phẩm này?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ok',
              cancelButtonText: 'Hủy'
            }).then((result) => {
              if (result.isConfirmed) {
                   window.location.href = url;
              }
            })

        })
        //xóa vỉnh vien
        $('.btn-force-delete').click(function(){
            var url = $(this).data('url');
            Swal.fire({
              title: 'Xóa vĩnh viễn sản phẩm này ',
              text: 'Thao tác không thể  khôi phục ?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ok',
              cancelButtonText: 'Hủy'
            }).then((result) => {
              if (result.isConfirmed) {
                   window.location.href = url;
              }
            })

        })
    </script>
@endpush

