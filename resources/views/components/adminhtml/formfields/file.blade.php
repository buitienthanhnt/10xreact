<div class="form-group">
    @include('components.adminhtml.formfields.label', [
        'field' => $field,
    ])
    <input type="{{ $field['type'] }}" class="form-control" id="{{ 'form-id-' . $field['key'] }}"
        @isset($field['require'])
        required
    @endisset onchange="readURL(this);"
        aria-describedby="{{ $field['key'] . '_Help' }}" name="{{ $field['key'] }}" value="{{ old($field['key']) }}"
        placeholder="{{ __('attr.' . $field['key']) }}" />
    <img id="blah" src="#" alt="your image"  class='p-2' style="display: none"/>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result).width(200).height(200).css('display', 'inherit').css('border-radius', 200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
