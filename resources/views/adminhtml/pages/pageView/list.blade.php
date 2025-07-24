@extends('adminhtml.layouts.left-bar')

@section('title')
    page list
@endsection

@section('mainBody')
    <x-dashboard-chart />
    <div class='p-2'>
        {{-- <span class="text-info font-weight-bold text-2xl">day la noi dung nam trong router pages list</span> --}}
        <p class="text-info font-italic font-weight-bold text-2xl">Tieeu ddef page list</p>
        <table class="table">
            <thead>
                <tr>
                    @foreach ($attributes as $attr)
                        <th scope="col">{{ __("attr.".$attr) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($pages as $item)
                    <tr>
                        @for ($i = 0; $i < count($attributes); $i++)
                            @if ($i === 0)
                                <th scope="row">{{ $item->{$attributes[$i]} }}</th>
                            @else
                                <td>{{ $item->{$attributes[$i]} }}</td>
                            @endif
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('body-afjs')
@endsection
