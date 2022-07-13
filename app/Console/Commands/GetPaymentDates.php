<?php

namespace App\Console\Commands;

use App\Support\PaymentDates;
use Illuminate\Console\Command;

class GetPaymentDates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:getpaymentdates {outputfile}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get sales department salary and bonus payment dates for each month in current year.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(PaymentDates $paymentDates)
    {
        $outputfile = $this->argument('outputfile');
        
        if (!checkIfCSV($outputfile)) {
            echo "Output file format is invalid. Only CSV file extension is supported.\n";
            return 0;
        }

        $storagePath = storage_path();
        $filePath = $storagePath."/".$outputfile;
        
        $status = $paymentDates->generatePaymentDates($filePath);
        if ($status) {
            echo "Payment dates sheet is generated and is available at following path :: $filePath\n";
        } else {
            echo "Error generating the payment dates sheet. \n";
        }
    }
}
