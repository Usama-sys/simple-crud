<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Type;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       
        //  dd($type->toArray());
        // $Type = Type::all();
        $companies = Company::with('type')->get();
      
        // dd($companies->toArray());
        return view('companies.index',compact('companies'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    
    {
        $types = Type::all();
        // dd($types->toArray());
        return view('companies.create',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Company $company)
    {
        // dd($request->post());
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email|',
            'dob' => 'required',
            'type_id'=>'required',
        ]);
        //  dd($request->post());

        $company->fill($request->post())->save();
        return redirect()->route('companies.index')->with('success','Company has been Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        // $company = Company::with('type')->get();
        // dd($company->toArray());
        $types = Type::all();
            if($company->created_by_user != auth()->id()){
                return redirect()->back()->with('deleted','You are not authorized to update this record');
            }
            return view('companies.edit',compact('company','types'));
       
        // dd($company->id);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Company $company)
    {
        // dd($company);
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'dob' => 'required',
        ]);
        $company->fill($request->post())->save();
        return redirect()->route('companies.index')->with('success','Company has been Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {

        // dd($company);
        if($company->created_by_user != auth()->id()){
            return redirect()->back()->with('deleted','You are not authorized to delete this record');
        }
        $company->delete();
        return redirect()->route('companies.index')->with('deleted','Company has been deleted successfully');
    }
}
