@extends('admin.layout.content')@section('title')
Thêm danh mục mới
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12 mt-5">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Thêm mới danh mục</li>
                        </ul>
                    </div>
                </div>
            </div>
            <form method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tên</label>
                                    <input class="form-control" name="name" type="text" value="" onkeyup="ChangeToSlug();" id="slug"
                                    placeholder="Nhập tên">
                                    @error('name')
                                    <span class="error text-danger" >{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Slug</label>
                                    <input class="form-control" type="text" value=""  name="slug" placeholder="Đường dẩn"
                                           id="convert_slug">
                                    @error('slug')
                                    <span class="error text-danger" >{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="display-block">Nổi bật</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="blog_active" value="1" checked="">
                                    <label class="form-check-label" for="blog_active"> Hoạt động </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="blog_inactive" value="0">
                                    <label class="form-check-label" for="blog_inactive"> Không hoạt động </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label w-100">Hình ảnh</label>
                                <input type="file"  id="input_file_img" name="image" onchange="review_img(event)" hidden>
                            </div>
                            <div class="review-img">
                                <img id="review-img" src="{{asset('/images/noimage.png')}}" style=" width: 100%;    border: 3px dashed blue;">
                            </div>
                        </div>
                    </div>
                <button class="btn btn-primary mt-4 buttonedit1">Lưu</button>
            </form>
        </div>
    </div>
@endsection

