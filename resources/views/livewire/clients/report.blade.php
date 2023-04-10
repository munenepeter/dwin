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
            <div class="grid gap-2 mb-4 md:grid-cols-3">
                <div>
                    <x-jet-label for="update_date_range" value="{{ __('Update Date Range') }}" />
                    <select id="update_date_range" wire:model="update_date_range" required autofocus class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="all">All</option>
                        <option value="today">Today</option>
                        <option value="this_week">This Week</option>
                        <option value="this_month">This Month</option>
                        <option value="this_quarter">This Quarter</option>
                        <option value="this_year">This Year</option>
                        <option value="last_week">Last Week</option>
                        <option value="last_30_days">Last 30 Days</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>
                <div>
                    <x-jet-label for="updated_from" value="{{ __('Updated From') }}" />
                    <x-jet-input id="updated_from" wire:model="updated_from" class="block mt-1 w-full" type="date" name="updated_from" :value="old('updated_from')" required autofocus />
                </div>
                <div>
                    <x-jet-label for="updated_to" value="{{ __('Updated To') }}" />
                    <x-jet-input id="updated_to" wire:model="updated_to" class="block mt-1 w-full" type="date" name="updated_to" :value="old('updated_to')" required autofocus />
                </div>

            </div>
            <div class="grid gap-2 mb-4 md:grid-cols-3">
                <div>
                    <x-jet-label for="basic_premium_range" value="{{ __('Basic Premium Range') }}" />
                    <select id="basic_premium_range" wire:model="basic_premium_range" required autofocus class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="all">All</option>
                        <option value="<2k">Less Than 2k</option>
                        <option value="<5k">Less Than 5k</option>
                        <option value=">5k">More Than 5k</option>
                        <option value=">10k">More Than 10k</option>
                        <option value="<50k">Less Than 50k</option>
                        <option value=">50k">More Than 50k</option>
                        <option value="custom">Custom</option>

                    </select>
                </div>
                <div>
                    <x-jet-label for="basic_premium_from" value="{{ __('Basic Premium From') }}" />
                    <x-jet-input id="basic_premium_from" wire:model="basic_premium_from" placeholder="KshXXX XXX" class="block mt-1 w-full" type="text" pattern="[0-9]{5}" name="basic_premium_from" :value="old('basic_premium_from')" required autofocus />
                </div>
                <div>
                    <x-jet-label for="basic_premium_to" value="{{ __('Basic Premium To') }}" />
                    <x-jet-input id="basic_premium_to" wire:model="basic_premium_to" placeholder="KshXXX XXX" class="block mt-1 w-full" type="text" pattern="[0-9]{5}" name="basic_premium_to" :value="old('basic_premium_from')" required autofocus />
                </div>

            </div>
            <div class="grid gap-2 mb-4 md:grid-cols-3">
                <div>
                    <x-jet-label for="sum_insured_range" value="{{ __('Sum Insured Range') }}" />
                    <select id="sum_insured_range" wire:model="sum_insured_range" required autofocus class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="all">All</option>
                        <option value="<2k">Less Than 2k</option>
                        <option value="<5k">Less Than 5k</option>
                        <option value=">5k">More Than 5k</option>
                        <option value=">10k">More Than 10k</option>
                        <option value="<50k">Less Than 50k</option>
                        <option value=">50k">More Than 50k</option>
                        <option value="custom">Custom</option>

                    </select>
                </div>
                <div>
                    <x-jet-label for="sum_insured_from" value="{{ __('Sum Insured From') }}" />
                    <x-jet-input id="sum_insured_from" wire:model="basic_premium_from" placeholder="KshXXX XXX" class="block mt-1 w-full" type="text" pattern="[0-9]{5}" name="sum_insured_from" :value="old('sum_insured_from')" required autofocus />
                </div>
                <div>
                    <x-jet-label for="sum_insured_to" value="{{ __('Sum Insured To') }}" />
                    <x-jet-input id="sum_insured_to" wire:model="sum_insured_to" placeholder="KshXXX XXX" class="block mt-1 w-full" type="text" pattern="[0-9]{5}" name="sum_insured_to" :value="old('sum_insured_from')" required autofocus />
                </div>

            </div>
            <div class="grid gap-2 mb-4 md:grid-cols-3">
                <div>
                    <x-jet-label for="annual_renewal_date_range" value="{{ __('Annual Expiry Date Range') }}" />
                    <select id="annual_renewal_date_range" wire:model="annual_renewal_date_range" required autofocus class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="all">All</option>
                        <option value="today">Today</option>
                        <option value="this_week">This Week</option>
                        <option value="this_month">This Month</option>
                        <option value="this_quarter">This Quarter</option>
                        <option value="this_year">This Year</option>
                        <option value="last_week">Last Week</option>
                        <option value="last_30_days">Last 30 Days</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>
                <div>
                    <x-jet-label for="expiry_from" value="{{ __('Annual Expiry Date From') }}" />
                    <x-jet-input id="expiry_from" wire:model="expiry_from" class="block mt-1 w-full" type="date" name="renewal_from" :value="old('renewal_from')" required autofocus />
                </div>
                <div>
                    <x-jet-label for="expiry_to" value="{{ __('Annual Expiry Date To') }}" />
                    <x-jet-input id="expiry_to" wire:model="expiry_to" class="block mt-1 w-full" type="date" name="renewal_to" :value="old('renewal_to')" required autofocus />
                </div>

            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>

                    <x-jet-label for="insurance" value="{{ __('Class of Insurance') }}" />
                    <select id="insurance" wire:model="insurance" required autofocus class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="all">All</option>
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
                    <select id="underwriter" wire:model="underwriter" required autofocus class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="all">All</option>
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
        </form>
    </x-slot>

    <x-slot name="footer" class="space-x-4">
        <x-jet-secondary-button wire:click="$toggle('newReport')" wire:loading.attr="disabled">
            Close
        </x-jet-secondary-button>
        <x-jet-button class="mx-2" wire:click="$toggle('newReport')" wire:loading.attr="disabled">
            View
        </x-jet-button>
        <x-jet-button class="bg-green-500" wire:click="$toggle('newReport')" wire:loading.attr="disabled">
            Print
        </x-jet-button>

    </x-slot>
</x-jet-dialog-modal>