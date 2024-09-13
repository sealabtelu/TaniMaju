<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\ChartWidget;

// use Filament\Support\Enums\IconPosition;

class StatsAdminOverview extends BaseWidget
{
    
    protected static ?string $pollingInterval = '360s';
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            
            // Widget 1: Website Engagement
            Stat::make('Website Engagement', DB::table('fblog_comments')->count())
                ->description('Jumlah Komen')
                ->chart(
                    DB::table('fblog_comments')
                        ->select(DB::raw('COUNT(*) as count'), DB::raw('DATE(created_at) as date'))
                        ->groupBy(DB::raw('DATE(created_at)'))  // Ensure proper grouping by date
                        ->orderBy('date', 'asc')
                        ->pluck('count')
                        ->toArray()
                )
                ->color('primary'),
            
            Stat::make('Total Petani', DB::table('petanis')->count())
                ->description('Jumlah Petani Saat Ini')
                ->chart(
                    DB::table('petanis')
                        ->select(DB::raw('COUNT(*) as count'), DB::raw('DATE(created_at) as date'))
                        ->groupBy('date')
                        ->orderBy('date', 'asc')  // Now ordering by the grouped 'date'
                        ->pluck('count')
                        ->toArray()
                )
                ->color('success'),

            Stat::make('Total Sawah', DB::table('sawahs')->count())
                ->description('Jumlah Sawah Saat Ini')
                ->chart(
                    DB::table('sawahs')
                        ->select(DB::raw('COUNT(*) as count'), DB::raw('DATE(created_at) as date'))
                        ->groupBy('date')
                        ->orderBy('date', 'asc')  // Now ordering by the grouped 'date'
                        ->pluck('count')
                        ->toArray()
                )
                ->color('success'),
        ];
    }
}

// class HarvestAdminOverview extends ChartWidget
// {
//     protected static ?string $heading = 'Blog Posts';
 
//     protected function getData(): array
//     {
//         return [
//             'datasets' => [
//                 [
//                     'label' => 'Blog posts created',
//                     'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
//                 ],
//             ],
//             'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
//         ];
//     }

//     protected function getType(): string
//     {
//         return 'line';
//     }
// }