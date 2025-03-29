/**
 * Hàm lấy thông tin từ Wikipedia
 */

// Hàm gọi Wikipedia API
async function fetchWikiInfo(countryName) {
    const url = `https://vi.wikipedia.org/api/rest_v1/page/summary/${encodeURIComponent(
        countryName
    )}`;

    try {
        const response = await fetch(url);
        const data = await response.json();

        if (data.extract) {
            document.getElementById("wiki-info").innerHTML = `
                <h2 class="text-xl font-semibold text-gray-800">${
                    data.title
                }</h2>
                <p class="text-gray-600">${data.extract}</p>
                ${
                    data.thumbnail
                        ? `<img src="${data.thumbnail.source}" class="w-64 mt-3 rounded-lg shadow">`
                        : ""
                }
                <a href="${
                    data.content_urls.desktop.page
                }" target="_blank" class="text-blue-500 hover:underline block mt-2">Đọc thêm trên Wikipedia</a>
            `;
        } else {
            document.getElementById(
                "wiki-info"
            ).innerHTML = `<p class="text-gray-500">Không tìm thấy thông tin trên Wikipedia.</p>`;
        }
    } catch (error) {
        console.error("Lỗi khi lấy thông tin Wikipedia:", error);
        document.getElementById(
            "wiki-info"
        ).innerHTML = `<p class="text-red-500">Không thể tải thông tin.</p>`;
    }
}

// Xuất hàm
export { fetchWikiInfo };