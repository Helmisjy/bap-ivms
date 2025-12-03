<?php

namespace App\Filament\Resources\InvoiceTrackings\Widgets;

use App\Models\InvoiceTracking;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Widget;

class InvoiceTrackingStats extends StatsOverviewWidget
{
    // protected function getStats(): array
    // {
    //     return [
            
    //     ];
    // }
    public ?string $filter = 'today'; // default

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'this_month' => 'This Month',
            'this_year' => 'This Year',
        ];
    }

    protected function getStats(): array
    {
        // ========== HITUNG OVERDUE ==========
        // Overdue = inv_target < today - 1 day
        // $overdueCount = InvoiceTracking::whereDate('inv_target', '<', now()->subDay())->count();

        // $overdueAmount = InvoiceTracking::whereDate('inv_target', '<', now()->subDay())
        //                 ->sum('amount');

        // ========== HITUNG PAID ==========
        // $paidAmount = InvoiceTracking::where('payment_status', 'paid')->sum('amount');

        $totalOverdueInvoices = InvoiceTracking::where('payment_status', 'unpaid')
            ->where('aging_days', '>', 0)   // overdue
            ->count();

        $totalOverdueAmount = InvoiceTracking::where('payment_status', 'unpaid')
            ->where('aging_days', '>', 0)
            ->sum('amount');

        $totalPaidAmount = InvoiceTracking::where('payment_status', 'paid')
            ->sum('amount');

        return [
            Stat::make('Overdue Invoices', number_format($totalOverdueInvoices))
                ->description('Total overdue invoices')
                ->descriptionColor('danger'),

            Stat::make(
                'Overdue Amount',
                'Rp ' . number_format($totalOverdueAmount, 0, ',', '.')
            )
                ->description('Total overdue amount')
                ->descriptionColor('warning'),

            Stat::make(
                'Paid Amount',
                'Rp ' . number_format($totalPaidAmount, 0, ',', '.')
            )
                ->description('Total paid amount')
                ->descriptionColor('success'),
        ];
    }
}
