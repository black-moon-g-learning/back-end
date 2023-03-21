<?php

namespace Database\Factories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

trait GeneralFactory
{

    /**
     * @return Collection
     */
    public function getCountryIds(): Collection
    {
        return DB::table('countries')->pluck('id');
    }

    public function getCountryId(): int
    {
        return DB::table('countries')->inRandomOrder()->first()->id;
    }

    /**
     * @return Collection
     */
    public function getTopicIds(): Collection
    {
        return DB::table('topics')->pluck('id');
    }

    /**
     * @return Collection
     */
    public function getVideosId(): Collection
    {
        return DB::table('videos')->pluck('id');
    }

    /**
     * @param string $tableName
     * @return Collection
     */
    public function getArrayIds(string $tableName): Collection
    {
        return DB::table($tableName)->pluck('id');
    }

}
