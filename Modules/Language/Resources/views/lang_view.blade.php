@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('translation.update') }}" method="POST">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1>{{ $language->name }} {{ __('addtranslationfor') }}</h1>
                        <a href="#" class="btn btn-info">{{  __('back') }}</a>
                    </div>

                    <div class="card-body">
                        @csrf
                        <input type="hidden" name="lang_id" value="{{ $language->id }}">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="45%">{{ __('key') }}</th>
                                    <th width="45%">{{ __('value') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($translations as $key => $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $key }}</td>
                                        <td><input class="form-control" type="text" name="{{ $key }}" value="{{ $value }}"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-block mt-2">{{ __('save') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
