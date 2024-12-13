@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card bg-white">
            <div class="card-body">
                <div class="mb-3">
                    <a href="{{ route('exports.visitor') }}" class="btn btn-success">Export Visitor</a>
                </div>

                <p>Total Row: {{ number_format($visitors->total()) }}</p>

                <div class="table-responsive">
                    <x-table.visitors :visitors="$visitors" />
                </div>
                {{ $visitors->links() }}
            </div>
        </div>
    </div>
@endsection
