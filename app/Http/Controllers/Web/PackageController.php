<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Package\IPackageService;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    protected IPackageService $packageSer;

    public function __construct(IPackageService $packageSer)
    {
        $this->packageSer = $packageSer;
    }

    public function index()
    {
        $services = $this->packageSer->indexAdmin();
        return view('pages.services', compact('services'));
    }

    public function edit(int $id)
    {
        $service = $this->packageSer->edit($id);
        return view('forms.service', compact('service'));
    }

    public function update(Request $request, int $id)
    {
        $response = $this->packageSer->update($request, $id);
        if ($response['status']) {
            return redirect()->route('web.services')->with('response', $response);
        }
        return redirect()->back()->with('errors', $response['data']);
    }
}
