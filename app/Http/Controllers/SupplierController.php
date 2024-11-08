<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        $suppliers = Supplier::orderBy('id')->paginate(15);
        return view('pages.suppliers.index', ['suppliers' => $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view('pages.suppliers.show', ['supplier' => $supplier]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('pages.suppliers.edit', ['supplier' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $update            = Supplier::find($supplier->id);
        $update->name      = $request->name;
        $update->email     = $request->email;
        $update->contact   = $request->contact;
        $update->save();

        return redirect('suppliers')->with('status','Item edited successfully!')->with('class', 'alert-success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        try {
            $supplier = Supplier::findOrFail($supplier->id);
            $supplier->delete();
            return redirect('suppliers')->with('status','Deleted successfully!')->with('class', 'alert-success');
        } catch (ModelNotFoundException $exception) {
            return redirect('suppliers')->with('status','Not Founded!')->with('class', 'alert-danger');
        } catch (Exception $exception) {
            return redirect('suppliers')->with('status','Error!')->with('class', 'alert-danger');
        }
    }
}
