<!-- Các bước tạo đường dẫn tĩnh -->
- B1: Lấy tên (trường tên)

- B2: thay thế
+ Chuyển tất cả các ký tự thành chữ thường
+ Chuyển các chữ tiếng việt có dấu => không dấu: a, á, â, ...
+ Chuyển các ký tự đặc biệt (bao gồm cả dấu khoảng trắng) => -

- Bước: tự động điền vào input slug

<!-- Ngôn ngữ lập trình sử dụng -->
1. PHP
- Tạo slug tự động dựa vào tên (Trường slug không nhập)
- Update slug vào CSDL

2. JS
- Tạo slug tự động dựa vào tên (Bắt sự kiện onkey ở trường tên)
- Điền dự liệu vào trường slug

=> gõ ký tự ở trường tên => Trường slug sẽ tự động có slug luôn

