function ChangeToSlug()
{
    var slug;
    slug = document.getElementById("slug").value;
    slug = slug.toLowerCase();
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        slug = slug.replace(/ /gi, "-");
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    document.getElementById('convert_slug').value = slug;
}


let review_img1 = function(event){
    let img = document.getElementById('review-img1');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.onload = function(){
        URL.revokeObjectURL(img.src);
    }
}
let review_img2 = function(event){
    let img = document.getElementById('review-img2');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.onload = function(){
        URL.revokeObjectURL(img.src);
    }
}
let review_img3 = function(event){
    let img = document.getElementById('review-img3');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.onload = function(){
        URL.revokeObjectURL(img.src);
    }
}
let review_img4 = function(event){
    let img = document.getElementById('review-img4');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.onload = function(){
        URL.revokeObjectURL(img.src);
    }
}
$(document).ready(function(){
    $('#review-img1').click(function(){
        $('#input_file_img1').click();
    })
})
$(document).ready(function(){
    $('#review-img2').click(function(){
        $('#input_file_img2').click();
    })
})
$(document).ready(function(){
    $('#review-img3').click(function(){
        $('#input_file_img3').click();
    })
})
$(document).ready(function(){
    $('#review-img4').click(function(){
        $('#input_file_img4').click();
    })
})
function isNumberKey(event){
    var charCode =(event.which) ? event.which : event.keyCode
    if(charCode >31 &&(charCode <48 || charCode >57))
        return false;
    return true;
}


