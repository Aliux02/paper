<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{-- <img src="//localhost/Mokslai/paper/public/img/logo.png">  --}}
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{route('order.store')}}" enctype="multipart/form-data">
            @csrf

            <div>
                <x-jet-label for="uzsakovas" value="{{ __('Uzsakovas') }}" />
                <x-jet-input size="4" id="uzsakovas" class="block mt-1 w-full" type="text" name="uzsakovas" :value="old('uzsakovas')" required autofocus autocomplete="uzsakovas" />
            </div>

            <div class="mt-4">
                <x-jet-label for="pavadinimas" value="{{ __('Pavadinimas') }}" />
                <x-jet-input id="pavadinimas" class="block mt-1 w-full" type="text" name="pavadinimas" :value="old('pavadinimas')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="ilgis" value="{{ __('Ilgis') }}" />
                <x-jet-input id="ilgis" class="block mt-1 w-full" type="text" name="ilgis"  />
            </div>

            <div class="mt-4">
                <x-jet-label for="plotis" value="{{ __('Plotis') }}" />
                <x-jet-input id="plotis" class="block mt-1 w-full" type="text" name="plotis"  />
            </div>

            
            <div class="mt-4">
                <x-jet-label for="medziaga" value="{{ __('medziaga') }}" />
                <x-jet-input id="medziaga" class="block mt-1 w-full" type="text" name="medziaga"  />
            </div>
            
            <div class="mt-4">
                <x-jet-label for="klijai" value="{{ __('klijai') }}" />
                <x-jet-input id="klijai" class="block mt-1 w-full" type="text" name="klijai"  />
            </div>
            
            <div class="mt-4">
                <x-jet-label for="eiles" value="{{ __('eiles') }}" />
                <x-jet-input id="eiles" class="block mt-1 w-full" type="text" name="eiles"  />
            </div>
            
            <div class="mt-4">
                <x-jet-label for="spalva" value="{{ __('spalva') }}" />
                <x-jet-input id="spalva" class="block mt-1 w-full" type="text" name="spalva"  />
            </div>
            
            <div class="mt-4">
                <x-jet-label for="kiekis" value="{{ __('kiekis') }}" />
                <x-jet-input id="kiekis" class="block mt-1 w-full" type="text" name="kiekis"  />
            </div>

            <div class="mt-4">
                <x-jet-label for="velenas" value="{{ __('velenas') }}" />
                <x-jet-input id="velenas" class="block mt-1 w-full" type="text" name="velenas"  />
            </div>

            <div class="mt-4">
                <x-jet-label for="pabaigimas" value="{{ __('pabaigimas') }}" />
                <x-jet-input id="pabaigimas" class="block mt-1 w-full" type="date" name="pabaigimas"  />
            </div>

            <div class="mt-4">
                <x-jet-label for="pastabos" value="{{ __('pastabos') }}" />
                <textarea name="pastabos" id="" cols="40" rows="2"></textarea>
            </div>

            <div class="mt-4">
                <x-jet-label for="maketas" value="{{ __('Prideti maketa') }}" />
                <input type="file" name="maketas">
            </div>

            <div class="flex items-center justify-end mt-4">


                <x-jet-button class="ml-4">
                    {{ __('Ivesti') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
