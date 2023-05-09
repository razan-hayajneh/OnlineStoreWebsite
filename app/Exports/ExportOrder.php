<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportOrder  implements FromView, WithEvents
{
    protected $orders;
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct($orders)
    {
        $this->orders = $orders;

        // dd($roles);
    }

    public function view(): View
    {
        return view('orders.excel')
            ->with(['orders' => $this->orders]);
    }
    public function registerEvents(): array
    {
        $lang = app()->getLocale();
        if ($lang == 'ar') {
            return [
                AfterSheet::class    => function (AfterSheet $event) {
                    $event->sheet->getDelegate()->setRightToLeft(true);
                },
            ];
        } else {
            return [
                AfterSheet::class    => function (AfterSheet $event) {
                    $event->sheet->getDelegate()->setRightToLeft(false);
                },
            ];
        }
    }
}
