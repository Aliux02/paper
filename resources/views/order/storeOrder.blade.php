<div class="store" id="store" style="display: none" >
    <form style="padding: 10px" action="{{route('order.store')}}" method="post" enctype="multipart/form-data">
    <div class="ivestis">
        <label for="uzsakovas">Uzsakovas:</label><br>
        <input type="text"  size="8" name="uzsakovas" value="{{ old('uzsakovas') }}">
    </div>
    <div class="ivestis">
        <label for="pavadinimas">Pavadinimas:</label><br>
        <input type="text"  size="8" name="pavadinimas" value="{{old('pavadinimas')}}">
    </div>
    <div class="ivestis">
        <label for="ilgis">Ilgis:</label><br>
        <input type="text"  size="8" name="ilgis" value="{{old('ilgis')}}"><br><br>
    </div>
    <div class="ivestis">
        <label for="plotis">Plotis:</label><br>
        <input type="text"  size="8" name="plotis" value="{{old('plotis')}}">
    </div>
    <div class="ivestis">
        <label for="medziaga">Medziaga:</label><br>
        <input type="text"  size="8" name="medziaga" value="{{old('medziaga')}}"><br><br>
    </div>
    <div class="ivestis">
        <label for="klijai">Klijai:</label><br>
        <input type="text"  size="8" name="klijai" value="{{old('klijai')}}"><br><br>
    </div>
    <div class="ivestis">
        <label for="eiles">eiles:</label><br>
        <input type="text"  size="8" name="eiles" value="{{old('eiles')}}"><br><br>
    </div>
    <div class="ivestis">
        <label for="spalva">Spalva:</label><br>
        <input type="text"  size="8" name="spalva" value="{{old('spalva')}}"><br><br>
    </div>
    <div class="ivestis">
        <label for="kiekis">Kiekis:</label><br>
        <input type="text"  size="8" name="kiekis" value="{{old('kiekis')}}"><br><br>
    </div>
    <div class="ivestis">
        <label for="velenas">Velenas:</label><br>
        <input type="text"  size="8" name="velenas" value="{{old('velenas')}}"><br><br>
    </div>
    
    
    <div class="ivestis">
        <label for="pabaigimas">Pagaminimo data:</label><br>
        <input type="date" name="pabaigimas" value="{{old('pabaigimas')}}"><br><br>
    </div>
    
    
    <div class="ivestis" >
        <label>Prideti maketa</label><br>
        <input type="file" name="maketas"><br><br>
    </div>
    
    <div class="ivestis" style="height: auto">
        <label>Pastabos</label><br>
        <textarea name="pastabos" id="" cols="60" rows="2"></textarea>
    </div>

    <div class="btn_ivastis">
        <input  type="submit" value="Submit">
    </div>
    @csrf
    </form>
</div>