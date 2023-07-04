<?php

namespace App\Actions;

use App\Models\Application;

class CheckApplicationsForJoinAction
{
    public function handle($apps): bool
    {
        $city_id = $apps[0]->city_id;
        $date = $apps[0]->date;
        foreach ($apps as $app) {
            if ($app->city_id != $city_id || $app->date != $date) return false;
        }

        return true;
    }

}
