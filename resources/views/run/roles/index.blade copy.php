<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles & Permissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(Session::has('status'))
                <p class="bg-green-400">{{ Session::get('status') }}</p>
            @endif
            
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-12 py-12">
                
                @can('add_posts')                
                    <a href="{{ route('posts.create') }}" class="btn-blue">
                        <i class="glyphicon glyphicon-plus-sign"></i> Create
                    </a>
                @endcan
                @forelse ($roles as $role)
                    <form action ="/roles/{{$role->id}}" method="POST" >
                        @method("PUT")
                        @csrf
                    @if($role->name == 'Admin')
                        @include('shared._permissions1', [
                                    'title' => $role->name .' Permissions',
                                    'options' => ['disabled'] ])
                    @else
                        @include('shared._permissions1', [
                                    'title' => $role->name .' Permissions',
                                    'model' => $role ])
                        @can('edit_roles')
                            <button type="submit" class="btn-blue">Save</button>
                        @endcan
                    @endif

                    </form>

                @empty
                    <p>No Roles defined, please run <code>php artisan db:seed</code> to seed some dummy data.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>