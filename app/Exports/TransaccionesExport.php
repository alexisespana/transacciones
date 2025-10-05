<?php

namespace App\Exports;

use App\Models\Transacciones\transacciones;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransaccionesExport implements FromCollection, WithMapping,WithCustomCsvSettings,WithHeadings
{
    public function collection()
    {
        return transacciones::with('emisor', 'receptor')->get();
    }
     public function headings(): array
    {
        return [
            'Nro',
            'Uusario Emisor',
            'Uusario Receptor',
            'Monto',
            'Fecha Transaccion',
        ];
    }

    /**
     * Mapear cada fila para formatear campos
     */
    public function map($transaccion): array
    {
        return [
            $transaccion->id,
            $transaccion->emisor->nombres,
            $transaccion->receptor->nombres,
            number_format($transaccion->monto, 2, ',', '.'), // Aquí formateamos con comas y 2 decimales
            $transaccion->fecha_transaccion,
        ];
    }
     public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';',
            // Opcional: 'enclosure' => '"', 'line_ending' => "\r\n", ...
        ];
    }
    }
