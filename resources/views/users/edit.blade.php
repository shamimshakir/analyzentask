<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-xl text-gray-600 pb-2">{{ __('Create User') }}</h3>
                        <a href="{{route('users.index')}}" type="button" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl font-medium rounded text-sm px-2 py-1 text-center me-2 mb-2">{{__("Users")}}</a>
                    </div>

                    <form method="POST" action="{{ route('users.store') }}" class="mt-4 space-y-4" enctype="multipart/form-data">
                        @csrf

                        <div class="flex">
                            <div class="w-full pr-2">
                                <x-input-label for="first_name" :value="__('First Name')" />
                                <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name')" autocomplete="first_name" />
                                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                            </div>

                            <div class="w-full pl-2">
                                <x-input-label for="last_name" :value="__('Last Name')" />
                                <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name')" autocomplete="last_name" />
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email Address')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="flex w-full">
                            <div class="w-full pr-2">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div class="w-full pl-2">
                                <x-input-label for="confirm-password" :value="__('Confirm Password')" />
                                <x-text-input id="confirm-password" name="confirm_password" type="password" class="mt-1 block w-full" autocomplete="password" />
                                <x-input-error :messages="$errors->get('confirm_password')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex w-full">
                            <div class="w-full pr-2">
                                <x-input-label for="phone" :value="__('Phone')" />
                                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" autocomplete="phone" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>

                            <div class="w-full pl-2">
                                <x-input-label for="photo" :value="__('Photo')" />
                                <input name="photo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer p-2" aria-describedby="photo" id="photo" type="file">
                                <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'saved')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>