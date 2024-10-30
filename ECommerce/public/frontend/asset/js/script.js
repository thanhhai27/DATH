// quantity-product
const quanPlus = document.querySelectorAll('.ri-add-line');
const quanMinus = document.querySelectorAll('.ri-subtract-line');
const quanInput = document.querySelectorAll('.quantity-input');

if (quanMinus != null && quanPlus != null) {
    for (let index = 0; index < quanMinus.length; index++) {
        let qty = parseInt(quanInput[index].value); // Lấy giá trị hiện tại của input
        
        // Thêm sự kiện khi nhấn nút tăng số lượng
        quanPlus[index].addEventListener('click', () => {
            qty++; // Tăng giá trị qty
            quanInput[index].value = qty; // Cập nhật input với giá trị mới
        });

        // Thêm sự kiện khi nhấn nút giảm số lượng
        quanMinus[index].addEventListener('click', () => {
            if (qty > 1) { // Chỉ giảm khi qty lớn hơn 1
                qty--; // Giảm giá trị qty
                quanInput[index].value = qty; // Cập nhật input với giá trị mới
            }
        });
    }
}

// ô drop-down
document.querySelector('.profile-menu').addEventListener('click', function() {
    var dropdown = this.querySelector('.dropdown-content');
    dropdown.classList.toggle('show'); // Thêm hoặc xóa class 'show'
});

// Đóng dropdown nếu nhấn ra ngoài
window.addEventListener('click', function(e) {
    if (!e.target.closest('.profile-menu')) {
        var dropdowns = document.querySelectorAll('.dropdown-content');
        dropdowns.forEach(function(dropdown) {
            dropdown.classList.remove('show'); // Ẩn tất cả dropdown
        });
    }
});


// ô drop-down của mật khẩu
// Hiển thị mật khẩu
const sessionPassword = document.querySelector('.hidden_password').textContent;

document.getElementById('eye-icon').addEventListener('click', function () {
    if (this.classList.contains('ri-eye-off-fill')) {
        document.getElementById('passwordModal').style.display = 'block';
    } else if (this.classList.contains('ri-eye-fill')) {
        document.getElementById('password-display').innerText = '**********';
        this.className = 'ri-eye-off-fill';
    }
});

function checkPassword() {
    const inputPassword = document.getElementById('passwordInput').value;
    if (inputPassword === sessionPassword) {
        document.getElementById('password-display').innerText = sessionPassword;
        document.getElementById('eye-icon').className = 'ri-eye-fill';
        closeModal();
    } else {
        document.getElementById('error-message').style.display = 'block';
        document.getElementById('password-display').innerText = '********';
    }
}

function closeModal() {
    document.getElementById('passwordModal').style.display = 'none';
    document.getElementById('error-message').style.display = 'none';
    document.getElementById('passwordInput').value = '';
}