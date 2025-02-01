<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderDetails;

    /**
     * Create a new message instance.
     *
     * @param array $orderDetails
     */
    public function __construct($orderDetails)
    {
        $this->orderDetails = $orderDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.order_confirmation')
                    ->with([
                        'customer_name' => $this->orderDetails['customer_name'],
                        'order_code' => $this->orderDetails['order_code'],
                        'total_amount' => $this->orderDetails['total_amount'],
                        'payment_method' => $this->orderDetails['payment_method'],
                        'qr_code_url' => asset($this->orderDetails['qr_code']), // Truyền đường dẫn file
                    ]);
    }
    
}
