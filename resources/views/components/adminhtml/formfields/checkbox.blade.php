 <div class="form-group form-check pl-0">
    <input type="checkbox" class="form-check-input" id="{{ 'form-id-' . $field['key'] }}" name="{{ $field['key'] }}"
        @if(old($field['key']))
            value="{{ old($field['key']) }}"
        @endif
        @isset($field['value']) checked @endisset
    >
     <label class="form-check-label" for="{{ 'form-id-' . $field['key'] }}">{{ __('attr.' . $field['key']) }}</label>
 </div>
