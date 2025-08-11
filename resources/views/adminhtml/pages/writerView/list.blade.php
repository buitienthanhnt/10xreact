@extends('adminhtml.layouts.left-bar')

@section('title')
    writer list
@endsection

@section('mainBody')
    <x-dashboard-chart />
    <div class='p-2'>
        <a href="{{ url('adminhtml/writer/create') }}" class="btn btn-info">create writer</a>
        <div class='p-2'>
            {!! view('components.adminhtml.pages.blocks.tableSearchField') !!}

            {!! view('components.adminhtml.pages.blocks.tableListItem', [
                'attributes' => $attributes,
                'pages' => $pages,
                'actions' => $actions,
            ]) !!}
        </div>
    </div>
@endsection
