/**
 * Các hàm gọi API
 */

// Hàm gọi API chung
async function fetchApi(url, options = {}) {
    try {
        const response = await fetch(url, options);
        return await response.json();
    } catch (error) {
        console.error(`Lỗi khi gọi API: ${url}`, error);
        throw error;
    }
}

// Hàm lấy tất cả quốc gia
async function fetchAllCountries() {
    return fetchApi("https://restcountries.com/v3.1/all");
}

// Hàm lấy thông tin chi tiết quốc gia theo mã
async function fetchCountryByCode(countryCode) {
    return fetchApi(`https://restcountries.com/v3.1/alpha/${countryCode}`);
}

// Xuất các hàm
export { fetchApi, fetchAllCountries, fetchCountryByCode };