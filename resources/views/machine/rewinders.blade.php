<div class="thirdTable row" >
    @foreach ($machines as $machine)
    @if ($machine->tipas == 'vyniokle')
    <div class="header col-12">{{$machine->pavadinimas}}</div>
    @include('machine.allMachines')
      @endif
    @endforeach
</div>