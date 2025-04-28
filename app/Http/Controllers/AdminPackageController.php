<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackageBooking;
use Illuminate\Support\Str;

class AdminPackageController extends Controller
{
    // Display all packages
    public function index()
    {
        // Package=>model ho yo bata data fetch garera $packages vanii variable ma rakheko
        //SELECT * FROM packages;  //$packages = Package::limit(3)->get();

        // $packages = Package::all();  //Retrieves all packages from the database
        $packages = Package::paginate(6);
        return view('admin.package.index', compact('packages')); //Passes them to the index view to be displayed in a list.
    }
    
    // Show create package form
    public function create()
    {
        return view('admin.package.create');  //return add pacakge form create.index.php
    }

    // Store new package
    public function store(Request $request)
    {
        //Validates the request
        // $request->validate([
        //     'title' => 'required',
        //     'description' => 'required',
        //     'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'destination' => 'required',
        //     'price' => 'required|numeric',
        //     'duration' => 'required|integer',
        // ]);
       
    $request->validate([
        'title' => 'required|regex:/^[a-zA-Z0-9\s\-\&\,\.\'\:]+$/',
  // Only alphabets and spaces allowed
        'description' => 'required',  // Only alphabets and spaces allowed
        // 'img' => 'nullable|image|mimes:jpeg,png,jpg,gif',  
        'img' => 'required|image',  // Image is optional during update
        'destination' => 'required|regex:/^[a-zA-Z\s]+$/',
        'price' => 'required|numeric|min:100',  // Price should be greater than 0
        'duration' => 'required|integer|min:1|max:10',  // Duration should be at least 1 day
    ]);

        // Handle file upload
        $fileName = Str::slug($request->title) . '-' . time() . '.' . $request->img->extension();
        $request->img->move(public_path('uploads'), $fileName);  //Moves the uploaded image to the public/uploads directory.

        // Str::slug($request->title): Converts title into a URL-friendly string.
        //time(): Appends the current timestamp to prevent duplicates.
        //$request->img->extension(): Gets the file extension (e.g., .jpg).

        // Store package data in database...create a row
        //INSERT INTO packages (title, description, img, destination, price, duration) VALUES ('Title', 'Description', 'file_name.jpg', 'Destination', 100, 5);

        Package::create([
            'title' => $request->title,
            'description' => $request->description,
            'img' => $fileName,
            'destination' => $request->destination,
            'price' => $request->price,
            'duration' => $request->duration,
        ]);

        return redirect()->route('package.index')->with('success', 'Package created successfully');
    }

    // Show edit form
    public function edit($id)
    {
        $package = Package::findOrFail($id);
        return view('admin.package.edit', compact('package'));
    }

    // Update package
    public function update(Request $request, $id)
    {
        //Finds the package by $id SELECT * FROM packages WHERE id = ? LIMIT 1;
        $package = Package::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            // 'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|',
            'img' => 'nullable|image|',
            'destination' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
        ]);

        // Update fields
        //UPDATE packages SET title = 'New Title', description = 'New Description', destination = 'New Destination', price = 150, duration = 7 WHERE id = ?;
        $package->title = $request->title;
        $package->description = $request->description;
        $package->destination = $request->destination;
        $package->price = $request->price;
        $package->duration = $request->duration;

        // checks if a new image was uploaded..if yes then generates a new filename using the same method as store()
        if ($request->hasFile('img')) {
            $fileName = Str::slug($request->title) . '-' . time() . '.' . $request->img->extension();
            $request->img->move(public_path('uploads'), $fileName);  //Moves the new image to public/uploads.
            $package->img = $fileName; //Updates the img field in the database.
        }

        $package->save();

        return redirect()->route('package.index')->with('success', 'Package updated successfully');
    }

    // Delete package
    public function destroy($id)
    {
        //Finds the package by $id and deletes it from the database.
        $package = Package::findOrFail($id);
        $package->delete();
        //DELETE FROM packages WHERE id = ?;


        //Redirects back to the package list(index page) with a success message
        return redirect()->route('package.index')->with('success', 'Package deleted successfully');
    }


}
