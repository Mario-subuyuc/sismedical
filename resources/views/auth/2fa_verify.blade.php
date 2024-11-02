@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verificación de dos factores (2FA)</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif


                
                    <form method="POST" action="{{ route('valido') }}">
                        @csrf
                        <div class="form-group">
                            <label for="code">Código de verificación:</label>
                            <input type="text" name="code" class="form-control" required autofocus>
                        </div>
                        <button type="submit" class="btn btn-primary">Verificar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
