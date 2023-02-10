<?php

namespace App\Services\Continent;


interface IContinentService
{
    public function index();
    public function update();
    public function show();
    public function edit(int $id);
}
