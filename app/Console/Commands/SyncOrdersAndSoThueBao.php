<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncOrdersAndSoThueBao extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-orders-and-so-thue-bao';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orders = \App\Models\Order::all();
        foreach ($orders as $order) {
            $soThueBao = $order->soThueBao;
            if ($soThueBao) {
                $soThueBao->trang_thai = $order->trang_thai;
                $soThueBao->save();
            }
        }
        $this->info('Đồng bộ trạng thái giữa orders và so_thue_bao thành công.');
    }
    
}
