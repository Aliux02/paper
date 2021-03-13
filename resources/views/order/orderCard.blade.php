
    @include('header')
    @include('errors')
    



        <x-guest-layout>

            @auth
            @if (auth()->user()->status!=0 )
            @if (auth()->user()->permission_lvl>=1000)
        
            <x-jet-authentication-card style="margin: 0">
                <x-slot name="logo">
                    {{-- <img src="//localhost/Mokslai/paper/public/img/logo.png">  --}}
                </x-slot>
        
                <x-jet-validation-errors class="mb-4"/>
        
                <form method="GET" action="{{route('order.update',$order)}}" enctype="multipart/form-data">
                    @csrf
        
                    <div class="mt-4"style="width: 48%; float: left;" >
                        <x-jet-label for="uzsakovas" value="{{ __('Uzsakovas') }}" />
                        <x-jet-input id="uzsakovas" class="block mt-1 w-full" type="text" name="uzsakovas" :value="$order->uzsakovas" />
                    </div>
        
                    <div class="mt-4"style="width: 48%; float: right">
                        <x-jet-label for="pavadinimas" value="{{ __('Pavadinimas') }}" />
                        <x-jet-input id="pavadinimas" class="block mt-1 w-full" type="text" name="pavadinimas" :value="$order->pavadinimas" />
                    </div>
        
                    <div class="mt-4"style="width: 48%; float: left">
                        <x-jet-label for="ilgis" value="{{ __('Ilgis') }}" />
                        <x-jet-input id="ilgis" class="block mt-1 w-full" type="text" name="ilgis" :value="$order->ilgis" />
                    </div>
        
                    <div class="mt-4"style="width: 48%; float: right">
                        <x-jet-label for="plotis" value="{{ __('Plotis') }}" />
                        <x-jet-input id="plotis" class="block mt-1 w-full" type="text" name="plotis" :value="$order->plotis"/>
                    </div>
        
                    
                    <div class="mt-4"style="width: 48%; float: left">
                        <x-jet-label for="medziaga" value="{{ __('medziaga') }}" />
                        <x-jet-input id="medziaga" class="block mt-1 w-full" type="text" name="medziaga"  :value="$order->medziaga"/>
                    </div>
                    
                    <div class="mt-4"style="width: 48%; float: right">
                        <x-jet-label for="klijai" value="{{ __('klijai') }}" />
                        <x-jet-input id="klijai" class="block mt-1 w-full" type="text" name="klijai" :value="$order->klijai"/>
                    </div>
                    
                    <div class="mt-4"style="width: 48%; float: left">
                        <x-jet-label for="eiles" value="{{ __('eiles') }}" />
                        <x-jet-input id="eiles" class="block mt-1 w-full" type="text" name="eiles" :value="$order->eiles"/>
                    </div>
                    
                    <div class="mt-4" style="width: 48%; float: right">
                        <x-jet-label for="spalva" value="{{ __('spalva') }}" />
                        <x-jet-input id="spalva" class="block mt-1 w-full" type="text" name="spalva" :value="$order->spalva"/>
                    </div>
                    
                    <div class="mt-4" style="width: 48%; float: left">
                        <x-jet-label for="kiekis" value="{{ __('kiekis') }}" />
                        <x-jet-input id="kiekis" class="block mt-1 w-full" type="text" name="kiekis" :value="$order->kiekis "/>
                    </div>
        
                    <div class="mt-4"style="width: 48%; float: right">
                        <x-jet-label for="velenas" value="{{ __('velenas') }}" />
                        <x-jet-input id="velenas" class="block mt-1 w-full" type="text" name="velenas"  :value="$order->velenas"/>
                    </div>
                    
                    
                    <div class="mt-4"style="width: 100%; float: right">
                        <x-jet-label for="pabaigimas" value="{{ __('pabaigimas') }}" />
                        <x-jet-input id="pabaigimas" class="block mt-1 w-full" type="date" name="pabaigimas" :value="$order->pabaigimas" />
                    </div>
                
                    <div class="mt-4"style="width: 100%; float: left">
                        <x-jet-label for="pastabos" value="{{ __('Pastabos') }}" />
                        <textarea class="block mt-1 w-full" name="pastabos" id="pastabos" cols="40" rows="2" style="border-width:thin;" :value="$order->pastabos">{{$order->pastabos}}</textarea>
                    </div>
                    
                    <div class="mt-4"style="width: 50%; float: left">
                        <x-jet-label style="color: red" for="masina" value="{{ __('Priskirti masina') }}" />
                        <select style="color: rgb(197, 30, 8)" name="machine_id" >
                            @if ($order->machine_id===null)
                            <option  value="0">
                                All 
                            </option>
                            @foreach ($machines as $machine)
                                <option value="{{$machine->id}}">{{$machine->pavadinimas}}</option>
                                @endforeach
                            @else
                        
                            @foreach ($machines as $machine)
                            @if ($order->machine_id == $machine->id)
            
                            <option value="{{$machine->id}}">
                                {{$machine->pavadinimas}}
                            </option>
                            @else 
            
                            @endif
                            @endforeach
                            <option style="background-color: rgb(4, 61, 110);color:white" value="0">
                                Nuimti
                            </option>
                            @foreach ($machines as $machine)
                                <option value="{{$machine->id}}">{{$machine->pavadinimas}}</option>
                            @endforeach
                            @endif
            
            
                        </select>
                    </div>


                    <div class="mt-4"style="width: 50%; float: right; line-height: 20px">
                        <x-jet-label for="pabaigimas" value="{{ __('Technologine kortele') }}" />
                        <?php if ($order->maketas !== '0') {
                        echo '<a style="text-decoration: none" href="'.route('order.printLayout', $order ).'">Maketas</a>';
                        }else{
                        echo "<p>Nera</p>";
                        } 
                        ?>
                      </div>

                    <div class="flex items-center justify-end mt-6" style=" float: right">
        

                        <x-jet-button class="ml-4">
                            {{ __('Ivesti') }}
                        </x-jet-button>

                    </form>
                    <form action="{{route('order.destroy',$order)}}" method="get">
                        <x-jet-button class="ml-4">
                            {{ __('Istrinti') }}
                        </x-jet-button>
                    @csrf
                    </form>  
                </div>

            </x-jet-authentication-card>
            @endif
            @endif
            @endauth
        </x-guest-layout>
        



</body>
</html>