<div class="text-sm">
<div class="col-md-8 mb-2">
        @if(session()->has('success'))
        {{ session()->get('success') }}
        @endif
        @if(session()->has('error'))
        {{ session()->get('error') }}
        @endif
        @if($addUnderwriter)
        @include('livewire.underwriters.create')
        @endif
        @if($updateUnderwriter)
        @include('livewire.underwriters.update')
        @endif
        @if($viewUnderwriter)
        @include('livewire.underwriters.view')
        @endif
       
    </div>


 
    <div class="col-md-8">
        <div class="p-2">
            <div class="flex justify-end mb-2">
               
                @if(!$addUnderwriter)
                <x-jet-button wire:click="addUnderwriter()" class="bg-green-500">
                    Add New underwriter
                </x-jet-button>
                @endif

            </div>
            <div class="relative overflow-x-auto">
              
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class=" text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="py-4 space-x-2">
                            <th scope="col">
                                id
                            </th>
                            <th scope="col">
                                Name
                            </th>
                           
                          
                            <th scope="col">
                                Dates
                            </th>
                            <th scope="col">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($underwriters))
                        @foreach ($underwriters as $underwriter)
                        <tr class="bg-white border-b space-y-2 hover:bg-gray-100">
                            <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <p class="font-medium text-gray-700">{{$underwriter->id}}</p>
                            </th>
                            <td>
                                <p class="font-medium text-gray-700">{{ (strlen($underwriter->name)<=3)? strtoupper($underwriter->name) : ucfirst($underwriter->name)}}</p>
                            </td>
                            <td>
                                <p class="font-medium text-gray-700">{!!date("j<\s\u\p>S</\s\u\p> M y",strtotime($underwriter->created_at))!!}</p>
                                <p class="text-gray-400 text-xs">({!!date("j<\s\u\p>S</\s\u\p> M y",strtotime($underwriter->updated_at))!!})</p>

                            </td>
                            <td>
                                <button title="View Underwriter" wire:click="viewUnderwriter({{$underwriter->id}})" class="text-teal-500"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>

                                </button>
                                <button title="Update Underwriter" wire:click="editUnderwriter({{$underwriter->id}})" class="text-green-500"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </button>
                                <button title="Delete underwriter" wire:click="deleteUnderwriter({{$underwriter->id}})" class="text-red-500"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4" x-tooltip="tooltip">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg></button>
                            </td>
                        </tr>
                        @endforeach
                        <tr class="p-2 bg-gray-100">
                            <td class="font-semibold" colspan="11">
                                {{ $underwriters->links() }}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td class="bg-gray-100" colspan="11">
                                No underwriters Found.
                            </td>
                        </tr>
                        @endif

                    </tbody>
                </table>
            </div>

        </div>
    </div> 

</div>