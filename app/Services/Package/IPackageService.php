<?php

namespace App\Services\Package;

use Illuminate\Http\Request;

interface IPackageService
{
    public function index();

    public function indexAdmin();

    public function edit(int $id);

    public function update(Request $request, int $id);
}
