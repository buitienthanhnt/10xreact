<div class="form-group">
    @include('components.adminhtml.formfields.label', [
        'field' => $field,
    ])
    <input type="{{ $field['type'] }}" class="form-control" id="{{ 'form-id-' . $field['key'] }}"
        @isset($field['require'])
        required
    @endisset
        aria-describedby="{{ $field['key'] . '_Help' }}" name="{{ $field['key'] }}" value="{{ old($field['key']) }}"
        placeholder="{{ __('attr.' . $field['key']) }}" />
</div>
