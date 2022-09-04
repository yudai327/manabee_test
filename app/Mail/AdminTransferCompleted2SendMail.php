<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminTransferCompleted2SendMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $transfer;
    protected $bank;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $transfer, $bank)
    {
        $this->user_name = $user['nickname'];
        $this->bank_name = $bank['bank_name'];
        $this->branch_name = $bank['branch_name'];
        $this->deposit_type = $bank['deposit_type'];
        $this->bank_num = $bank['bank_num'];
        $this->name = $bank['name'];
        $this->price = $transfer['price'];
        $this->transfer_fee = $transfer['transfer_fee'];
        $this->transfer_fee_real = $transfer['transfer_fee_real'];
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
            ->subject('振り込み完了しました')
            ->view('admin.transfer.mail2')
            ->with([
                'user_name' => $this->user_name,
                'bank_name' => $this->bank_name,
                'branch_name' => $this->branch_name,
                'deposit_type'  => $this->deposit_type,
                'bank_num'  => $this->bank_num,
                'name'  => $this->name,
                'price'  => $this->price,
                'transfer_fee'  => $this->transfer_fee,
                'transfer_fee_real'  => $this->transfer_fee_real,
            ]);
    }
}
