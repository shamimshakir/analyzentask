<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-xl text-gray-600 pb-2">{{ __('User List') }}</h3>
                        <a href="{{route('users.create')}}" type="button" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl font-semibold rounded text-sm px-2 py-1 text-center me-2 mb-2">{{__("Add User")}}</a>
                    </div>

                    <table class="w-full rounded overflow-hidden">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="p-2 text-sm font-semibold tracking-wide text-left">SL</th>
                                <th class="p-2 text-sm font-semibold tracking-wide text-left">Name</th>
                                <th class="p-2 text-sm font-semibold tracking-wide text-left">Email</th>
                                <th class="p-2 text-sm font-semibold tracking-wide text-left">Phone</th>
                                <th class="p-2 text-sm font-semibold tracking-wide text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-100">
                        @foreach($users as $key => $user)
                        <tr class="border-t border-gray-200">
                            <td class="p-2 text-sm">{{ $key + 1 }}</td>
                            <td class="p-2 text-sm">
                                <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
                            </td>
                            <td class="p-2 text-sm">
                                <a href="{{ route('users.show', $user->id) }}">{{ $user->email }}</a>
                            </td>
                            <td class="p-2 text-sm">{{ $user->phone }}</td>
                            <td class="p-2 text-sm flex justify-end">
                                <a href="" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl font-semibold rounded text-sm px-2 py-1 text-center me-2">{{__('Edit')}}</a>
                                <form action="{{ route('users.trash', $user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl font-semibold rounded text-sm px-2 py-1 text-center">{{ __('Trash') }}</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>