@extends('admin.layout.content')
@section('title')
    Danh sách nhân viên
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="d-flex" style="justify-content: space-between">
                    <div class=" mt-5">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Nhân viên</li>
                        </ul>
                    </div>
                    <div class=" mt-5">
                        <a href="{{ route('user.add') }}" class="badge badge-pill bg-success inv-badge">Thêm mới</a>
                    </div>
                </div>
            </div>
            @include('notification')
            <div class="row">
                <div class="top-nav-search" style="margin: 0 0 20px 15px;">
                    <form style="margin: 0" method="get" action="{{ route('user.index') }}">
                        @csrf
                        <input type="text" class="form-control" name="email" placeholder="Search here">
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
                                        <th>Email</th>
                                        <th class="text-center">Hoạt động</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-right">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if($users->count() > 0)
                                        @foreach($users as $user)
                                        <tr>
                                            <td class="text-nowrap">
                                                <div>{{$user->id}}</div>
                                            </td>
                                            <td class="text-nowrap">
                                                {{$user->name}}
                                            </td>
                                            <td>{{$user->email}}</td>
                                            <td class="text-center">
                                                <a href="{{ route('user.history.detail', $user->id) }}"
                                                   class=" btn-border btn-custom  btn btn-success">Xem
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" {{$user->status == 1 ? 'checked' : ''}}
                                                    class="status" data-id="{{$user->id}}"
                                                >
                                            </td>
                                            <td class="text-right">
                                                <a href="{{ route('user.edit', $user->id) }}"
                                                   class=" btn-border btn-custom  btn btn-warning">Sửa</a>
                                                <a href="{{ route('admin.reset.pass', $user->id) }}"
                                                   class=" btn-border btn-custom  btn btn-primary btn-reset">Đặt lại mật khẩu</a>
                                                <button type="button" class="btn-border btn-custom btn btn-danger btn-delete"
                                                        data-url="{{ route('user.destroy', $user->id) }}"
                                                >Xóa
                                                </button>
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
                                    {{ $users->links() }}
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
    $('.btn-reset').click(function(e){
         e.preventDefault();
         href = $(this).attr('href');
         if(confirm("Xác nhận cập nhật mật khẩu?")){
            window.location.href = href;
         }
    })


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
                url:window.route('user.status'),
                method:'POST',
                data:{status:status, id:id},
                success:function(data){

                }
            })
        })


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
