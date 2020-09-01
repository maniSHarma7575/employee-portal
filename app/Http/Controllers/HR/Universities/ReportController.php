<?php

namespace App\Http\Controllers\HR\Universities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HR\University;

class ReportController extends Controller
{
    public function index()
    {
        $applications=University::getUniversitiesReports();
        return view('hr.universities.reports')->with(['applications'=>$applications]);
    }
}
