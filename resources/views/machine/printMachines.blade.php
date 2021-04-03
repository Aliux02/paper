<div class="row" >
    
    
    @foreach ($machines as $machine)
    @if ($machine->tipas == 'spausdinimo')
    <div class="header col-12">{{$machine->pavadinimas}}</div>
    @include('machine.allMachines')
    @endif
    @endforeach
</div>
