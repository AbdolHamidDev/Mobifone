import { initializeCuocQuocTe, cleanupCuocQuocTe } from './modules/cuocQuocTe.js';



$(document).ready(function() {
    initializeCuocQuocTe();
    
    // Nếu cần reload lại trang/component
    $(document).on('turbolinks:load', function() {
        cleanupCuocQuocTe();
        initializeCuocQuocTe();
    });
});

