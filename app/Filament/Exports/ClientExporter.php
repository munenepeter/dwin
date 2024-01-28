<?php

namespace App\Filament\Exports;

use App\Models\Client;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class ClientExporter extends Exporter
{
    protected static ?string $model = Client::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('insurance_id'),
            ExportColumn::make('underwriter_id'),
            ExportColumn::make('full_names'),
            ExportColumn::make('policy_number'),
            ExportColumn::make('risk_id'),
            ExportColumn::make('rate'),
            ExportColumn::make('sum_insured'),
            ExportColumn::make('political_risk'),
            ExportColumn::make('excess_protector'),
            ExportColumn::make('basic_premium'),
            ExportColumn::make('annual_total_premium'),
            ExportColumn::make('annual_expiry_date'),
            ExportColumn::make('annual_renewal_date'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your client export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
