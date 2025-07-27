@extends('adminhtml.layouts.left-bar')

@section('title')
    writer list
@endsection

@section('mainBody')
    <x-dashboard-chart />
    <div class='p-2'>
        {{-- <span class="text-info font-weight-bold text-2xl">day la noi dung nam trong router pages list</span> --}}        
			<a href="{{ url('adminhtml/writer/create') }}" class="btn btn-info">create writer</a>
	
    </div>
@endsection

@section('body-afjs')
@endsection
