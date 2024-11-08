<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<form  method="POST" action="{{ url('users/'.$user->id) }}">
    @csrf
    @method('PUT')
    <div class="space-y-12">

    <div class="border-b border-gray-900/10 pb-12">
    <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="{{ $user->image}}" alt="">   
    <div class="border-b border-gray-900/10 pb-12">
      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="first-name" class="block text-sm/6 font-medium text-gray-900">Nome</label>
          <div class="mt-2">
            <input type="text" name="name" value=" {{$user->name}}"  id="name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
          </div>
        </div>

        <div class="sm:col-span-3">
          <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Telefone</label>
          <div class="mt-2">
            <input type="text" name="contact" id="contact" value=" {{$user->contact}}"  autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
          </div>
        </div>

        <div class="sm:col-span-4">
          <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
          <div class="mt-2">
            <input id="email" name="email" type="email" value=" {{$user->email}}"  autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
          </div>
        </div>        
    </div>

    <div class="border-b border-gray-900/10 pb-12">     
      <p class="mt-1 text-sm/6 text-gray-600">We'll always let you know about important changes, but you pick what else you want to hear about.</p>    
    </div>
  </div>

  <div class="mt-6 flex items-center justify-end gap-x-6">
    <button type="button" class="text-sm/6 font-semibold text-gray-900" href="{{url('/users')}}">Back to users List</button>
    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
  </div>
</form>
<!-- 
<div class="container">
    <div class="row">
        <div class="col-6 mx-auto mt-5">
            <h2>Show user - {{$user->id}}</h2>
              <form>
                <div class="form-row mt-3">
                    <div class="form-group col-md-6">
                        <label for="name">name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            autocomplete="name"
                            readonly
                            class="form-control"
                            value="{{ $user->name}}"
                            aria-describedby="nameHelp">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="email">email</label>
                        <input
                            type="text"
                            id="email"
                            name="email"
                            class="form-control"
                            value="{{$user->email}}"
                            readonly
                            aria-describedby="emailHelp">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="contact">contact</label>
                        <input
                            type="text"
                            id="contact"
                            name="contact"
                            class="form-control"
                            value="{{ date('Y-m-d', strtotime($user->contact)) }}"
                            readonly
                            aria-describedby="contactHelp">
                    </div>
                </div>                  

                <a type="button" class="btn btn-primary mt-3" href="{{url('/users')}}">Back to users List</a>

            </form>
        </div>
    </div>
</div> -->
