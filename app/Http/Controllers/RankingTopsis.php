<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class RankingTopsis extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function topsis()
    {
        return view('ranking.topsis');
    }
}
