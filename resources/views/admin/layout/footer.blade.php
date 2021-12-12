<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="/_admin/js/jquery-3.5.1.min.js"></script>
<script src="/_admin/js/popper.min.js"></script>
<script src="/_admin/js/bootstrap.min.js"></script>
<script src="/_admin/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/_admin/plugins/raphael/raphael.min.js"></script>
<script src="/_admin/plugins/morris/morris.min.js"></script>
<script src="/_admin/js/chart.morris.js"></script>
<script src="/_admin/js/script.js"></script>
<script src="/_admin/js/my_script.js"></script>
<script src="/vendor/sweetalert2.min.js"></script>
<script src="/ckeditor/ckeditor.js"></script>
@stack('js')
<script>
    CKEDITOR.replace('ckeditor',{
      filebrowserImageUploadUrl : "{{ url('admin/upload-manager/uploads-ckeditor?_token='.csrf_token()) }}",
      filebrowserBrowseUrl : "{{ url('admin/upload-manager/file/file-browser?_token='.csrf_token()) }}",
      filebrowserUploadMethod : 'form'
    });
  CKEDITOR.config.entities = false; //khong bi loi font khi insert
</script>
</body>

</html>
