<?php

namespace App\Support;

use Error;
use Illuminate\Support\Carbon;
use phpDocumentor\Reflection\Types\Boolean;

class PaymentDates
{

    /**
     * Generates Payment Dates Report
     *
     * @return bool
     */
    public function generatePaymentDates($filePath): bool
    {
        try {
            $fp = fopen($filePath, "w+");
            fputcsv($fp, array('Month', 'Salary Payment Date', 'Bonus Payment Date'), "\t");
            
            $processDate = today();
            $processMonth = $processDate->month;
            $currentYear = $processDate->year;
            $next = 0;
            while ($processMonth <= 12) {
                $paymentDatesArr = array();
                $paymentDatesArr['monthName']   = $processDate->monthName;
                $paymentDatesArr['salaryDate']  = $this->getSalaryDate($processDate);
                $paymentDatesArr['bonutDate']   = $this->getBonusDate($processDate, $processMonth);

                if ($currentYear != $processDate->year) {
                    break;
                }
                $next++;
                $nextMonth = $processMonth + 1;
                $processDate->setMonth($nextMonth);
                $processMonth = $processDate->month;

                fputcsv($fp, $paymentDatesArr, "\t");
            }
            fclose($fp);
            
            return true;
        } catch (Error $e) {
            return false;
        }
    }

    /**
     * Generates Payment Dates Report
     *
     * @return Boolean
     */
    private function getSalaryDate(Carbon $processDate): string
    {
        $salaryDate = clone $processDate;
        $salaryDate->lastOfMonth();
        
        if (checkIfWeekend($salaryDate)) {
            $salaryDate->previousWeekday();
        }
        return $salaryDate->toDateString();
    }

    private function getBonusDate(Carbon $processDate, int $processMonth): string
    {
        $bonusDate = clone $processDate;
        $bonusDate->month($processMonth + 1)->day(15);
        
        if (checkIfWeekend($bonusDate)) {
            $bonusDate->next("Wednesday");
        }
        return $bonusDate->toDateString();
    }
}
