<?php

namespace App\Http\Controllers;

use App\Models\CostCenter;
use Illuminate\Http\Request;

class CostCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cost-center.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $budget = $request->input('budget');
        $budget = str_replace('.', '', $budget);
        $budget = str_replace(',', '.', $budget);
        $budget = (float) $budget;

        $data = [
            'name' => $request->input('name'),
            'budget' => $budget,
            'cost_center_type' => $request->input('cost_center_type'),
        ];
        $costCenter = CostCenter::create($data);

        return $costCenter;
    }

    /**
     * Display the specified resource.
     */
    public function show(CostCenter $costCenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CostCenter $costCenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CostCenter $costCenter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CostCenter $costCenter)
    {
        //
    }
}
