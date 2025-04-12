<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GoicuocDetail;

class GoicuocDetailSeeder extends Seeder
{
    public function run()
    {
        $details = [
            // Gói VoIP 1313 - TQT9 (id 54)
            [
                'goicuoc_id' => 54,
                'key' => 'Phạm vi áp dụng',
                'value' => 'Toàn cầu (trừ một số quốc gia bị hạn chế)'
            ],
            [
                'goicuoc_id' => 54,
                'key' => 'Ưu đãi',
                'value' => 'Miễn phí 100 phút gọi quốc tế, 100 tin nhắn quốc tế'
            ],
            [
                'goicuoc_id' => 54,
                'key' => 'Thời hạn',
                'value' => '30 ngày kể từ ngày kích hoạt'
            ],
            [
                'goicuoc_id' => 54,
                'key' => 'Điều kiện',
                'value' => 'Áp dụng cho thuê bao trả trước và trả sau'
            ],
            [
                'goicuoc_id' => 54,
                'key' => 'Cách đăng ký',
                'value' => 'Soạn DK TQT9 gửi 1313'
            ],

            // Gói VoIP 1313 - TQT19 (id 55)
            [
                'goicuoc_id' => 55,
                'key' => 'Phạm vi áp dụng',
                'value' => 'Toàn cầu (ưu tiên khu vực Châu Á)'
            ],
            [
                'goicuoc_id' => 55,
                'key' => 'Ưu đãi',
                'value' => 'Miễn phí 200 phút gọi quốc tế, 200 tin nhắn quốc tế'
            ],
            [
                'goicuoc_id' => 55,
                'key' => 'Dung lượng data',
                'value' => '2GB tốc độ cao, sau đó giảm tốc độ'
            ],
            [
                'goicuoc_id' => 55,
                'key' => 'Cách đăng ký',
                'value' => 'Soạn DK TQT19 gửi 1313'
            ],

            // Gói VoIP 1313 - TQT49 (id 56)
            [
                'goicuoc_id' => 56,
                'key' => 'Phạm vi áp dụng',
                'value' => 'Toàn cầu, ưu tiên Châu Á, Châu Âu'
            ],
            [
                'goicuoc_id' => 56,
                'key' => 'Ưu đãi',
                'value' => 'Miễn phí 500 phút gọi quốc tế, không giới hạn tin nhắn'
            ],
            [
                'goicuoc_id' => 56,
                'key' => 'Dung lượng data',
                'value' => '5GB tốc độ cao, sau đó giảm còn 256Kbps'
            ],
            [
                'goicuoc_id' => 56,
                'key' => 'Lưu ý',
                'value' => 'Không áp dụng cho các cuộc gọi video call'
            ],

            // Gói VoIP 1313 - TQT99 (id 57)
            [
                'goicuoc_id' => 57,
                'key' => 'Phạm vi áp dụng',
                'value' => 'Toàn cầu không giới hạn'
            ],
            [
                'goicuoc_id' => 57,
                'key' => 'Ưu đãi',
                'value' => 'Miễn phí 1000 phút gọi quốc tế, không giới hạn tin nhắn'
            ],
            [
                'goicuoc_id' => 57,
                'key' => 'Dung lượng data',
                'value' => '10GB tốc độ cao, sau đó giảm còn 512Kbps'
            ],
            [
                'goicuoc_id' => 57,
                'key' => 'Đặc biệt',
                'value' => 'Tặng thêm 2GB data khi sử dụng tại Châu Âu'
            ],

            // Gói VoIP 1313 - TQT199 (id 58)
            [
                'goicuoc_id' => 58,
                'key' => 'Phạm vi áp dụng',
                'value' => 'Toàn cầu premium'
            ],
            [
                'goicuoc_id' => 58,
                'key' => 'Ưu đãi',
                'value' => 'Không giới hạn phút gọi quốc tế'
            ],
            [
                'goicuoc_id' => 58,
                'key' => 'Dung lượng data',
                'value' => '20GB tốc độ cao, sau đó giảm còn 1Mbps'
            ],
            [
                'goicuoc_id' => 58,
                'key' => 'Đặc quyền',
                'value' => 'Hỗ trợ 24/7 tại tất cả các quốc gia'
            ],

            // Gói VoIP 1313 - TQT299 (id 59)
            [
                'goicuoc_id' => 59,
                'key' => 'Phạm vi áp dụng',
                'value' => 'Toàn cầu cao cấp'
            ],
            [
                'goicuoc_id' => 59,
                'key' => 'Ưu đãi',
                'value' => 'Không giới hạn phút gọi và tin nhắn quốc tế'
            ],
            [
                'goicuoc_id' => 59,
                'key' => 'Dung lượng data',
                'value' => '30GB tốc độ cao, sau đó giảm còn 2Mbps'
            ],
            [
                'goicuoc_id' => 59,
                'key' => 'Đặc quyền',
                'value' => 'Ưu tiên kết nối, hỗ trợ riêng tại tất cả các quốc gia'
            ],

            // Gói Combo Hàn Quốc 1 (id 60)
            [
                'goicuoc_id' => 60,
                'key' => 'Phạm vi áp dụng',
                'value' => 'Hàn Quốc'
            ],
            [
                'goicuoc_id' => 60,
                'key' => 'Ưu đãi',
                'value' => '100 phút gọi về Việt Nam, 100 tin nhắn'
            ],
            [
                'goicuoc_id' => 60,
                'key' => 'Dung lượng data',
                'value' => '2GB tốc độ cao'
            ],
            [
                'goicuoc_id' => 60,
                'key' => 'Thời hạn',
                'value' => '7 ngày'
            ],

            // Gói Combo Hàn Quốc 2 (id 61)
            [
                'goicuoc_id' => 61,
                'key' => 'Phạm vi áp dụng',
                'value' => 'Hàn Quốc'
            ],
            [
                'goicuoc_id' => 61,
                'key' => 'Ưu đãi',
                'value' => '200 phút gọi về Việt Nam, không giới hạn tin nhắn'
            ],
            [
                'goicuoc_id' => 61,
                'key' => 'Dung lượng data',
                'value' => '5GB tốc độ cao'
            ],
            [
                'goicuoc_id' => 61,
                'key' => 'Thời hạn',
                'value' => '14 ngày'
            ],

            // Gói MobiF MF199QT (id 62)
            [
                'goicuoc_id' => 62,
                'key' => 'Phạm vi áp dụng',
                'value' => 'Trong nước và quốc tế'
            ],
            [
                'goicuoc_id' => 62,
                'key' => 'Ưu đãi',
                'value' => '1000 phút gọi nội mạng, 100 phút gọi quốc tế'
            ],
            [
                'goicuoc_id' => 62,
                'key' => 'Dung lượng data',
                'value' => '4GB tốc độ cao'
            ],
            [
                'goicuoc_id' => 62,
                'key' => 'Khuyến mãi',
                'value' => 'Tặng thêm 1GB data khi đăng ký lần đầu'
            ],

            // Gói MobiF MF149QT (id 63)
            [
                'goicuoc_id' => 63,
                'key' => 'Phạm vi áp dụng',
                'value' => 'Trong nước và quốc tế'
            ],
            [
                'goicuoc_id' => 63,
                'key' => 'Ưu đãi',
                'value' => '500 phút gọi nội mạng, 50 phút gọi quốc tế'
            ],
            [
                'goicuoc_id' => 63,
                'key' => 'Dung lượng data',
                'value' => '3GB tốc độ cao'
            ],
            [
                'goicuoc_id' => 63,
                'key' => 'Khuyến mãi',
                'value' => 'Tặng 500MB data khi đăng ký lần đầu'
            ],

            // Gói MobiF MF99QT (id 64)
            [
                'goicuoc_id' => 64,
                'key' => 'Phạm vi áp dụng',
                'value' => 'Trong nước và quốc tế'
            ],
            [
                'goicuoc_id' => 64,
                'key' => 'Ưu đãi',
                'value' => '300 phút gọi nội mạng, 30 phút gọi quốc tế'
            ],
            [
                'goicuoc_id' => 64,
                'key' => 'Dung lượng data',
                'value' => '2GB tốc độ cao'
            ],
            [
                'goicuoc_id' => 64,
                'key' => 'Khuyến mãi',
                'value' => 'Tặng 300MB data khi đăng ký lần đầu'
            ],

            // Gói FClass (id 65)
            [
                'goicuoc_id' => 65,
                'key' => 'Đối tượng',
                'value' => 'Doanh nghiệp nhỏ (dưới 10 thuê bao)'
            ],
            [
                'goicuoc_id' => 65,
                'key' => 'Ưu đãi',
                'value' => 'Miễn phí gọi nội bộ doanh nghiệp'
            ],
            [
                'goicuoc_id' => 65,
                'key' => 'Dung lượng data',
                'value' => '10GB/thuê bao'
            ],
            [
                'goicuoc_id' => 65,
                'key' => 'Hỗ trợ',
                'value' => 'Hotline riêng cho doanh nghiệp'
            ],

            // Gói BClass (id 66)
            [
                'goicuoc_id' => 66,
                'key' => 'Đối tượng',
                'value' => 'Doanh nghiệp vừa (10-50 thuê bao)'
            ],
            [
                'goicuoc_id' => 66,
                'key' => 'Ưu đãi',
                'value' => 'Miễn phí gọi nội bộ và gọi 1000 số hotline'
            ],
            [
                'goicuoc_id' => 66,
                'key' => 'Dung lượng data',
                'value' => '20GB/thuê bao'
            ],
            [
                'goicuoc_id' => 66,
                'key' => 'Hỗ trợ',
                'value' => 'Nhân viên hỗ trợ riêng'
            ],

            // Gói EClass_1 (id 67)
            [
                'goicuoc_id' => 67,
                'key' => 'Đối tượng',
                'value' => 'Doanh nghiệp lớn (50-200 thuê bao)'
            ],
            [
                'goicuoc_id' => 67,
                'key' => 'Ưu đãi',
                'value' => 'Không giới hạn gọi nội bộ, 5000 phút gọi di động'
            ],
            [
                'goicuoc_id' => 67,
                'key' => 'Dung lượng data',
                'value' => '30GB/thuê bao'
            ],
            [
                'goicuoc_id' => 67,
                'key' => 'Hỗ trợ',
                'value' => 'Nhân viên hỗ trợ 24/7'
            ],

            // Gói NClass (id 68)
            [
                'goicuoc_id' => 68,
                'key' => 'Đối tượng',
                'value' => 'Tập đoàn (trên 200 thuê bao)'
            ],
            [
                'goicuoc_id' => 68,
                'key' => 'Ưu đãi',
                'value' => 'Không giới hạn gọi nội bộ và di động'
            ],
            [
                'goicuoc_id' => 68,
                'key' => 'Dung lượng data',
                'value' => '50GB/thuê bao'
            ],
            [
                'goicuoc_id' => 68,
                'key' => 'Hỗ trợ',
                'value' => 'Đội ngũ hỗ trợ chuyên dụng'
            ],

            // Gói Enterprise E329QT (id 69)
            [
                'goicuoc_id' => 69,
                'key' => 'Đối tượng',
                'value' => 'Doanh nghiệp có nhu cầu quốc tế'
            ],
            [
                'goicuoc_id' => 69,
                'key' => 'Ưu đãi',
                'value' => '100 phút gọi quốc tế, 1000 phút nội địa'
            ],
            [
                'goicuoc_id' => 69,
                'key' => 'Dung lượng data',
                'value' => '5GB quốc tế + 10GB nội địa'
            ],
            [
                'goicuoc_id' => 69,
                'key' => 'Hỗ trợ',
                'value' => 'Tư vấn giải pháp doanh nghiệp'
            ],

            // Gói Enterprise E229QT (id 70)
            [
                'goicuoc_id' => 70,
                'key' => 'Đối tượng',
                'value' => 'Doanh nghiệp nhỏ có nhu cầu quốc tế'
            ],
            [
                'goicuoc_id' => 70,
                'key' => 'Ưu đãi',
                'value' => '50 phút gọi quốc tế, 500 phút nội địa'
            ],
            [
                'goicuoc_id' => 70,
                'key' => 'Dung lượng data',
                'value' => '3GB quốc tế + 5GB nội địa'
            ],
            [
                'goicuoc_id' => 70,
                'key' => 'Hỗ trợ',
                'value' => 'Hotline doanh nghiệp'
            ],

            // Gói QTTK15 (id 71)
            [
                'goicuoc_id' => 71,
                'key' => 'Đối tượng',
                'value' => 'Thuê bao có nhu cầu sử dụng tối thiểu'
            ],
            [
                'goicuoc_id' => 71,
                'key' => 'Ưu đãi',
                'value' => 'Giữ số khi không có nhu cầu sử dụng nhiều'
            ],
            [
                'goicuoc_id' => 71,
                'key' => 'Dung lượng data',
                'value' => '500MB tốc độ thường'
            ],
            [
                'goicuoc_id' => 71,
                'key' => 'Lưu ý',
                'value' => 'Không bao gồm phút gọi, chỉ tính phí theo dung lượng sử dụng'
            ]
        ];

        foreach ($details as $detail) {
            GoicuocDetail::create($detail);
        }
    }
}