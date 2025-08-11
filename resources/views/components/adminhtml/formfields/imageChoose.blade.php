<style>
    #holder > img{
        width: 120px;
        height: 120px !important;
        border-radius: 100%;
        object-fit: cover;
    }
</style>
<div class="input-group">
    <span class="input-group-btn">
        <a id="lfm-{{ $field['key'] }}" data-input="id-{{ $field['key'] }}" data-preview="holder" class="btn btn-primary">
            <i class="fa fa-picture-o"></i> Choose
        </a>
    </span>
    <input id="id-{{ $field['key'] }}" class="form-control" type="text" name="{{ $field['key'] }}">
</div>
<div id="holder" style="margin-top:15px;max-height:120px;"></div>

<script type="text/javascript">
    var filemanager_url_base = "{{ url('adminhtml/laravel-filemanager?type=Images') }}";
    $(document).ready(function() {
        $("#lfm-{{ $field['key'] }}").filemanager('image', {
            prefix: filemanager_url_base
        });
    });
</script>
