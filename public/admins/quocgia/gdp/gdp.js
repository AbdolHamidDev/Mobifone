/**
 * Hàm lấy thông tin GDP và thông tin chi tiết quốc gia
 */
import { formatNumber } from '../helpers/format.js';
import { fetchCountryByCode } from '../helpers/api.js';

// Lấy thông tin chi tiết quốc gia
async function fetchCountryDetails(countryCode) {
    try {
        // Lấy thông tin cơ bản từ RestCountries
        const [countryData] = await fetchCountryByCode(countryCode);

        // Lấy GDP từ World Bank API (song song)
        const gdpPromise = fetchGDP(countryCode);

        // Cập nhật thông tin có sẵn
        document.getElementById("population").textContent =
            countryData.population
                ? formatNumber(countryData.population)
                : "--";

        document.getElementById("area").textContent = countryData.area
            ? `${formatNumber(countryData.area)} km²`
            : "--";

        if (countryData.currencies) {
            const currencyCode = Object.keys(countryData.currencies)[0];
            const currency = countryData.currencies[currencyCode];
            document.getElementById("currency").textContent = `${
                currency.name
            } (${currency.symbol || currencyCode})`;
        }

        // Cập nhật GDP khi có kết quả
        document.getElementById("gdp").textContent = "Đang tải...";
        document.getElementById("gdp").textContent = await gdpPromise;

        // Hiển thị phần thống kê
        document.getElementById("country-stats").classList.remove("hidden");
    } catch (error) {
        console.error("Lỗi khi lấy thông tin chi tiết:", error);
        document.getElementById("gdp").textContent = "--";
    }
}

// Lấy thông tin GDP từ World Bank
async function fetchGDP(countryCode) {
    try {
        // World Bank sử dụng mã ISO 2 ký tự
        const wbCode = getWorldBankCode(countryCode);
        if (!wbCode) return "--";

        const response = await fetch(
            `https://api.worldbank.org/v2/country/${wbCode}/indicator/NY.GDP.MKTP.CD?format=json&date=2022`
        );
        const data = await response.json();

        if (data[1] && data[1][0] && data[1][0].value) {
            const gdpInDollars = data[1][0].value;
            return `$${(gdpInDollars / 1000000000).toFixed(1)} tỷ USD`;
        }
        return "--";
    } catch (error) {
        console.error("Lỗi khi lấy GDP:", error);
        return "--";
    }
}

// Hàm chuyển đổi mã quốc gia sang World Bank code
function getWorldBankCode(isoCode) {
    // Một số quốc gia có mã đặc biệt
    const specialCases = {
        XK: "XKX", // Kosovo
    };
    return specialCases[isoCode] || isoCode;
}

// Xuất các hàm
export { fetchCountryDetails, fetchGDP };