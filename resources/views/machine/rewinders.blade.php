<div class="lentele2" style="background-color: rgb(148, 235, 19)">
    @foreach ($machines as $machine)
    @if ($machine->tipas == 'vyniokle')
    @include('machine.allMachines')
      @endif
    @endforeach
</div>