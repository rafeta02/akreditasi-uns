@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.ajuan.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.ajuan-akreditasi.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="lembaga_id">{{ trans('cruds.ajuan.fields.lembaga') }}</label>
                                    <select class="form-control select2" name="lembaga_id" id="lembaga_id">
                                        @foreach($lembagas as $id => $entry)
                                            <option value="{{ $id }}" {{ old('lembaga_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('lembaga'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('lembaga') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.ajuan.fields.lembaga_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ trans('cruds.ajuan.fields.type_ajuan') }}</label>
                                    <select class="form-control" name="type_ajuan" id="type_ajuan">
                                        <option value disabled {{ old('type_ajuan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\Ajuan::TYPE_AJUAN_SELECT as $key => $label)
                                            <option value="{{ $key }}" {{ old('type_ajuan', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('type_ajuan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('type_ajuan') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.ajuan.fields.type_ajuan_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="note">{{ trans('cruds.ajuan.fields.note') }}</label>
                                    <textarea class="form-control" name="note" id="note">{{ old('note') }}</textarea>
                                    @if($errors->has('note'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('note') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.ajuan.fields.note_helper') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 d-flex justify-content-between align-items-center">
                                <label for="note">Dokumen Ajuan Akreditasi (ISK, LED, DKPS, dll)</label>
                                <button type="button" class="btn btn-success" onclick="addFileUpload()">Add Document</button>
                            </div>
                        </div>
                        
                        <div id="dokumen-container">
                            <div class="dokumen-row mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="nama_dokumen" class="required">Nama Dokumen</label>
                                        <input type="text" class="form-control" name="nama_dokumen[]" placeholder="Document Name">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="tipe_dokumen" class="required">Tipe Dokumen</label>
                                        <select class="form-control" name="tipe_dokumen[]">
                                            @foreach(App\Models\DokumenAkreditasi::TYPE_SELECT as $key => $label)
                                                <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="needsclick dropzone" id="dokumen-dropzone-0"></div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger" onclick="removeFileUpload(this)">X</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let dropzoneCount = 0;
    let uploadedDokumenMap = {};

function initializeDropzone(id) {
    new Dropzone(`#dokumen-dropzone-${id}`, {
        url: '{{ route('frontend.dokumen-akreditasis.storeMedia') }}',
        maxFilesize: 5,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
            $('form').append(`<input type="hidden" name="dokumen[${id}][]" value="${response.name}">`)
            uploadedDokumenMap[file.name] = response.name
        },
        removedfile: function (file) {
            file.previewElement.remove()
            let name = file.file_name || uploadedDokumenMap[file.name]
            $('form').find(`input[name="dokumen[${id}][]"][value="${name}"]`).remove()
        }
    });
}

function addFileUpload() {
    dropzoneCount++;
    let template = `
        <div class="dokumen-row mb-3">
            <div class="row">
                <div class="col-md-4">
                    <label for="nama_dokumen" class="required">Nama Dokumen</label>
                    <input type="text" class="form-control" name="nama_dokumen[]" placeholder="Document Name">
                </div>
                <div class="col-md-3">
                    <label for="tipe_dokumen" class="required">Tipe Dokumen</label>
                    <select class="form-control" name="tipe_dokumen[]">
                        @foreach(App\Models\DokumenAkreditasi::TYPE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="needsclick dropzone" id="dokumen-dropzone-${dropzoneCount}"></div>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger" onclick="removeFileUpload(this)">X</button>
                </div>
            </div>
        </div>`;

    $('#dokumen-container').append(template);
    initializeDropzone(dropzoneCount);
}

function removeFileUpload(button) {
    $(button).closest('.dokumen-row').remove();
}

// Initialize first dropzone
initializeDropzone(0);
</script>
@endsection