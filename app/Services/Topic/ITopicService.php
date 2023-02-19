<?php

namespace App\Services\Topic;

use Illuminate\Http\Request;

interface ITopicService
{
    public function index();

    public function edit(int $id);

    public function update(Request $request, int $id);

    public function delete(int $id);
}
