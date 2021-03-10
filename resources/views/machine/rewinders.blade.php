<div class="thirdTable" >
    @foreach ($machines as $machine)
    @if ($machine->tipas == 'vyniokle')
    <div class="header">{{$machine->pavadinimas}}</div>
    @include('machine.allMachines')
      @endif
    @endforeach
</div>