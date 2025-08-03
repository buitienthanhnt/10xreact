@extends('adminhtml.layouts.left-bar')

@section('title')
    writer list
@endsection

@section('mainBody')
    <x-dashboard-chart />
    <div class='p-2'>
        <a href="{{ url('adminhtml/writer/create') }}" class="btn btn-info">create writer</a>
        <div class='p-2'>
            <div class="d-flex justify-content-between">
                <span class="text-info font-italic font-weight-bold text-2xl">list of writers</span>
                <div class="d-flex">
                    <form action="" method="get">
                        <div class="form-group d-flex" style="column-gap: 8px">
                            <button type="submit" class="btn btn-link">
                                <i class="material-icons" style="font-size: 36px">search</i>
                            </button>
                            <input type="text" name="fast-search" class="form-control" placeholder="fast search"
                                id="fast-search">
                        </div>
                    </form>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        @foreach ($attributes as $attr)
                            <th scope="col">{{ __('attr.' . $attr) }}</th>
                        @endforeach
                        @isset($actions)
                            <th scope="col">action</th>
                        @endisset
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pages instanceof \Illuminate\Pagination\LengthAwarePaginator ? $pages->items() : $pages as $item)
                        <tr>
                            @for ($i = 0; $i < count($attributes); $i++)
                                @if ($i === 0)
                                    <th scope="row">{{ $item->{$attributes[$i]} }}</th>
                                @else
                                    <td>{{ $item->{$attributes[$i]} }}</td>
                                @endif
                            @endfor
                            <th scope="row">
                                <div class="d-flex" style="column-gap: 16px">
                                    @isset($actions)
                                        @foreach ($actions as $action)
                                            @switch($action['type'])
                                                @case('delete')
                                                    {!! view('components.adminhtml.formfields.deleteBtn', [...$action, 'id' => $item->id]) !!}
                                                @break

                                                @default
                                                    {!! view('components.adminhtml.formfields.redirectBtn', [...$action, 'id' => $item->id]) !!}
                                            @endswitch
                                        @endforeach
                                    @endisset
                                </div>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($pages instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $pages->links('components.adminhtml.pages.links') }}
            @endif
        </div>

    </div>
@endsection

@section('body-afjs')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.onDelete').click(function(e) {
                url = $(this).attr('data-url');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    }
                });
            });
        })
    </script>
@endsection
