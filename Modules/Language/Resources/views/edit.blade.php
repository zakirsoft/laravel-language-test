@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1>{{ __('Edit Language') }}</h1>
                    <a href="{{ route('language.index') }}" class="btn btn-info">{{ __('back') }}</a>
                </div>

                <div class="card-body">

                    @if (session()->has('msg'))
                        <div class="alert alert-info">{{ session()->get('msg'); }}</div>
                    @endif

                    <form action="{{ route('language.update', $language->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name" class="form-label">{{ __('language') }} {{ __('name') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="name" class="form-control @error('name') is-invalid @enderror">
                                        <option value="" selected disabled> {{ __('selectlanguage') }}</option>

                                        @foreach ($translations as $key => $country)
                                            <option {{ $country['name'] == $language->name ? 'selected': '' }} value="{{ $country['name'] }}"> {{ $country['name'] }}</option>
                                        @endforeach
                                    </select>

                                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="code" class="form-label">{{ __('language') }} {{ __('code') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="code" class="form-control @error('code') is-invalid @enderror">
                                        <option value="" selected disabled> {{ __('language') }} {{ __('code') }}</option>

                                        @foreach ($translations as $key => $country)
                                            <option {{ $country['name'] == $language->name ? 'selected': '' }} value="{{ $key }}"> {{ $key }}</option>
                                        @endforeach
                                      </select>
                                      @error('code') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
