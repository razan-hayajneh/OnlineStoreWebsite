<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportCategory  implements FromView,WithEvents
{
   private  $categories;

        public function __construct($categories)
        {
            $this->categories = $categories;

            // dd($roles);
        }

        public function view(): View
        {
            return view('categories.excel')
                ->with(['categories' => $this->categories ]);
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
