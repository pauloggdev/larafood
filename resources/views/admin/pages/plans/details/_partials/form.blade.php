@csrf
<div class="form-group">
    <label for="name">Nome: </label>
    <input type="text" name="name" value="{{$detail->name?? ''}}"  class="form-control" placeholder="Nome: ">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>