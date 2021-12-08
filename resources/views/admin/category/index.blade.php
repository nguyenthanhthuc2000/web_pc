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
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-right">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cats as $cat)
                                            <tr>
                                                <td class="text-nowrap">
                                                    <div>{{ $cat->id }}</div>
                                                </td>
                                                <td class="text-nowrap">{{ $cat->name }}</td>
                                                <td class="text-nowrap">{{ $cat->name }}</td>
                                                <td class="text-center">
                                                    <input type="checkbox" checked="">
                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox" checked="">
                                                </td>
                                                <td class="text-right">
                                                    <a href="" class=" btn-border btn-custom  btn btn-warning">Sửa</a>
                                                    <button type="button" class="btn-border btn-custom btn btn-danger">Xóa</button>
                                                </td>
                                            </tr>
                                        @endforeach
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

