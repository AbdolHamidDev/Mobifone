/**
 * Tải dữ liệu từ API Dashboard
 * @returns {Promise} Promise chứa dữ liệu dashboard
 */
export function fetchDashboardData() {
    return fetch(window.urlDashboard)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        });
}

/**
 * Tải dữ liệu từ API Pricing
 * @returns {Promise} Promise chứa dữ liệu pricing
 */
export function fetchPricingData() {
    return fetch(window.urlDashboard1)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        });
}