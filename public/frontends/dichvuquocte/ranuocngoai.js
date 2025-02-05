const app = Vue.createApp({
    data() {
        return {
            countries: [],  // Danh sách quốc gia từ API
            selectedCountry: null,  // Quốc gia đã chọn
            selectedSubscription: "",
            tableData: [],
            dropdownOpen: false  // Trạng thái dropdown
        };
    },
    mounted() {
        this.fetchCountries();  // Gọi API khi trang tải
    },
    methods: {
        async fetchCountries() {
            try {
                const response = await fetch("/api/quoc-gia");
                const data = await response.json();

                // Chuyển dữ liệu từ API về đúng định dạng Vue cần
                this.countries = data.map(country => ({
                    id: country.id,
                    name: country.ten_quoc_gia,   // Tên quốc gia
                    code: country.ma_quoc_gia.toLowerCase() // Mã quốc gia ISO (viết thường)
                }));
            } catch (error) {
                console.error("Lỗi khi lấy danh sách quốc gia:", error);
            }
        },
        selectCountry(country) {
            this.selectedCountry = country; // Gán quốc gia đã chọn
            this.dropdownOpen = false; // Đóng dropdown sau khi chọn
        },
        toggleDropdown() {
            this.dropdownOpen = !this.dropdownOpen;
        },
        async searchPackages() {
            if (!this.selectedCountry || !this.selectedSubscription) {
                alert("Vui lòng chọn quốc gia và loại thuê bao.");
                return;
            }

            try {
                const apiUrl = `/api/cuoc-quoc-te?ma_quoc_gia=${this.selectedCountry.code}&loai_thue_bao=${this.selectedSubscription}`;
                const response = await fetch(apiUrl);
                const data = await response.json();

                if (data.length === 0) {
                    alert("Không tìm thấy dữ liệu!");
                }

                this.tableData = data.map((row, index) => ({
                    stt: index + 1, // Thêm số thứ tự
                    loai_thue_bao: row.loai_thue_bao ?? "N/A", // Hiển thị loại thuê bao
                    nha_khai_thac: row.nha_khai_thac ? row.nha_khai_thac.ten_nha_khai_thac : "N/A",
                    ma_nha_khai_thac: row.nha_khai_thac ? row.nha_khai_thac.ma_nha_khai_thac : "N/A",
                    dau_so_thuc_hien_cuoc_goi: row.dau_so_thuc_hien_cuoc_goi ?? "+ / 00",
                    thuc_hien_cuoc_goi: row.thuc_hien_cuoc_goi ?? " ",
                    nhan_cuoc_goi: row.nhan_cuoc_goi ?? "x",
                    dich_vu_sms: row.dich_vu_sms ?? "x",
                    data_3g: row.data_3g ?? "",
                    data_4g: row.data_4g ?? "",
                    data_5g: row.data_5g ?? "",
                    cuoc_goi_trong_mang: row.cuoc_goi_trong_mang ?? "N/A",
                    cuoc_goi_ve_vn: row.cuoc_goi_ve_vn ?? "N/A",
                    cuoc_quoc_te: row.cuoc_quoc_te ?? "N/A",
                    cuoc_ve_tinh: row.cuoc_ve_tinh ?? "N/A",
                    cuoc_nhan_goi: row.cuoc_nhan_goi ?? "N/A",
                    cuoc_sms: row.cuoc_sms ?? "N/A",
                    cuoc_data: row.cuoc_data ?? "N/A"
                }));
            } catch (error) {
                console.error("Lỗi khi tìm kiếm gói cước:", error);
            }
        }
    }
});

app.mount("#app");
