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
                            <div class="col-12">
                                <button type="button" class="btn btn-primary" onclick="addFileUpload()">Add Document</button>
                            </div>
                        </div>
                        
                        <div id="dokumen-container">
                            <div class="dokumen-row mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="nama_dokumen[]" placeholder="Document Name">
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control" name="tipe_dokumen[]">
                                            <option value="">Select Type</option>
                                            <option value="type1">Type 1</option>
                                            <option value="type2">Type 2</option>
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
                        
                        
                        
                        {{-- <div class="form-group">
                            <label for="tgl_ajuan">{{ trans('cruds.ajuan.fields.tgl_ajuan') }}</label>
                            <input class="form-control date" type="text" name="tgl_ajuan" id="tgl_ajuan" value="{{ old('tgl_ajuan') }}">
                            @if($errors->has('tgl_ajuan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tgl_ajuan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ajuan.fields.tgl_ajuan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tgl_diterima">{{ trans('cruds.ajuan.fields.tgl_diterima') }}</label>
                            <input class="form-control date" type="text" name="tgl_diterima" id="tgl_diterima" value="{{ old('tgl_diterima') }}">
                            @if($errors->has('tgl_diterima'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tgl_diterima') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ajuan.fields.tgl_diterima_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="asesors">{{ trans('cruds.ajuan.fields.asesor') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="asesors[]" id="asesors" multiple>
                                @foreach($asesors as $id => $asesor)
                                    <option value="{{ $id }}" {{ in_array($id, old('asesors', [])) ? 'selected' : '' }}>{{ $asesor }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('asesors'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('asesors') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ajuan.fields.asesor_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.ajuan.fields.status_ajuan') }}</label>
                            <select class="form-control" name="status_ajuan" id="status_ajuan">
                                <option value disabled {{ old('status_ajuan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Ajuan::STATUS_AJUAN_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status_ajuan', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status_ajuan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status_ajuan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ajuan.fields.status_ajuan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="surat_tugas">{{ trans('cruds.ajuan.fields.surat_tugas') }}</label>
                            <div class="needsclick dropzone" id="surat_tugas-dropzone">
                            </div>
                            @if($errors->has('surat_tugas'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('surat_tugas') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ajuan.fields.surat_tugas_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="surat_pernyataan">{{ trans('cruds.ajuan.fields.surat_pernyataan') }}</label>
                            <div class="needsclick dropzone" id="surat_pernyataan-dropzone">
                            </div>
                            @if($errors->has('surat_pernyataan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('surat_pernyataan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ajuan.fields.surat_pernyataan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="bukti_upload">{{ trans('cruds.ajuan.fields.bukti_upload') }}</label>
                            <div class="needsclick dropzone" id="bukti_upload-dropzone">
                            </div>
                            @if($errors->has('bukti_upload'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bukti_upload') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ajuan.fields.bukti_upload_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="diajukan_by_id">{{ trans('cruds.ajuan.fields.diajukan_by') }}</label>
                            <select class="form-control select2" name="diajukan_by_id" id="diajukan_by_id">
                                @foreach($diajukan_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ old('diajukan_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('diajukan_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('diajukan_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ajuan.fields.diajukan_by_helper') }}</span>
                        </div> --}}
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
    var uploadedSuratTugasMap = {}
Dropzone.options.suratTugasDropzone = {
    url: '{{ route('frontend.ajuan-akreditasi.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="surat_tugas[]" value="' + response.name + '">')
      uploadedSuratTugasMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedSuratTugasMap[file.name]
      }
      $('form').find('input[name="surat_tugas[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($ajuan) && $ajuan->surat_tugas)
          var files =
            {!! json_encode($ajuan->surat_tugas) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="surat_tugas[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    var uploadedSuratPernyataanMap = {}
Dropzone.options.suratPernyataanDropzone = {
    url: '{{ route('frontend.ajuan-akreditasi.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="surat_pernyataan[]" value="' + response.name + '">')
      uploadedSuratPernyataanMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedSuratPernyataanMap[file.name]
      }
      $('form').find('input[name="surat_pernyataan[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($ajuan) && $ajuan->surat_pernyataan)
          var files =
            {!! json_encode($ajuan->surat_pernyataan) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="surat_pernyataan[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    var uploadedBuktiUploadMap = {}
Dropzone.options.buktiUploadDropzone = {
    url: '{{ route('frontend.ajuan-akreditasi.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 2000,
      height: 2000
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="bukti_upload[]" value="' + response.name + '">')
      uploadedBuktiUploadMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedBuktiUploadMap[file.name]
      }
      $('form').find('input[name="bukti_upload[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($ajuan) && $ajuan->bukti_upload)
      var files = {!! json_encode($ajuan->bukti_upload) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="bukti_upload[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
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
                    <input type="text" class="form-control" name="nama_dokumen[]" placeholder="Document Name">
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="tipe_dokumen[]">
                        <option value="">Select Type</option>
                        <option value="type1">Type 1</option>
                        <option value="type2">Type 2</option>
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