<div class="form-group">
    {!! Form::label('name', 'Nombre de la Categoría') !!}
    {!! Form::text('name', null, [
        'class' => 'form-control',
        'placeholder' => 'Ingrese el nombre de la categoría',
        'required',
        'id' => 'name', // ← IMPORTANTE
    ]) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descripción de la Categoría') !!}
    {!! Form::textarea('description', null, [
        'class' => 'form-control',
        'placeholder' => 'Ingrese la descripción de la categoría',
        'rows' => 4,
        'id' => 'description', // ← IMPORTANTE
    ]) !!}
</div>

<div class="form-group">
    {!! Form::label('family_id', 'Familia') !!}
    {!! Form::select('family_id', $families->pluck('name', 'id'), null, [
        'class' => 'form-control',
        'placeholder' => 'Seleccione una familia',
        'required',
        'id' => 'family_id', // ← IMPORTANTE
    ]) !!}
</div>
