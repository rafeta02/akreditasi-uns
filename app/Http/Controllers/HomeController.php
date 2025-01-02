<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Faculty;
use App\Models\Prodi;
use App\Models\Jenjang;
use App\Models\LembagaAkreditasi;
use App\Models\Ajuan;
use App\Models\Akreditasi;
use App\Models\akreditasiInternasional;
use Yajra\DataTables\Facades\DataTables;
use App\Charts\BarChart;
use App\Charts\PieChart;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(PieChart $pie)
    {
        //grafik pie akred nasional
        $title = 'Capaian Peringkat Akreditasi Tahun 2024';
        $subtitle = 'Capaian Peringkat Akreditasi Tahun 2024 Seluruh Universitas Sebelas Maret';
        $data = [47, 84, 22, 16, 22, 3, 8];
        $label = ['Terakreditasi Unggul', 'Terakreditasi A', ' Terakreditasi Baik Sekali', 'Terakreditasi B', 'Terakreditasi Baik', 'Terakreditasi Sementara', 'Belum Terakreditasi'];
        $grafik = $pie->build($title, $subtitle, $data, $label);

        //grafik pie akred internasional
        $internasional = [
            'labels' => ['ASIIN', 'FIBAA', 'AQAS', 'IABEE', 'Belum Terakreditasi'],
            'values' => [14, 5, 11, 5, 167]
        ];

        return view('home', compact('grafik', 'data', 'label', 'internasional'));
    }

    public function fakultas()
    {
        $fakultas = Faculty::all();
        return view('frontend.fakultas', compact('fakultas'));
    }

    public function prodi(Request $request)
    {
        if ($request->ajax()) {
            $query = Prodi::with(['fakultas', 'jenjang'])->select(sprintf('%s.*', (new Prodi)->table));

            if (!empty($request->fakultas)) {
                $query->where('fakultas_id', $request->fakultas);
            }
            if (!empty($request->jenjang)) {
                $query->where('jenjang_id', $request->jenjang);
            }
            // if (!empty($request->nasional)) {
            //     $query->whereHas('akreditasi', $request->nasional);
            // }
            // if (!empty($request->internasional)) {
            //     $query->where('akreditasi_internasional', $request->internasional);
            // }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                return '<a class="btn btn-primary btn-xs" href="'.route('detail-prodi', $row->slug).'">
                                <i class="fas fa-eye"></i>
                            </a>';
            });

            $table->addColumn('nama_prodi', function ($row) {
                return $row->nama_prodi ? $row->nama_prodi : '';
            });
            $table->addColumn('fakultas_name', function ($row) {
                return $row->fakultas ? $row->fakultas->name : '';
            });
            $table->addColumn('jenjang_name', function ($row) {
                return $row->jenjang ? $row->jenjang->name : '';
            });

            $table->editColumn('name_dikti', function ($row) {
                return $row->name_dikti ? $row->name_dikti : '';
            });
            $table->editColumn('name_en', function ($row) {
                return $row->name_en ? $row->name_en : '';
            });
            $table->editColumn('gelar', function ($row) {
                return $row->gelar ? $row->gelar : '';
            });

            $table->filterColumn('nama_prodi', function ($query, $keyword) {
                $query->whereHas('jenjang', function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', "%{$keyword}%");
                })
                ->orWhere('name_dikti', 'LIKE', "%{$keyword}%");
            });

            $table->rawColumns(['actions', 'placeholder', 'fakultas', 'jenjang']);

            return $table->make(true);
        }

        $jenjangs = Jenjang::pluck('name', 'id')->prepend('All', '');
        $fakultas = Faculty::pluck('name', 'id')->prepend('All', '');
        $lembaga_nasional = LembagaAkreditasi::where('type', 'nasional')->pluck('name', 'id')->prepend('All', '');
        $lembaga_internasional = LembagaAkreditasi::where('type','internasional')->pluck('name', 'id')->prepend('All', '');

        return view('frontend.prodi', compact('jenjangs', 'fakultas', 'lembaga_nasional', 'lembaga_internasional'));
    }

    public function detailProdi($slug)
    {
        $prodi = Prodi::where('slug', $slug)->first();
        return view('frontend.detail_prodi', compact('prodi'));
    }

    public function akreditasiNasional(Request $request)
    {
        if ($request->ajax()) {
            $query = Akreditasi::with(['fakultas', 'prodi', 'jenjang', 'lembaga'])->select(sprintf('%s.*', (new Akreditasi)->table))->current()->orderBy('tgl_akhir_sk', 'DESC');

            if (!empty($request->fakultas)) {
                $query->where('fakultas_id', $request->fakultas);
            }
            if (!empty($request->jenjang)) {
                $query->where('jenjang_id', $request->jenjang);
            }
            // if (!empty($request->nasional)) {
            //     $query->whereHas('akreditasi', $request->nasional);
            // }
            // if (!empty($request->internasional)) {
            //     $query->where('akreditasi_internasional', $request->internasional);
            // }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                return '<a class="btn btn-primary btn-xs" href="'.route('detail-prodi', $row->prodi->slug).'">
                                <i class="fas fa-eye"></i>
                            </a>';
            });

            $table->addColumn('fakultas_name', function ($row) {
                return $row->fakultas ? $row->fakultas->name : '';
            });

            $table->addColumn('prodi_name_dikti', function ($row) {
                return $row->prodi ? $row->jenjang->name. ' - '.  $row->prodi->name_dikti : '';
            });

            $table->addColumn('lembaga_name', function ($row) {
                return $row->lembaga ? $row->lembaga->name : '';
            });

            $table->editColumn('no_sk', function ($row) {
                return $row->no_sk ? $row->no_sk : '';
            });

            $table->editColumn('peringkat', function ($row) {
                return $row->peringkat ? Akreditasi::PERINGKAT_SELECT[$row->peringkat] : '';
            });
            $table->editColumn('nilai', function ($row) {
                return $row->nilai ? $row->nilai : '';
            });
            $table->editColumn('sertifikat', function ($row) {
                if ($photo = $row->sertifikat) {
                    return sprintf(
                        '<a href="%s" class="image-popup"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'fakultas', 'prodi', 'lembaga', 'sertifikat']);

            return $table->make(true);
        }

        $jenjangs = Jenjang::pluck('name', 'id')->prepend('All', '');
        $fakultas = Faculty::pluck('name', 'id')->prepend('All', '');
        $lembaga_nasional = LembagaAkreditasi::where('type', 'nasional')->pluck('name', 'id')->prepend('All', '');

        return view('frontend.akreditasi_nasional', compact('jenjangs', 'fakultas', 'lembaga_nasional'));
    }

    public function akreditasiInternasional(Request $request)
    {
        if ($request->ajax()) {
            $query = AkreditasiInternasional::with(['fakultas', 'prodi', 'jenjang', 'lembaga'])->select(sprintf('%s.*', (new AkreditasiInternasional)->table))->current()->orderBy('tgl_akhir_sk', 'DESC');

            if (!empty($request->fakultas)) {
                $query->where('fakultas_id', $request->fakultas);
            }
            if (!empty($request->jenjang)) {
                $query->where('jenjang_id', $request->jenjang);
            }
            // if (!empty($request->nasional)) {
            //     $query->whereHas('akreditasi', $request->nasional);
            // }
            // if (!empty($request->internasional)) {
            //     $query->where('akreditasi_internasional', $request->internasional);
            // }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                return '<a class="btn btn-primary btn-xs" href="'.route('detail-prodi', $row->prodi->slug).'">
                                <i class="fas fa-eye"></i>
                            </a>';
            });

            $table->addColumn('fakultas_name', function ($row) {
                return $row->fakultas ? $row->fakultas->name : '';
            });

            $table->addColumn('prodi_name_dikti', function ($row) {
                return $row->prodi ? $row->jenjang->name. ' - '.  $row->prodi->name_dikti : '';
            });

            $table->addColumn('lembaga_name', function ($row) {
                return $row->lembaga ? $row->lembaga->name : '';
            });

            $table->editColumn('no_sk', function ($row) {
                return $row->no_sk ? $row->no_sk : '';
            });

            $table->editColumn('diakui_dikti', function ($row) {
                return $row->diakui_dikti ? "<span class='badge badge-info'>Sudah</span>" : '<span class="badge badge-danger">Belum</span>';
            });

            $table->editColumn('peringkat', function ($row) {
                return $row->peringkat ? AkreditasiInternasional::PERINGKAT_SELECT[$row->peringkat] : '';
            });
            $table->editColumn('nilai', function ($row) {
                return $row->nilai ? $row->nilai : '';
            });
            $table->editColumn('sertifikat', function ($row) {
                if ($photo = $row->sertifikat) {
                    return sprintf(
                        '<a href="%s" class="image-popup"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'fakultas', 'prodi', 'lembaga', 'sertifikat', 'diakui_dikti']);

            return $table->make(true);
        }

        $jenjangs = Jenjang::pluck('name', 'id')->prepend('All', '');
        $fakultas = Faculty::pluck('name', 'id')->prepend('All', '');
        $lembaga_internasional = LembagaAkreditasi::where('type', 'internasional')->pluck('name', 'id')->prepend('All', '');
        
        return view('frontend.akreditasi_internasional', compact('jenjangs', 'fakultas', 'lembaga_internasional'));
    }

    public function infografis()
    {
        return view('frontend.infografis');
    }

    public function pantauanBanpt(Request $request)
    {
        if ($request->ajax()) {
            $query = Ajuan::with(['fakultas', 'prodi', 'jenjang', 'lembaga'])->select(sprintf('%s.*', (new Ajuan)->table))->latest();

            if (!empty($request->fakultas)) {
                $query->where('ajuans.fakultas_id', $request->fakultas);
            }
            if (!empty($request->jenjang)) {
                $query->where('ajuans.jenjang_id', $request->jenjang);
            }
            
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->addColumn('fakultas_name', function ($row) {
                return $row->fakultas ? $row->fakultas->name : '';
            });

            $table->addColumn('prodi_name_dikti', function ($row) {
                return $row->prodi ? $row->jenjang->name. ' '.  $row->prodi->name_dikti : '';
            });

            $table->addColumn('lembaga_name', function ($row) {
                return $row->lembaga ? $row->lembaga->name : '';
            });

            $table->editColumn('status_ajuan', function ($row) {
                return $row->status_ajuan ? '<span class="badge badge-primary">'.Ajuan::STATUS_AJUAN_SELECT[$row->status_ajuan].'</span>' : '';
            });

            $table->editColumn('tgl_ajuan', function ($row) {
                return $row->tgl_ajuan ? Carbon::parse($row->tgl_ajuan)->format('d F Y') : '';
            });

            $table->editColumn('bukti_upload', function ($row) {
                if (! $row->bukti_upload) {
                    return '';
                }
                $links = [];
                foreach ($row->bukti_upload as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank" class="image-popup"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });

            $table->rawColumns(['placeholder', 'fakultas', 'prodi', 'lembaga', 'status_ajuan', 'bukti_upload']);

            return $table->make(true);
        }

        $jenjangs = Jenjang::pluck('name', 'id')->prepend('All', '');
        $fakultas = Faculty::pluck('name', 'id')->prepend('All', '');

        return view('frontend.pantuan_banpt', compact('jenjangs', 'fakultas'));
    }
}
