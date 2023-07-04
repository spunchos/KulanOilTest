<?php

namespace App\Actions;

class JoinApplicationsAction
{
    /**
     * source - кошмарныеКостыли.com
     *
     * @param $apps
     * @return void
     */
    public function handle($apps)
    {
        $from = '';
        $to = '';
        $count = 1;
        $city_id = $apps[0]->city_id;
        $date = $apps[0]->date;
        foreach ($apps as $app) {
            $from .= $count.') '.$app->from.'. ';
            $to .= $count.') '.$app->to.'. ';
            $app->delete();
            $count++;
        }
        auth()->user()->applications()->create([
            'from'    => $from,
            'to'      => $to,
            'city_id' => $city_id,
            'date'    => $date,
        ]);
    }
}
