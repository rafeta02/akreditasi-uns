@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.logbookAkreditasi.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.logbook-akreditasis.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.logbookAkreditasi.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.logbookAkreditasi.fields.uraian') }}</label>
                <select class="form-control {{ $errors->has('uraian') ? 'is-invalid' : '' }}" name="uraian" id="uraian">
                    <option value disabled {{ old('uraian', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\LogbookAkreditasi::URAIAN_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('uraian', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('uraian'))
                    <span class="text-danger">{{ $errors->first('uraian') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.uraian_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="detail">{{ trans('cruds.logbookAkreditasi.fields.detail') }}</label>
                <input class="form-control {{ $errors->has('detail') ? 'is-invalid' : '' }}" type="text" name="detail" id="detail" value="{{ old('detail', '') }}">
                @if($errors->has('detail'))
                    <span class="text-danger">{{ $errors->first('detail') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.detail_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tanggal">{{ trans('cruds.logbookAkreditasi.fields.tanggal') }}</label>
                <input class="form-control date {{ $errors->has('tanggal') ? 'is-invalid' : '' }}" type="text" name="tanggal" id="tanggal" value="{{ old('tanggal') }}">
                @if($errors->has('tanggal'))
                    <span class="text-danger">{{ $errors->first('tanggal') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.tanggal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="jumlah">{{ trans('cruds.logbookAkreditasi.fields.jumlah') }}</label>
                <input class="form-control {{ $errors->has('jumlah') ? 'is-invalid' : '' }}" type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', '') }}" step="1">
                @if($errors->has('jumlah'))
                    <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.jumlah_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="satuan">{{ trans('cruds.logbookAkreditasi.fields.satuan') }}</label>
                <input class="form-control {{ $errors->has('satuan') ? 'is-invalid' : '' }}" type="text" name="satuan" id="satuan" value="{{ old('satuan', '') }}">
                @if($errors->has('satuan'))
                    <span class="text-danger">{{ $errors->first('satuan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.satuan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hasil_pekerjaan">{{ trans('cruds.logbookAkreditasi.fields.hasil_pekerjaan') }}</label>
                <div class="needsclick dropzone {{ $errors->has('hasil_pekerjaan') ? 'is-invalid' : '' }}" id="hasil_pekerjaan-dropzone">
                </div>
                @if($errors->has('hasil_pekerjaan'))
                    <span class="text-danger">{{ $errors->first('hasil_pekerjaan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.logbookAkreditasi.fields.hasil_pekerjaan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="keterangan">{{ trans('cruds.logbookAkreditasi.fields.keterangan') }}</label>
                <textarea class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" name="keterangan" id="keterangan">{{ old('keterangan') }}</textarea>
                @if($errors->has('keterangan'))
                    <span class="text-danger">{{ $errors->first('keterangan') }}</span>
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



@endsection

@section('scripts')
<script>
    var uploadedHasilPekerjaanMap = {}
Dropzone.options.hasilPekerjaanDropzone = {
    url: '{{ route('admin.logbook-akreditasis.storeMedia') }}',
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