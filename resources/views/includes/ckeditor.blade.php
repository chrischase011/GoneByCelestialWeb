<script type="text/javascript">
    CKEDITOR.replace('editor',{
        filebrowserBrowseUrl: "{{ asset('js/ckfinder/ckfinder.html') }}",
        filebrowserUploadUrl: "{{ asset('js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}"
    });
</script>
