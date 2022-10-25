<?php

namespace App\Helpers;

use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;

class DatesHelper
{

    public static function monthsToStr($months){
        switch ($months) {
            case '1':$months="Enero";break;
            case '2':$months="Febrero";break;
            case '3':$months="Marzo";break;
            case '4':$months="Abril";break;
            case '5':$months="Mayo";break;
            case '6':$months="Junio";break;
            case '7':$months="Julio";break;
            case '8':$months="Agosto";break;
            case '9':$months="Septiembre";break;
            case '10':$months="Octubre";break;
            case '11':$months="Noviembre";break;
            case '12':$months="Diciembre";break;
        }
        return $months;
    }

    public static function monthsToNumber($months){
        switch ($months) {
            case 'Enero':$months="1";break;
            case 'Febrero':$months="2";break;
            case 'Marzo':$months="3";break;
            case 'Abril':$months="4";break;
            case 'Mayo':$months="5";break;
            case 'Junio':$months="6";break;
            case 'Julio':$months="7";break;
            case 'Agosto':$months="8";break;
            case 'Septiembre':$months="9";break;
            case 'Octubre':$months="10";break;
            case 'Noviembre':$months="11";break;
            case 'Diciembre':$months="12";break;
        }
        return $months;
    }

    public static function getMonthsInRange($start,$end){
        $months = array();
        while (strtotime($start) <= strtotime($end)) {
            /* $months[] = array(  'year' => date('Y', strtotime($start)),  'month' => date('m', strtotime($startDate)),   ); */
            $months[] = date('Y', strtotime($start))."-".date('m', strtotime($start));
            // Set date to 1 so that new month is returned as the month changes.
            $start = date('01 M Y', strtotime($start . '+ 1 month'));
        }
        return $months;
    }

}