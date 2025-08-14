@extends('adminhtml.layouts.left-bar')

@section('title')
    create new paper
@endsection

@section('mainBody')
    <x-dashboard-chart />
    <div class="px-4">
        <div class="row">
            <div class="p-1 col-md-6">
                {!! view('components.adminhtml.formfields.formBase', [
                    'method' => 'POST',
                    'action' => url('adminhtml/page/register'),
                    'listAttributes' => $listAttributes,
                ]) !!}
            </div>
        </div>
    </div>
@endsection
