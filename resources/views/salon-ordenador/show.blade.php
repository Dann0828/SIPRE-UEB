@extends('layouts.app')

@section('template_title')
    {{ $salonOrdenador->name ?? "{{ __('Show') Salon Ordenador" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Salon Ordenador</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('salon-ordenadors.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Salon Id:</strong>
                            {{ $salonOrdenador->salon_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ordenador Id:</strong>
                            {{ $salonOrdenador->ordenador_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
