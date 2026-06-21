<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GoicuocDetail;
use App\Models\GoiCuoc;

class GoicuocDetailSeeder extends Seeder
{
    public function run()
    {
        // Lấy danh sách gói cước theo tên để lấy ID thực tế
        $goiCuocMap = GoiCuoc::all()->pluck('id', 'ten_goicuoc');

        $details = [];

        // Gói VoIP 1313 - TQT9
        if (isset($goiCuocMap['VoIP 1313 - TQT9'])) {
            $id = $goiCuocMap['VoIP 1313 - TQT9'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Toàn cầu (trừ một số quốc gia bị hạn chế)'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Miễn phí 100 phút gọi quốc tế, 100 tin nhắn quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày kể từ ngày kích hoạt'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Điều kiện', 'value' => 'Áp dụng cho thuê bao trả trước và trả sau'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Cách đăng ký', 'value' => 'Soạn DK TQT9 gửi 1313'];
        }

        // Gói VoIP 1313 - TQT19
        if (isset($goiCuocMap['VoIP 1313 - TQT19'])) {
            $id = $goiCuocMap['VoIP 1313 - TQT19'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Toàn cầu (ưu tiên khu vực Châu Á)'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Miễn phí 200 phút gọi quốc tế, 200 tin nhắn quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '2GB tốc độ cao, sau đó giảm tốc độ'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Cách đăng ký', 'value' => 'Soạn DK TQT19 gửi 1313'];
        }

        // Gói VoIP 1313 - TQT49
        if (isset($goiCuocMap['VoIP 1313 - TQT49'])) {
            $id = $goiCuocMap['VoIP 1313 - TQT49'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Toàn cầu, ưu tiên Châu Á, Châu Âu'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Miễn phí 500 phút gọi quốc tế, không giới hạn tin nhắn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '5GB tốc độ cao, sau đó giảm còn 256Kbps'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Lưu ý', 'value' => 'Không áp dụng cho các cuộc gọi video call'];
        }

        // Gói VoIP 1313 - TQT99
        if (isset($goiCuocMap['VoIP 1313 - TQT99'])) {
            $id = $goiCuocMap['VoIP 1313 - TQT99'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Toàn cầu không giới hạn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Miễn phí 1000 phút gọi quốc tế, không giới hạn tin nhắn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '10GB tốc độ cao, sau đó giảm còn 512Kbps'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đặc biệt', 'value' => 'Tặng thêm 2GB data khi sử dụng tại Châu Âu'];
        }

        // Gói VoIP 1313 - TQT199
        if (isset($goiCuocMap['VoIP 1313 - TQT199'])) {
            $id = $goiCuocMap['VoIP 1313 - TQT199'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Toàn cầu premium'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Không giới hạn phút gọi quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '20GB tốc độ cao, sau đó giảm còn 1Mbps'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đặc quyền', 'value' => 'Hỗ trợ 24/7 tại tất cả các quốc gia'];
        }

        // Gói VoIP 1313 - TQT299
        if (isset($goiCuocMap['VoIP 1313 - TQT299'])) {
            $id = $goiCuocMap['VoIP 1313 - TQT299'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Toàn cầu cao cấp'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Không giới hạn phút gọi và tin nhắn quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '30GB tốc độ cao, sau đó giảm còn 2Mbps'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đặc quyền', 'value' => 'Ưu tiên kết nối, hỗ trợ riêng tại tất cả các quốc gia'];
        }

        // Gói Combo Hàn Quốc 1
        if (isset($goiCuocMap['Combo Hàn Quốc 1'])) {
            $id = $goiCuocMap['Combo Hàn Quốc 1'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Hàn Quốc'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '100 phút gọi về Việt Nam, 100 tin nhắn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '2GB tốc độ cao'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '7 ngày'];
        }

        // Gói Combo Hàn Quốc 2
        if (isset($goiCuocMap['Combo Hàn Quốc 2'])) {
            $id = $goiCuocMap['Combo Hàn Quốc 2'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Hàn Quốc'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '200 phút gọi về Việt Nam, không giới hạn tin nhắn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '5GB tốc độ cao'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '14 ngày'];
        }

        // Gói MobiF MF199QT
        if (isset($goiCuocMap['Gói MobiF MF199QT'])) {
            $id = $goiCuocMap['Gói MobiF MF199QT'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Trong nước và quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '1000 phút gọi nội mạng, 100 phút gọi quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '4GB tốc độ cao'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Khuyến mãi', 'value' => 'Tặng thêm 1GB data khi đăng ký lần đầu'];
        }

        // Gói MobiF MF149QT
        if (isset($goiCuocMap['Gói MobiF MF149QT'])) {
            $id = $goiCuocMap['Gói MobiF MF149QT'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Trong nước và quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '500 phút gọi nội mạng, 50 phút gọi quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '3GB tốc độ cao'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Khuyến mãi', 'value' => 'Tặng 500MB data khi đăng ký lần đầu'];
        }

        // Gói MobiF MF99QT
        if (isset($goiCuocMap['Gói MobiF MF99QT'])) {
            $id = $goiCuocMap['Gói MobiF MF99QT'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Trong nước và quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '300 phút gọi nội mạng, 30 phút gọi quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '2GB tốc độ cao'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Khuyến mãi', 'value' => 'Tặng 300MB data khi đăng ký lần đầu'];
        }

        // Gói FClass
        if (isset($goiCuocMap['Gói FClass'])) {
            $id = $goiCuocMap['Gói FClass'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Doanh nghiệp nhỏ (dưới 10 thuê bao)'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Miễn phí gọi nội bộ doanh nghiệp'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '10GB/thuê bao'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Hỗ trợ', 'value' => 'Hotline riêng cho doanh nghiệp'];
        }

        // Gói BClass
        if (isset($goiCuocMap['Gói BClass'])) {
            $id = $goiCuocMap['Gói BClass'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Doanh nghiệp vừa (10-50 thuê bao)'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Miễn phí gọi nội bộ và gọi 1000 số hotline'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '20GB/thuê bao'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Hỗ trợ', 'value' => 'Nhân viên hỗ trợ riêng'];
        }

        // Gói EClass_1
        if (isset($goiCuocMap['Gói EClass_1'])) {
            $id = $goiCuocMap['Gói EClass_1'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Doanh nghiệp lớn (50-200 thuê bao)'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Không giới hạn gọi nội bộ, 5000 phút gọi di động'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '30GB/thuê bao'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Hỗ trợ', 'value' => 'Nhân viên hỗ trợ 24/7'];
        }

        // Gói NClass
        if (isset($goiCuocMap['Gói NClass'])) {
            $id = $goiCuocMap['Gói NClass'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Tập đoàn (trên 200 thuê bao)'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Không giới hạn gọi nội bộ và di động'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '50GB/thuê bao'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Hỗ trợ', 'value' => 'Đội ngũ hỗ trợ chuyên dụng'];
        }

        // Gói Enterprise E329QT
        if (isset($goiCuocMap['Gói Enterprise E329QT'])) {
            $id = $goiCuocMap['Gói Enterprise E329QT'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Doanh nghiệp có nhu cầu quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '100 phút gọi quốc tế, 1000 phút nội địa'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '5GB quốc tế + 10GB nội địa'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Hỗ trợ', 'value' => 'Tư vấn giải pháp doanh nghiệp'];
        }

        // Gói Enterprise E229QT
        if (isset($goiCuocMap['Gói Enterprise E229QT'])) {
            $id = $goiCuocMap['Gói Enterprise E229QT'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Doanh nghiệp nhỏ có nhu cầu quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '50 phút gọi quốc tế, 500 phút nội địa'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '3GB quốc tế + 5GB nội địa'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Hỗ trợ', 'value' => 'Hotline doanh nghiệp'];
        }

        // Gói QTTK15
        if (isset($goiCuocMap['Gói QTTK15'])) {
            $id = $goiCuocMap['Gói QTTK15'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Thuê bao có nhu cầu sử dụng tối thiểu'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Giữ số khi không có nhu cầu sử dụng nhiều'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '500MB tốc độ thường'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Lưu ý', 'value' => 'Không bao gồm phút gọi, chỉ tính phí theo dung lượng sử dụng'];
        }

        foreach ($details as $detail) {
            GoicuocDetail::create($detail);
        }
    }
}
