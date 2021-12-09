@extends('admin.layout.content')
@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">

            <form action="{{ route('product.update', $pro->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="page-header">
                    <div class="d-flex" style="justify-content: space-between">
                        <div class=" mt-5">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">Thêm mới sản phẩm</li>
                            </ul>
                        </div>
                        <div class=" mt-5">
                            <button class="btn-border btn-custom btn btn-primary">Lưu</button>
                        </div>
                    </div>
                </div>
                @include('notification')
                <div class="row">
                    <div class="col-md-12 d-flex">
                        <div class="card card-table flex-fill">
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <form>
                                        <div class="row formtype pt-3">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Tên sản phẩm</label>
                                                            <input class="form-control" type="text" name="name"
                                                                   onkeyup="ChangeToSlug();" id="slug"
                                                                   placeholder="Nhập tên sản phẩm" value="{{$pro->name}}">
                                                            @error('name')
                                                            <span class="error text-danger" >{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Slug</label>
                                                            <div class="time-icon">
                                                                <input type="text" class="form-control" name="slug"
                                                                       id="convert_slug" placeholder="Slug" value="{{$pro->slug}}">
                                                                @error('slug')
                                                                <span class="error text-danger" >{{ $message }}</span>
                                                                @enderror
                                                                @if(Session::has('errorSlug'))
                                                                    <span class="error text-danger">{{ Session::get('errorSlug') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Giá bán</label>
                                                            <div class="time-icon">
                                                                <input type="number" class="form-control" name="price"
                                                                       value="{{$pro->price}}" onkeypress="return isNumberKey(event)">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Đã bán</label>
                                                            <div class="time-icon">
                                                                <input type="number" class="form-control" name="sold" value="{{$pro->sold}}" onkeypress="return isNumberKey(event)">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Tồn kho</label>
                                                            <div class="time-icon">
                                                                <input type="number" class="form-control" name="remains" value="{{$pro->remains}}" onkeypress="return isNumberKey(event)">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" style="margin-bottom:0;">
                                                            <label>Mô tả </label>
                                                            <textarea class="form-control" rows="5" name="desc" > {{$pro->desc}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 pt-2">
                                                        <div class="form-group">
                                                            <label>Nội dung</label>
                                                            <textarea class="form-control" rows="5" id="ckeditor" name="content">{{$pro->content}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pt-4">
                                                        <div class="form-group mb-0" >
                                                            <label class="form-label w-100">Ảnh đại diện</label>
                                                            <input type="file"  id="input_file_img1" name="image1" onchange="review_img1(event)" hidden>
                                                            @error('image')
                                                            <span class="error text-danger" >{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="review-img">
                                                            @if($pro->image1 != null)
                                                                <img id="review-img1" src="{{asset('/upload/products/'.$pro->image1)}}" style=" width: 100%;    border: 3px dashed blue;">
                                                            @else
                                                                <img id="review-img1" src="{{asset('/images/noimage.png')}}" style=" width: 100%;    border: 3px dashed blue;">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pt-4">
                                                        <div class="form-group mb-0">
                                                            <label class="form-label w-100">Hình ảnh 1</label>
                                                            <input type="file"  id="input_file_img2" name="image2" onchange="review_img2(event)" hidden>
                                                            @error('image')
                                                            <span class="error text-danger" >{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="review-img">
                                                            @if($pro->image2 != null)
                                                                <img id="review-img2" src="{{asset('/upload/products/'.$pro->image2)}}" style=" width: 100%;    border: 3px dashed blue;">
                                                            @else
                                                                <img id="review-img2" src="{{asset('/images/noimage.png')}}" style=" width: 100%;    border: 3px dashed blue;">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pt-4">
                                                        <div class="form-group mb-0">
                                                            <label class="form-label w-100">Hình ảnh 2</label>
                                                            <input type="file"  id="input_file_img3" name="image3" onchange="review_img3(event)" hidden>
                                                            @error('image')
                                                            <span class="error text-danger" >{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="review-img">
                                                            @if($pro->image3 != null)
                                                                <img id="review-img3" src="{{asset('/upload/products/'.$pro->image3)}}" style=" width: 100%;    border: 3px dashed blue;">
                                                            @else
                                                                <img id="review-img3" src="{{asset('/images/noimage.png')}}" style=" width: 100%;    border: 3px dashed blue;">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pt-4 pb-4">
                                                        <div class="form-group mb-0">
                                                            <label class="form-label w-100">Hình ảnh 3</label>
                                                            <input type="file"  id="input_file_img4" name="image4" onchange="review_img4(event)" hidden>
                                                            @error('image')
                                                            <span class="error text-danger" >{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="review-img">
                                                            @if($pro->image4 != null)
                                                                <img id="review-img4" src="{{asset('/upload/products/'.$pro->image4)}}" style=" width: 100%;    border: 3px dashed blue;">
                                                            @else
                                                                <img id="review-img4" src="{{asset('/images/noimage.png')}}" style=" width: 100%;    border: 3px dashed blue;">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Danh mục</label>
                                                    <select class="form-control" id="sel2" name="category_id">
                                                        <option value="">Chọn danh mục</option>
                                                        @foreach($cats as $cat)
                                                            <option value="{{$cat->id}}" {{$pro->category_id == $cat->id ? 'selected' : ''}}>{{$cat->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <span class="error text-danger" >{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Tên</th>
                                                        <th scope="col">Mô tả cấu hình</th>
                                                        <th scope="col " class="text-right">#</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="list-rule">
                                                        @foreach($options as $option)
                                                            <tr class="mt-2">
                                                                <td>
                                                                    <input class="form-control" name="title_rules[]" type="text" value="{{$option[0]}}">
                                                                </td>
                                                                <td>
                                                                    <input class="form-control" name="rules[]" type="text" value="{{$option[1]}}" >
                                                                </td>
                                                                <td class="text-right">
                                                                    <button type="button" class="btn__n__style btn__del__rule" id="" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <br>
                                                <div class="box__add__rule">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-sm-3 text-left">Tên<span style="color: red;">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"  id="name" placeholder="Nhập tên">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-sm-3 text-left">Mô tả<span style="color: red;">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="rule" placeholder="Nhập mô tả">
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn-border btn-custom btn btn-primary float-right" id="addRule"
                                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Thêm"
                                                    >
                                                        <i class="align-middle " data-feather="plus"></i>
                                                        Thêm
                                                    </button>
                                                </div>


                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>

        $('.list-rule').on('click', '.btn__del__rule', function(){
            $(this).closest("tr").remove();
        })

        $('#addRule').click(function(){
            $('.tbl-rule').removeClass('d-none');
            var name = $('#name').val();
            var rule = $('#rule').val();
            if(name !== '' && rule !==''){

                var rule_html = $('.list-rule').html();
                rule_html += '<br><tr  class="mt-2"><td ><input class="form-control" name="title_rules[]" type="text" value="'+name+'"></td>'
                rule_html += '<td><input class="form-control" name="rules[]" type="text" value="'+rule+'"</td>'
                rule_html += '<td class="text-right"><button type="button" class="btn__n__style btn__del__rule" id=""'
                rule_html += 'data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa"><i class="fa fa-trash"></i></button></td></tr>'

                $('.list-rule').html(rule_html);

                var name = $('#name').val('');
                var rule = $('#rule').val('');
            }
            else{
                Swal.fire("Lỗi!", "Nhập đầy đủ thông tin", "error")
            }
        })
    </script>
@endpush


