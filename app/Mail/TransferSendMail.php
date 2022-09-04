<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransferSendMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $bank;
    protected $price;
    protected $transfer_fee;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($bank, $price, $transfer_fee)
    {
        $this->bank_name = $bank['bank_name'];
        $this->branch_name = $bank['branch_name'];
        $this->deposit_type = $bank['deposit_type'];
        $this->bank_num = $bank['bank_num'];
        $this->name = $bank['name'];
        $this->price = $price;
        $this->transfer_fee = $transfer_fee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('manabee.info@gmail.com', 'manabee')
            ->subject('振り込み申請')
            ->view('transfer.mail')
            ->with([
                'bank_name' => $this->bank_name,
                'branch_name' => $this->branch_name,
                'deposit_type'  => $this->deposit_type,
                'bank_num'  => $this->bank_num,
                'name'  => $this->name,
                'price'  => $this->price,
                'transfer_fee'  => $this->transfer_fee
            ]);
        }
}
