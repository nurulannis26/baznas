<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PermohonanController extends Controller
{
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
}
