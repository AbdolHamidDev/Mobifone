const app = Vue.createApp({
    data() {
        return {
            countries: [], // Danh sách quốc gia từ backend
            selectedCountry: "", // Mã quốc gia đã chọn
            selectedSubscription: "", // Loại thuê bao
            dropdownOpen: false, // Trạng thái dropdown
            tableData: [] // Dữ liệu bảng
        };
    },
    mounted() {
        this.fetchCountries(); // Lấy danh sách quốc gia từ backend khi trang load
    },
    methods: {
        async fetchCountries() {
            try {
                const response = await fetch("/api/quoc-gia"); // Lấy danh sách từ backend
                const data = await response.json();
                this.countries = data.map(country => ({
                    id: country.id,          
                    name: country.ten_quoc_gia, 
                    code: country.ma_quoc_gia   
                }));
            } catch (error) {
                console.error("Lỗi khi lấy danh sách quốc gia từ backend:", error);
            }
        },
        async searchPackages() {
            if (!this.selectedCountry || !this.selectedSubscription) {
                alert("Vui lòng chọn quốc gia và loại thuê bao.");
                return;
            }
            try {
                const apiUrl = `/api/cuoc-quoc-te?ma_quoc_gia=${this.selectedCountry}&loai_thue_bao=${this.selectedSubscription}`;
                console.log("Gọi API:", apiUrl);

                const response = await fetch(apiUrl);
                const data = await response.json();

                console.log("Dữ liệu từ API:", data);

                if (data.length === 0) {
                    alert("Không tìm thấy dữ liệu!");
                }

                this.tableData = data.map(row => ({
                    nha_khai_thac: row.nha_khai_thac ? row.nha_khai_thac.ten_nha_khai_thac : "N/A",
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
