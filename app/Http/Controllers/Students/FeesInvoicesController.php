<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\FeeInvoicesRepositoryInterface;

class FeesInvoicesController extends Controller
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

 
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return $this->Fees_Invoices->store($request);
    }


    public function show($id)
    {
        return $this->Fees_Invoices->show($id);
    }



    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
