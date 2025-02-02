<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;



class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderDetails;
    public $qrCodePath; // ✅ Thêm biến để lưu QR Code

    /**
     * Create a new message instance.
     *
     * @param array $orderDetails
     */
    public function __construct($orderDetails)
    {
        $this->orderDetails = $orderDetails;
         // Nếu có QR Code, tạo đường dẫn tuyệt đối
         if (!empty($orderDetails['qr_code'])) {
            $this->qrCodePath = storage_path('app/public/' . str_replace('storage/', '', $orderDetails['qr_code']));
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->subject("Xác nhận đặt hàng - MobiFone")
                      ->view('emails.order_confirmation')
                      ->with('orderDetails', $this->orderDetails);
    
        // Kiểm tra nếu có QR Code thì đính kèm file
        if (!empty($this->orderDetails['qr_code_path']) && file_exists($this->orderDetails['qr_code_path'])) {
            $email->attach($this->orderDetails['qr_code_path'], [
                'as' => 'QR_Code.png', // Tên file đính kèm
                'mime' => 'image/png', // Định dạng file
            ]);
        }
    
        return $email;
    }
    
    
    
}
