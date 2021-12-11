@extends('admin.layout.content')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="d-flex" style="justify-content: space-between">
                    <div class=" mt-5">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Sửa mã giảm giá</li>
                        </ul>
                    </div>
                </div>
            </div>
            @include('notification')
            <div class="row">
                <div class="col-md-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <form action="{{ route('voucher.update', $voucher->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tên:</label>
                                            <input type="text" name="name" value="{{$voucher->name}}" class="form-control" placeholder="Nhập Tên">
                                            @error('name')
                                            <span class="error text-danger" >{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Mã:</label>
                                            <input type="text" name="code" value="{{$voucher->code}}" class="form-control" placeholder="Nhập Mã">
                                            @error('code')
                                            <span class="error text-danger" >{{ $message }}</span>
                                            @enderror
                                            @if(Session::has('errorCode'))
                                                <span class="error text-danger">{{ Session::get('errorCode') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Số tiền giảm:</label>
                                                    <input type="number"name="number"  value="{{$voucher->number}}" onkeypress="return isNumberKey(event)" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Đã dùng:</label>
                                                    <input type="number" name="used" value="{{$voucher->used}}" onkeypress="return isNumberKey(event)" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Số lượng:</label>
                                                    <input type="number" name="total" value="{{$voucher->total}}" onkeypress="return isNumberKey(event)" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Hình thức</label>
                                                    <select class="form-control" id="sel1" name="type">
                                                        <option value="2" {{$voucher->status == 2 ? 'selected' : ''}}>Giảm theo số tiền</option>
                                                        <option value="1" {{$voucher->status == 1 ? 'selected' : ''}}>Giảm theo phần  trăm</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

