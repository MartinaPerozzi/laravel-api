@extends('layouts.app')

@section('content')
    <section class="container">

        @if (session('message_content'))
            <div class="alert alert-{{ session('message_type') ? session('message_type') : 'success' }}">
                {{ session('message_content') }}
            </div>
        @endif

        <h1 class="my-4">Dettaglio - {{ $technology->label }}</h1>

        <div class="d-flex mb-3">
            <a href="{{ route('admin.technologies.index') }}" class="btn btn-primary">
                Torna alla lista
            </a>

            <a href="{{ route('admin.technologies.edit', $technology) }}" class="btn btn-primary ms-3">
                Modifica tipologia
            </a>
        </div>

        <div class="card mb-3 p-4" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <div class="preview-tech" style="background-color: {{ $technology->color }}">
                    </div>
                    {{-- <p class="fw-semibold mt-2">
                        {{ $type->color }}
                    </p> --}}
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <h5 class="card-title">{{ $technology->label }}</h5>
                            </div>
                            <a href="{{ route('admin.technologies.edit', $technology) }}"><i
                                    class="fa-solid fa-pen ms-3"></i></a>
                        </div>
                        <span class="fw-semibold">
                            {{ $technology->color }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
