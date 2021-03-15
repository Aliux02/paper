<nav class="navBar">

    @auth
    @if (auth()->user()->status!=0 )


    {{-- <a href="{{route('welcome')}}" class="active">I pradzia</a>

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
    @endif --}}


    <ul>

        <li class="dropdown" >
            <a href="javascript:void(0)" class="dropbtn">Daugiau</a>
            <div class="dropdown-content">

                @if (auth()->user()->permission_lvl>=1000)
                <a href="{{route('order.create')}}" style="background-color: #398B93; color:white">Ivesti uzsakyma</a>
                @endif

                @if (auth()->user()->permission_lvl>=10)
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


           </div>
          </li>


        <li class="homebtn">
            <a href="{{route('welcome')}}" class="active">I pradzia</a>
        </li>

        <div class="show">
            <li>
                @if (auth()->user()->permission_lvl>=1000)
                <a href="{{route('order.create')}}" class="create " >Ivesti uzsakyma</a>
              @endif
            </li>
            <li>
                @if (auth()->user()->permission_lvl<=10 || auth()->user()->permission_lvl>=1000)
                <a href="{{route('paper.index')}}">Popierius</a>
                @endif
            </li>
            <li>
                @if(auth()->user()->permission_lvl>=100 )
                <a href="{{route('machine.index')}}">Masinos</a>
                @endif
            </li>
            <li>
                @if (auth()->user()->permission_lvl>=750)
                <a href="{{route('order.index')}}">Uzsakymai</a>
                <a href="{{route('pack.index')}}">Pakavimas</a>
                <a href="{{route('order.archive')}}">Archyvas</a>
                @endif
            </li>
            <li>
                @if(auth()->user()->permission_lvl>=2000 )
                <a href="{{route('user.index')}}">Vartotojai</a>
                @endif
            </li>

        </div>



      </ul>


    @endif
    @endauth
    </nav>


    

    