@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1>{{ __('addlanguage') }}</h1>
                    <a href="{{ route('language.index') }}" class="btn btn-info">{{ __('back') }}</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('language.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="name" class="form-label">{{ __('language') }} {{ __('name') }}</label>
                          <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                          <label for="code" class="form-label">{{ __('language') }} {{ __('code') }}</label>
                          <input type="text" class="form-control" id="code" name="code">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
