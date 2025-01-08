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
                <label for="file_sk_pendirian">{{ trans('cruds.prodi.fields.file_sk_pendirian') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file_sk_pendirian') ? 'is-invalid' : '' }}" id="file_sk_pendirian-dropzone">
                </div>
                @if($errors->has('file_sk_pendirian'))
                    <span class="text-danger">{{ $errors->first('file_sk_pendirian') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prodi.fields.file_sk_pendirian_helper') }}</span>
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
    var uploadedFileSkPendirianMap = {}
Dropzone.options.fileSkPendirianDropzone = {
    url: '{{ route('admin.prodis.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="file_sk_pendirian[]" value="' + response.name + '">')
      uploadedFileSkPendirianMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFileSkPendirianMap[file.name]
      }
      $('form').find('input[name="file_sk_pendirian[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($prodi) && $prodi->file_sk_pendirian)
          var files =
            {!! json_encode($prodi->file_sk_pendirian) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="file_sk_pendirian[]" value="' + file.file_name + '">')
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