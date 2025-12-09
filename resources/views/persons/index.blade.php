@extends('layouts.app')

@section('title', 'Dashboard - Persons')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0"><i class="bi bi-people-fill me-2" style="color: #667eea;"></i>Persons Management</h1>
            <p class="text-muted mb-0">Manage and organize person records</p>
        </div>
        <div>
            <a href="{{ route('persons.create') }}" class="btn btn-success"><i class="bi bi-person-plus-fill me-2"></i>Add Person</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search & Filter Card -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('dashboard') }}" class="row g-3">
                <div class="col-md-5">
                    <label class="form-label"><i class="bi bi-search me-2"></i>Search by NIK or Nama</label>
                    <input type="text" name="search" class="form-control" placeholder="Enter NIK or Nama..." value="{{ request('search') }}">
                </div>

                <div class="col-md-5">
                    <label class="form-label"><i class="bi bi-funnel me-2"></i>Filter by Provinsi</label>
                    <select name="provinsi_id" class="form-select">
                        <option value="">-- All Provinces --</option>
                        @foreach($provinsis as $prov)
                            <option value="{{ $prov->id }}" {{ request('provinsi_id') == $prov->id ? 'selected' : '' }}>
                                {{ $prov->nama_provinsi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search me-1"></i>Search</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-clockwise"></i></a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Provinsi</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($people as $key => $p)
                        <tr>
                            <td>{{ $people->firstItem() + $key }}</td>
                            <td>{{ $p->nik }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->provinsi?->nama_provinsi ?? '-' }}</td>
                            <td>
                                <a href="{{ route('persons.edit', $p) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form method="POST" action="{{ route('persons.destroy', $p) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center">No persons found.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $people->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
