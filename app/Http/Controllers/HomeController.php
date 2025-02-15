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
use App\Models\AkreditasiInternasional;
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
        $title = 'Capaian Peringkat Akreditasi Tahun 2025';
        $subtitle = 'Capaian Peringkat Akreditasi Tahun 2025 Seluruh Universitas Sebelas Maret';


        $data = [sumProdiUnggul(), sumProdiA(), sumProdiBaikSekali(), sumProdiB(), sumProdiBaik(), sumProdiSementara(), sumProdiBelumTerakreditasi()];
        $label = ['Terakreditasi Unggul', 'Terakreditasi A', ' Terakreditasi Baik Sekali', 'Terakreditasi B', 'Terakreditasi Baik', 'Terakreditasi Sementara', 'Belum Terakreditasi'];
        $grafik = $pie->build($title, $subtitle, $data, $label);

        //grafik pie akred internasional
        $internasional = [
            'labels' => ['ASIIN', 'FIBAA', 'AQAS', 'IABEE', 'Belum Terakreditasi'],
            'values' => [sumProdiAsiin(), sumProdiFibaa(), sumProdiAqas(), sumProdiIabee(), sumProdiBelumTerakreditasiInternasional()]
        ];

        $lembaga_nasional = LembagaAkreditasi::where('type', 'nasional')->get();
        $akreditasi = Akreditasi::current()->get();

        $labels_cakupan = [];
        $values_cakupan = [];

        foreach($lembaga_nasional as $lembaga) {
            $labels_cakupan[] = $lembaga->name;
            $values_cakupan[] = $akreditasi->where('lembaga_id', $lembaga->id)->count();
        };

        $cakupan = [
            'labels' => $labels_cakupan,
            'values' => $values_cakupan,
        ];

        return view('home', compact('grafik', 'data', 'label', 'internasional', 'cakupan'));
    }

    public function fakultas(PieChart $pie)
    {
        $fakultas = Faculty::all();
        $akreditasi = Akreditasi::current()->get();
        $akreditasiInternasional = AkreditasiInternasional::current()->get();

        foreach ($fakultas as $key => $value) {
            $title = 'CAPAIAN PERINGKAT AKREDITASI NASIONAL FAKULTAS ' . $value->name;
            $subtitle = '';
            
            $data = [
                $akreditasi->where('fakultas_id', $value->id)->where('peringkat', 'UNGGUL')->count(),
                $akreditasi->where('fakultas_id', $value->id)->where('peringkat', 'A')->count(),
                $akreditasi->where('fakultas_id', $value->id)->where('peringkat', 'BAIK SEKALI')->count(),
                $akreditasi->where('fakultas_id', $value->id)->where('peringkat', 'B')->count(),
                $akreditasi->where('fakultas_id', $value->id)->where('peringkat', 'BAIK')->count(),
                $akreditasi->where('fakultas_id', $value->id)->where('peringkat', 'C')->count(),
                $akreditasi->where('fakultas_id', $value->id)->where('peringkat', 'SEMENTARA')->count(),
                $value->prodi->count() - $akreditasi->where('fakultas_id', $value->id)->count()
            ];

            $label = ["Terakreditasi Unggul", 'Terakreditasi "A"', 'Terakreditasi Baik Sekali', 'Terakreditasi "B"', 'Terakreditasi Baik', 'Terakreditasi "C"', 'Terakreditasi Sementara', 'Belum Terakreditasi'];

            $grafik[$key] = $pie->build($title, $subtitle, $data, $label);
        }

        return view('frontend.fakultas', compact('fakultas', 'akreditasi', 'akreditasiInternasional', 'grafik'));
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
            if (!empty($request->nasional)) {
                $lembaga_nasional = $request->nasional;
                $query->whereHas('currentAkreditasi', function ($query) use ($lembaga_nasional)  {
                    $query->where('lembaga_id', $lembaga_nasional);
                });
            }
            if (!empty($request->internasional)) {
                $lembaga_internasional = $request->internasional;
                $query->whereHas('currentAkreditasiInternasional', function ($query) use ($lembaga_internasional)  {
                    $query->where('lembaga_id', $lembaga_internasional);
                });
            }

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

            $table->addColumn('akreditasi_nasional', function ($row) {
                return $row->currentAkreditasi ? '<b>'.$row->currentAkreditasi->lembaga->name.'</b><br>('.$row->currentAkreditasi->no_sk.')' : 'Belum Terakreditasi';
            });

            $table->addColumn('akreditasi_internasional', function ($row) {
                return $row->currentAkreditasiInternasional 
                ? '<b>' . $row->currentAkreditasiInternasional->lembaga->name . '</b>' 
                    . (!empty($row->currentAkreditasiInternasional->no_sk) 
                        ? '<br>(' . $row->currentAkreditasiInternasional->no_sk . ')' 
                        : '') 
                : 'Belum Terakreditasi';
            });

            $table->addColumn('peringkat_nasional', function ($row) {
                return $row->currentAkreditasi ? $row->currentAkreditasi->peringkat : 'Belum Terakreditasi';
            });

            $table->rawColumns(['actions', 'placeholder', 'fakultas', 'jenjang', 'akreditasi_nasional', 'akreditasi_internasional']);

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
        $currentAkreditasi = Akreditasi::where('prodi_id', $prodi->id)->current()->first();
        $allAkreditasi = Akreditasi::allAkreditasi($prodi->id)->get();
        $currentAkreditasiInternasional = AkreditasiInternasional::where('prodi_id', $prodi->id)->current()->first();
        $allAkreditasiInternasional = AkreditasiInternasional::allAkreditasi($prodi->id)->get();

        return view('frontend.detail_prodi', compact('prodi', 'currentAkreditasi', 'allAkreditasi', 'currentAkreditasiInternasional', 'allAkreditasiInternasional'));
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
            if (!empty($request->lembaga)) {
                $query->where('lembaga_id', $request->lembaga);
            }
            if (!empty($request->peringkat)) {
                $query->where('peringkat', $request->peringkat);
            }

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
            if (!empty($request->lembaga)) {
                $query->where('lembaga_id', $request->lembaga);
            }

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

            $table->editColumn('tgl_akhir_sk', function ($row) {
                return $row->tgl_akhir_sk ? Carbon::parse($row->tgl_akhir_sk)->format('d F Y') : '';
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
