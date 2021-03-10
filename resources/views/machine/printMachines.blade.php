<div class="secondTable" >
    
    
    @foreach ($machines as $machine)
    @if ($machine->tipas == 'spausdinimo')
    <div class="header">{{$machine->pavadinimas}}</div>
    @include('machine.allMachines')
    @endif
    @endforeach
</div>
