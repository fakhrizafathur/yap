@extends('layouts.app')

@section('title', 'Edit Person')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <i class="bi bi-pencil-square" style="font-size: 2rem; color: #667eea;"></i>
                        <h3 class="card-title mt-2">Edit Person</h3>
                        <p class="text-muted mb-0">Update person details and information</p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('persons.update', $person) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">NIK</label>
                            <input type="text" name="nik" value="{{ old('nik', $person->nik) }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" value="{{ old('nama', $person->nama) }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Provinsi</label>
                            <select name="provinsi_id" class="form-select">
                                <option value="">-- choose --</option>
                                @foreach($provinsis as $prov)
                                    <option value="{{ $prov->id }}" {{ old('provinsi_id', $person->provinsi_id) == $prov->id ? 'selected' : '' }}>{{ $prov->nama_provinsi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="bi bi-arrow-repeat me-2"></i>Update Person</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
