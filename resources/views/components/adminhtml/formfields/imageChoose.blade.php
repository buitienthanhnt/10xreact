<div class="input-group">
    <span class="input-group-btn">
        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
            <i class="fa fa-picture-o"></i> Choose
        </a>
    </span>
    <input id="thumbnail" class="form-control" type="text" name="filepath">
</div>
<div id="holder" style="margin-top:15px;max-height:100px;"></div>

<script type="text/javascript">
    var filemanager_url_base = "{{ url('adminhtml/laravel-filemanager?type=Images') }}";
    $(document).ready(function() {
        $('#lfm').filemanager('image', {
            prefix: filemanager_url_base
        });
    });
</script>
