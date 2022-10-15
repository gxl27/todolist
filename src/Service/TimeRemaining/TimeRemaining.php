<?php

namespace App\Service\TimeRemaining;

class TimeRemaining {

    const EXPIRED = 'expired';

    public static function calculate(\DateTime $date) {

        $now = new \DateTime();
        $diff = $now->diff($date);

        return self::diffFormated($diff);
    }

    private static function diffFormated(\DateInterval $diff) {

        
        $isExpired = self::checkExpired($diff) ?? false;
        if($isExpired){
            return self::EXPIRED;
        }

        $hasYears = self::checkYears($diff) ?? false;
        if($hasYears){
            return $diff->format('%y years');;
        }

        $hasMonths = self::checkMonths($diff) ?? false;
        if($hasMonths){
            return $diff->format('%m months');;
        }

        $hasDays = self::checkDays($diff) ?? false;
        if($hasDays){
            return $diff->format('%d days');;
        }

        $formated = "";
        $formated .= self::checkHours($diff);
        $formated .= self::checkMinutes($diff);
        
        return $formated;

    }

    private static function checkYears(\DateInterval $diff) {

        if($diff->format('%y') > 0){

            return true;
        }

        return;
    }

    private static function checkMonths(\DateInterval $diff) {

        if($diff->format('%m') > 0){

            return true;
        }

        return;
    }

    private static function checkDays(\DateInterval $diff) {

        if($diff->format('%d') > 0){

            return true;
        }

        return;
    }

    private static function checkHours(\DateInterval $diff) {

        if($diff->format('%h') > 0){

            return $diff->format('%h hours ');
        }

        return;
    }

    private static function checkMinutes(\DateInterval $diff) {

        if($diff->format('%i') > 0){

            return $diff->format('%i minutes ');
        }

        return;
    }



    private static function checkExpired(\DateInterval $diff) {

        if($diff->format('%r') === '-'){

            return true;
        }

        return;
    }

}