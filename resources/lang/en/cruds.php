<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'username'                 => 'Username',
            'username_helper'          => ' ',
            'no_hp'                    => 'No Handphone',
            'no_hp_helper'             => ' ',
            'level'                    => 'Level',
            'level_helper'             => ' ',
            'identity_number'          => 'Identity Number',
            'identity_number_helper'   => ' ',
            'alamat'                   => 'Alamat',
            'alamat_helper'            => ' ',
        ],
    ],
    'auditLog' => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'masterAkreditasi' => [
        'title'          => 'Master Akreditasi',
        'title_singular' => 'Master Akreditasi',
    ],
    'jenjang' => [
        'title'          => 'Jenjang',
        'title_singular' => 'Jenjang',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'code'               => 'Code',
            'code_helper'        => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'lembagaAkreditasi' => [
        'title'          => 'Lembaga Akreditasi',
        'title_singular' => 'Lembaga Akreditasi',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'code'               => 'Code',
            'code_helper'        => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'type'               => 'Type',
            'type_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'prodi' => [
        'title'          => 'Program Studi',
        'title_singular' => 'Program Studi',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'code'                   => 'Code',
            'code_helper'            => ' ',
            'jenjang'                => 'Jenjang',
            'jenjang_helper'         => ' ',
            'code_siakad'            => 'Code Siakad',
            'code_siakad_helper'     => ' ',
            'nim'                    => 'NIM',
            'nim_helper'             => ' ',
            'name_dikti'             => 'Name (PDDikti)',
            'name_dikti_helper'      => ' ',
            'name_akreditasi'        => 'Name (BANPT/LAMPT)',
            'name_akreditasi_helper' => ' ',
            'name_en'                => 'Name (English)',
            'name_en_helper'         => ' ',
            'gelar'                  => 'Gelar',
            'gelar_helper'           => ' ',
            'tanggal_berdiri'        => 'Tanggal Berdiri',
            'tanggal_berdiri_helper' => ' ',
            'sk_izin'                => 'No. SK Izin Prodi',
            'sk_izin_helper'         => ' ',
            'tgl_sk_izin'            => 'Tgl.  SK Izin Prodi',
            'tgl_sk_izin_helper'     => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'gelar_en'               => 'Gelar (English)',
            'gelar_en_helper'        => ' ',
            'description'            => 'Description',
            'description_helper'     => ' ',
            'fakultas'               => 'Fakultas',
            'fakultas_helper'        => ' ',
            'status'                 => 'Status',
            'status_helper'          => ' ',
        ],
    ],
    'akreditasi' => [
        'title'          => 'Akreditasi',
        'title_singular' => 'Akreditasi',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'prodi'                 => 'Program Studi',
            'prodi_helper'          => ' ',
            'jenjang'               => 'Jenjang',
            'jenjang_helper'        => ' ',
            'lembaga'               => 'Lembaga Akreditasi',
            'lembaga_helper'        => ' ',
            'no_sk'                 => 'No SK Akreditasi',
            'no_sk_helper'          => ' ',
            'tgl_sk'                => 'Tgl SK Akreditasi',
            'tgl_sk_helper'         => ' ',
            'tgl_akhir_sk'          => 'Tgl Akhir SK Akreditasi',
            'tgl_akhir_sk_helper'   => ' ',
            'tahun_expired'         => 'Tahun Expired SK Akreditasi',
            'tahun_expired_helper'  => ' ',
            'peringkat'             => 'Peringkat',
            'peringkat_helper'      => ' ',
            'sertifikat'            => 'Sertifikat',
            'sertifikat_helper'     => ' ',
            'file_penunjang'        => 'File Penunjang',
            'file_penunjang_helper' => ' ',
            'note'                  => 'Note',
            'note_helper'           => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'nilai'                 => 'Nilai',
            'nilai_helper'          => ' ',
            'fakultas'              => 'Fakultas',
            'fakultas_helper'       => ' ',
            'tgl_awal_sk'           => 'Tgl Awal SK Akreditasi',
            'tgl_awal_sk_helper'    => ' ',
        ],
    ],
    'akreditasiInternasional' => [
        'title'          => 'Akreditasi Internasional',
        'title_singular' => 'Akreditasi Internasional',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'prodi'                 => 'Program Studi',
            'prodi_helper'          => ' ',
            'jenjang'               => 'Jenjang',
            'jenjang_helper'        => ' ',
            'lembaga'               => 'Lembaga Akreditasi',
            'lembaga_helper'        => ' ',
            'no_sk'                 => 'No SK Akreditasi',
            'no_sk_helper'          => ' ',
            'tgl_sk'                => 'Tgl SK Akreditasi',
            'tgl_sk_helper'         => ' ',
            'tgl_akhir_sk'          => 'Tgl Akhir SK Akreditasi',
            'tgl_akhir_sk_helper'   => ' ',
            'tahun_expired'         => 'Tahun Expired SK Akreditasi',
            'tahun_expired_helper'  => ' ',
            'peringkat'             => 'Peringkat',
            'peringkat_helper'      => ' ',
            'nilai'                 => 'Nilai',
            'nilai_helper'          => ' ',
            'diakui_dikti'          => 'Diakui PDDikti',
            'diakui_dikti_helper'   => ' ',
            'sertifikat'            => 'Sertifikat',
            'sertifikat_helper'     => ' ',
            'file_penunjang'        => 'File Penunjang',
            'file_penunjang_helper' => ' ',
            'note'                  => 'Note',
            'note_helper'           => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'fakultas'              => 'Fakultas',
            'fakultas_helper'       => ' ',
            'tgl_awal_sk'           => 'Tgl Awal SK Akreditasi',
            'tgl_awal_sk_helper'    => ' ',
        ],
    ],
    'ajuan' => [
        'title'          => 'Ajuan Akreditasi',
        'title_singular' => 'Ajuan Akreditasi',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'fakultas'            => 'Fakultas',
            'fakultas_helper'     => ' ',
            'prodi'               => 'Program Studi',
            'prodi_helper'        => ' ',
            'jenjang'             => 'Jenjang',
            'jenjang_helper'      => ' ',
            'lembaga'             => 'Lembaga Akreditasi',
            'lembaga_helper'      => ' ',
            'tgl_ajuan'           => 'Tanggal Pengajuan',
            'tgl_ajuan_helper'    => ' ',
            'tgl_diterima'        => 'Tanggal Diterima',
            'tgl_diterima_helper' => ' ',
            'status_ajuan'        => 'Status Ajuan',
            'status_ajuan_helper' => ' ',
            'bukti_upload'        => 'Bukti Upload',
            'bukti_upload_helper' => ' ',
            'note'                => 'Note',
            'note_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],
    'faculty' => [
        'title'          => 'Faculty',
        'title_singular' => 'Faculty',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'code'               => 'Code',
            'code_helper'        => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],

];
