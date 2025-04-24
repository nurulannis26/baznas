<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PDF as Dompdf;
class PermohonanController extends Controller
{
    public $filters_fo;
    public $filters_atasan;
    public $filters_survey;
    public $filters_pencairan;
    public $filters_lpj;

    public function index()
    {
        $filter_permohonan = '';

        return view('permohonan.index', compact('filter_permohonan'));
    }

    public function filter_permohonan_post(Request $request)
    {
        if ($request->fo_lv) {
            $fo_lv = $request->fo_lv;
        } else {
            $fo_lv = 'Semua';
        }

        if ($request->atasan_lv) {
            $atasan_lv = $request->atasan_lv;
        } else {
            $atasan_lv = 'Semua';
        }

        if ($request->survey_lv) {
            $survey_lv = $request->survey_lv;
        } else {
            $survey_lv = 'Semua';
        }

        if ($request->pencairan_lv) {
            $pencairan_lv = $request->pencairan_lv;
        } else {
            $pencairan_lv = 'Semua';
        }

        if ($request->lpj_lv) {
            $lpj_lv = $request->lpj_lv;
        } else {
            $lpj_lv = 'Semua';
        }
        return Redirect::to('/filter_permohonan/' . $request->filter_daterange . '/'  . $fo_lv . '/' .  $atasan_lv . '/' .  $survey_lv . '/'.  $pencairan_lv . '/'.  $lpj_lv );
    }

    public function filter_permohonan($c_filter_daterange, $c_filters_fo, $c_filters_atasan, $c_filters_survey, $c_filters_pencairan, $c_filters_lpj, Request $request)
    {
        $filter_permohonan = 'on';

        $c_filter_daterange = $c_filter_daterange;
        $c_filters_fo = $c_filters_fo;
        $c_filters_atasan = $c_filters_atasan;
        $c_filters_survey = $c_filters_survey;
        $c_filters_pencairan = $c_filters_pencairan;
        $c_filters_lpj = $c_filters_lpj;
        return view(
            'permohonan.index',
            compact('filter_permohonan', 'c_filter_daterange', 'c_filters_fo', 'c_filters_atasan', 'c_filters_survey', 'c_filters_pencairan', 'c_filters_lpj')
        );
    }

    public function detail_permohonan($permohonan_id)
    {
        $title = "DETAIL PERMOHONAN";
        $permohonan_id = $permohonan_id;
        return view(
            'permohonan.detail_permohonan',
            compact('title', 'permohonan_id')
        );
    }

    public function print_permohonan_pdf(Request $request)
{
   
    // Ambil semua query string
    $filter_daterange     = $request->query('filter_daterange');
    $filters_fo           = $request->query('filters_fo');
    $filters_atasan       = $request->query('filters_atasan');
    $filters_pencairan    = $request->query('filters_pencairan');
    $filters_survey       = $request->query('filters_survey');
    $filters_lpj          = $request->query('filters_lpj');
    // dd( $filter_daterange, $filters_fo, $filters_atasan, $filters_pencairan, $filters_survey, $filters_lpj);    
    // Format date range
    $start_date = null;
    $end_date = null;

    if (strpos($filter_daterange, '+-+') !== false) {
        $date_parts = explode("+-+", $filter_daterange);
        $start_date = $date_parts[0];
        $end_date   = $date_parts[1];
    } else {
        $date_parts = explode(" - ", $filter_daterange);
        $start_date = $date_parts[0];
        $end_date   = $date_parts[1];
    }

    $filter_daterange = $start_date . ' - ' . $end_date;

    // Handle kondisi filter
    $this->filters_fo        = $filters_fo        == 'Semua' ? null : $filters_fo;
    $this->filters_atasan    = $filters_atasan    == 'Semua' ? null : $filters_atasan;
    $this->filters_pencairan = $filters_pencairan == 'Semua' ? null : $filters_pencairan;
    $this->filters_survey    = $filters_survey    == 'Semua' ? null : $filters_survey;
    $this->filters_lpj       = $filters_lpj       == 'Semua' ? null : $filters_lpj;

    // Query data
    $data = DB::table('permohonan')
        ->leftJoin('upz', 'upz.upz_id', '=', 'permohonan.upz_id')
        ->select('permohonan.*', 'upz.*')
        ->when($filter_daterange != '', function ($query) use ($start_date, $end_date) {
            return $query->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
                if ($start_date == $end_date) {
                    return $query->whereDate('permohonan_tgl', '=', $start_date);
                } else {
                    return $query->whereDate('permohonan_tgl', '>=', $start_date)
                        ->whereDate('permohonan_tgl', '<=', $end_date);
                }
            });
        })
        ->when($this->filters_fo, function ($query) {
            return $query->where('permohonan_status_input', $this->filters_fo);
        })
        ->when($this->filters_atasan, function ($query) {
            if ($this->filters_atasan == 'Belum Dicek') {
                return $query->where('permohonan_status_input', 'Selesai Input');
            } else {
                return $query->where('permohonan_status_atasan', $this->filters_atasan);
            }
        })
        ->when($this->filters_survey, function ($query) {
            return $query->where('survey_pilihan', $this->filters_survey);
        })
        ->when($this->filters_pencairan, function ($query) {
            if ($this->filters_pencairan == 'Belum Dicairkan') {
                return $query->where('permohonan_status_atasan', 'Diterima');
            } else {
                return $query->where('pencairan_status', $this->filters_pencairan);
            }
        })
        ->when($this->filters_lpj, function ($query) {
            return $query->where('tujuan', $this->filters_lpj);
        })
        ->orderBy('permohonan.created_at', 'desc')
        ->get();
        Carbon::setLocale('id');

        $start_date = Carbon::parse(explode(' - ', $filter_daterange)[0])->translatedFormat('d F Y');
        $end_date   = Carbon::parse(explode(' - ', $filter_daterange)[1])->translatedFormat('d F Y');
    
        // Generate PDF
    $pdf = Dompdf::loadView('permohonan.print_permohonan_pdf', [
        'data'               => $data,
        'filter_daterange'   => $filter_daterange,
        'filters_fo'         => $filters_fo,
        'filters_atasan'     => $filters_atasan,
        'filters_pencairan'  => $filters_pencairan,
        'filters_survey'     => $filters_survey,
        'filters_lpj'        => $filters_lpj,
        'start_date'         => $start_date,
        'end_date'           => $end_date,
    ])->setPaper('a4', 'landscape');

    return $pdf->stream('PERMOHONAN_' . $filter_daterange . '.pdf');
}
}
