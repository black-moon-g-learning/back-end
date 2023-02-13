<?php

namespace App\Services\Continent;

use Illuminate\Http\Request;

interface IContinentService
{
    public function index();
    public function update(Request $request, int $id);
    public function show();
    public function edit(int $id);
}
