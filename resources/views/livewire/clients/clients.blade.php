<div class="text-sm">
    <div class="col-md-8 mb-2">
        @if (session()->has('success'))
            {{ session()->get('success') }}
        @endif
        @if (session()->has('error'))
            {{ session()->get('error') }}
        @endif
        @if ($addClient)
            @include('livewire.clients.create')
        @endif
        @if ($updateClient)
            @include('livewire.clients.update')
        @endif
        @if ($viewClient)
            @include('livewire.clients.view')
        @endif
        {{-- @if ($newReport)
        @include('livewire.clients.report')
        @endif --}}
    </div>

    <div class="col-md-8">
        <div class="p-2">
            <div class="flex justify-end mb-2">
                {{-- @if (!$addClient)
                <x-jet-button wire:click="newReport()" class="mr-4 bg-rose-500">
                    Generate Report
                </x-jet-button>
                @endif --}}
                @if (!$addClient)
                    <x-jet-button wire:click="addClient()" class="bg-green-500">
                        Add New client
                    </x-jet-button>
                @endif
            </div>
            <livewire:client-table />


        </div>
    </div>

</div>
