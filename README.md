# DoAnNganh_NguyenHoangVu_2051050576
HƯỚNG DẪN CÀI ĐẶT MÔI TRƯỜNG
#1.	Cài đặt Laragon
Bước 1: Truy cập vào đường link dưới đây để tiến hành download Laragon https://laragon.org/download/
Bước 2: Mở mục Edition, lựa chọn “Download Laragon – Full”.
Bước 3: Sau khi download về máy, click vào file setup và cài đặt.
Bước 4: Lựa chọn ổ đĩa để chứa Laragon và click “Next” liên tục cho đến khi kết thúc.

#2.	Tạo database trong MySQL
Tạo database có tên “quanlybanhangdientu”
Tạo các table có liên quan

#3.	Cài đặt PhpStorm
Bước 1: Truy cập vào đường link bên dưới để tiến hàng download PhpStorm https://www.jetbrains.com/phpstorm/download/#section=windows
Bước 2: Click vào nút “Download” để tải về.
Bước 3: Sau khi download về máy, click vào file setup và cài đặt.
Bước 4: Lựa chọn ổ đĩa để chứa PhpStorm.
Bước 5: Ở cửa sổ “Configure your PhpStorm installation”, lựa chọn các option sau: 64-bit launcher, .php. Sau đó click “Next” liên tục cho đến khi kết thúc.
#4.	Thiết lập thư mục để chạy phần mềm.
Bước 1: Sau khi cài đặt được Laragon, mở ứng dụng Laragon từ ổ đĩa đã chứa Laragon trong quá trình setup, sau đó click “Start All”.
Bước 2: Vào thư mục Laragon, có 1 folder “www”, xóa file “index.php” mặc định để khi chạy chương trình sẽ không chạy file này.
Bước 3: Đặt toàn bộ ứng dụng websitebanhang vào trong folder “www”.
Bước 4: Tại trình duyệt bất kỳ (Chrome, Safari, Firefox, CocCoc,...), nhập vào URL đường dẫn “localhost” và chọn vào folder “websitebanhang” hoặc nhập vào URL đường dẫn “localhost/ websitebanhang”.

#5.	Xem toàn bộ souce code trên PhpStorm
Bước 1: Mở ứng dụng PhpStorm lên từ ổ đĩa chứa PhpStorm đã cài đặt từ file setup.
Bước 2: PhpStorm sẽ có 2 option để lựa chọn: Activate PhpStorm và Evaluate for free. Click vào “Evaluate for free” và click vào “Evaluate” để sử dụng PhpStorm miễn phí trong 30 ngày.
Bước 3: Chọn “Open” để mở ứng dụng và xem source code.

#6.	Truy cập vào trang quản trị với các tài khoản
STT	Username	Email	Password	Quyền
1	admin	admin@gmail.com
admin@123	Tối thượng
2	user	hoangvu@gmail.com
vu123	Các quyền của User
				
				
				
-	Để không bị gián đoạn trong quá trình thử nghiệm trong module admin, thầy cô có thể vào phần source code và đi theo đường dẫn sau: bookstore/libs/Bootstrap.php.
-	Trong file Bootstrap.php, comment những dòng 49, 52, 53, 54 để hệ thống sẽ không xét các quyền truy cập nếu như gặp phải sự cố màn hình màu trắng khi vào trang admin. Do đôi lúc hệ thống không lấy được những quyền của các Admin và xem như toàn bộ Admin đều không thể truy cập vào phần quản trị.
-	Quá trình này phải đăng nhập vài lần cho đến khi màn hình xuất hiện mảng privilege như hình bên dưới là thành công. Đồng thời phải tắt comment của dòng 46, 47, 48.
 
-	Nếu như thành công rồi thì cần tắt comment của dòng 49, 52, 53, 54 và bật commet của dòng 46, 47, 48 để thực hiện tiếp quá trình thử nghiệm.

7.	Link Source Code
https://drive.google.com/drive/folders/1Sg7DFm2lBiXqjmG1YH3CogSoL2LDW5n9?usp=share_link
