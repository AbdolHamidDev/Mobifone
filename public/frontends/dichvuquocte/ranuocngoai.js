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






// Js các modals
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("modal2G3G");
    const openModals = document.querySelectorAll("#open2G3GModal"); // Chọn tất cả phần tử có ID này
    const closeModal = document.getElementById("close2G3GModal");

    // Lặp qua tất cả phần tử có ID "open2G3GModal" và gán sự kiện click
    openModals.forEach(button => {
        button.addEventListener("click", function () {
            modal.classList.remove("hidden");
        });
    });

    closeModal.addEventListener("click", function () {
        modal.classList.add("hidden");
    });

    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.classList.add("hidden");
        }
    });
});
document.addEventListener("DOMContentLoaded", function () {
    /*** Modal 1: Danh sách thiết bị hỗ trợ VoLTE ***/
    const voLTE_Modal = document.getElementById("voLTE-Modal");
    const openVoLTE_Modal = document.getElementById("openVoLTEModal");
    const closeVoLTE_Modal = document.querySelector("#voLTE-Modal .close");

    if (openVoLTE_Modal && voLTE_Modal && closeVoLTE_Modal) {
        openVoLTE_Modal.addEventListener("click", function () {
            closeAllModals(); // Đóng tất cả các modal khác trước khi mở modal này
            voLTE_Modal.style.display = "flex";
        });

        closeVoLTE_Modal.addEventListener("click", function () {
            voLTE_Modal.style.display = "none";
        });

        voLTE_Modal.addEventListener("click", function (e) {
            if (e.target === voLTE_Modal) {
                voLTE_Modal.style.display = "none";
            }
        });
    }

    /*** Modal 2: Phóng to ảnh ***/
    document.querySelectorAll('.zoomable').forEach(img => {
        img.addEventListener('click', function () {
            const imageModal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImg');

            if (!imageModal || !modalImg) return;

            closeAllModals(); // Đóng tất cả modal trước khi mở cái mới
            modalImg.style.opacity = "0"; // Ẩn ảnh trong lúc load
            modalImg.src = "";

            const tempImage = new Image();
            tempImage.src = this.src;
            tempImage.onload = () => {
                modalImg.src = tempImage.src;
                imageModal.classList.add("show");
                modalImg.style.opacity = "1"; // Hiển thị ảnh khi đã load xong
            };
        });
    });

    const closeImageModal = document.getElementById('closeModal');
    const imageModal = document.getElementById('imageModal');

    if (closeImageModal && imageModal) {
        closeImageModal.addEventListener('click', function () {
            imageModal.classList.remove("show");
        });

        imageModal.addEventListener('click', function (e) {
            if (e.target === imageModal) {
                imageModal.classList.remove("show");
            }
        });
    }

    /*** Hàm đóng tất cả modal nhưng **không ảnh hưởng đến các modal khác** ***/
    function closeAllModals() {
        document.querySelectorAll(".modal").forEach(modal => {
            if (modal.style.display === "flex") {
                modal.style.display = "none";
            }
        });

        document.querySelectorAll(".show").forEach(modal => {
            modal.classList.remove("show");
        });
    }
});





// js các tab
function showTab(tab) {
    document.getElementById('condition-content').classList.add('hidden');
    document.getElementById('setup-content').classList.add('hidden');
    document.getElementById('tab-condition').classList.remove('font-bold', 'border-b-2', 'border-blue-700', 'text-blue-700');
    document.getElementById('tab-setup').classList.remove('font-bold', 'border-b-2', 'border-blue-700', 'text-blue-700');

    if (tab === 'condition') {
        document.getElementById('condition-content').classList.remove('hidden');
        document.getElementById('tab-condition').classList.add('font-bold', 'border-b-2', 'border-blue-700', 'text-blue-700');
    } else {
        document.getElementById('setup-content').classList.remove('hidden');
        document.getElementById('tab-setup').classList.add('font-bold', 'border-b-2', 'border-blue-700', 'text-blue-700');
    }
}


// js các nút dropdown
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".dropdown-btn").forEach((button) => {
        button.addEventListener("click", function () {
            const parent = this.parentElement;
            const content = parent.querySelector(".dropdown-content");
            const icon = this.querySelector(".dropdown-icon");

            content.classList.toggle("hidden");
            icon.textContent = content.classList.contains("hidden") ? "🔽" : "🔼";
        });
    });
});

function toggleDropdown(id) {
    const dropdown = document.getElementById(id);
    dropdown.classList.toggle("hidden");
}