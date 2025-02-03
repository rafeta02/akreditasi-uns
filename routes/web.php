<?php

// Route::redirect('/', '/login');
Route::get('/', 'HomeController@index')->name("home");
Route::get('/home', function () {
    return redirect()->route('home');
});
Route::get('/fakultas', 'HomeController@fakultas')->name("fakultas");
Route::get('/universitas', 'HomeController@universitas')->name("universitas");
Route::get('/prodi', 'HomeController@prodi')->name("prodi");
Route::get('/prodi/{slug}', 'HomeController@detailProdi')->name("detail-prodi");
Route::get('/akreditasi-nasional', 'HomeController@akreditasiNasional')->name("akreditasiNasional");
Route::get('/akreditasi-internasional', 'HomeController@akreditasiInternasional')->name("akreditasiInternasional");
Route::get('/infografis', 'HomeController@infografis')->name("infografis");
Route::get('/pantauan-banpt', 'HomeController@pantauanBanpt')->name("pantauanBanpt");

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

    // Faculty
    Route::delete('faculties/destroy', 'FacultyController@massDestroy')->name('faculties.massDestroy');
    Route::post('faculties/parse-csv-import', 'FacultyController@parseCsvImport')->name('faculties.parseCsvImport');
    Route::post('faculties/process-csv-import', 'FacultyController@processCsvImport')->name('faculties.processCsvImport');
    Route::resource('faculties', 'FacultyController'); 

    // Jenjang
    Route::delete('jenjangs/destroy', 'JenjangController@massDestroy')->name('jenjangs.massDestroy');
    Route::post('jenjangs/parse-csv-import', 'JenjangController@parseCsvImport')->name('jenjangs.parseCsvImport');
    Route::post('jenjangs/process-csv-import', 'JenjangController@processCsvImport')->name('jenjangs.processCsvImport');
    Route::resource('jenjangs', 'JenjangController');

    // Prodi
    Route::delete('prodis/destroy', 'ProdiController@massDestroy')->name('prodis.massDestroy');
    Route::post('prodis/media', 'ProdiController@storeMedia')->name('prodis.storeMedia');
    Route::post('prodis/ckmedia', 'ProdiController@storeCKEditorImages')->name('prodis.storeCKEditorImages');
    Route::post('prodis/parse-csv-import', 'ProdiController@parseCsvImport')->name('prodis.parseCsvImport');
    Route::post('prodis/process-csv-import', 'ProdiController@processCsvImport')->name('prodis.processCsvImport');
    Route::post('prodis/import', 'ProdiController@import')->name('prodis.import');
    Route::get('prodis/{prodi}/upload-sertifikat', 'ProdiController@uploadSertifikat')->name('prodis.uploadSertifikat');
    Route::resource('prodis', 'ProdiController');

    // Lembaga Akreditasi
    Route::delete('lembaga-akreditasis/destroy', 'LembagaAkreditasiController@massDestroy')->name('lembaga-akreditasis.massDestroy');
    Route::post('lembaga-akreditasis/parse-csv-import', 'LembagaAkreditasiController@parseCsvImport')->name('lembaga-akreditasis.parseCsvImport');
    Route::post('lembaga-akreditasis/process-csv-import', 'LembagaAkreditasiController@processCsvImport')->name('lembaga-akreditasis.processCsvImport');
    Route::resource('lembaga-akreditasis', 'LembagaAkreditasiController');

    // Akreditasi
    Route::delete('akreditasis/destroy', 'AkreditasiController@massDestroy')->name('akreditasis.massDestroy');
    Route::post('akreditasis/media', 'AkreditasiController@storeMedia')->name('akreditasis.storeMedia');
    Route::post('akreditasis/ckmedia', 'AkreditasiController@storeCKEditorImages')->name('akreditasis.storeCKEditorImages');
    Route::post('akreditasis/parse-csv-import', 'AkreditasiController@parseCsvImport')->name('akreditasis.parseCsvImport');
    Route::post('akreditasis/process-csv-import', 'AkreditasiController@processCsvImport')->name('akreditasis.processCsvImport');
    Route::post('akreditasis/import', 'AkreditasiController@import')->name('akreditasis.import');
    Route::get('akreditasis/{akreditasi}/upload-sertifikat', 'AkreditasiController@uploadSertifikat')->name('akreditasis.uploadSertifikat');
    Route::resource('akreditasis', 'AkreditasiController');

    // Akreditasi Internasional
    Route::delete('akreditasi-internasionals/destroy', 'AkreditasiInternasionalController@massDestroy')->name('akreditasi-internasionals.massDestroy');
    Route::post('akreditasi-internasionals/media', 'AkreditasiInternasionalController@storeMedia')->name('akreditasi-internasionals.storeMedia');
    Route::post('akreditasi-internasionals/ckmedia', 'AkreditasiInternasionalController@storeCKEditorImages')->name('akreditasi-internasionals.storeCKEditorImages');
    Route::post('akreditasi-internasionals/parse-csv-import', 'AkreditasiInternasionalController@parseCsvImport')->name('akreditasi-internasionals.parseCsvImport');
    Route::post('akreditasi-internasionals/process-csv-import', 'AkreditasiInternasionalController@processCsvImport')->name('akreditasi-internasionals.processCsvImport');
    Route::post('akreditasi-internasionals/import', 'AkreditasiInternasionalController@import')->name('akreditasi-internasionals.import');
    Route::get('akreditasi-internasionals/{akreditasiInternasional}/upload-sertifikat', 'AkreditasiInternasionalController@uploadSertifikat')->name('akreditasi-internasionals.uploadSertifikat');
    Route::resource('akreditasi-internasionals', 'AkreditasiInternasionalController');

    // Ajuan
    Route::delete('ajuans/destroy', 'AjuanController@massDestroy')->name('ajuans.massDestroy');
    Route::post('ajuans/media', 'AjuanController@storeMedia')->name('ajuans.storeMedia');
    Route::post('ajuans/ckmedia', 'AjuanController@storeCKEditorImages')->name('ajuans.storeCKEditorImages');
    Route::post('ajuans/parse-csv-import', 'AjuanController@parseCsvImport')->name('ajuans.parseCsvImport');
    Route::post('ajuans/process-csv-import', 'AjuanController@processCsvImport')->name('ajuans.processCsvImport');
    Route::resource('ajuans', 'AjuanController');

    // Dokumen Akreditasi
    Route::delete('dokumen-akreditasis/destroy', 'DokumenAkreditasiController@massDestroy')->name('dokumen-akreditasis.massDestroy');
    Route::post('dokumen-akreditasis/media', 'DokumenAkreditasiController@storeMedia')->name('dokumen-akreditasis.storeMedia');
    Route::post('dokumen-akreditasis/ckmedia', 'DokumenAkreditasiController@storeCKEditorImages')->name('dokumen-akreditasis.storeCKEditorImages');
    Route::resource('dokumen-akreditasis', 'DokumenAkreditasiController');

    // Document
    Route::delete('documents/destroy', 'DocumentController@massDestroy')->name('documents.massDestroy');
    Route::post('documents/media', 'DocumentController@storeMedia')->name('documents.storeMedia');
    Route::post('documents/ckmedia', 'DocumentController@storeCKEditorImages')->name('documents.storeCKEditorImages');
    Route::resource('documents', 'DocumentController');

    // Logbook Akreditasi
    Route::delete('logbook-akreditasis/destroy', 'LogbookAkreditasiController@massDestroy')->name('logbook-akreditasis.massDestroy');
    Route::post('logbook-akreditasis/media', 'LogbookAkreditasiController@storeMedia')->name('logbook-akreditasis.storeMedia');
    Route::post('logbook-akreditasis/ckmedia', 'LogbookAkreditasiController@storeCKEditorImages')->name('logbook-akreditasis.storeCKEditorImages');
    Route::post('logbook-akreditasis/parse-csv-import', 'LogbookAkreditasiController@parseCsvImport')->name('logbook-akreditasis.parseCsvImport');
    Route::post('logbook-akreditasis/process-csv-import', 'LogbookAkreditasiController@processCsvImport')->name('logbook-akreditasis.processCsvImport');
    Route::resource('logbook-akreditasis', 'LogbookAkreditasiController');                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             

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

Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Ajuan
    Route::delete('ajuan-akreditasi/destroy', 'AjuanController@massDestroy')->name('ajuan-akreditasi.massDestroy');
    Route::post('ajuan-akreditasi/media', 'AjuanController@storeMedia')->name('ajuan-akreditasi.storeMedia');
    Route::post('ajuan-akreditasi/ckmedia', 'AjuanController@storeCKEditorImages')->name('ajuan-akreditasi.storeCKEditorImages');
    Route::post('ajuan-akreditasi/parse-csv-import', 'AjuanController@parseCsvImport')->name('ajuan-akreditasi.parseCsvImport');
    Route::post('ajuan-akreditasi/process-csv-import', 'AjuanController@processCsvImport')->name('ajuan-akreditasi.processCsvImport');
    Route::resource('ajuan-akreditasi', 'AjuanController');

    // Dokumen Akreditasi
    Route::delete('dokumen-akreditasis/destroy', 'DokumenAkreditasiController@massDestroy')->name('dokumen-akreditasis.massDestroy');
    Route::post('dokumen-akreditasis/media', 'DokumenAkreditasiController@storeMedia')->name('dokumen-akreditasis.storeMedia');
    Route::post('dokumen-akreditasis/ckmedia', 'DokumenAkreditasiController@storeCKEditorImages')->name('dokumen-akreditasis.storeCKEditorImages');
    Route::resource('dokumen-akreditasis', 'DokumenAkreditasiController');

    // Logbook Akreditasi
    Route::delete('logbook-akreditasi/destroy', 'LogbookAkreditasiController@massDestroy')->name('logbook-akreditasi.massDestroy');
    Route::post('logbook-akreditasi/media', 'LogbookAkreditasiController@storeMedia')->name('logbook-akreditasi.storeMedia');
    Route::post('logbook-akreditasi/ckmedia', 'LogbookAkreditasiController@storeCKEditorImages')->name('logbook-akreditasi.storeCKEditorImages');
    Route::resource('logbook-akreditasi', 'LogbookAkreditasiController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
