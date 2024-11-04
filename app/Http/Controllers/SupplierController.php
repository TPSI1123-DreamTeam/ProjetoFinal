<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Models\Supplier;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;

class SupplierController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.suppliers.index', ['suppliers' => Supplier::paginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone-number' => 'required',
        ]);

        Supplier::create($request->all())->save();
        return redirect('suppliers')->with('status', 'Item created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view('pages.suppliers.show',['supplier' => $supplier]);
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone-number' => 'required',
        ]);

        $supplier->update($request->all());
        return redirect('suppliers')->with('status', 'Item created successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect('suppliers')->with('status', 'Item deleted successfully!');
    }
}
