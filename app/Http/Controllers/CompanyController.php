<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\CompanyPostRequest;
use Illuminate\Http\Request;
use Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::latest()->paginate(10);
    
        return view('companies.index',compact('companies'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyPostRequest $request)
    {
        $validated = $request->validated();
        
        if($request->hasFile('image')){
            $image = $request->image->store('public');
            $request->merge([
                'logo' => $image,
            ]);
        }

        Company::create($request->all());
     
        return redirect()->route('companies.index')
                        ->with('success','Company created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyPostRequest $request, Company $company)
    {
        $validated = $request->validated();

        if($request->hasFile('image')){
            $image = $request->image->store('public');
            $request->merge([
                'logo' => $image,
            ]);
        }

        if ($company->logo) 
            Storage::delete($company->logo);

        $company->update($request->all());
    
        return redirect()->route('companies.index')
                        ->with('success','Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if ($company->logo) 
            Storage::delete($company->logo);
        $company->delete();
    
        return redirect()->route('companies.index')
                        ->with('success','Company deleted successfully');

    }
}
