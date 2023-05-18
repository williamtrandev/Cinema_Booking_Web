Để cấu hình database, vào configs/database.php để thay đổi các thông tin về cấu hình database.
Tài khoản admin vào hệ thống: admin, mật khẩu: 123456
Tài khoản cá nhân: 0907640699, mật khẩu: admin123. 0907640694, mật khẩu: thanhtran






Chi tiết thư mục:
-Thư mục app chua mo hinh MVC
-Thư mục controllers chứa các controllers tương tác với các models trong thư mục models, các models tương tác với database.
-Thư mục view chứa các phần trong trang web, trong view có thư mục blocks chứa các thành phần con tái sử dụng trong web. Các thư mục khác như home là view của trang home. Thư mục layout chứa layout chính của trang web, ở đây là client_layout chính là layout chính gồm 2 thành phần là sidebar và footer.
-App.php để xử lý URL, lấy các action
-Thư mục configs dùng để cấu hình mặc định cho các xử lý.
-Thư mục core chứa các lớp đã viết các phương thức để hỗ trợ kế thừa cho các Controller, Model. Ở đây cũng có một số file dùng để kết nối database và định tuyến.
-Thư mục public chứa các folder con, các folder con gồm css chứa các file css, folder img chứa các file image, folder js chứa các file javascript.

