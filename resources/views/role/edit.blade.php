<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Role Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('role.update',$role->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div>
                            <label for="" class="text-lg font-medium">Name</label>
                            <div class="my-3">
                                <input value="{{ old('name',$role->name) }}" placeholder="Enter Name" name="name" type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('name')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-3 mb-3">
                                @if ($permissions->isNotEmpty())
                                @foreach ($permissions as $data)
                                <div class="mt-3">
                                    
                                        <input {{ ($hasPermissions->contains($data->name)) ? 'checked' : '' }} type="checkbox" class="rounded" id="permission-{{ $data->id }}" name="permission[]" value="{{ $data->name }}"> 
                                        <label for="permission-{{ $data->id }}">{{ $data->name }}</label>
                                        
                                    
                                
                                    @error('permission')
                                        <p class="text-red-400 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                                @endforeach
                                @endif

                            </div>
                            <button class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white hover:bg-slate-600">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
