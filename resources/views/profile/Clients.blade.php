<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Clients') }}
        </h2>
            <a href="">
                <h6 class="text-info">Create New Client</h6>
            </a>
    </x-slot>

    <div class="py-12 m-2">

        <div class="card bg-dark text-light">
            <div class="card-body m-3 p-2">
                <h5 >Create new Client</h5>
                <form method="post" action="{{ url("oauth/clients") }}" class="mt-6 space-y-6">
                    @csrf
                    @method('post')
            
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
            
                    <div>
                        <x-input-label for="RedirectURL" :value="__('Redirect URL')" />
                        <x-text-input id="RedirectURL" name="redirect" type="text" class="mt-1 block w-full" :value="old('redirect')" autocomplete="url" />
                        <x-input-error class="mt-2" :messages="$errors->get('redirect')" />
            
                    </div>
            
                    <div class="flex items-center gap-4">
                       <button type="submit" class="btn-success">Submit</button>
            
                        @if (Session::get('isClientCreated'))
                            <p class="text-success">{{ Session::get("isClientCreated") }}</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <div class="card my-2">
      <h5 class="p-3">Here are list of clients</h5>
      @foreach ($Clients as $client)
         
              <div class="card-body">
                <h3 class="text-info">{{ $client->name }}</h3>
                <p class="text-primary">
                    <b>CLIENT_REDIRECT :</b>  {{ $client->redirect }}
                </p>

                <p class="text-primary">
                    <b>CLIENT_ID :</b>  {{ $client->id }}
                </p>
                
                <p class="text-primary">
                   <b>CLIENT_SECRET :</b>{{ $client->secret }}
                </p>
              </div>
        
      @endforeach
    </div>
    </div>
</x-app-layout>
