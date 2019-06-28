
<div class="form-group">
    {!! Form::label('name', '商品名:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', '商品説明:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('price', '価格:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    在庫:<br>
    <label class="checkbox-inline">
        あり
        {!! Form::radio('available', 1, null) !!}
    </label>
    <br>
    <label class="checkbox-inline">
        なし
        {!! Form::radio('available', 0, null) !!}
    </label>
</div>
<div class="form-group">
      写真：
      {!! Form::file('thefile') !!}
</div>
<div class="form-group">
    {!! Form::submit('更新', ['class' => 'btn btn-primary form-control']) !!}
</div>