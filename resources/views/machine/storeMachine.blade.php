<div class="store"><form action="{{route('machine.store')}}" method="post">
    <div class="ivestis">
      <label for="pavadinimas">Pavadinimas:</label><br>
      <input type="text" id="pavadinimas" size="8" name="pavadinimas" value="">
    </div>
    
    <div style="float: left">
      <label for="tipas">Tipas:</label><br>
      <select id="tipas" name="tipas" >
        <option value="vyniokle">Vyniokle</option>
        <option value="spausdinimo">Spausdinimo</option>
      </select>
    </div>

    <div class="btn_ivastis">
      <input  type="submit" value="Submit">
      @csrf
    </div>
  </form>
</div>