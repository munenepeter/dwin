<x-jet-dialog-modal wire:model="newReport">
    <x-slot name="title">
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
            <h3 class="text-lg font-semibold text-orange-500 dark:text-white">
                Generate A New Report
            </h3>
            <button wire:click="$toggle('newReport')" type="button" class="text-orange-500 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif

    </x-slot>

    <x-slot name="content">
        <form>
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>
                    <x-jet-label for="policy_number" value="{{ __('Policy Number') }}" />
                    <x-jet-input id="policy_number" wire:model="policy_number" placeholder="XXX XXX XXX" class="block mt-1 w-full" type="text" pattern="[0-9]{5}" name="policy_number" :value="old('policy_number')" required autofocus />
                </div>

            </div>
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>
                    <x-jet-label for="basic_premium" value="{{ __('Basic Premium') }}" />
                    <x-jet-input id="basic_premium" wire:model="basic_premium" placeholder="KshXXX XXX" class="block mt-1 w-full" type="text" pattern="[0-9]{5}" name="basic_premium" :value="old('basic_premium')" required autofocus />
                </div>
                <div>
                    <x-jet-label for="excess_protector" value="{{ __('Excess Protector') }}" />
                    <x-jet-input id="excess_protector" wire:model="excess_protector" placeholder="KshXXX XXX" class="block mt-1 w-full" type="text" pattern="[0-9]{9}" name="excess_protector" :value="old('excess_protector')" required autofocus />
                </div>
            </div>
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>
                    <x-jet-label for="political_risk" value="{{ __('Political Risk') }}" />
                    <x-jet-input id="political_risk" wire:model="political_risk" placeholder="KshXXX XXX" class="block mt-1 w-full" type="text" pattern="[0-9]{5}" name="political_risk" :value="old('political_risk')" required autofocus />
                </div>
                <div>
                    <x-jet-label for="risk_id" value="{{ __('Risk ID') }}" />
                    <x-jet-input id="risk_id" wire:model="risk_id" placeholder="XXX XXX XXX" class="block mt-1 w-full" type="text" pattern="[0-9]{9}" name="risk_id" :value="old('risk_id')" required autofocus />
                </div>
            </div>
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>

                    <x-jet-label for="insurance" value="{{ __('Class of Insurance') }}" />
                    <select id="insurance" wire:model="insurance" required autofocus class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option>Choose class of insurance</option>
                        @if (count($insurance_types) > 0)
                        @foreach ($insurance_types as $insurance)
                        <option value="{{ $insurance->id }}"> {{ ucfirst($insurance->name) }}</option>
                        @endforeach
                        @else
                        <option>No insurances are available!</option>
                        @endif
                    </select>

                </div>
                <div>
                    <x-jet-label for="underwriter" value="{{ __('Underwriter') }}" />
                    <select id="underwriter" wire:model="underwriter" required autofocus class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option>Choose a underwriter</option>
                        @if (count($underwriters) > 0)
                        @foreach ($underwriters as $underwriter)
                        <option value="{{ $underwriter->id }}"> {{ ucfirst($underwriter->name) }}</option>
                        @endforeach
                        @else
                        <option>No underwriters are available!</option>
                        @endif
                    </select>
                </div>

            </div>
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>
                    <x-jet-label for="annual_expiry_date" value="{{ __('Annual Expiry Date') }}" />
                    <x-jet-input id="annual_expiry_date" wire:model="annual_expiry_date" placeholder="Enter the risk_id number" class="block mt-1 w-full" type="date" name="annual_expiry_date" :value="old('annual_expiry_date')" required autofocus />
                </div>
                <div>
                    <x-jet-label for="sum_insured" value="{{ __('Sum Insured') }}" />
                    <x-jet-input id="sum_insured" wire:model="sum_insured" placeholder="KshXXX XXX" class="block mt-1 w-full" type="text" pattern="[0-9]{9}" name="sum_insured" :value="old('sum_insured')" required autofocus />
                </div>
            </div>
        </form>
    </x-slot>

    <x-slot name="footer" class="space-x-2">
        <x-jet-secondary-button wire:click="$toggle('newReport')" wire:loading.attr="disabled">
            Close
        </x-jet-secondary-button>
        <x-jet-secondary-button wire:click="$toggle('newReport')" wire:loading.attr="disabled">
            Save
        </x-jet-secondary-button>
        <x-jet-secondary-button wire:click="$toggle('newReport')" wire:loading.attr="disabled">
            Print
        </x-jet-secondary-button>

    </x-slot>
</x-jet-dialog-modal>