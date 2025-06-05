<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CompaniesController extends Controller
{
    public function __construct()
    {
        // register services
    }

    public function index()
    {
        return Inertia::render('Companies', [
            // pass props
        ]);
    }
}
