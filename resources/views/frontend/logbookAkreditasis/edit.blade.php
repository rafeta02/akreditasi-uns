@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.logbookAkreditasi.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.logbook-akreditasis.update", [$logbookAkreditasi->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="user_id">{{ trans('cruds.logbookAkreditasi.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id">
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $logbookAkreditasi->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.logbookAkreditasi.fields.uraian') }}</label>
                            <select class="form-control" name="uraian" id="uraian">
                                <option value disabled {{ old('uraian', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\LogbookAkreditasi::URAIAN_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('uraian', $logbookAkreditasi->uraian) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('uraian'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('uraian') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.uraian_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="detail">{{ trans('cruds.logbookAkreditasi.fields.detail') }}</label>
                            <input class="form-control" type="text" name="detail" id="detail" value="{{ old('detail', $logbookAkreditasi->detail) }}">
                            @if($errors->has('detail'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('detail') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.detail_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">{{ trans('cruds.logbookAkreditasi.fields.tanggal') }}</label>
                            <input class="form-control date" type="text" name="tanggal" id="tanggal" value="{{ old('tanggal', $logbookAkreditasi->tanggal) }}">
                            @if($errors->has('tanggal'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tanggal') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.tanggal_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">{{ trans('cruds.logbookAkreditasi.fields.jumlah') }}</label>
                            <input class="form-control" type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $logbookAkreditasi->jumlah) }}" step="1">
                            @if($errors->has('jumlah'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('jumlah') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.jumlah_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="satuan">{{ trans('cruds.logbookAkreditasi.fields.satuan') }}</label>
                            <input class="form-control" type="text" name="satuan" id="satuan" value="{{ old('satuan', $logbookAkreditasi->satuan) }}">
                            @if($errors->has('satuan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('satuan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.satuan_helper') }}</span>
                        </div>
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
                        <div class="form-group">
                            <label for="keterangan">{{ trans('cruds.logbookAkreditasi.fields.keterangan') }}</label>
                            <textarea class="form-control" name="keterangan" id="keterangan">{{ old('keterangan', $logbookAkreditasi->keterangan) }}</textarea>
                            @if($errors->has('keterangan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('keterangan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.keterangan_helper') }}</span>
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
    url: '{{ route('frontend.logbook-akreditasis.storeMedia') }}',
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
@endsection