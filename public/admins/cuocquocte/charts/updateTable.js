// charts/updateTable.js
import helpers from '../helpers/format.js';
import toast from '../helpers/toast.js';

const table = {};

/**
 * Updates the top countries table with the provided data
 * @param {Array} data - Array of country data objects
 */
table.updateTopCountriesTable = async function(data) {
    const tbody = $('#topCountriesTable tbody');
    
    // Show loading animation
    tbody.empty().append(`
        <tr class="text-center">
            <td colspan="6">
                <div class="d-flex flex-column align-items-center justify-content-center py-5">
                    <div class="spinner-border text-primary mb-3" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <span class="text-muted">Đang tải dữ liệu...</span>
                </div>
            </td>
        </tr>
    `);

    const loadingStartTime = Date.now();
    const minLoadingTime = 800; // Tăng thời gian loading tối thiểu lên 800ms

    try {
        // Xử lý dữ liệu trống hoặc không hợp lệ
        if (!data || !Array.isArray(data) || data.length === 0) {
            const elapsed = Date.now() - loadingStartTime;
            const remainingDelay = Math.max(0, minLoadingTime - elapsed);
            
            await new Promise(resolve => setTimeout(resolve, remainingDelay));
            
            tbody.empty().append(`
                <tr class="text-center">
                    <td colspan="6">
                        <div class="d-flex flex-column align-items-center justify-content-center py-5">
                            <i class="fas fa-database fs-1 text-muted mb-3"></i>
                            <span class="text-muted">Không có dữ liệu</span>
                        </div>
                    </td>
                </tr>
            `);
            return;
        }

        // Cache mã quốc gia
        const countryCodeCache = {};
        
        // Lấy mã quốc gia từ API
        try {
            const response = await fetch('https://restcountries.com/v3.1/all');
            const countries = await response.json();
            
            countries.forEach(country => {
                countryCodeCache[country.name.common.toLowerCase()] = country.cca2.toLowerCase();
            });
        } catch (error) {
            console.error('Lỗi khi lấy mã quốc gia:', error);
        }

        function getCountryCode(countryName) {
            if (!countryName) return '🌍';
            const normalized = countryName.toLowerCase();
            return countryCodeCache[normalized] || '🌍';
        }

        // Tính giá trị max cho các progress bar
        const maxValues = {
            call_rate: Math.max(...data.map(item => item.call_rate || 0)),
            data_rate: Math.max(...data.map(item => item.data_rate || 0)),
            sms_rate: Math.max(...data.map(item => item.sms_rate || 0)),
            total: Math.max(...data.map(item => item.total || 0))
        };

        // Tạo các hàng của bảng
        const rows = data.map((item, index) => {
            const countryCode = getCountryCode(item.country);
            const callRatePercent = maxValues.call_rate ? ((item.call_rate || 0) / maxValues.call_rate * 100) : 0;
            const dataRatePercent = maxValues.data_rate ? ((item.data_rate || 0) / maxValues.data_rate * 100) : 0;
            const smsRatePercent = maxValues.sms_rate ? ((item.sms_rate || 0) / maxValues.sms_rate * 100) : 0;
            const totalPercent = maxValues.total ? ((item.total || 0) / maxValues.total * 100) : 0;
            
            return `
            <tr class="align-middle" style="opacity: 0; transform: translateY(20px);">
                <td class="text-center fw-bold">${index + 1}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <img src="https://flagcdn.com/16x12/${countryCode}.png" 
                         alt="${item.country}" class="me-2" style="width: 16px; height: 12px;"
                         onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/9/9a/Earth_symbol.png';">
                        <span>${item.country || 'N/A'}</span>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="progress flex-grow-1" style="height: 6px;">
                            <div class="progress-bar bg-primary" role="progressbar" 
                                 style="width: 0%" 
                                 data-percent="${callRatePercent}">
                            </div>
                        </div>
                        <small class="text-muted ms-2">${helpers.formatCurrency(item.call_rate || 0)}</small>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="progress flex-grow-1" style="height: 6px;">
                            <div class="progress-bar bg-info" role="progressbar" 
                                 style="width: 0%" 
                                 data-percent="${dataRatePercent}">
                            </div>
                        </div>
                        <small class="text-muted ms-2">${helpers.formatCurrency(item.data_rate || 0)}</small>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="progress flex-grow-1" style="height: 6px;">
                            <div class="progress-bar bg-success" role="progressbar" 
                                 style="width: 0%" 
                                 data-percent="${smsRatePercent}">
                            </div>
                        </div>
                        <small class="text-muted ms-2">${helpers.formatCurrency(item.sms_rate || 0)}</small>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="progress flex-grow-1" style="height: 6px;">
                            <div class="progress-bar bg-warning" role="progressbar" 
                                 style="width: 0%" 
                                 data-percent="${totalPercent}">
                            </div>
                        </div>
                        <small class="text-muted ms-2">${helpers.formatCurrency(item.total || 0)}</small>
                    </div>
                </td>
            </tr>`;
        });

        // Đảm bảo thời gian loading tối thiểu
        const elapsed = Date.now() - loadingStartTime;
        const remainingDelay = Math.max(0, minLoadingTime - elapsed);
        
        await new Promise(resolve => setTimeout(resolve, remainingDelay));

        // Thay thế loading bằng nội dung thực
        tbody.empty().append(rows.join(''));

        // Hiệu ứng xuất hiện từng hàng
        tbody.find('tr').each(function(index) {
            $(this).delay(50 * index).animate({
                opacity: 1,
                translateY: 0
            }, 300, function() {
                // Hiệu ứng cho progress bar sau khi hàng xuất hiện
                $(this).find('.progress-bar').each(function() {
                    const percent = $(this).data('percent');
                    $(this).animate({
                        width: percent + '%'
                    }, 600, 'easeOutQuad');
                });
            });
        });

    } catch (error) {
        console.error('Lỗi khi cập nhật bảng:', error);
        const elapsed = Date.now() - loadingStartTime;
        const remainingDelay = Math.max(0, minLoadingTime - elapsed);
        
        await new Promise(resolve => setTimeout(resolve, remainingDelay));

        tbody.empty().append(`
            <tr class="text-center">
                <td colspan="6">
                    <div class="d-flex flex-column align-items-center justify-content-center py-5">
                        <i class="fas fa-exclamation-triangle fs-1 text-danger mb-3"></i>
                        <span class="text-danger">Đã xảy ra lỗi khi tải dữ liệu</span>
                    </div>
                </td>
            </tr>
        `);
    }
};

export default table;