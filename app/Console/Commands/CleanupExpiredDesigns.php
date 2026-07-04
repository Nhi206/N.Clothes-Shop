<?php

namespace App\Console\Commands;

use App\Models\Design;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanupExpiredDesigns extends Command
{
    protected $signature = 'design:cleanup';
    protected $description = 'Xóa file thiết kế đã hết hạn 7 ngày sau khi giao hàng thành công';

    public function handle()
    {
        $designs = Design::whereNotNull('expired_at')
            ->where('expired_at', '<=', now())
            ->get();

        $count = 0;

        foreach ($designs as $design) {
            if ($design->preview_image && Storage::disk('public')->exists($design->preview_image)) {
                Storage::disk('public')->delete($design->preview_image);
            }

            $design->delete();
            $count++;
        }

        $this->info("Đã xóa {$count} thiết kế hết hạn.");

        return 0;
    }
}
