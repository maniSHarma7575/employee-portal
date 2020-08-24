<?php

namespace App\Http\Controllers\HR\Universities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HR\University;
use App\Http\Requests\HR\UniversityRequest;

class UniversityController extends Controller
{
    public function index()
    {
        $searchString = (request()->has('search')) ? request()->input('search') : false;
        $universities = University::getList($searchString);
        return view('hr.universities.index')->with([
            'universities' => $universities,
        ]);
    }

    public function create()
    {
        return view('hr.universities.create');
    }

    public function store(UniversityRequest $request)
    {
        $validatedData = $request->validated();
        $university=University::create([
            'name'=>$validatedData['name'],
            'address'=>isset($validatedData['address'])?$validatedData['address']:null,
            'rating'=>isset($validatedData['rating'])?$validatedData['rating']:null
        ]);
        return redirect(route('universities.edit', $university))->with('status', 'University created successfully!');
    }

    public function edit(University $university)
    {
        return view('hr.universities.edit')->with([
            'university' => $university,
        ]);
    }

    public function update(UniversityRequest $request, University $university)
    {
        $validated = $request->validated();
        $updated = $university->update([
            'name' => $validated['name'],
            'address'=>isset($validated['address'])?$validated['address']:null,
            'rating'=>isset($validated['rating'])?$validated['rating']:null
        ]);
        return redirect(route('universities.edit', $university->id))->with('status', 'University updated successfully!');
    }


    public function destroy(University $university)
    {
        $isDeleted=$university->delete();
        return $isDeleted?redirect(route('universities'))->with('status', 'University Deleted successfully!'):
        redirect(route('universities'))->with('status', 'Something went wrong! Please try again');
    }
}
