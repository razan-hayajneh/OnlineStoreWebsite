<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportProduct  implements FromView,WithEvents
{
    private $products=[];

        public function __construct($products)
        {
            $this->products = $products;
        }

        public function view(): View
        {
            return view('products.excel')
                ->with(['products' => $this->products ]);
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
