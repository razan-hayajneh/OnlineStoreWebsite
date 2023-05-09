<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class OptionKeyExport implements FromView, WithEvents
{
   /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($optionKeys,$option)
    {
        $this->optionKeys = $optionKeys;
        $this->option = $option;

        // dd($roles);
    }

    public function view(): View
    {
        return view('option_keys.excel')
            ->with(['optionKeys' => $this->optionKeys , 'option' => $this->option ]);
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
