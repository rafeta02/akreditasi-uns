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
                                        {{ trans('cruds.logbookAkreditasi.fields.user') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.logbookAkreditasi.fields.uraian') }}
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
    // Add checkbox column configuration
    let dtOverrideGlobals = {
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
                render: function (data, type, row) {
                    return '<input type="checkbox" class="dt-checkboxes" value="' + row.id + '">';
                }
            },
            { data: 'user_name', name: 'user.name' },
            { data: 'tugas', name: 'tugas' },
            { data: 'uraian_name', name: 'uraian.name' },
            { data: 'detail', name: 'detail' },
            { data: 'tanggal', name: 'tanggal' },
            { data: 'jumlah', name: 'jumlah' },
            { data: 'hasil_pekerjaan', name: 'hasil_pekerjaan', sortable: false, searchable: false },
            { data: 'keterangan', name: 'keterangan' },
            { data: 'valid', name: 'valid' },
            { data: 'actions', name: '{{ trans('global.actions') }}' }
        ],
        orderCellsTop: true,
        pageLength: 50,
        dom: 'Bfrtip', // Add buttons to the DOM
        buttons: [
            {
                text: 'Validate Selected',
                className: 'btn btn-success',
                action: function (e, dt, node, config) {
                    validateSelected();
                }
            }
        ],
        select: {
            style: 'multi',
            selector: 'td:first-child input[type="checkbox"]'
        }
    };

    // Initialize DataTable
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

    // Function to handle validation of selected items
    function validateSelected() {
        var selectedIds = [];
        $('.dt-checkboxes:checked').each(function() {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            alert('Please select at least one item to validate');
            return;
        }

        // Show confirmation dialog
        if (confirm('Are you sure you want to validate ' + selectedIds.length + ' selected items?')) {
            // Send AJAX request to validate selected items
            $.ajax({
                url: '{{ route("frontend.logbook-akreditasi.mass-validate") }}',
                type: 'POST',
                data: {
                    ids: selectedIds,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Show success message
                    alert('Successfully validated ' + selectedIds.length + ' items');
                    // Reload the table to reflect changes
                    table.ajax.reload();
                    // Uncheck "Select All" checkbox
                    $('#select-all').prop('checked', false);
                },
                error: function(xhr, status, error) {
                    alert('Error validating items: ' + error);
                }
            });
        }
    }

    // Handle tab changes
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
  
});

</script>
@endsection