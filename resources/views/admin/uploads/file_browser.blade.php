<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duyệt hình ảnh</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
        	var funcNum = <?php echo $_GET['CKEditorFuncNum'].';'; ?>
        $('#list-image').on('click','img',function(){
            var fileUrl = $(this).attr('title');
            window.opener.CKEDITOR.tools.callFunction(funcNum,fileUrl);
            window.close();
        })
    })
</script>
</head>
<body>
<style type="text/css">
    .box-images{
        margin: auto;
    }
    .image{
        cursor: pointer;
        border: 3px solid #fdcb6e;
        overflow: hidden;
        display: block;
        margin: 10px;
        text-align: center;
    }
    .image img{
        transition: 0.5s;
        width: 100%;
        height: 200px;
        object-fit: contain;
    }
    .image:hover img{
        transform:scale(1.1,1.1);
    }
</style>
<div id="list-image">
    <div class="box-images row">
        @foreach($fileNames as $file)
            <div class="image col-md-3 col-sm-3 col-xs-2" >
                <img src="{{asset('/uploads/ckeditor/'.$file)}}"  alt="thumb"
                     title="{{asset('/uploads/ckeditor/'.$file)}}">
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
