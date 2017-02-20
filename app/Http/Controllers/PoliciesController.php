<?php

namespace Iplan\Http\Controllers;

use Illuminate\Http\Request;

use Iplan\Http\Requests;

class PoliciesController extends Controller
{
   public function index()
   {
       return view('privacy_policies');
   }
}
