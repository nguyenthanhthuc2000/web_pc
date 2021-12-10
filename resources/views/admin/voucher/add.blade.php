@extends('admin.layout.content')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="d-flex" style="justify-content: space-between">
                    <div class=" mt-5">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Thêm giảm giá</li>
                        </ul>
                    </div>
                    <div class=" mt-5">
                        <button class="badge badge-pill bg-success inv-badge">Lưu</button>
                    </div>
                </div>
            </div>
            @include('notification')
            <div class="row">
                <div class="col-md-12 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-body">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

