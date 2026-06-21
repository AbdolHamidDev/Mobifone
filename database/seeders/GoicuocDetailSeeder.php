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

        // ==================== CHI TIẾT GÓI THOẠI QUỐC TẾ ====================
        
        // VoIP 1313 - TQT9
        if (isset($goiCuocMap['VoIP 1313 - TQT9'])) {
            $id = $goiCuocMap['VoIP 1313 - TQT9'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Toàn cầu (trừ một số quốc gia bị hạn chế)'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Miễn phí 100 phút gọi quốc tế, 100 tin nhắn quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày kể từ ngày kích hoạt'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Điều kiện', 'value' => 'Áp dụng cho thuê bao trả trước và trả sau'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Cách đăng ký', 'value' => 'Soạn DK TQT9 gửi 1313'];
        }

        // VoIP 1313 - TQT19
        if (isset($goiCuocMap['VoIP 1313 - TQT19'])) {
            $id = $goiCuocMap['VoIP 1313 - TQT19'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Toàn cầu (ưu tiên khu vực Châu Á)'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Miễn phí 200 phút gọi quốc tế, 200 tin nhắn quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '2GB tốc độ cao, sau đó giảm tốc độ'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Cách đăng ký', 'value' => 'Soạn DK TQT19 gửi 1313'];
        }

        // VoIP 1313 - TQT49
        if (isset($goiCuocMap['VoIP 1313 - TQT49'])) {
            $id = $goiCuocMap['VoIP 1313 - TQT49'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Toàn cầu, ưu tiên Châu Á, Châu Âu'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Miễn phí 500 phút gọi quốc tế, không giới hạn tin nhắn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '5GB tốc độ cao, sau đó giảm còn 256Kbps'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Lưu ý', 'value' => 'Không áp dụng cho các cuộc gọi video call'];
        }

        // VoIP 1313 - TQT99
        if (isset($goiCuocMap['VoIP 1313 - TQT99'])) {
            $id = $goiCuocMap['VoIP 1313 - TQT99'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Toàn cầu không giới hạn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Miễn phí 1000 phút gọi quốc tế, không giới hạn tin nhắn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '10GB tốc độ cao, sau đó giảm còn 512Kbps'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đặc biệt', 'value' => 'Tặng thêm 2GB data khi sử dụng tại Châu Âu'];
        }

        // VoIP 1313 - TQT199
        if (isset($goiCuocMap['VoIP 1313 - TQT199'])) {
            $id = $goiCuocMap['VoIP 1313 - TQT199'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Toàn cầu premium'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Không giới hạn phút gọi quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '20GB tốc độ cao, sau đó giảm còn 1Mbps'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đặc quyền', 'value' => 'Hỗ trợ 24/7 tại tất cả các quốc gia'];
        }

        // VoIP 1313 - TQT299
        if (isset($goiCuocMap['VoIP 1313 - TQT299'])) {
            $id = $goiCuocMap['VoIP 1313 - TQT299'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Toàn cầu cao cấp'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Không giới hạn phút gọi và tin nhắn quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '30GB tốc độ cao, sau đó giảm còn 2Mbps'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đặc quyền', 'value' => 'Ưu tiên kết nối, hỗ trợ riêng tại tất cả các quốc gia'];
        }

        // Gói Roaming Châu Á
        if (isset($goiCuocMap['Gói Roaming Châu Á'])) {
            $id = $goiCuocMap['Gói Roaming Châu Á'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Châu Á (Nhật, Hàn, Trung Quốc, Đông Nam Á)'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '50 phút gọi quốc tế, 100 tin nhắn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '3GB tốc độ cao trong 7 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '150.000 VNĐ'];
        }

        // Gói Roaming Châu Âu
        if (isset($goiCuocMap['Gói Roaming Châu Âu'])) {
            $id = $goiCuocMap['Gói Roaming Châu Âu'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Châu Âu (EU, UK, Thụy Sĩ)'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '200 phút gọi quốc tế, không giới hạn tin nhắn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '8GB tốc độ cao trong 15 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '450.000 VNĐ'];
        }

        // ==================== CHI TIẾT GÓI CHUYỂN VÙNG QUỐC TẾ ====================
        
        // Combo Hàn Quốc 1
        if (isset($goiCuocMap['Combo Hàn Quốc 1'])) {
            $id = $goiCuocMap['Combo Hàn Quốc 1'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Hàn Quốc'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '100 phút gọi về Việt Nam, 100 tin nhắn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '2GB tốc độ cao'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '7 ngày'];
        }

        // Combo Hàn Quốc 2
        if (isset($goiCuocMap['Combo Hàn Quốc 2'])) {
            $id = $goiCuocMap['Combo Hàn Quốc 2'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Hàn Quốc'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '200 phút gọi về Việt Nam, không giới hạn tin nhắn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '5GB tốc độ cao'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '14 ngày'];
        }

        // Combo Nhật Bản
        if (isset($goiCuocMap['Combo Nhật Bản'])) {
            $id = $goiCuocMap['Combo Nhật Bản'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Nhật Bản'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '150 phút gọi về Việt Nam, 200 tin nhắn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '6GB tốc độ cao'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '10 ngày'];
        }

        // Combo Mỹ - Canada
        if (isset($goiCuocMap['Combo Mỹ - Canada'])) {
            $id = $goiCuocMap['Combo Mỹ - Canada'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Mỹ và Canada'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '300 phút gọi quốc tế, không giới hạn tin nhắn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '10GB tốc độ cao'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '15 ngày'];
        }

        // Combo Châu Âu
        if (isset($goiCuocMap['Combo Châu Âu'])) {
            $id = $goiCuocMap['Combo Châu Âu'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Châu Âu (Schengen)'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Không giới hạn gọi và tin nhắn trong EU'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '12GB tốc độ cao'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '15 ngày'];
        }

        // ==================== CHI TIẾT GÓI COMBO TRONG NƯỚC ====================
        
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

        // Gói MobiF MF49QT
        if (isset($goiCuocMap['Gói MobiF MF49QT'])) {
            $id = $goiCuocMap['Gói MobiF MF49QT'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Trong nước'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '200 phút gọi nội mạng, 20 phút gọi quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '1GB tốc độ cao'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Khuyến mãi', 'value' => 'Tặng 100MB data khi đăng ký lần đầu'];
        }

        // Gói MobiF MF299QT
        if (isset($goiCuocMap['Gói MobiF MF299QT'])) {
            $id = $goiCuocMap['Gói MobiF MF299QT'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Phạm vi áp dụng', 'value' => 'Trong nước và quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '2000 phút gọi nội mạng, 200 phút gọi quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '6GB tốc độ cao'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Khuyến mãi', 'value' => 'Tặng 2GB data khi đăng ký lần đầu'];
        }

        // ==================== CHI TIẾT GÓI DOANH NGHIỆP ====================
        
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

        // Gói Enterprise E129QT
        if (isset($goiCuocMap['Gói Enterprise E129QT'])) {
            $id = $goiCuocMap['Gói Enterprise E129QT'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Doanh nghiệp mới thành lập'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '30 phút gọi quốc tế, 300 phút nội địa'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '2GB quốc tế + 3GB nội địa'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Hỗ trợ', 'value' => 'Email hỗ trợ'];
        }

        // ==================== CHI TIẾT GÓI TIẾT KIỆM ====================
        
        // Gói QTTK15
        if (isset($goiCuocMap['Gói QTTK15'])) {
            $id = $goiCuocMap['Gói QTTK15'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Thuê bao có nhu cầu sử dụng tối thiểu'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Giữ số khi không có nhu cầu sử dụng nhiều'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '500MB tốc độ thường'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Lưu ý', 'value' => 'Không bao gồm phút gọi, chỉ tính phí theo dung lượng sử dụng'];
        }

        // Gói QTTK30
        if (isset($goiCuocMap['Gói QTTK30'])) {
            $id = $goiCuocMap['Gói QTTK30'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Thuê bao tiết kiệm'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Giữ số, 100 phút gọi nội mạng'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '1GB tốc độ thường'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Lưu ý', 'value' => 'Phù hợp cho người ít sử dụng'];
        }

        // Gói QTTK90
        if (isset($goiCuocMap['Gói QTTK90'])) {
            $id = $goiCuocMap['Gói QTTK90'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Thuê bao tiết kiệm dài hạn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Giữ số, 300 phút gọi nội mạng, 50 phút quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '2GB tốc độ thường'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Lưu ý', 'value' => 'Tiết kiệm hơn khi mua gói 3 tháng'];
        }

        // ==================== CHI TIẾT GÓI HOT ====================
        
        // Gói HOT DATA 10GB
        if (isset($goiCuocMap['Gói HOT DATA 10GB'])) {
            $id = $goiCuocMap['Gói HOT DATA 10GB'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Người dùng cần data lớn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '10GB tốc độ cao, không giới hạn data'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '99.000 VNĐ'];
        }

        // Gói HOT DATA 20GB
        if (isset($goiCuocMap['Gói HOT DATA 20GB'])) {
            $id = $goiCuocMap['Gói HOT DATA 20GB'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Người dùng cần data rất lớn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '20GB tốc độ cao, không giới hạn data'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '159.000 VNĐ'];
        }

        // Gói HOT VOICE 500P
        if (isset($goiCuocMap['Gói HOT VOICE 500P'])) {
            $id = $goiCuocMap['Gói HOT VOICE 500P'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Người dùng gọi nhiều'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '500 phút gọi quốc tế, 1000 phút nội mạng'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '79.000 VNĐ'];
        }

        // ==================== CHI TIẾT GÓI SIÊU DATA ====================
        
        // Gói Siêu Data 50GB
        if (isset($goiCuocMap['Gói Siêu Data 50GB'])) {
            $id = $goiCuocMap['Gói Siêu Data 50GB'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Người dùng data heavy'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '50GB tốc độ cao, sau đó giảm còn 2Mbps'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '249.000 VNĐ'];
        }

        // Gói Siêu Data 100GB
        if (isset($goiCuocMap['Gói Siêu Data 100GB'])) {
            $id = $goiCuocMap['Gói Siêu Data 100GB'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Người dùng data cực lớn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '100GB tốc độ cao, sau đó giảm còn 3Mbps'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '399.000 VNĐ'];
        }

        // Gói Siêu Data 200GB
        if (isset($goiCuocMap['Gói Siêu Data 200GB'])) {
            $id = $goiCuocMap['Gói Siêu Data 200GB'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Doanh nghiệp SME'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '200GB tốc độ cao, sau đó giảm còn 5Mbps'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '599.000 VNĐ'];
        }

        // ==================== CHI TIẾT GÓI GIA ĐÌNH ====================
        
        // Gói Gia Đình 3 SIM
        if (isset($goiCuocMap['Gói Gia Đình 3 SIM'])) {
            $id = $goiCuocMap['Gói Gia Đình 3 SIM'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Gia đình 3 người'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '30GB chia sẻ cho 3 SIM, gọi nội mạng miễn phí'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '450.000 VNĐ'];
        }

        // Gói Gia Đình 5 SIM
        if (isset($goiCuocMap['Gói Gia Đình 5 SIM'])) {
            $id = $goiCuocMap['Gói Gia Đình 5 SIM'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Gia đình 5 người'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '50GB chia sẻ cho 5 SIM, gọi nội mạng miễn phí'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '699.000 VNĐ'];
        }

        // ==================== CHI TIẾT GÓI MOBIF ====================
        
        // MobiF D10
        if (isset($goiCuocMap['MobiF D10'])) {
            $id = $goiCuocMap['MobiF D10'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Người dùng cơ bản'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '10GB tốc độ cao, 100 phút gọi nội mạng'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '90.000 VNĐ'];
        }

        // MobiF D20
        if (isset($goiCuocMap['MobiF D20'])) {
            $id = $goiCuocMap['MobiF D20'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Người dùng trung bình'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '20GB tốc độ cao, 200 phút gọi nội mạng'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '159.000 VNĐ'];
        }

        // MobiF D50
        if (isset($goiCuocMap['MobiF D50'])) {
            $id = $goiCuocMap['MobiF D50'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Người dùng nặng'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '50GB tốc độ cao, 500 phút gọi nội mạng'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '299.000 VNĐ'];
        }

        // ==================== CHI TIẾT GÓI TÍCH ĐIỂM ====================
        
        // Gói Tích Điểm Vàng
        if (isset($goiCuocMap['Gói Tích Điểm Vàng'])) {
            $id = $goiCuocMap['Gói Tích Điểm Vàng'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Khách hàng thân thiết'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Tích điểm gấp 2 lần, đổi quà hấp dẫn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '2GB tốc độ cao'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '50.000 VNĐ'];
        }

        // Gói Tích Điểm Bạc
        if (isset($goiCuocMap['Gói Tích Điểm Bạc'])) {
            $id = $goiCuocMap['Gói Tích Điểm Bạc'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Khách hàng mới'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Tích điểm gấp 1.5 lần'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => '1GB tốc độ cao'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '30.000 VNĐ'];
        }

        // ==================== CHI TIẾT GÓI MOBISAFE ====================
        
        // MobiSafe Cơ bản
        if (isset($goiCuocMap['MobiSafe Cơ bản'])) {
            $id = $goiCuocMap['MobiSafe Cơ bản'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Người dùng cá nhân'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Bảo vệ chống virus, chống lừa đảo'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => 'Không giới hạn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '29.000 VNĐ'];
        }

        // MobiSafe Nâng cao
        if (isset($goiCuocMap['MobiSafe Nâng cao'])) {
            $id = $goiCuocMap['MobiSafe Nâng cao'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Người dùng doanh nghiệp'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => 'Bảo vệ toàn diện, VPN, chống hack'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Dung lượng data', 'value' => 'Không giới hạn'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '59.000 VNĐ'];
        }

        // ==================== CHI TIẾT GÓI QUỐC TẾ LINH HOẠT ====================
        
        // Gói Quốc Tế Linh Hoạt 1GB
        if (isset($goiCuocMap['Gói Quốc Tế Linh Hoạt 1GB'])) {
            $id = $goiCuocMap['Gói Quốc Tế Linh Hoạt 1GB'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Du lịch ngắn ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '1GB data quốc tế, 30 phút gọi'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '199.000 VNĐ'];
        }

        // Gói Quốc Tế Linh Hoạt 5GB
        if (isset($goiCuocMap['Gói Quốc Tế Linh Hoạt 5GB'])) {
            $id = $goiCuocMap['Gói Quốc Tế Linh Hoạt 5GB'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Du lịch dài ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '5GB data quốc tế, 100 phút gọi'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '599.000 VNĐ'];
        }

        // Gói Quốc Tế Linh Hoạt 10GB
        if (isset($goiCuocMap['Gói Quốc Tế Linh Hoạt 10GB'])) {
            $id = $goiCuocMap['Gói Quốc Tế Linh Hoạt 10GB'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Công tác quốc tế'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '10GB data quốc tế, 200 phút gọi'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '999.000 VNĐ'];
        }

        // ==================== CHI TIẾT GÓI COMBO ====================
        
        // Combo Văn Phòng
        if (isset($goiCuocMap['Combo Văn Phòng'])) {
            $id = $goiCuocMap['Combo Văn Phòng'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Văn phòng nhỏ'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '15GB data, 500 phút gọi nội bộ'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '350.000 VNĐ'];
        }

        // Combo Gia Đình
        if (isset($goiCuocMap['Combo Gia Đình'])) {
            $id = $goiCuocMap['Combo Gia Đình'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Gia đình 4-5 người'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '25GB chia sẻ, gọi nội mạng miễn phí'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '450.000 VNĐ'];
        }

        // Combo Doanh Nghiệp
        if (isset($goiCuocMap['Combo Doanh Nghiệp'])) {
            $id = $goiCuocMap['Combo Doanh Nghiệp'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Doanh nghiệp vừa và nhỏ'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '50GB data, 2000 phút gọi, 10 SIM'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '899.000 VNĐ'];
        }

        // ==================== CHI TIẾT GÓI CHỊ ĐẸP ====================
        
        // Gói Chị Đẹp 5GB
        if (isset($goiCuocMap['Gói Chị Đẹp 5GB'])) {
            $id = $goiCuocMap['Gói Chị Đẹp 5GB'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Nữ giới'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '5GB data, 100 phút gọi nội mạng'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '79.000 VNĐ'];
        }

        // Gói Chị Đẹp 10GB
        if (isset($goiCuocMap['Gói Chị Đẹp 10GB'])) {
            $id = $goiCuocMap['Gói Chị Đẹp 10GB'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Nữ giới'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '10GB data, 200 phút gọi nội mạng'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '129.000 VNĐ'];
        }

        // Gói Chị Đẹp 20GB
        if (isset($goiCuocMap['Gói Chị Đẹp 20GB'])) {
            $id = $goiCuocMap['Gói Chị Đẹp 20GB'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Đối tượng', 'value' => 'Nữ giới'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Ưu đãi', 'value' => '20GB data, 500 phút gọi nội mạng'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Thời hạn', 'value' => '30 ngày'];
            $details[] = ['goicuoc_id' => $id, 'key' => 'Giá', 'value' => '199.000 VNĐ'];
        }

        foreach ($details as $detail) {
            GoicuocDetail::create($detail);
        }
    }
}
