<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Settlement2SendMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user_1;
    protected $user_2;
    protected $now;
    protected $item;
    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_1, $user_2, $now, $item, $data)
    {
        $this->my_name = $user_2;
        $this->your_name = $user_1;
        $this->now = $now;
        $this->title = $item['title'];
        $this->item_id = $item['id'];
        $this->price = $data['price'];
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
            ->subject('manabee|投稿中の動画が購入されました。')
            ->view('settlement.mail2')
            ->with([
                'my_name' => $this->my_name,
                'your_name' => $this->your_name,
                'now'  => $this->now,
                'title'  => $this->title,
                'item_id'  => $this->item_id,
                'price'  => $this->price,
            ]);
    }
}
