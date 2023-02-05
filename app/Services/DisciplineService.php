<?php

namespace App\Services;

use App\Models\Discipline;

class DisciplineService
{
    public function create(array $data): void
    {
        $discipline = new Discipline($data);
        $discipline->save();
    }

    public function edit(Discipline $discipline, array $data): void
    {
        $discipline->fill($data);
        $discipline->save();
    }

    public function delete(Discipline $discipline): void
    {
        $discipline->delete();
    }
}
