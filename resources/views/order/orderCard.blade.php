
    



        <x-guest-layout>
            
            @auth
            @if (auth()->user()->status!=0 )
            {{-- @if (auth()->user()->permission_lvl>=1000) --}}
            
            @include('header')
            <x-jet-authentication-card >
                <x-slot name="logo">
                    {{-- <img src="//localhost/Mokslai/paper/public/img/logo.png">  --}}
                </x-slot>
        
                <x-jet-validation-errors class="mt-4"/>
        
                <form method="GET" action="{{route('order.update',$order)}}" enctype="multipart/form-data">
                    @csrf
        
                    <div class="mt-4"style="width: 48%; float: left;" >
                        <x-jet-label class="font-semibold" for="uzsakovas" value="{{ __('Uzsakovas') }}" />
                        {{-- <x-jet-input id="uzsakovas" class="block mt-1 w-full" type="text" name="uzsakovas" :value="$order->uzsakovas" /> --}}
                            {{-- <p>{{$order->uzsakovas}}</p> --}}
                            @if (auth()->user()->permission_lvl>=1000)
                            <x-jet-input id="uzsakovas" class="block mt-1 w-full" type="text" name="uzsakovas" :value="$order->uzsakovas" />
                            @else
                            <p>{{$order->uzsakovas}}</p> 
                            @endif
                    </div>

                    <div class="mt-4"style="width: 48%; float: right">
                        <x-jet-label class="font-semibold" for="pavadinimas" value="{{ __('Pavadinimas') }}" />
                        {{-- <x-jet-input id="pavadinimas" class="block mt-1 w-full" type="text" name="pavadinimas" :value="$order->pavadinimas" /> --}}
                            @if (auth()->user()->permission_lvl>=1000)
                            <x-jet-input id="pavadinimas" class="block mt-1 w-full" type="text" name="pavadinimas" :value="$order->pavadinimas" />
                            @else
                            <p>{{$order->pavadinimas}}</p> 
                            @endif
                    </div>
        
                    <div class="mt-4"style="width: 48%; float: left">
                        <x-jet-label class="font-semibold" for="ilgis" value="{{ __('Ilgis') }}" />
                        @if (auth()->user()->permission_lvl>=1000)
                            <x-jet-input id="ilgis" class="block mt-1 w-full" type="text" name="ilgis" :value="$order->ilgis" />
                            @else
                            <p>{{$order->ilgis}}</p> 
                            @endif
                    </div>
        
                    <div class="mt-4"style="width: 48%; float: right">
                        <x-jet-label class="font-semibold" for="plotis" value="{{ __('Plotis') }}" />
                        @if (auth()->user()->permission_lvl>=1000)
                        <x-jet-input id="plotis" class="block mt-1 w-full" type="text" name="plotis" :value="$order->plotis"/>
                        @else
                        <p>{{$order->plotis}}</p> 
                         @endif        
                    </div>
        
                    
                    <div class="mt-4"style="width: 48%; float: left">
                        <x-jet-label class="font-semibold" for="medziaga" value="{{ __('medziaga') }}" />
                        @if (auth()->user()->permission_lvl>=1000)
                        <x-jet-input id="medziaga" class="block mt-1 w-full" type="text" name="medziaga"  :value="$order->medziaga"/>
                            @else
                        <p>{{$order->medziaga}}</p> 
                        @endif   
                    </div>
                    
                    <div class="mt-4"style="width: 48%; float: right">
                        <x-jet-label class="font-semibold" for="klijai" value="{{ __('klijai') }}" />
                        
                            @if (auth()->user()->permission_lvl>=1000)
                            <x-jet-input id="klijai" class="block mt-1 w-full" type="text" name="klijai" :value="$order->klijai"/>
                                @else
                            <p>{{$order->klijai}}</p> 
                            @endif   
                    </div>

                    <div class="mt-4"style="width: 48%; float: left">
                        <x-jet-label class="font-semibold" for="eiles" value="{{ __('eiles') }}" />
                        
                            @if (auth()->user()->permission_lvl>=1000)
                            <x-jet-input id="eiles" class="block mt-1 w-full" type="text" name="eiles" :value="$order->eiles"/>
                                @else
                            <p>{{$order->eiles}}</p> 
                            @endif 
                    </div>
                    
                    <div class="mt-4" style="width: 48%; float: right">
                        <x-jet-label class="font-semibold" for="spalva" value="{{ __('spalva') }}" />
                        
                            @if (auth()->user()->permission_lvl>=1000)
                            <x-jet-input id="spalva" class="block mt-1 w-full" type="text" name="spalva" :value="$order->spalva"/>
                                @else
                            <p>{{$order->spalva}}</p> 
                            @endif 
                    </div>
                    
                    <div class="mt-4" style="width: 48%; float: left">
                        <x-jet-label class="font-semibold" for="kiekis" value="{{ __('kiekis') }}" />
                        
                            @if (auth()->user()->permission_lvl>=1000)
                            <x-jet-input id="kiekis" class="block mt-1 w-full" type="text" name="kiekis" :value="$order->kiekis "/>
                                @else
                            <p>{{$order->kiekis}}</p> 
                            @endif 
                    </div>
        
                    <div class="mt-4"style="width: 48%; float: right">
                        <x-jet-label class="font-semibold" for="velenas" value="{{ __('velenas') }}" />
                        
                            @if (auth()->user()->permission_lvl>=1000)
                            <x-jet-input id="velenas" class="block mt-1 w-full" type="text" name="velenas"  :value="$order->velenas"/>
                                @else
                            <p>{{$order->velenas}}</p> 
                            @endif 
                    </div>
                    
                    
                    <div class="mt-4"style="width: 100%; float: right">
                        <x-jet-label class="font-semibold" for="pabaigimas" value="{{ __('pabaigimas') }}" />
                        @if (auth()->user()->permission_lvl>=1000)
                            <x-jet-input id="pabaigimas" class="block mt-1 w-full" type="date" name="pabaigimas" :value="$order->pabaigimas" />
                        @else
                            <p>{{$order->pabaigimas}}</p> 
                        @endif 
                    </div>
                
                    <div class="mt-4"style="width: 100%; float: left">
                        <x-jet-label class="font-semibold" for="pastabos" value="{{ __('Pastabos') }}" />
                        @if (auth()->user()->permission_lvl>=1000)
                        <textarea class="block mt-1 w-full" name="pastabos" id="pastabos" cols="40" rows="2" style="border-width:thin;" :value="$order->pastabos">{{$order->pastabos}}</textarea>
                        
                    @else
                        <p>{{$order->pastabos}}</p> 
                    @endif 
                    </div>
                    @if (auth()->user()->permission_lvl>=1000)
                    <div class="mt-4"style="width: 50%; float: left">
                        <x-jet-label class="font-semibold" style="color: red" for="masina" value="{{ __('Priskirti masina') }}" />
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
                    @endif

                    <div class="mt-4"style="width: 50%; float: right; line-height: 23px">
                        <x-jet-label class="font-semibold" for="maketas" value="{{ __('Technologine kortele') }}" />
                        <?php if ($order->maketas !== '0') {
                        echo '<a style="text-decoration: none" href="'.route('order.printLayout', $order ).'">Maketas</a>';
                        }else{
                        echo "<p>Nera</p>";
                        } 
                        ?>
                      </div>
                      
                    @if (auth()->user()->permission_lvl>=1000)
                    <div class="flex items-center justify-end mt-6" style=" float: right">
                        <x-jet-button class="ml-4">
                            {{ __('Ivesti') }}
                        </x-jet-button>
                    </div>

                </form>
                    <div class="flex items-center justify-end mt-6" style=" float: left">
                        <form action="{{route('order.destroy',$order)}}" method="get" >
                            <x-jet-button class="ml-4" style="background-color: red; margin-left:0px">
                                {{ __('Istrinti') }}
                            </x-jet-button>
                            @csrf
                        </form> 
                    </div> 
                @endif
                    
                </x-jet-authentication-card>
                {{-- <div class="mt-4"style="width: 50%; float: right style=" float: left">
                    <iframe src="{{url('storage/'.$path)}}" style=" top:0px; left:0; bottom:0; right:0; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:999999;"></iframe>
                </div> --}}
                {{-- @endif --}}
            @endif
            @endauth
        </x-guest-layout>
        



</body>
</html>