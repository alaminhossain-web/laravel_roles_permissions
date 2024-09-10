<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('role.store') }}" method="post">
                        @csrf
                        <div>
                            <label for="" class="text-lg font-medium">Name</label>
                            <div class="my-3">
                                <input value="{{ old('name') }}" placeholder="Enter Name" name="name" type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('name')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-5 mb-3">
                                @if ($permissions->isNotEmpty())
                                @foreach ($permissions as $data)
                                <div class="mt-3">
                                    
                                        <input type="checkbox" class="rounded" id="permission-{{ $data->id }}" name="permission[]" value="{{ $data->name }}"> 
                                        <label for="permission-{{ $data->id }}">{{ $data->name }}</label>
                                    @error('permission')
                                        <p class="text-red-400 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                                @endforeach
                                @endif

                            </div>
                            
                            
                            <button class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <h3 class="p-3 text-lg font-bold border-b">Roles List</h3>

                <div class="p-6 text-gray-900">
                    <table class="w-full border">
                        <thead class="bg-gray-200">
                            <tr class="border-b">
                                <th class="px-6 py-3 text-left" width="60">#</th>
                                <th class="px-6 py-3 text-left">Name</th>
                                <th class="px-6 py-3 text-left">Permissions</th>
                                <th class="px-6 py-3 text-left" width="250">Created</th>
                                <th class="px-6 py-3 text-center" width="180">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @if($permissions->isNotEmpty())
                            @foreach ($roles as $data)
                            <tr class="border-b">
                                <td class="px-6 py-3 text-left">{{ $loop->iteration }}</td>
                                <td class="px-6 py-3 text-left">{{ $data->name }}</td>
                                <td class="px-6 py-3 text-left">
                                    {{ $data->permissions->pluck('name')->implode(', ') }}
                                </td>
                                <td class="px-6 py-3 text-left">{{ $data->created_at->format('d M, Y') }}</td>
                                <td class="px-6 py-3 text-center">
                                    @can('edit roles')
                                    <a href="{{ route('role.edit',$data->id) }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600">Edit</a>
                                    @endcan
                                    @can('delete roles')
                                    <a href="javascript:void(0);" onclick="deleteRole({{ $data->id }})" class="bg-red-600 text-sm rounded-md text-white px-3 py-2 hover:bg-red-500">Delete</a>
                                    @endcan
                                    

                                </td>
                            </tr>
                            @endforeach
                            @else
                            <td>No Data</td>
                            @endif
                           
                        </tbody>
                    </table>
                    <div class="my-3">
                    {{ $roles->links() }}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script type="text/javascript">
            function deleteRole(id) {
                if (confirm("Are you sure you want to delete this Role?")) {
                    $.ajax({
                        url: '{{ route('role.destroy', '') }}/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}', 
                            id: id
                        },
                        dataType: 'json',
                        success: function(response) {
                            
                         window.location.href = '{{ route('role.index') }}';
                            
                        },
                        error: function(xhr) {
                            
                            // toastr()->error('Failed to delete permission.');
                        }
                    });
                }
            }
        </script>
        
    </x-slot>    
</x-app-layout>
