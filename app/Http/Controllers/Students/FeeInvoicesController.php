<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\FeeInvoicesRepositoryInterface;

use App\Models\fee_Invoices;
use Illuminate\Http\Request;

class FeeInvoicesController extends Controller
{
    protected $Fees_Invoices;
    public function __construct(FeeInvoicesRepositoryInterface $Fees_Invoices)
    {
        $this->Fees_Invoices = $Fees_Invoices;
    }

    public function index()
    {
        return $this->Fees_Invoices->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->Fees_Invoices->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\feeInvoices  $feeInvoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->Fees_Invoices->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\feeInvoices  $feeInvoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->Fees_Invoices->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\feeInvoices  $feeInvoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return $this->Fees_Invoices->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\feeInvoices  $feeInvoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->Fees_Invoices->destroy($request);
    }
}
