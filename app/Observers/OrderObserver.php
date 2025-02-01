<?php

namespace App\Observers;

use App\Models\Order;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order)
    {
        // Kiểm tra nếu trạng thái (trang_thai) của Order thay đổi
        if ($order->isDirty('trang_thai')) {
            // Lấy thông tin số thuê bao qua quan hệ
            $soThueBao = $order->soThueBao;

            // Nếu tồn tại số thuê bao, cập nhật trạng thái tương ứng
            if ($soThueBao) {
                $soThueBao->trang_thai = $order->trang_thai;
                $soThueBao->save();
            }
        }
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
