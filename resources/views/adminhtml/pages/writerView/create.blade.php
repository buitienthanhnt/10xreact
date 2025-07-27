@extends('adminhtml.layouts.left-bar')

@section('title')
    register writer
@endsection

@section('mainBody')
    <x-dashboard-chart />
    <div class="px-4">
        <div class="row">
            <div class="p-1 col-md-6">
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin_writer_create') }}">
                    @csrf
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

                            @case(\App\Models\Types\FormInterface::TYPE_FILE)
                                @include('components.adminhtml.formfields.file', [
                                    'field' => $field,
                                ])
                            @break

                            @case(\App\Models\Types\FormInterface::TYPE_EMAIL)
                            @case(\App\Models\Types\FormInterface::TYPE_DATE)

                            @case(\App\Models\Types\FormInterface::TYPE_PHONE)
                            @case(\App\Models\Types\FormInterface::TYPE_TEXT)
                                @include('components.adminhtml.formfields.textField', [
                                    'field' => $field,
                                ])
                            @break

                            @default
                        @endswitch
                    @endforeach
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
