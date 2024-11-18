#FITVAA

HỌC VIỆN HÀNG KHÔNG VIỆT NAM

KHOA CONG NGHỆ THÔNG TIN

NHOM 05
- Lê Trần Đức Huy
- Hoàng Thị Thanh Trúc
- Cao Thị Yến Nhung
- Lê Dương Anh Thư
- Trần Thảo

  Hướng dẫn download sourcode và chạy ứng dụng bán thức ăn nhanh
Hướng dẫn
 
- Download sourcode “FoodApp”
- Download Folder “ foodapp” và lưu trong C:\xampp\htdocs\
- Mở XAMPP và chạy MySQL sau đó tạo một database mới với tên “ foodapp” rồi import file foodapp.sql vào để lấy dữ liệu.
 
- Mở sourcode bằng Android Studio:
+ Khởi động Android Studio và nhấp chuột trái vào biểu tượng của Main Menu (biểu tượng 4 gạch ngang, nằm ở góc trái, phía trên màn hình)
 
+ Di chuyển chuột xuống Open và import folder source code vừa giải nén vào.
 

+ chọn app\java\com.name.foodapp\retrofit\RetrofitInstace , ở dòng 
private static final String BASE_URL = "http://192.168.56.1/appfood/";

 

	Chúng ta đổi ip 192.168.56.1 thành ip của máy tính đang sử dụng, nếu không nhớ ip của máy tính thì chúng ta nhấn tổ hợp phím “Windows + R” gỏ lệnh “ cmd “ nhấn phím Enter rồi gỏ lệnh “ ipconfig “ sẻ hiển thị ip của máy.
 
Chạy ứng dụng 
	- Cài đặt máy ảo có API từ 24 trở lên
	- Run app băng cách nhánh nút Run ở trên thanh cộng cụ hoặc nhấn tổ hợp phím “ shift + f10 “
 
	Sau khi nhấn Run sẻ hiển thị ứng dụng

	Đắng nhập hoặc đăng kí tài khoản để có thể vào trang home và sử dụng
