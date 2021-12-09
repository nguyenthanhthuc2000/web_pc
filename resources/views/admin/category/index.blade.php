@extends('admin.layout.content')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="d-flex" style="justify-content: space-between">
                    <div class=" mt-5">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Danh mục</li>
                        </ul>
                    </div>
                    <div class=" mt-5">
                        <a href="{{ route('category.add') }}" class="badge badge-pill bg-success inv-badge">Thêm mới</a>
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
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Hình ảnh</th>
                                        <th class="text-center">Nổi bật</th>
                                        <th class="text-right">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($cats->count() > 0)
                                        @foreach($cats as $cat)
                                            <tr>
                                                <td class="text-nowrap">
                                                    <div>{{ $cat->id }}</div>
                                                </td>
                                                <td class="text-nowrap">{{ $cat->name }}</td>
                                                <td class="text-nowrap">
                                                    @if($cat->image != null)
                                                    <img src="{{asset('upload/category/'.$cat->image)  }}"
                                                         alt="{{asset('upload/category/'.$cat->image)  }}" class="img-admin" >
                                                    @else
                                                        <img src="{{asset('images/noimage.png')  }}"  class="img-admin" >
                                                    @endif

                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox" {{$cat->status == 1 ? 'checked' : ''}}  class="status" data-id="{{$cat->id}}">
                                                </td>
                                                <td class="text-right">
                                                    <a href="{{ route('category.edit', $cat->id) }}" class=" btn-border btn-custom  btn btn-warning">Sửa</a>
                                                    <button type="button" class="btn-border btn-custom btn btn-danger btn-delete"
                                                            data-url="{{ route('category.destroy', $cat->id) }}"
                                                        >Xóa
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">
                                                Không có dữ liệu
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                <div style="float: right" class="mr-4 mt-2">
                                    {{ $cats->links() }}
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
                url:window.route('category.status'),
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

