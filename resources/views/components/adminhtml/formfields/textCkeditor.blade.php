<div class="p-1 form form-textarea">
    <textarea name="{{ $key }}" id="id-{{ $key }}" cols="10" rows="10" placeholder="content of area">
</textarea>

</div>
<script type="text/javascript">
    // luwu y can dat gia trij trong dau "" de nhan duoc gia tri string trong js.
    // https://ckeditor.com/ckeditor-4/download/
    // https://www.tiny.cloud/docs/tinymce/latest/php-projects/
    CKEDITOR.replace("{{ $key }}", {
        width: '100%',
        height: 360,
        editorplaceholder: 'Start typing here...',
        removeButtons: 'PasteFromWord'
    });
</script>
