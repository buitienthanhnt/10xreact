@extends('adminhtml.layouts.left-bar')

@section('title')
    create new paper
@endsection

@section('mainBody')
    <x-dashboard-chart />
    <div class="px-4">
        <div class="row">
            <div class="p-1 col-md-6">
                <form>
                    @foreach ($listAttributes as $field)
                        @switch($field['type'])
                            @case(\App\Models\Types\FormInterface::TYPE_CHECKBOX)
                                @include('components.adminhtml.formfields.checkbox', [
                                    'field' => $field,
                                ])
                            @break

                            @case(\App\Models\Types\FormInterface::TYPE_TEXTAREA)
                                @include('components.adminhtml.formfields.textarea', [
                                    'field' => $field,
                                ])
                            @break

                            @default
                                <div class="form-group">
                                    @include('components.adminhtml.formfields.label', [
                                        'field' => $field,
                                    ])
                                    <input type="{{ $field['type'] }}" class="form-control" id="{{ $field['key'] }}"
                                        aria-describedby="{{ $field['key'] . '_Help' }}"
                                        placeholder="{{ __('attr.' . $field['key']) }}" />
                                </div>
                        @endswitch
                    @endforeach
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
