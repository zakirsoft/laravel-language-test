@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1>{{ __('languagelist') }}</h1>
                    <a href="{{ route('language.create') }}" class="btn btn-info">{{ __('addlanguage') }}</a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>{{ __('language') }} {{ __('name') }}</th>
                            <th>{{ __('language') }} {{ __('code') }}</th>
                            <th>{{ __('actions') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($languages as $key => $language)
                            <tr>
                              <th>{{ $key+1 }}</th>
                              <td>{{ $language->name }}</td>
                              <td>{{ $language->code }}</td>
                              <td>
                                  <a href="{{ route('language.view', $language->code) }}" class="btn btn-secondary">{{ __('settings') }}</a>
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
