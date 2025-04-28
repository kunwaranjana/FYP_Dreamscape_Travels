<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    // public function index()
    // {
    //     $packages = Package::all(); // Fetch all packages
    //     return view('pages.package', compact('packages'));
    // }

    public function homePagePackages()
    {
        $packages = Package::limit(6)->get(); 
        return view('pages.home', compact('packages'));
    }

    public function index(Request $request)
    {
        //SELECT DISTINCT destination FROM packages;
        $destinations = Package::select('destination')->distinct()->pluck('destination'); //pluck le tai column matra extract garxa
    
        //$request->input() gets the values from the URL and stored in variable
        $destination = $request->input('destination');
        $pricing = $request->input('pricing');
        $duration = $request->input('duration');
    
        //query() is a method in Laravel's Eloquent ORM that allows you to start building a query on the Package table.
        $query = Package::query();
    
        if ($destination) {
            $query->where('destination', $destination);
        }
    
        if ($duration) {
            if ($duration == 'short') {
                $query->where('duration', '<=', 3);
            } elseif ($duration == 'medium') {
                $query->whereBetween('duration', [4, 7]);
            } elseif ($duration == 'long') {
                $query->where('duration', '>=', 8);
            }
        }
    
        if ($pricing) {
            if ($pricing === 'low-to-high') {
                $query->orderBy('price', 'asc');
            } elseif ($pricing === 'high-to-low') {
                $query->orderBy('price', 'desc');
            }
        }

        $packages = $query->get(); // // Executes the final query
    
        return view('pages.packages.package', compact('packages', 'destinations')); //Passes the filtered packages and destinations to view.
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showPackageDescription($id)
    {
        $package = Package::findOrFail($id); // Fetch package by ID or fail if not found
        // dd($package);
        return view('pages.packages.packageDescription', compact('package'));

    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        //
    }
}
