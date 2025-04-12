import { fetchDashboardData, fetchPricingData } from '../helpers/api.js';
import { handleDataLoadError } from '../helpers/toast.js';
import { initCountryChart } from '../charts/countryChart.js';
import { initGroupChart } from '../charts/groupChart.js';
import { initBlock6sChart } from '../charts/block6sChart.js';
import { initPricePerSecondChart } from '../charts/pricePerSecondChart.js';

/**
 * Tải dữ liệu và cập nhật dashboard
 */
export async function loadDashboardData() {
    try {
        const data = await fetchDashboardData();
        updateOverviewCards(data);
        initCountryChart(data.countryLabels, data.countryData);
        initGroupChart(data.groupLabels, data.groupData);
    } catch (error) {
        handleDataLoadError(error);
    }
}

/**
 * Tải dữ liệu và cập nhật pricing
 */
export async function loadPricingData() {
    try {
        const data = await fetchPricingData();
        updatePricingCards(data);
        initBlock6sChart(data.regionLabels, data.block6sData);
        initPricePerSecondChart(data.regionLabels, data.pricePerSecondData);
    } catch (error) {
        handleDataLoadError(error);
    }
}

/**
 * Cập nhật thẻ tổng quan
 */
function updateOverviewCards(data) {
    const elements = {
        'totalCountries': data.totalCountries,
        'totalGroups': data.totalGroups,
        'totalPackages': data.totalPackages
    };
    
    Object.entries(elements).forEach(([id, value]) => {
        const element = document.getElementById(id);
        if (element) element.textContent = value;
    });
}

/**
 * Cập nhật thẻ giá
 */
function updatePricingCards(data) {
    const elements = {
        'totalRegions': data.totalRegions,
        'avgBlock6s': `${data.avgBlock6s} VNĐ`,
        'avgPricePerSecond': `${data.avgPricePerSecond} VNĐ`,
        'avgPriceFirstMinute': `${data.avgPriceFirstMinute} VNĐ`
    };
    
    Object.entries(elements).forEach(([id, value]) => {
        const element = document.getElementById(id);
        if (element) element.textContent = value;
    });
}

/**
 * Thiết lập sự kiện cho dashboard
 */
export function setupDashboardEvents() {
    setupRefreshButton();
    setupChartPeriodButtons();
}

function setupRefreshButton() {
    const btn = document.querySelector('.btn-refresh');
    if (!btn) return;
    
    btn.addEventListener('click', async function() {
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        
        try {
            await Promise.all([loadDashboardData(), loadPricingData()]);
        } finally {
            btn.innerHTML = originalHtml;
        }
    });
}

function setupChartPeriodButtons() {
    document.querySelectorAll('.btn-chart-action').forEach(button => {
        button.addEventListener('click', function() {
            const parent = this.parentElement;
            parent.querySelectorAll('.btn-chart-action').forEach(btn => {
                btn.classList.remove('active');
            });
            this.classList.add('active');
            
            // Gọi hàm reload chart với period tương ứng
            const period = this.dataset.period;
            reloadChartsWithPeriod(period);
        });
    });
}

function reloadChartsWithPeriod(period) {
    console.log('Reload charts with period:', period);
    // Triển khai logic reload chart theo period ở đây
}