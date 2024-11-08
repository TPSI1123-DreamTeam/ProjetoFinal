
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="container-fluid">

    <div class="d-flex align-items-center">
        <p class="text-sm/6 font-semibold text-gray-900">Users List</p>
    </div>

    <ul role="list" class="divide-y">
        @foreach ($users as $user)
        <li class="flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">
            <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="{{ $user->image}}" alt="">
            <div class="min-w-0 flex-auto">
                <p class="text-sm/6 font-semibold text-gray-900">{{$user->name}}</p>
                <p class="mt-1 truncate text-xs/5 text-gray-500">{{$user->email}}</p>
                <p class="text-sm/6 text-gray-900">{{$user->birthdate}}</p>
                <p class="text-sm/6 text-gray-900">{{$user->role}}</p>
            </div>
            </div>
            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
            
            <p class="mt-1 text-xs/5 text-gray-500"></p>
            </div>
            <div class="flex justify-between  gap-x-6 py-5">
                <a href="{{ url('users/' . $user->id) }}" class="btn btn-success">Show</a>
                <a href="{{ url('users/' . $user->id) . '/edit' }}" class="btn btn-primary">Edit</a>
                <form action="{{ url('users/' . $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
            
        </li>
        @endforeach
    </ul>

    {{ $users->links() }}
</div>