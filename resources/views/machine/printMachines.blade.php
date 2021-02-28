<div class="secondTable" style="background-color: rgb(221, 255, 127)">
    @foreach ($machines as $machine)
    @if ($machine->tipas == 'spausdinimo')
    @include('machine.allMachines')
    @endif
    @endforeach
</div>
