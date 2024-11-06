<?php

// Route::redirect('/', '/login');
Route::get('/', 'HomeController@index')->name("home");
Route::get('/home', function () {
    return redirect()->route('home');
});
Route::get('/fakultas', 'HomeController@fakultas')->name("fakultas");
Route::get('/prodi', 'HomeController@prodi')->name("prodi");
Route::get('/prodi/detail', 'HomeController@detailProdi')->name("detail-prodi");

Route::get('select/prodi-with-fakultas', 'Admin\ProdiController@getProdisWithFakultas')->name('select.getProdiWithFakultas');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Jenjang
    Route::delete('jenjangs/destroy', 'JenjangController@massDestroy')->name('jenjangs.massDestroy');
    Route::post('jenjangs/parse-csv-import', 'JenjangController@parseCsvImport')->name('jenjangs.parseCsvImport');
    Route::post('jenjangs/process-csv-import', 'JenjangController@processCsvImport')->name('jenjangs.processCsvImport');
    Route::resource('jenjangs', 'JenjangController');

    // Lembaga Akreditasi
    Route::delete('lembaga-akreditasis/destroy', 'LembagaAkreditasiController@massDestroy')->name('lembaga-akreditasis.massDestroy');
    Route::post('lembaga-akreditasis/parse-csv-import', 'LembagaAkreditasiController@parseCsvImport')->name('lembaga-akreditasis.parseCsvImport');
    Route::post('lembaga-akreditasis/process-csv-import', 'LembagaAkreditasiController@processCsvImport')->name('lembaga-akreditasis.processCsvImport');
    Route::resource('lembaga-akreditasis', 'LembagaAkreditasiController');

    // Prodi
    Route::delete('prodis/destroy', 'ProdiController@massDestroy')->name('prodis.massDestroy');
    Route::post('prodis/parse-csv-import', 'ProdiController@parseCsvImport')->name('prodis.parseCsvImport');
    Route::post('prodis/process-csv-import', 'ProdiController@processCsvImport')->name('prodis.processCsvImport');
    Route::post('prodis/import', 'ProdiController@import')->name('prodis.import');
    Route::resource('prodis', 'ProdiController');

    // Akreditasi
    Route::delete('akreditasis/destroy', 'AkreditasiController@massDestroy')->name('akreditasis.massDestroy');
    Route::post('akreditasis/media', 'AkreditasiController@storeMedia')->name('akreditasis.storeMedia');
    Route::post('akreditasis/ckmedia', 'AkreditasiController@storeCKEditorImages')->name('akreditasis.storeCKEditorImages');
    Route::post('akreditasis/parse-csv-import', 'AkreditasiController@parseCsvImport')->name('akreditasis.parseCsvImport');
    Route::post('akreditasis/process-csv-import', 'AkreditasiController@processCsvImport')->name('akreditasis.processCsvImport');
    Route::resource('akreditasis', 'AkreditasiController');

    // Akreditasi Internasional
    Route::delete('akreditasi-internasionals/destroy', 'AkreditasiInternasionalController@massDestroy')->name('akreditasi-internasionals.massDestroy');
    Route::post('akreditasi-internasionals/media', 'AkreditasiInternasionalController@storeMedia')->name('akreditasi-internasionals.storeMedia');
    Route::post('akreditasi-internasionals/ckmedia', 'AkreditasiInternasionalController@storeCKEditorImages')->name('akreditasi-internasionals.storeCKEditorImages');
    Route::post('akreditasi-internasionals/parse-csv-import', 'AkreditasiInternasionalController@parseCsvImport')->name('akreditasi-internasionals.parseCsvImport');
    Route::post('akreditasi-internasionals/process-csv-import', 'AkreditasiInternasionalController@processCsvImport')->name('akreditasi-internasionals.processCsvImport');
    Route::resource('akreditasi-internasionals', 'AkreditasiInternasionalController');

    // Ajuan
    Route::delete('ajuans/destroy', 'AjuanController@massDestroy')->name('ajuans.massDestroy');
    Route::post('ajuans/media', 'AjuanController@storeMedia')->name('ajuans.storeMedia');
    Route::post('ajuans/ckmedia', 'AjuanController@storeCKEditorImages')->name('ajuans.storeCKEditorImages');
    Route::post('ajuans/parse-csv-import', 'AjuanController@parseCsvImport')->name('ajuans.parseCsvImport');
    Route::post('ajuans/process-csv-import', 'AjuanController@processCsvImport')->name('ajuans.processCsvImport');
    Route::resource('ajuans', 'AjuanController');

    // Faculty
    Route::delete('faculties/destroy', 'FacultyController@massDestroy')->name('faculties.massDestroy');
    Route::post('faculties/parse-csv-import', 'FacultyController@parseCsvImport')->name('faculties.parseCsvImport');
    Route::post('faculties/process-csv-import', 'FacultyController@processCsvImport')->name('faculties.processCsvImport');
    Route::resource('faculties', 'FacultyController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
