<header>
    @auth
    @if (auth()->user()->status!=0 )
    <a href="{{route('welcome')}}" class="button">I pradzia</a>

    @if (auth()->user()->permission_lvl<=10 || auth()->user()->permission_lvl>=1000)
    <a href="{{route('paper.index')}}">Popierius</a>
    @endif

    @if(auth()->user()->permission_lvl>=100 )
    <a href="{{route('machine.index')}}">Masinos</a>
    @endif
    
    @if (auth()->user()->permission_lvl>=750)
    <a href="{{route('order.index')}}">Uzsakymai</a>
    <a href="{{route('pack.index')}}">Pakavimas</a>
    <a href="{{route('order.archive')}}">Archyvas</a>
    @endif
    
    @if(auth()->user()->permission_lvl>=2000 )
    <a href="{{route('user.index')}}">Vartotojai</a>
    @endif

    @endif
    @endauth
</header>