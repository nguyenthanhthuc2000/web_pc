@extends('admin.layout.content')
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

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 d-flex">
                    <div class="card flex-fill">

                        <div class="card-body">
                            <form action="{{ route('user.store') }}" method="post" >
                                @csrf
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Họ và tên</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="name">
                                        @error('name')
                                        <span class="error text-danger" >{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Email</label>
                                    <div class="col-md-10">
                                        <input type="email" class="form-control" name="email">
                                        @error('email')
                                        <span class="error text-danger" >{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Password</label>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control" name="password">
                                        @error('password')
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

