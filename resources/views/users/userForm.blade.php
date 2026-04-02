<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name','id' => 'name']) !!}
</div>
<div class="form-group">
    {!! Form::label('email', 'E-mail') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail','id' => 'email']) !!}
</div>
<div class="form-group">
    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password','id' => 'password']) !!}
</div>
<div class="form-group">
    {!! Form::label('password_confirmation', 'Confirmation Password') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmation Password', 'id' => 'password_confirmation']) !!}
</div>
<div class="form-group">
    {!! Form::label('avatar', 'avatar') !!}
    {!! Form::file('avatar', ['class' => 'form-control', 'placeholder' => 'Confirmation Password', 'id' => 'avatar']) !!}
</div>