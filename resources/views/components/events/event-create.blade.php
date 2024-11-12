<div class="carousel">
    <button class="arrow left-arrow">&lt;</button>
    <div class="carousel-container">
        <div class="card" id="Workshop" title="Workshop"  style="background-image: url('{{ asset('images/eventoPublicoNosAlive.jpg') }}');"></div>
        <div class="card" id="Concerto" title="Concerto" style="background-image: url('{{ asset('images/eventoPublicoNosAlive.jpg') }}');"></div>
        <div class="card" id="Festival" title="Festival" style="background-image: url('{{ asset('images/eventoPublicoNosAlive.jpg') }}');"></div>
        <div class="card" id="Musical" title="Musical" style="background-image: url('{{ asset('images/eventoPublicoNosAlive.jpg') }}');"></div>
        <div class="card" id="Teatro" title="Teatro" style="background-image: url('{{ asset('images/eventoPublicoNosAlive.jpg') }}');"></div>
    </div>
    <button class="arrow right-arrow">&gt;</button>
</div>


<form  method="POST" action="{{ url('/events') }}">
    @csrf
    @method('PUT')
    <div class="space-y-12">

    <div class="border-b border-gray-900/10 pb-12">
    <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="" alt="">   
    <div class="border-b border-gray-900/10 pb-12">
      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="first-name" class="block text-sm/6 font-medium text-gray-900">Nome</label>
          <div class="mt-2">
            <input type="text" name="name" value=" "  id="name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
          </div>
        </div>

        <div class="sm:col-span-3">
          <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Telefone</label>
          <div class="mt-2">
            <input type="text" name="contact" id="contact" value=" "  autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
          </div>
        </div>

        <div class="sm:col-span-4">
          <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
          <div class="mt-2">
            <input id="email" name="email" type="email" value=" "  autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
          </div>
        </div>        
    </div>

    <div class="border-b border-gray-900/10 pb-12">     
      <p class="mt-1 text-sm/6 text-gray-600">We'll always let you know about important changes, but you pick what else you want to hear about.</p>    
    </div>
  </div>

  <div class="mt-6 flex items-center justify-end gap-x-6">
    <button type="button" class="text-sm/6 font-semibold text-gray-900" href="{{url('/events')}}">Back to users List</button>
    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create</button>
  </div>
</form>