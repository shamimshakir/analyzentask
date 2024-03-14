<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-xl text-gray-600 pb-2">{{ __('User Details') }}</h3>
                        <a href="{{route('users.index')}}" type="button" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl font-semibold rounded text-sm px-2 py-1 text-center me-2 mb-2">{{__("Users")}}</a>
                    </div>

                    <div class="flex flex-col items-center bg-gray-100 rounded md:flex-row md:max-w-xl">
                        <img class="object-cover w-full rounded h-96 md:h-auto md:w-48 " src="../images/{{$user->photo}}" alt="">
                        <div class="flex flex-col justify-between p-4">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-700">{{ $user->name }}</h5>
                            <p class="mb-3 font-normal text-gray-700">{{ $user->email }}</p>
                            <p class="mb-3 font-normal text-gray-700">{{ $user->phone }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
