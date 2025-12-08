// Chạy khi DOM sẵn sàng
document.addEventListener("DOMContentLoaded", function() {

    // Xác nhận trước khi xóa
    const deleteLinks = document.querySelectorAll(".btn-danger");
    deleteLinks.forEach(function(link){
        link.addEventListener("click", function(e){
            const confirmed = confirm("Bạn có chắc chắn muốn xóa?");
            if(!confirmed){
                e.preventDefault();
            }
        });
    });

    // Thông báo tự ẩn sau 3s (nếu có div.alert)
    const alerts = document.querySelectorAll(".alert");
    alerts.forEach(function(alert){
        setTimeout(function(){
            alert.style.display = "none";
        }, 3000);
    });

    // Toggle sidebar (nếu bạn muốn thêm sidebar responsive)
    const sidebarToggle = document.querySelector("#sidebarToggle");
    if(sidebarToggle){
        sidebarToggle.addEventListener("click", function(){
            document.body.classList.toggle("sidebar-collapsed");
        });
    }

});
