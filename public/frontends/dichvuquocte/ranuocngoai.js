//API các nước
const app = Vue.createApp({
    data() {
        return {
            countries: [],
            selectedCountry: null,
            selectedSubscription: "",
            dropdownOpen: false
        };
    },
    mounted() {
        this.fetchCountries();
    },
    methods: {
        async fetchCountries() {
            try {
                const response = await fetch("https://restcountries.com/v3.1/all");
                const data = await response.json();
                this.countries = data.map(country => ({
                    name: country.name.common,
                    flag: country.flags.svg,
                    code: country.cca2
                })).sort((a, b) => a.name.localeCompare(b.name));
            } catch (error) {
                console.error("Lỗi khi lấy danh sách quốc gia:", error);
            }
        },
        selectCountry(country) {
            this.selectedCountry = country;
            this.dropdownOpen = false;
        },
        searchPackages() {
            console.log("Tìm kiếm gói cước cho:", this.selectedCountry, "Loại thuê bao:", this.selectedSubscription);
            // Gọi API tìm kiếm gói cước theo quốc gia & loại thuê bao
        }
    }
});

app.mount("#app");



