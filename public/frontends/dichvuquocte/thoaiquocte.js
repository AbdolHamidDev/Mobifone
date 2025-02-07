const app = Vue.createApp({
    data() {
        return {
            activeTab: 0, // Mặc định tab đầu tiên
            hasSearched: false, // Chỉ hiện ảnh "Không có dữ liệu" sau khi tìm kiếm
            tabs: [
                { label: "Gọi trực tiếp IDD", hasData: false },
                { label: "Gọi VoIP 131", hasData: false },
                { label: "Các gói cước ưu đãi", hasData: false },
                { label: "Gọi VoIP 1313", hasData: false } // ✅ Thêm tab Gọi VoIP 1313
            ],
            dropdownOpen: false,
            selectedCountry: null,
            countries: [],
            rates: [],
            tableData: [],
            iddRates: [], // Dữ liệu IDD sẽ dựa trên VoIP 131 nhưng có sự điều chỉnh
            voip1313Data: { applied: [], notApplied: [] }, // Dữ liệu cho tab VoIP 1313
            predefinedCountries: [] // Danh sách quốc gia lưu sẵn
        };
    },
    async created() {
        await this.fetchCountries();
    },
    methods: {
        async fetchCountries() {
            try {
                const response = await fetch('/api/get-countries');
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                const data = await response.json();
                this.countries = data.map(country => ({
                    id: country.id,
                    name: country.ten_quoc_gia,
                    code: country.ma_quoc_gia.toLowerCase()
                }));
            } catch (error) {
                console.error('Lỗi khi tải danh sách quốc gia:', error);
            }
        },
        selectCountry(country) {
            this.selectedCountry = country;
            this.dropdownOpen = false;
        },
        toggleDropdown() {
            this.dropdownOpen = !this.dropdownOpen;
        },
        async searchPackages() {
            if (!this.selectedCountry) {
                alert('Vui lòng chọn quốc gia.');
                return;
            }

            try {
                this.hasSearched = true; // Đánh dấu rằng người dùng đã tìm kiếm
                const apiUrl = `/api/get-rates?ma_quoc_gia=${this.selectedCountry.code}`;
                const response = await fetch(apiUrl);
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                const data = await response.json();
                
                // ✅ Lưu dữ liệu VoIP 131
                this.rates = data.map((rate, index) => ({
                    stt: index + 1,
                    ten_quoc_gia: rate.ten_quoc_gia,
                    ma_quoc_gia: rate.ma_quoc_gia,
                    ma_vung: rate.ma_vung || 'Tất cả các mã',
                    block_6s_dau: rate.block_6s_dau,
                    gia_moi_giay: rate.gia_moi_giay,
                    gia_1_phut_dau: rate.gia_1_phut_dau,
                    gia_1_phut_tiep_theo: rate.gia_1_phut_tiep_theo || '-',
                    goi_voip_nhom2: rate.goi_voip_nhom2 || '-'
                }));

                // ✅ Tạo dữ liệu IDD dựa trên VoIP 131 nhưng có điều chỉnh giá trị
                this.iddRates = this.rates.map(rate => ({
                    ...rate, // Sao chép toàn bộ dữ liệu từ VoIP 131
                    block_6s_dau: (rate.block_6s_dau * 1.05).toFixed(0), // Tăng 5%
                    gia_moi_giay: (rate.gia_moi_giay * 1.08).toFixed(0), // Tăng 8%
                    gia_1_phut_dau: (rate.gia_1_phut_dau * 1.10).toFixed(0), // Tăng 10%
                    gia_1_phut_tiep_theo: rate.gia_1_phut_tiep_theo !== '-' ? (rate.gia_1_phut_tiep_theo * 1.07).toFixed(0) : '-' // Tăng 7% nếu có dữ liệu
                }));

                 // ✅ Xác định quốc gia nào áp dụng 1313 dựa vào danh sách cố định
                 this.voip1313Data.applied = this.rates.filter(rate => 
                    this.predefinedCountries.includes(rate.ma_quoc_gia)
                );
                this.voip1313Data.notApplied = this.rates.filter(rate => 
                    !this.predefinedCountries.includes(rate.ma_quoc_gia)
                );

                // ✅ Lưu dữ liệu vào bảng
                this.tableData = this.rates;

                // ✅ Random danh sách quốc gia áp dụng 1313 (gọi sau khi rates được cập nhật)
                this.generateVoIP1313Data();

                // ✅ Xác định tab nào có dữ liệu
                this.tabs.forEach(tab => tab.hasData = false);
                this.tabs[0].hasData = this.iddRates.length > 0; // Dữ liệu IDD
                this.tabs[1].hasData = this.rates.length > 0; // Dữ liệu VoIP 131
                this.tabs[3].hasData = this.tableData.length > 0; // Bảng dữ liệu có hay không
                this.tabs[4].hasData = this.voip1313Data.applied.length > 0 || this.voip1313Data.notApplied.length > 0; // ✅ Xác định tab VoIP 1313 có dữ liệu

                // 🔥 Tự động chuyển đến tab đầu tiên có dữ liệu
                const tabIndexWithData = this.tabs.findIndex(tab => tab.hasData);
                if (tabIndexWithData !== -1) {
                    this.activeTab = tabIndexWithData;
                }

            } catch (error) {
                console.error('Lỗi khi tải dữ liệu:', error);
            }
        },
        generateVoIP1313Data() {
            if (this.rates.length === 0) return;
        
            // 🔹 Tạo seed từ mã quốc gia
            let countryCode = this.selectedCountry.code;
            let seed = this.hashString(countryCode); // Tạo số hash từ mã quốc gia
        
            // 🔹 Xáo trộn danh sách theo seed
            let shuffled = [...this.rates].sort(() => (seed % 10) / 10 - 0.5);
            let applyCount = Math.ceil(shuffled.length * 0.4);
        
            this.voip1313Data.applied = shuffled.slice(0, applyCount);
        
            // ✅ Chọn ngẫu nhiên một số mã KHÔNG áp dụng dựa trên seed
            let notAppliedFullList = shuffled.slice(applyCount);
            let notAppliedLimit = Math.min(notAppliedFullList.length, 5);
        
            this.voip1313Data.notApplied = notAppliedFullList
                .sort(() => ((seed % 7) / 7) - 0.5)
                .slice(0, notAppliedLimit);
        
            console.log("Mã vùng/mạng áp dụng 1313:", this.voip1313Data.applied);
            console.log("Mã vùng/mạng KHÔNG áp dụng 1313 (dựa vào hash của quốc gia):", this.voip1313Data.notApplied);
        },
        
        // Hàm tạo số hash đơn giản từ chuỗi (mã quốc gia)
        hashString(str) {
            let hash = 0;
            for (let i = 0; i < str.length; i++) {
                hash = (hash << 5) - hash + str.charCodeAt(i);
                hash |= 0;
            }
            return Math.abs(hash);
        }
        
        
    }
});

app.mount('#app');





function toggleDropdown(id) {
    const element = document.getElementById(id);
    element.classList.toggle('hidden');
}
