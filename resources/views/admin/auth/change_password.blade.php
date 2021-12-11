@extends('admin.layout.content')@section('title')
Đỏi mật khẩu
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="d-flex" style="justify-content: space-between">
                    <div class=" mt-5">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Đổi mật khẩu</li>
                        </ul>
                    </div>
                    <div class=" mt-5">

                    </div>
                </div>
            </div>
            @include('notification')
            <div class="row">
                <div class="col-md-9 d-flex">
                    <div class="card flex-fill">

                        <div class="card-body">
                            <form action="{{ route('admin.post.change.pass') }}" method="post" >
                                @csrf
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Mật khẩu cũ</label>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control" name="old_password">
                                        @error('old_password')
                                        <span class="error text-danger" >{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Mật khẩu mới</label>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control" name="new_password">
                                        @error('new_password')
                                        <span class="error text-danger" >{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Xác nhận mật khẩu</label>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control" name="confirm_password">
                                        @error('confirm_password')
                                        <span class="error text-danger" >{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex" style="justify-content: right;">
                                    <button class="btn-border btn-custom btn btn-primary"
                                    >Lưu
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

