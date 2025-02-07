let loadedTabs = {};

// Mở tab chính khi tải trang
document.addEventListener("DOMContentLoaded", async function () {
    let defaultTabButton = document.querySelector("[data-default-tab]");
    let defaultTabSection = document.querySelector("[data-default-section]");
    let defaultApiUrl = defaultTabButton.getAttribute("data-api");
    let defaultContainerId = defaultTabButton.getAttribute("data-container");

    if (defaultTabButton && defaultTabSection) {
        defaultTabButton.classList.add("text-blue-500");
        defaultTabSection.classList.add("active");

        // Load dữ liệu cho tab chính ngay khi tải trang
        if (!loadedTabs[defaultTabSection.id]) {
            await loadData(defaultApiUrl, defaultContainerId);
            loadedTabs[defaultTabSection.id] = true;
        }
    }
});

async function switchTab(evt, tabId, apiUrl, containerId) {
    // Ẩn tất cả tab và loại bỏ class active
    document.querySelectorAll(".tab-section").forEach(tab => tab.classList.remove("active"));
    document.getElementById(tabId).classList.add("active");

    // Cập nhật trạng thái active của tab
    document.querySelectorAll(".tab-button").forEach(tab => tab.classList.remove("text-blue-500"));
    evt.currentTarget.classList.add("text-blue-500");

    // Chỉ tải dữ liệu nếu chưa tải
    if (!loadedTabs[tabId]) {
        await loadData(apiUrl, containerId);
        loadedTabs[tabId] = true;
    }
}

async function loadData(apiUrl, containerId) {
    try {
        let response = await fetch(apiUrl);
        let data = await response.json();
        let container = document.getElementById(containerId);

        container.innerHTML = data.map(item => {
            let isBlogType = containerId.includes("dich-vu") || containerId.includes("loai-thuebao");

            if (isBlogType) {
                // Xác định nội dung mô tả dựa vào bảng tương ứng
                let description = containerId.includes("dich-vu") 
                    ? item.noi_dung || "Không có mô tả" // Lấy từ cột noi_dung của bảng dichvus
                    : item.title || "Không có mô tả";  // Lấy từ cột title của bảng subscription_types

                // Xây dựng đường dẫn chính xác
                let detailUrl = containerId.includes('dich-vu') 
                    ? `/dich-vu-di-dong/dich-vu/${item.id}` 
                    : `/dich-vu-di-dong/loai-thue-bao/${item.id}/chi-tiet`;

                return `
                    <div class="min-w-[220px] bg-gray-100 p-4 rounded-lg shadow-md text-center flex flex-col justify-between">
                        <h3 class="font-bold text-lg">${truncateText(item.ten_dich_vu || item.ten_loai_thuebao || "Nội dung", 20)}</h3>
                        <p>${truncateText(description, 50)}</p>
                        <a href="${detailUrl}" class="btn-detail">Xem chi tiết</a>
                    </div>
                `;
            } else {
                return `
                    <div class="min-w-[220px] bg-gray-100 p-4 rounded-lg shadow-md text-center flex flex-col justify-between">
                        <h3 class="font-bold text-lg">${item.ten_goicuoc || item.ten_data || "Gói thuê bao"}</h3>
                        <p>💰 ${item.gia ? item.gia.toLocaleString() + " đ" : "Không có giá"} / ${item.thoi_gian ? item.thoi_gian + " Ngày" : "Không giới hạn"}</p>
                        <p>📦 ${item.dung_luong ? item.dung_luong + " " + (item.don_vi_dung_luong || "GB") : "Không có dung lượng"}</p>
                        <button class="btn-register" onclick="openRegisterModal('${item.id}', '${item.ten_goicuoc || item.ten_data}', '${containerId.includes('goi-cuoc') ? 'goi-cuoc' : 'goi-data'}')">
                            Đăng ký
                        </button>
                    </div>
                `;
            }
        }).join("");

    } catch (error) {
        console.error("Lỗi khi tải dữ liệu:", error);
    }
}

// Hàm rút gọn văn bản
function truncateText(text, maxLength) {
    return text.length > maxLength ? text.substring(0, maxLength) + "..." : text;
}







function openRegisterModal(packageId, packageName, type) {
    document.getElementById("packageId").value = packageId;
    document.getElementById("selectedPackage").textContent = `Bạn đang đăng ký gói: ${packageName}`;
    document.getElementById("registerModal").setAttribute("data-package-type", "goidata");

    const modal = new bootstrap.Modal(document.getElementById("registerModal"));
    modal.show();
}



document.addEventListener("DOMContentLoaded", function () {
    const submitButton = document.getElementById("submitRegisterForm");

    submitButton.addEventListener("click", function () {
        const packageId = document.getElementById("packageId").value;
        const phoneNumber = document.getElementById("phoneNumber").value;
        const packageType = document.getElementById("registerModal").getAttribute("data-package-type");

        if (!packageId || !phoneNumber) {
            Swal.fire({
                icon: "error",
                title: "Lỗi!",
                text: "Vui lòng nhập đầy đủ thông tin trước khi xác nhận.",
                confirmButtonText: "OK"
            });
            return;
        }

        let apiUrl = packageType === "goi-cuoc"
            ? "/dich-vu-di-dong/goi-cuoc/register"
            : "/dich-vu-di-dong/goi-data/register";

        console.log("Gửi đăng ký:", {
            package_id: packageId,
            phoneNumber: phoneNumber,
            type: packageType
        });

        fetch(apiUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify({
                package_id: packageId,
                phoneNumber: phoneNumber,
                type: packageType // Gửi đúng type
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log("Phản hồi từ server:", data);

            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: "Thành công!",
                    text: data.message,
                    confirmButtonText: "OK"
                });

                const modal = bootstrap.Modal.getInstance(document.getElementById("registerModal"));
                modal.hide();
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Thất bại!",
                    text: data.message,
                    confirmButtonText: "OK"
                });
            }
        })
        .catch(error => {
            console.error("Lỗi request:", error);
            Swal.fire({
                icon: "error",
                title: "Lỗi hệ thống!",
                text: "Không thể hoàn thành yêu cầu. Vui lòng thử lại sau.",
                confirmButtonText: "OK"
            });
        });
    });
});


