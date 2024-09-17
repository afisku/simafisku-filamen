<?php

namespace App\Exports;

use App\Models\SuratKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class SuratKeluarExport extends DefaultValueBinder implements FromCollection, WithMapping, WithHeadings, WithCustomValueBinder, WithColumnFormatting, ShouldAutoSize, WithEvents
{
    protected $total_data;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = SuratKeluar::all();

        $this->total_data = (string) ($data->count() + 1);

        return $data;
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        return parent::bindValue($cell, $value);
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'G' => NumberFormat::FORMAT_TEXT,

        ];
    }

    public function map($data): array
    {
        $result = [
            'no_surat'          => $data->no_surat,
            'kategori'          => $data->kategoriSurat->kategori,
            'tgl_surat_keluar'  => $data->tgl_surat_keluar,
            'perihal'           => $data->perihal,
            'tujuan_pengiriman' => $data->tujuan_pengiriman,
            'dibuat_oleh'       => $data->dibuatOleh->name,
            'tahunAjaran'       => $data->tahunAjaran->ta,
        ];

        return $result;
    }

    public function headings(): array
    {
        return [
            'NO SURAT',
            'KATEGORI',
            'TGL SURAT KELUAR',
            'PERIHAL',
            'TUJUAN PENGIRIMAN',
            'DIBUAT OLEH',
            'TAHUN AJARAN',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // header
                $event->sheet->styleCells(
                    'A1:G1',
                    [
                        'font' => [
                            'name'  =>  'Calibri',
                            'size'  =>  13,
                            'bold'  =>  true,
                            'color' => ['rgb' => 'ffffff'],

                        ],

                        'alignment' => [
                            'vertical' => Alignment::VERTICAL_CENTER,
                        ],

                        'fill' => [
                            'fillType'      => Fill::FILL_SOLID,
                            'startColor'    => ['rgb' => '6AA84F']
                        ],

                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['rgb' => 'ffffff'],
                            ],
                        ],
                    ]
                );

                // border data
                $event->sheet->styleCells(
                    'A2:G' . $this->total_data,
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['rgb' => '000000'],
                            ],
                        ],
                    ]
                );
                // Center align columns
                $centerColumns = ['C', 'G'];
                foreach ($centerColumns as $column) {
                    $event->sheet->getStyle("{$column}2:{$column}{$this->total_data}")->getAlignment()->setHorizontal('center');
                }

                // header
                $event->sheet->getRowDimension(1)->setRowHeight(100);
                $event->sheet->getStyle('A1:H1')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'font' => [
                        'bold' => true,
                    ],
                ]);
                // $event->sheet->getStyle('AG1:AX1')->getAlignment()->setWrapText(true);
                // $event->sheet->getColumnDimension('AE')->setAutoSize(false)->setWidth(32);
                // $event->sheet->getColumnDimension('AG')->setAutoSize(false)->setWidth(32);
                // $event->sheet->getColumnDimension('AH')->setAutoSize(false)->setWidth(32);
                // $event->sheet->getColumnDimension('AI')->setAutoSize(false)->setWidth(32);
                // $event->sheet->getColumnDimension('AJ')->setAutoSize(false)->setWidth(32);
                // $event->sheet->getColumnDimension('AK')->setAutoSize(false)->setWidth(32);
                // $event->sheet->getColumnDimension('AL')->setAutoSize(false)->setWidth(32);
                // $event->sheet->getColumnDimension('AM')->setAutoSize(false)->setWidth(32);
                // $event->sheet->getColumnDimension('AN')->setAutoSize(false)->setWidth(32);
                // $event->sheet->getColumnDimension('AO')->setAutoSize(false)->setWidth(32);
                // $event->sheet->getColumnDimension('AP')->setAutoSize(false)->setWidth(32);
                // $event->sheet->getColumnDimension('AQ')->setAutoSize(false)->setWidth(32);
                // $event->sheet->getColumnDimension('AR')->setAutoSize(false)->setWidth(32);
                // $event->sheet->getColumnDimension('AS')->setAutoSize(false)->setWidth(32);
                // $event->sheet->getColumnDimension('AT')->setAutoSize(false)->setWidth(32);
                // $event->sheet->getColumnDimension('AU')->setAutoSize(false)->setWidth(32);
                // $event->sheet->getColumnDimension('AV')->setAutoSize(false)->setWidth(32);
                // $event->sheet->getColumnDimension('AW')->setAutoSize(false)->setWidth(32);
                // $event->sheet->getColumnDimension('AX')->setAutoSize(false)->setWidth(32);

                // $event->sheet->styleCells('AG1:AX2')->getAlignment()->setWrapText(true);
            },
        ];
    }
}
