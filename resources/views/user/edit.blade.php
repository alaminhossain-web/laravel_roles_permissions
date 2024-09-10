<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('user.update',$user->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div>
                            <label for="" class="text-lg font-medium">Name</label>
                            <div class="my-3">
                                <input value="{{ old('name',$user->name) }}" placeholder="Enter Name" name="name" type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('name')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <label for="" class="text-lg font-medium">Email</label>
                            <div class="my-3">
                                <input value="{{ old('email',$user->email) }}" placeholder="Enter Email Address" name="email" type="email" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('email')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <label for="" class="text-lg font-medium">Select Role</label>
                            <div class="grid grid-cols-5 mb-3">
                                
                                @if ($roles->isNotEmpty())
                                @foreach ($roles as $data)
                                <div class="mt-3">
                                    
                                        <input {{ ($hasRoles->contains($data->id)) ? 'checked' : '' }} type="checkbox" class="rounded" id="role-{{ $data->id }}" name="role[]" value="{{ $data->name }}"> 
                                        <label for="role-{{ $data->id }}">{{ $data->name }}</label>
                                    @error('role')
                                        <p class="text-red-400 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                                @endforeach
                                @endif

                            </div>
                            <button class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
