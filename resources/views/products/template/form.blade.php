<div class="form-group">
    {!! Form::label('name', 'Nombre del Producto') !!}
    {!! Form::text('name', $product->name ?? null, [
        'class' => 'form-control',
        'placeholder' => 'Ingrese el nombre del producto',
        'required',
        'id' => 'name', // ← IMPORTANTE
    ]) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descripción del Producto') !!}
    {!! Form::textarea('description', $product->description ?? null, [
        'class' => 'form-control',
        'placeholder' => 'Ingrese la descripción del producto',
        'rows' => 4,
        'id' => 'description', // ← IMPORTANTE
    ]) !!}
</div>

<div class="form-group">
    {!! Form::label('family_id', 'Familia') !!}
    {!! Form::select('family_id', $families->pluck('name', 'id'), $product->family_id ?? null, [
        'class' => 'form-control',
        'placeholder' => 'Seleccione una familia',
        'required',
        'id' => 'family_id', // ← IMPORTANTE
    ]) !!}
</div>


<div class="form-group">
    {!! Form::label('category_id', 'Categoría') !!}
    {!! Form::select('category_id', $categories->pluck('name', 'id'), $product->category_id ?? null, [
        'class' => 'form-control',
        'placeholder' => 'Seleccione una categoría',
        'required',
        'id' => 'category_id', // ← IMPORTANTE
    ]) !!}
</div>



<div class="form-group">
    {!! Form::label('price', 'Precio') !!}
    {!! Form::number('price', $product->price ?? null, [
        'class' => 'form-control',
        'placeholder' => 'Ingrese el precio del producto',
        'required',
        'step' => '0.01',
        'id' => 'price', // ← IMPORTANTE
    ]) !!}
</div>
