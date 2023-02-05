<?php

namespace App\Services;

use App\Models\Schedule;

class ScheduleService
{
    public function create(array $lessons, int $current_class, int $day): void
    {
        foreach ($lessons as $key => $value) {
            if ($value) {
                $query = Schedule::query()
                    ->where('class_id', $current_class)
                    ->where('day_id', $day)
                    ->where('num_lesson_id', $key)
                    ->count();

                $schedule = !$query ? new Schedule() :
                    Schedule::query()
                        ->where('class_id', $current_class)
                        ->where('day_id', $day)
                        ->where('num_lesson_id', $key)
                        ->first();

                $schedule->day_id = $day;
                $schedule->class_id = $current_class;
                $schedule->num_lesson_id = $key;
                $schedule->discipline_id = $value;
                $schedule->save();
            }
        }
    }
}
