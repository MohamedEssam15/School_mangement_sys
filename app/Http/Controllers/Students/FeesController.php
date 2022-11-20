<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;

use App\Repository\FeesRepositoryInterface;
use App\Models\fee;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    protected $Fees;

    public function __construct(FeesRepositoryInterface $Fees)
    {
        $this->Fees = $Fees;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->Fees->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->Fees->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->Fees->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function show(fee $fee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->Fees->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, fee $fee)
    {
        return $this->Fees->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->Fees->destroy($request);
    }
}
