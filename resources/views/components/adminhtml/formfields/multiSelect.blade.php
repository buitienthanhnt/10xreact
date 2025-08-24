<div class="form-group">
    @include('components.adminhtml.formfields.label', [
        'field' => $field,
    ])
    <select class="select2-{{ $field['key'] }}" name="{{ $field['key'] }}[]" multiple="multiple" style="width: 75%">
        @foreach ($field['model']::{ $field['key'] . 'Options' }() as $item)
            <option value="{{ $item['value'] }}"
                @isset($field['value'])
                @if ($field['value'] === $item['value'])
                    selected
                @endif
            @endisset>
                {{ $item['label'] }}</option>
        @endforeach
    </select>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".select2-{{ $field['key'] }}").select2({
                  placeholder: "Select a state",
                  allowClear: true,
                   width: 'resolve'
            });
        });
    </script>
</div>
