@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card bg-white">
                    <div class="card-header bg-white">
                        <h6 class="mb-0">Export Files</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="10">#</th>
                                        <th>Name</th>
                                        <th>Size</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($files as $file)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $file['name'] }}</td>
                                            <td>{{ $file['size'] }}</td>
                                            <td class="{{ $file['is_new'] ? 'bg-success text-white' : '' }}">
                                                {{ $file['created_at_human'] }}</td>
                                            <td>
                                                <a href="{{ $file['url'] }}" class="btn btn-sm btn-primary">
                                                    Download
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No data available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
