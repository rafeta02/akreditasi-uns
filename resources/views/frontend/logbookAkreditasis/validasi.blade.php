@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.logbookAkreditasi.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-LogbookAkreditasi">
                            <thead>
                                <tr>
                                    <th width="10"> 

                                    </th>
                                    <th>
                                        Personal
                                    </th>
                                    <th>
                                        {{ trans('cruds.logbookAkreditasi.fields.uraian') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.logbookAkreditasi.fields.detail') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.logbookAkreditasi.fields.tanggal') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.logbookAkreditasi.fields.jumlah') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.logbookAkreditasi.fields.hasil_pekerjaan') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.logbookAkreditasi.fields.keterangan') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.logbookAkreditasi.fields.valid') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
$(function () {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    
    let validateButton = {
        text: 'Validate Selected',
        className: 'btn-success',
        action: function (e, dt, node, config) {
            var selectedIds = [];
            $('.dt-checkboxes:checked').each(function() {
                selectedIds.push($(this).val());
            });

            if (selectedIds.length === 0) {
                alert('Please select at least one item to validate');
                return;
            }

            if (confirm('Are you sure you want to validate ' + selectedIds.length + ' selected items?')) {
                $.ajax({
                    headers: {'x-csrf-token': _token},
                    url: '{{ route("frontend.logbook-akreditasi.mass-validate") }}',
                    type: 'POST',
                    data: { ids: selectedIds }
                })
                .done(function() {
                    location.reload();
                })
                .fail(function(xhr, status, error) {
                    alert('Error validating items: ' + error);
                });
            }
        }
    }
    dtButtons.push(validateButton)

    let dtOverrideGlobals = {
        buttons: dtButtons,
        processing: true,
        serverSide: true,
        retrieve: true,
        aaSorting: [],
        ajax: "{{ route('frontend.logbook-akreditasi.validasi') }}",
        columns: [
            {
                data: 'placeholder',
                name: 'placeholder',
                orderable: false,
                searchable: false,
                width: '30px',
                class: 'text-center',
                render: function (data, type, row) {
                    return '<input type="checkbox" class="dt-checkboxes" value="' + row.id + '">';
                }
            },
            { data: 'user_name', name: 'user.name', class: 'text-center'  },
            { data: 'tugas', name: 'tugas', class: 'text-center'  },
            { data: 'detail', name: 'detail', class: 'text-center'  },
            { data: 'tanggal', name: 'tanggal', class: 'text-center'  },
            { data: 'jumlah', name: 'jumlah', sortable: false, class: 'text-center' },
            { data: 'hasil_pekerjaan', name: 'hasil_pekerjaan', sortable: false, searchable: false, class: 'text-center'  },
            { data: 'keterangan', name: 'keterangan', sortable: false, class: 'text-center'  },
            { data: 'valid', name: 'valid', sortable: false, searchable: false, class: 'text-center'  },
            { data: 'actions', name: '{{ trans('global.actions') }}', class: 'text-center'  }
        ],
        orderCellsTop: true,
        pageLength: 50,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]], // Page length options
        dom: '<"top"Bl>rt<"bottom"p>' // Only show length menu, buttons, and pagination
    };

    let table = $('.datatable-LogbookAkreditasi').DataTable(dtOverrideGlobals);

    // Add "Select All" checkbox in header
    table.on('draw', function() {
        if (!$('th.select-checkbox').length) {
            $(table.column(0).header()).html('<input type="checkbox" id="select-all">');
        }
    });

    // Handle "Select All" checkbox
    $(document).on('change', '#select-all', function() {
        $('.dt-checkboxes').prop('checked', this.checked);
    });

    // Handle individual checkbox changes
    $(document).on('change', '.dt-checkboxes', function() {
        if (!this.checked) {
            $('#select-all').prop('checked', false);
        } else {
            var allChecked = $('.dt-checkboxes:not(:checked)').length === 0;
            $('#select-all').prop('checked', allChecked);
        }
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});
</script>
@endsection