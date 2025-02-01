// Hiển thị Modal
function showModal() {
    const emailList = JSON.parse(localStorage.getItem('newsletterEmails')) || [];
    const emailListDiv = document.getElementById('email-list');
    const modal = document.getElementById('email-modal');

    if (emailList.length > 0) {
        emailListDiv.innerHTML = `<ul>${emailList.map(email => `<li>${email}</li>`).join('')}</ul>`;
    } else {
        emailListDiv.innerHTML = '<p>Chưa có email nào được đăng ký.</p>';
    }

    modal.style.display = 'flex'; // Hiển thị modal
}

// Đóng Modal
function closeModal() {
    document.getElementById('email-modal').style.display = 'none';
}

// Đóng Modal khi nhấn ngoài nội dung
function closeModalOnClickOutside(event) {
    const modal = document.getElementById('email-modal');
    if (event.target === modal) {
        closeModal();
    }
}

// Hàm cập nhật số lượng email đã đăng ký trên badge
function updateEmailCount() {
    const emailList = JSON.parse(localStorage.getItem('newsletterEmails')) || [];
    const emailCountBadge = document.getElementById('email-count');
    if (emailCountBadge) {
        emailCountBadge.textContent = emailList.length; // Cập nhật số lượng email
    }
}

// Xử lý sự kiện gửi email
function handleEmailSubmit() {
    const emailInput = document.getElementById('newsletter-email');
    const message = document.getElementById('newsletter-message');
    const email = emailInput.value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(email)) {
        message.style.display = 'block';
        message.style.color = 'red';
        message.textContent = 'Vui lòng nhập email hợp lệ!';
        return;
    }

    let emailList = JSON.parse(localStorage.getItem('newsletterEmails')) || [];

    if (emailList.includes(email)) {
        message.style.display = 'block';
        message.style.color = 'blue';
        message.textContent = 'Email này đã được đăng ký!';
        return;
    }

    emailList.push(email);
    localStorage.setItem('newsletterEmails', JSON.stringify(emailList));

    message.style.display = 'block';
    message.style.color = 'green';
    message.textContent = 'Đăng ký thành công!';
    emailInput.value = '';

    // Cập nhật badge số lượng email
    updateEmailCount();
}

// Đăng ký sự kiện khi DOM đã tải xong
document.addEventListener('DOMContentLoaded', function () {
    // Cập nhật badge khi tải trang
    updateEmailCount();

    // Đăng ký sự kiện hiển thị Modal
    const viewRegisteredEmailsButton = document.getElementById('view-registered-emails');
    if (viewRegisteredEmailsButton) {
        viewRegisteredEmailsButton.addEventListener('click', function (event) {
            event.preventDefault();
            showModal();
        });
    }

    // Đăng ký sự kiện đóng Modal
    const closeButton = document.querySelector('.close-btn');
    if (closeButton) {
        closeButton.addEventListener('click', closeModal);
    }

    // Đóng Modal khi nhấn ngoài nội dung
    window.addEventListener('click', closeModalOnClickOutside);

    // Đăng ký sự kiện gửi email
    const submitButton = document.getElementById('newsletter-submit');
    if (submitButton) {
        submitButton.addEventListener('click', handleEmailSubmit);
    }
});





document.addEventListener('DOMContentLoaded', function () {
    // Hàm cập nhật số lượng messages và notifications
    function updateCounts() {
        // Lấy số lượng từ LocalStorage
        const messagesCount = JSON.parse(localStorage.getItem('messagesCount')) || 0;
        const notificationsCount = JSON.parse(localStorage.getItem('notificationsCount')) || 0;

        // Cập nhật số lượng cho messages
        const messageBadge = document.getElementById('message-count');
        const messageHeaderCount = document.getElementById('message-header-count');
        if (messageBadge && messageHeaderCount) {
            messageBadge.textContent = messagesCount;
            messageHeaderCount.textContent = messagesCount;
        }

        // Cập nhật số lượng cho notifications
        const notificationBadge = document.getElementById('notification-count');
        const notificationHeaderCount = document.getElementById('notification-header-count');
        if (notificationBadge && notificationHeaderCount) {
            notificationBadge.textContent = notificationsCount;
            notificationHeaderCount.textContent = notificationsCount;
        }
    }

    // Giả lập thêm messages hoặc notifications
    document.getElementById('add-message')?.addEventListener('click', function () {
        const currentMessages = JSON.parse(localStorage.getItem('messagesCount')) || 0;
        localStorage.setItem('messagesCount', JSON.stringify(currentMessages + 1));
        updateCounts();
    });

    document.getElementById('add-notification')?.addEventListener('click', function () {
        const currentNotifications = JSON.parse(localStorage.getItem('notificationsCount')) || 0;
        localStorage.setItem('notificationsCount', JSON.stringify(currentNotifications + 1));
        updateCounts();
    });

    // Cập nhật số lượng ngay khi tải trang
    updateCounts();
});
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('email-modal');
    const emailListDiv = document.getElementById('email-list');
    const emailCountBadge = document.getElementById('email-count');
    const viewRegisteredEmailsButton = document.getElementById('view-registered-emails');
    const closeButton = document.querySelector('.close-btn');

    // Hàm cập nhật số lượng email trên badge
    function updateEmailCount() {
        const emailList = JSON.parse(localStorage.getItem('newsletterEmails')) || [];
        emailCountBadge.textContent = emailList.length;
    }

    // Hàm hiển thị modal
    function showModal() {
        const emailList = JSON.parse(localStorage.getItem('newsletterEmails')) || [];
        if (emailList.length > 0) {
            emailListDiv.innerHTML = `<ul>${emailList.map(email => `<li>${email}</li>`).join('')}</ul>`;
        } else {
            emailListDiv.innerHTML = '<p>Chưa có email nào được đăng ký.</p>';
        }
        modal.style.display = 'flex';
    }

    // Hàm đóng modal
    function closeModal() {
        modal.style.display = 'none';
    }

    // Đóng modal khi nhấn ngoài nội dung
    function closeModalOnClickOutside(event) {
        if (event.target === modal) {
            closeModal();
        }
    }

    // Gắn sự kiện mở modal
    viewRegisteredEmailsButton.addEventListener('click', function (event) {
        event.preventDefault();
        showModal();
    });

    // Gắn sự kiện đóng modal
    closeButton.addEventListener('click', closeModal);
    window.addEventListener('click', closeModalOnClickOutside);

    // Cập nhật số lượng email khi tải trang
    updateEmailCount();
});
