@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.prodi.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.prodis.update", [$prodi->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="code">{{ trans('cruds.prodi.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', $prodi->code) }}" required>
                @if($errors->has('code'))
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prodi.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="fakultas_id">{{ trans('cruds.prodi.fields.fakultas') }}</label>
                <select class="form-control select2 {{ $errors->has('fakultas') ? 'is-invalid' : '' }}" name="fakultas_id" id="fakultas_id" required>
                    @foreach($fakultas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('fakultas_id') ? old('fakultas_id') : $prodi->fakultas->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('fakultas'))
                    <span class="text-danger">{{ $errors->first('fakultas') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prodi.fields.fakultas_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="jenjang_id">{{ trans('cruds.prodi.fields.jenjang') }}</label>
                <select class="form-control select2 {{ $errors->has('jenjang') ? 'is-invalid' : '' }}" name="jenjang_id" id="jenjang_id" required>
                    @foreach($jenjangs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('jenjang_id') ? old('jenjang_id') : $prodi->jenjang->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('jenjang'))
                    <span class="text-danger">{{ $errors->first('jenjang') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prodi.fields.jenjang_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="code_siakad">{{ trans('cruds.prodi.fields.code_siakad') }}</label>
                <input class="form-control {{ $errors->has('code_siakad') ? 'is-invalid' : '' }}" type="text" name="code_siakad" id="code_siakad" value="{{ old('code_siakad', $prodi->code_siakad) }}">
                @if($errors->has('code_siakad'))
                    <span class="text-danger">{{ $errors->first('code_siakad') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prodi.fields.code_siakad_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nim">{{ trans('cruds.prodi.fields.nim') }}</label>
                <input class="form-control {{ $errors->has('nim') ? 'is-invalid' : '' }}" type="text" name="nim" id="nim" value="{{ old('nim', $prodi->nim) }}">
                @if($errors->has('nim'))
                    <span class="text-danger">{{ $errors->first('nim') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prodi.fields.nim_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name_dikti">{{ trans('cruds.prodi.fields.name_dikti') }}</label>
                <input class="form-control {{ $errors->has('name_dikti') ? 'is-invalid' : '' }}" type="text" name="name_dikti" id="name_dikti" value="{{ old('name_dikti', $prodi->name_dikti) }}">
                @if($errors->has('name_dikti'))
                    <span class="text-danger">{{ $errors->first('name_dikti') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prodi.fields.name_dikti_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name_akreditasi">{{ trans('cruds.prodi.fields.name_akreditasi') }}</label>
                <input class="form-control {{ $errors->has('name_akreditasi') ? 'is-invalid' : '' }}" type="text" name="name_akreditasi" id="name_akreditasi" value="{{ old('name_akreditasi', $prodi->name_akreditasi) }}">
                @if($errors->has('name_akreditasi'))
                    <span class="text-danger">{{ $errors->first('name_akreditasi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prodi.fields.name_akreditasi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name_en">{{ trans('cruds.prodi.fields.name_en') }}</label>
                <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en" id="name_en" value="{{ old('name_en', $prodi->name_en) }}">
                @if($errors->has('name_en'))
                    <span class="text-danger">{{ $errors->first('name_en') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prodi.fields.name_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gelar">{{ trans('cruds.prodi.fields.gelar') }}</label>
                <input class="form-control {{ $errors->has('gelar') ? 'is-invalid' : '' }}" type="text" name="gelar" id="gelar" value="{{ old('gelar', $prodi->gelar) }}">
                @if($errors->has('gelar'))
                    <span class="text-danger">{{ $errors->first('gelar') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prodi.fields.gelar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gelar_en">{{ trans('cruds.prodi.fields.gelar_en') }}</label>
                <input class="form-control {{ $errors->has('gelar_en') ? 'is-invalid' : '' }}" type="text" name="gelar_en" id="gelar_en" value="{{ old('gelar_en', $prodi->gelar_en) }}">
                @if($errors->has('gelar_en'))
                    <span class="text-danger">{{ $errors->first('gelar_en') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prodi.fields.gelar_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tanggal_berdiri">{{ trans('cruds.prodi.fields.tanggal_berdiri') }}</label>
                <input class="form-control date {{ $errors->has('tanggal_berdiri') ? 'is-invalid' : '' }}" type="text" name="tanggal_berdiri" id="tanggal_berdiri" value="{{ old('tanggal_berdiri', $prodi->tanggal_berdiri) }}">
                @if($errors->has('tanggal_berdiri'))
                    <span class="text-danger">{{ $errors->first('tanggal_berdiri') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prodi.fields.tanggal_berdiri_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sk_izin">{{ trans('cruds.prodi.fields.sk_izin') }}</label>
                <input class="form-control {{ $errors->has('sk_izin') ? 'is-invalid' : '' }}" type="text" name="sk_izin" id="sk_izin" value="{{ old('sk_izin', $prodi->sk_izin) }}">
                @if($errors->has('sk_izin'))
                    <span class="text-danger">{{ $errors->first('sk_izin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prodi.fields.sk_izin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tgl_sk_izin">{{ trans('cruds.prodi.fields.tgl_sk_izin') }}</label>
                <input class="form-control date {{ $errors->has('tgl_sk_izin') ? 'is-invalid' : '' }}" type="text" name="tgl_sk_izin" id="tgl_sk_izin" value="{{ old('tgl_sk_izin', $prodi->tgl_sk_izin) }}">
                @if($errors->has('tgl_sk_izin'))
                    <span class="text-danger">{{ $errors->first('tgl_sk_izin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prodi.fields.tgl_sk_izin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.prodi.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $prodi->description) }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prodi.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="status" value="0">
                    <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ $prodi->status || old('status', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">{{ trans('cruds.prodi.fields.status') }}</label>
                </div>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prodi.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection