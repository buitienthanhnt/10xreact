<div>
    <div>
        <h1>{{ $count }}</h1>
        <button wire:click="increment">+</button>
        <button wire:click="decrement">-</button>
    </div>

    {{-- <div class="px-4">
        <div class="row">
            <div class="p-1 col-md-6">
                {!! view('components.adminhtml.formfields.formBase', [
                    'method' => 'POST',
                    'action' => url('adminhtml/page/register'),
                    'listAttributes' => $listAttributes,
                ]) !!}
            </div>
        </div>
    </div> --}}
</div>
