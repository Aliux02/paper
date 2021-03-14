
<x-guest-layout>
    @auth
    @if (auth()->user()->status!=0 )
    @if (auth()->user()->permission_lvl>=1000)
    @include('header')

    <x-jet-authentication-card>
        <x-slot name="logo">
            {{-- <img src="//localhost/Mokslai/paper/public/img/logo.png">  --}}
        </x-slot>

        <x-jet-validation-errors class="mt-4" />

        <form method="POST" action="{{route('order.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="mt-4"style="width: 48%; float: left;" >
                <x-jet-label for="uzsakovas" value="{{ __('Uzsakovas') }}" />
                <x-jet-input id="uzsakovas" class="block mt-1 w-full" type="text" name="uzsakovas" :value="old('uzsakovas')" />
            </div>

            <div class="mt-4"style="width: 48%; float: right">
                <x-jet-label for="pavadinimas" value="{{ __('Pavadinimas') }}" />
                <x-jet-input id="pavadinimas" class="block mt-1 w-full" type="text" name="pavadinimas" :value="old('pavadinimas')" />
            </div>

            <div class="mt-4"style="width: 48%; float: left">
                <x-jet-label for="ilgis" value="{{ __('Ilgis') }}" />
                <x-jet-input id="ilgis" class="block mt-1 w-full" type="text" name="ilgis" :value="old('ilgis')" />
            </div>

            <div class="mt-4"style="width: 48%; float: right">
                <x-jet-label for="plotis" value="{{ __('Plotis') }}" />
                <x-jet-input id="plotis" class="block mt-1 w-full" type="text" name="plotis" :value="old('plotis') "/>
            </div>

            <div class="mt-4"style="width: 48%; float: left">
                <x-jet-label for="eiles" value="{{ __('eiles') }}" />
                <x-jet-input id="eiles" class="block mt-1 w-full" type="text" name="eiles" :value="old('eiles') "/>
            </div>
            
            <div class="mt-4" style="width: 48%; float: right">
                <x-jet-label for="spalva" value="{{ __('spalva') }}" />
                <x-jet-input id="spalva" class="block mt-1 w-full" type="text" name="spalva" :value="old('spalva') "/>
            </div>
            
            <div class="mt-4"style="width: 48%; float: left">
                <x-jet-label for="medziaga" value="{{ __('medziaga') }}" />
                <x-jet-input id="medziaga" class="block mt-1 w-full" type="text" name="medziaga"  :value="old('medziaga')"/>
            </div>
            
            <div class="mt-4"style="width: 48%; float: right">
                <x-jet-label for="klijai" value="{{ __('klijai') }}" />
                <x-jet-input id="klijai" class="block mt-1 w-full" type="text" name="klijai" :value="old('klijai') "/>
            </div>
            
            
            <div class="mt-4" style="width: 48%; float: left">
                <x-jet-label for="kiekis" value="{{ __('kiekis') }}" />
                <x-jet-input id="kiekis" class="block mt-1 w-full" type="text" name="kiekis" :value="old('kiekis') "/>
            </div>

            <div class="mt-4"style="width: 48%; float: right">
                <x-jet-label for="velenas" value="{{ __('velenas') }}" />
                <x-jet-input id="velenas" class="block mt-1 w-full" type="text" name="velenas"  :value="old('velenas')"/>
            </div>
            
            
            <div class="mt-4"style="width: 100%; float: right">
                <x-jet-label for="pabaigimas" value="{{ __('pabaigimas') }}" />
                <x-jet-input id="pabaigimas" class="block mt-1 w-full" type="date" name="pabaigimas" :value="old('pabaigimas')" />
            </div>
            
            <div class="mt-4"style="width: 100%; float: left">
                <x-jet-label for="pastabos" value="{{ __('Pastabos') }}" />
                <textarea class="block mt-1 w-full" name="pastabos" id="pastabos" cols="40" rows="2" style="border-width:thin;" >{{old('pastabos')}}</textarea>
            </div>
            
            <div class="mt-4"style="width: 50%; float: left">
                <x-jet-label for="maketas" value="{{ __('Prideti maketa') }}" />
                <input type="file" name="maketas">
            </div>
            
            <div class="flex items-center justify-end mt-8" style=" float: right">


                <x-jet-button class="ml-4">
                    {{ __('Ivesti') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
    @endif
    @endif
    @endauth
</x-guest-layout>
