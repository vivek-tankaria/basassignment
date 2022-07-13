<?php
declare(strict_types = 1);

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
    protected $signature = 'command:getpaymentdates';

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
        $outputFileName = $this->ask('Enter Output File Name', 'outputFileName');
        
        if (!checkIfCSV($outputFileName)) {
            $this->error('Error:: outputFileName format is invalid. Only CSV file extension is supported.');
            
            return;
        }
        
        $storagePath = storage_path();
        $filePath = $storagePath."/".$outputFileName;
        
        $status = $paymentDates->generatePaymentDatesCSV($filePath);
        if ($status) {
            $this->info(sprintf('Payment dates sheet is generated and is available at following path :: %s', $filePath));
        } else {
            $this->error('Error generating the payment dates csv.');
        }
    }
}
