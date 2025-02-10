@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.logbookAkreditasi.title_singular') }}
                </div>

                <div class="card-body">
                    <form class="form-prevent-multiple-submits" method="POST" action="{{ route("frontend.logbook-akreditasi.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label  class="required">{{ trans('cruds.logbookAkreditasi.fields.tugas') }}</label>
                                    <select class="form-control {{ $errors->has('tugas') ? 'is-invalid' : '' }}" name="tugas" id="tugas">
                                        <option value disabled {{ old('tugas', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\LogbookAkreditasi::TUGAS_SELECT as $key => $label)
                                            <option value="{{ $key }}" {{ old('tugas', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('tugas'))
                                        <span class="text-danger">{{ $errors->first('tugas') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.tugas_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="required" for="tanggal">{{ trans('cruds.logbookAkreditasi.fields.tanggal') }}</label>
                                    <input class="form-control date" type="text" name="tanggal" id="tanggal" value="{{ old('tanggal') }}">
                                    @if($errors->has('tanggal'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('tanggal') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.tanggal_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="required" for="uraian_id">{{ trans('cruds.logbookAkreditasi.fields.uraian') }}</label>
                                    <select class="form-control select2 {{ $errors->has('uraian') ? 'is-invalid' : '' }}" name="uraian_id" id="uraian_id">
                                        @foreach($uraians as $id => $entry)
                                            <option value="{{ $id }}" {{ old('uraian_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('uraian'))
                                        <span class="text-danger">{{ $errors->first('uraian') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.uraian_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="required" for="detail">{{ trans('cruds.logbookAkreditasi.fields.detail') }}</label>
                                    <input class="form-control" type="text" name="detail" id="detail" value="{{ old('detail', '') }}">
                                    @if($errors->has('detail'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('detail') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.detail_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="required" for="jumlah">{{ trans('cruds.logbookAkreditasi.fields.jumlah') }}</label>
                                    <input class="form-control" type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', '') }}" step="1">
                                    @if($errors->has('jumlah'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('jumlah') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.jumlah_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="required" for="satuan">{{ trans('cruds.logbookAkreditasi.fields.satuan') }}</label>
                                    <input class="form-control" type="text" name="satuan" id="satuan" value="{{ old('satuan', '') }}">
                                    @if($errors->has('satuan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('satuan') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.satuan_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="hasil_pekerjaan">{{ trans('cruds.logbookAkreditasi.fields.hasil_pekerjaan') }}</label>
                                    <div class="needsclick dropzone" id="hasil_pekerjaan-dropzone">
                                    </div>
                                    @if($errors->has('hasil_pekerjaan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('hasil_pekerjaan') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.hasil_pekerjaan_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="keterangan">{{ trans('cruds.logbookAkreditasi.fields.keterangan') }}</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan">{{ old('keterangan') }}</textarea>
                                    @if($errors->has('keterangan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('keterangan') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.keterangan_helper') }}</span>
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
var uploadedHasilPekerjaanMap = {}
Dropzone.options.hasilPekerjaanDropzone = {
    url: '{{ route('frontend.logbook-akreditasi.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="hasil_pekerjaan[]" value="' + response.name + '">')
      uploadedHasilPekerjaanMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedHasilPekerjaanMap[file.name]
      }
      $('form').find('input[name="hasil_pekerjaan[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($logbookAkreditasi) && $logbookAkreditasi->hasil_pekerjaan)
          var files =
            {!! json_encode($logbookAkreditasi->hasil_pekerjaan) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="hasil_pekerjaan[]" value="' + file.file_name + '">')
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
$(document).ready(function() {
    // Initialize Select2 on both dropdowns
    $('#tugas').select2({
        placeholder: "Please select",
        allowClear: true
    });

    // Initialize Select2 on uraian dropdown with Ajax
    $('#uraian_id').select2({
        placeholder: "Please select uraian",
        allowClear: true,
        ajax: {
            url: '{{route('select.getUraian')}}',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    tugas: $('#tugas').val(),
                    search: params.term
                };
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        minimumInputLength: 0
    });

    // When tugas changes, clear and reset uraian
    $('#tugas').on('change', function() {
        $('#uraian_id').val(null).trigger('change');
    });
});
</script>
@endsection