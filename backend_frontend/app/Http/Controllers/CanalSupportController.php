<?php

namespace App\Http\Controllers;

use App\Models\CanalSupport;
use Illuminate\Http\Request;

class CanalSupportController extends Controller
{
    public function index()
    {
        return CanalSupport::all();
    }

    public function store(Request $request)
    {
        return CanalSupport::create($request->all());
    }

    public function show(CanalSupport $canalSupport)
    {
        return $canalSupport;
    }

    public function update(Request $request, CanalSupport $canalSupport)
    {
        $canalSupport->update($request->all());
        return $canalSupport;
    }

    public function destroy(CanalSupport $canalSupport)
    {
        $canalSupport->delete();
        return response()->json(['message'=>'Deleted']);
    }
}