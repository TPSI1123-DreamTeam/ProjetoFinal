<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        $suppliers = Supplier::with('supplierType')->paginate(10);
        return view('pages.suppliers.index', ['suppliers' => $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supplierTypes = SupplierType::all();
        return view('pages.suppliers.create', compact('supplierTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        // Validação dos dados do fornecedor, utilizando a StoreSupplierRequest.
        $validatedData = $request->validated();
        
            // Criação do fornecedor
            $supplier = Supplier::create([
            'name'  => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'supplier_type_id' => $request->supplier_type_id,
            'status' => true
            ]);

            if($request->has('image')){
                $file      = $request->file('image');
                $imageName = time().'.'.$request->image->extension();
                $path      = 'images/suppliers/'.$supplier->id;
    
                $request->image->move(public_path($path), $imageName);
    
                // save image
                $update = Supplier::find($supplier->id);
                $update->image = $imageName;
                $update->save();      
            }


            // Redirecionamento após sucesso
            return redirect()->route('suppliers.index')->with('status', 'Fornecedor criado com sucesso!');
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

        return redirect('suppliers')->with('status','Fornecedor atualizado com sucesso!')->with('class', 'alert-success');
    }

    /**
     * Remove the specified resource from storage.
     */

     public function toggleStatus(Supplier $supplier)
     {
         $supplier->status = !$supplier->status;  // Alterna entre 1 e 0
         $supplier->save();
         
         if($supplier->status){
             return redirect()->route('suppliers.index')->with('status', 'Fornecedor ativado com sucesso!');
         } else {
            return redirect()->route('suppliers.index')->with('status', 'Fornecedor desativado com sucesso!');
         }
     }
}
