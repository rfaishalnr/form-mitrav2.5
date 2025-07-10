<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\MitraPendaftaran;
use App\Models\BoqLine;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Stat::make('Total Mitra', MitraPendaftaran::count())
            //     ->description('Jumlah mitra yang telah didaftarkan')
            //     ->color('primary'),

            // Stat::make('Total Lokasi BOQ', BoqLine::count())
            //     ->description('Jumlah seluruh baris lokasi pekerjaan di BOQ')
            //     ->color('success'),

            // Stat::make('Total Nilai REKON', 'Rp ' . number_format(BoqLine::sum('rekon_total'), 0, ',', '.'))
            //     ->description('Akumulasi nilai REKON total')
            //     ->color('info'),

            // Stat::make('Total Nilai SP', 'Rp ' . number_format(
            //     BoqLine::sum('sp_material') + BoqLine::sum('sp_jasa'), 0, ',', '.'
            // ))
            //     ->description('Total nilai SP (Material + Jasa)')
            //     ->color('warning'),

            // Stat::make('Rata-rata PPN', number_format(MitraPendaftaran::avg('ppn_percent'), 2) . '%')
            //     ->description('PPN rata-rata semua mitra')
            //     ->color('gray'),
        ];
    }
}
