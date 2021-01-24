<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class StudentNewOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $order;
    public $invoice;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $student, Order $order)
    {
        $this->student = $student;
        $this->order = $order;
        $this->invoice = $this->student->findInvoice($this->order->invoice_id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        $vendor = config('app.name');
        $product = "Compra de cursos";
        $invoice = $this->invoice;
        $owner = $this->student;
        $pdf = \PDF::loadview('vendor.cashier.receipt', compact('invoice', 'product', 'owner', 'vendor'));
        return $this
            ->attachData($pdf->output(), $this->invoice->id . '-' . date('d-m-Y') . '.pdf', ['mime' => 'application/pdf'])
            ->subject('Gracias por tu pedido - ' . config('app.name'))
            ->markdown('emails.students.new_order');
    }
}
