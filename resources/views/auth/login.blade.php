<x-guest-layout>
    <x-jet-authentication-card>
        <div class="p-2 space-y-2 md:space-y-4 sm:p-8">
            <x-jet-validation-errors class="mb-2" />

            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
            @endif
            <h1 class="text-xl font-bold leading-tight tracking-tight text-rose-900 md:text-2xl dark:text-white">
                Sign in to your account
            </h1>
            <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <x-jet-label for="email" value="{{ __('Your email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full px-3 py-2 border border-slate-300  focus:outline-none bg-white focus:border-sky-500 focus:ring-1 focus:ring-sky-500" type="email" name="email" :value="old('email')" placeholder="name@company.com" required autofocus />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full px-3 py-2 bg-white border border-slate-300 focus:outline-none  focus:border-sky-500 focus:ring-1 focus:ring-sky-500" type="password" name="password" placeholder="Your password" required autocomplete="current-password" />
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-start">
                        <label for="remember_me" class="flex items-center">
                            <x-jet-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-rose-600 hover:underline dark:text-rose-500">Forgot password?</a>
                    @endif
                </div>
                <button type="submit" class="w-full text-white bg-rose-600 hover:bg-rose-700 focus:ring-4 focus:outline-none focus:ring-rose-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-rose-600 dark:hover:bg-rose-700 dark:focus:ring-rose-800">Sign in</button>
                {{-- <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Don’t have an account yet? <a href="{{ route('register') }}" class="font-medium text-rose-600 hover:underline dark:text-rose-500">Sign up</a>
                    </p> --}}
            </form>
        </div>

    </x-jet-authentication-card>






</x-guest-layout>