const menuLi = document.querySelectorAll('.admin-sidebar-content > ul > li >a')
const subMenu = document.querySelectorAll('.sub-menu')
for (let index = 0; index < menuLi.length; index++) {
    menuLi[index].addEventListener('click', (e) => {
        e.preventDefault();
        for (let i = 0; i < subMenu.length; i++) {
            subMenu[i].setAttribute("style","height:0px");
        }
        const submenuHeight = menuLi[index].parentNode.querySelector('ul .sub-menu-items').offsetHeight;
        menuLi[index].parentNode.querySelector('ul').setAttribute("style","height:"+submenuHeight+"px");
    });
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

