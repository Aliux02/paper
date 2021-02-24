@if ($errors->any())
    <div class="alert">
      <ul class="list-group">
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
      </ul>
    </div>
    @endif

    @if (session()->has('success_message'))
    <ul class="alert alert-success">
      <li>{{session()->get('success_message')}}</li>
    </ul>
    @endif

    @if (session()->has('info_message'))
    <ul class="alert alert-success">
      <li>{{session()->get('info_message')}}</li>
    </ul>
@endif