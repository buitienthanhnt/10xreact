@extends('adminhtml.layouts.left-bar')

@section('title')
    edit the paper
@endsection

@section('mainBody')
    <x-dashboard-chart />
    <div class="px-4">
        <div class="row">
            <div class="p-1 col-md-6">
                {!! view('components.adminhtml.formfields.formBase', $__data) !!}
            </div>
        </div>
    </div>
@endsection
