-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 16, 2024 lúc 03:49 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `csdl_radix`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `category_id` int(11) DEFAULT 0,
  `content` text DEFAULT NULL,
  `view_count` int(11) DEFAULT 0,
  `thumbnail` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `duplicate` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `blog`
--

INSERT INTO `blog` (`id`, `title`, `slug`, `user_id`, `category_id`, `content`, `view_count`, `thumbnail`, `description`, `create_at`, `update_at`, `duplicate`) VALUES
(1, 'Bài viết 14', 'bai-viet-14', 3, 2, '&#60;p&#62;Sau khi rời cửa khẩu, 2 bộ trưởng đến thăm c&#38;ocirc;ng tr&#38;igrave;nh Nh&#38;agrave; văn h&#38;oacute;a hữu nghị Việt - Trung tại Bản Phiệt. C&#38;ocirc;ng tr&#38;igrave;nh được kh&#38;aacute;nh th&#38;agrave;nh để ch&#38;agrave;o mừng Giao lưu hữu nghị quốc ph&#38;ograve;ng bi&#38;ecirc;n giới Việt - Trung lần thứ 8. Trong nh&#38;agrave; văn h&#38;oacute;a treo ảnh chụp cuộc gặp của c&#38;aacute;c vị l&#38;atilde;nh đạo tiền bối 2 nước. Đại tướng Phan Văn Giang n&#38;oacute;i với người đồng cấp Trung Quốc rằng những bức ảnh n&#38;agrave;y được chụp &#38;quot;từ l&#38;uacute;c ch&#38;uacute;ng ta chưa sinh ra&#38;quot;.&#60;/p&#62;&#13;&#10;', 21, '/codephp/MD6/radix/uploads/files/4.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#13;&#10;&#13;&#10;', '2024-04-11 15:04:17', '2024-09-03 18:33:41', 2),
(7, 'Bài viết 13', 'bai-viet-13', 3, 9, '&#60;p&#62;Sau khi rời cửa khẩu, 2 bộ trưởng đến thăm c&#38;ocirc;ng tr&#38;igrave;nh Nh&#38;agrave; văn h&#38;oacute;a hữu nghị Việt - Trung tại Bản Phiệt. C&#38;ocirc;ng tr&#38;igrave;nh được kh&#38;aacute;nh th&#38;agrave;nh để ch&#38;agrave;o mừng Giao lưu hữu nghị quốc ph&#38;ograve;ng bi&#38;ecirc;n giới Việt - Trung lần thứ 8. Trong nh&#38;agrave; văn h&#38;oacute;a treo ảnh chụp cuộc gặp của c&#38;aacute;c vị l&#38;atilde;nh đạo tiền bối 2 nước. Đại tướng Phan Văn Giang n&#38;oacute;i với người đồng cấp Trung Quốc rằng những bức ảnh n&#38;agrave;y được chụp &#38;quot;từ l&#38;uacute;c ch&#38;uacute;ng ta chưa sinh ra&#38;quot;.&#60;/p&#62;&#13;&#10;', 11, '/codephp/MD6/radix/uploads/files/4.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#13;&#10;&#13;&#10;', '2024-04-12 17:06:50', '2024-09-03 18:33:28', 0),
(8, 'Bài viết 12', 'bai-viet-12', 3, 10, '&#60;p&#62;Sau khi rời cửa khẩu, 2 bộ trưởng đến thăm c&#38;ocirc;ng tr&#38;igrave;nh Nh&#38;agrave; văn h&#38;oacute;a hữu nghị Việt - Trung tại Bản Phiệt. C&#38;ocirc;ng tr&#38;igrave;nh được kh&#38;aacute;nh th&#38;agrave;nh để ch&#38;agrave;o mừng Giao lưu hữu nghị quốc ph&#38;ograve;ng bi&#38;ecirc;n giới Việt - Trung lần thứ 8. Trong nh&#38;agrave; văn h&#38;oacute;a treo ảnh chụp cuộc gặp của c&#38;aacute;c vị l&#38;atilde;nh đạo tiền bối 2 nước. Đại tướng Phan Văn Giang n&#38;oacute;i với người đồng cấp Trung Quốc rằng những bức ảnh n&#38;agrave;y được chụp &#38;quot;từ l&#38;uacute;c ch&#38;uacute;ng ta chưa sinh ra&#38;quot;.&#60;/p&#62;&#13;&#10;', 16, '/codephp/MD6/radix/uploads/files/4.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#13;&#10;&#13;&#10;', '2024-04-12 17:06:52', '2024-09-03 18:33:06', 1),
(9, 'Bài viết 11', 'bai-viet-11', 5, 3, '&#60;p&#62;Sau khi rời cửa khẩu, 2 bộ trưởng đến thăm c&#38;ocirc;ng tr&#38;igrave;nh Nh&#38;agrave; văn h&#38;oacute;a hữu nghị Việt - Trung tại Bản Phiệt. C&#38;ocirc;ng tr&#38;igrave;nh được kh&#38;aacute;nh th&#38;agrave;nh để ch&#38;agrave;o mừng Giao lưu hữu nghị quốc ph&#38;ograve;ng bi&#38;ecirc;n giới Việt - Trung lần thứ 8. Trong nh&#38;agrave; văn h&#38;oacute;a treo ảnh chụp cuộc gặp của c&#38;aacute;c vị l&#38;atilde;nh đạo tiền bối 2 nước. Đại tướng Phan Văn Giang n&#38;oacute;i với người đồng cấp Trung Quốc rằng những bức ảnh n&#38;agrave;y được chụp &#38;quot;từ l&#38;uacute;c ch&#38;uacute;ng ta chưa sinh ra&#38;quot;.&#60;/p&#62;&#13;&#10;', 11, '/codephp/MD6/radix/uploads/files/4.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#13;&#10;&#13;&#10;', '2024-04-12 17:06:53', '2024-09-03 18:32:50', 1),
(10, 'Bài viết 10', 'bai-viet-10', 3, 3, '&#60;p&#62;Sau khi rời cửa khẩu, 2 bộ trưởng đến thăm c&#38;ocirc;ng tr&#38;igrave;nh Nh&#38;agrave; văn h&#38;oacute;a hữu nghị Việt - Trung tại Bản Phiệt. C&#38;ocirc;ng tr&#38;igrave;nh được kh&#38;aacute;nh th&#38;agrave;nh để ch&#38;agrave;o mừng Giao lưu hữu nghị quốc ph&#38;ograve;ng bi&#38;ecirc;n giới Việt - Trung lần thứ 8. Trong nh&#38;agrave; văn h&#38;oacute;a treo ảnh chụp cuộc gặp của c&#38;aacute;c vị l&#38;atilde;nh đạo tiền bối 2 nước. Đại tướng Phan Văn Giang n&#38;oacute;i với người đồng cấp Trung Quốc rằng những bức ảnh n&#38;agrave;y được chụp &#38;quot;từ l&#38;uacute;c ch&#38;uacute;ng ta chưa sinh ra&#38;quot;.&#60;/p&#62;&#13;&#10;', 21, '/codephp/MD6/radix/uploads/files/4.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#13;&#10;&#13;&#10;', '2024-05-12 17:04:15', '2024-09-03 18:32:34', 1),
(11, 'Bài viết 9', 'bai-viet-9', 5, 3, '&#60;p&#62;Sau khi rời cửa khẩu, 2 bộ trưởng đến thăm c&#38;ocirc;ng tr&#38;igrave;nh Nh&#38;agrave; văn h&#38;oacute;a hữu nghị Việt - Trung tại Bản Phiệt. C&#38;ocirc;ng tr&#38;igrave;nh được kh&#38;aacute;nh th&#38;agrave;nh để ch&#38;agrave;o mừng Giao lưu hữu nghị quốc ph&#38;ograve;ng bi&#38;ecirc;n giới Việt - Trung lần thứ 8. Trong nh&#38;agrave; văn h&#38;oacute;a treo ảnh chụp cuộc gặp của c&#38;aacute;c vị l&#38;atilde;nh đạo tiền bối 2 nước. Đại tướng Phan Văn Giang n&#38;oacute;i với người đồng cấp Trung Quốc rằng những bức ảnh n&#38;agrave;y được chụp &#38;quot;từ l&#38;uacute;c ch&#38;uacute;ng ta chưa sinh ra&#38;quot;.&#60;/p&#62;&#13;&#10;', 10, '/codephp/MD6/radix/uploads/files/4.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#13;&#10;&#13;&#10;', '2024-05-12 17:04:16', '2024-09-03 18:32:17', 1),
(12, 'Bìa viết 8', 'bia-viet-8', 5, 3, '&#60;p&#62;Đ&#38;acirc;y l&#38;agrave; m&#38;ocirc; tả của b&#38;agrave;i viết 8&#60;/p&#62;&#13;&#10;', 10, '/codephp/MD6/radix/uploads/files/4.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#13;&#10;&#13;&#10;', '2024-05-12 17:04:17', '2024-09-03 18:31:58', 1),
(13, 'Bài viết 6', 'bai-viet-6', 5, 3, '&#60;p&#62;Sau khi rời cửa khẩu, 2 bộ trưởng đến thăm c&#38;ocirc;ng tr&#38;igrave;nh Nh&#38;agrave; văn h&#38;oacute;a hữu nghị Việt - Trung tại Bản Phiệt. C&#38;ocirc;ng tr&#38;igrave;nh được kh&#38;aacute;nh th&#38;agrave;nh để ch&#38;agrave;o mừng Giao lưu hữu nghị quốc ph&#38;ograve;ng bi&#38;ecirc;n giới Việt - Trung lần thứ 8. Trong nh&#38;agrave; văn h&#38;oacute;a treo ảnh chụp cuộc gặp của c&#38;aacute;c vị l&#38;atilde;nh đạo tiền bối 2 nước. Đại tướng Phan Văn Giang n&#38;oacute;i với người đồng cấp Trung Quốc rằng những bức ảnh n&#38;agrave;y được chụp &#38;quot;từ l&#38;uacute;c ch&#38;uacute;ng ta chưa sinh ra&#38;quot;.&#60;/p&#62;&#13;&#10;', 10, '/codephp/MD6/radix/uploads/files/4.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#13;&#10;&#13;&#10;', '2024-05-12 17:04:18', '2024-09-03 18:31:22', 2),
(14, 'bài viết 7', 'bai-viet-7', 5, 3, '&#60;p&#62;Sau khi rời cửa khẩu, 2 bộ trưởng đến thăm c&#38;ocirc;ng tr&#38;igrave;nh Nh&#38;agrave; văn h&#38;oacute;a hữu nghị Việt - Trung tại Bản Phiệt. C&#38;ocirc;ng tr&#38;igrave;nh được kh&#38;aacute;nh th&#38;agrave;nh để ch&#38;agrave;o mừng Giao lưu hữu nghị quốc ph&#38;ograve;ng bi&#38;ecirc;n giới Việt - Trung lần thứ 8. Trong nh&#38;agrave; văn h&#38;oacute;a treo ảnh chụp cuộc gặp của c&#38;aacute;c vị l&#38;atilde;nh đạo tiền bối 2 nước. Đại tướng Phan Văn Giang n&#38;oacute;i với người đồng cấp Trung Quốc rằng những bức ảnh n&#38;agrave;y được chụp &#38;quot;từ l&#38;uacute;c ch&#38;uacute;ng ta chưa sinh ra&#38;quot;.&#60;/p&#62;&#13;&#10;', 11, '/codephp/MD6/radix/uploads/files/4.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#13;&#10;&#13;&#10;', '2024-05-12 17:04:18', '2024-09-03 18:31:37', 0),
(15, 'bài viết 5', 'bai-viet-5', 5, 3, '&#60;p&#62;Sau khi rời cửa khẩu, 2 bộ trưởng đến thăm c&#38;ocirc;ng tr&#38;igrave;nh Nh&#38;agrave; văn h&#38;oacute;a hữu nghị Việt - Trung tại Bản Phiệt. C&#38;ocirc;ng tr&#38;igrave;nh được kh&#38;aacute;nh th&#38;agrave;nh để ch&#38;agrave;o mừng Giao lưu hữu nghị quốc ph&#38;ograve;ng bi&#38;ecirc;n giới Việt - Trung lần thứ 8. Trong nh&#38;agrave; văn h&#38;oacute;a treo ảnh chụp cuộc gặp của c&#38;aacute;c vị l&#38;atilde;nh đạo tiền bối 2 nước. Đại tướng Phan Văn Giang n&#38;oacute;i với người đồng cấp Trung Quốc rằng những bức ảnh n&#38;agrave;y được chụp &#38;quot;từ l&#38;uacute;c ch&#38;uacute;ng ta chưa sinh ra&#38;quot;.&#60;/p&#62;&#13;&#10;', 10, '/codephp/MD6/radix/uploads/files/4.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#13;&#10;&#13;&#10;', '2024-05-12 17:04:19', '2024-09-03 18:31:04', 1),
(16, 'bài viết 4', 'bai-viet-4', 5, 3, '&#60;p&#62;Sau khi rời cửa khẩu, 2 bộ trưởng đến thăm c&#38;ocirc;ng tr&#38;igrave;nh Nh&#38;agrave; văn h&#38;oacute;a hữu nghị Việt - Trung tại Bản Phiệt. C&#38;ocirc;ng tr&#38;igrave;nh được kh&#38;aacute;nh th&#38;agrave;nh để ch&#38;agrave;o mừng Giao lưu hữu nghị quốc ph&#38;ograve;ng bi&#38;ecirc;n giới Việt - Trung lần thứ 8. Trong nh&#38;agrave; văn h&#38;oacute;a treo ảnh chụp cuộc gặp của c&#38;aacute;c vị l&#38;atilde;nh đạo tiền bối 2 nước. Đại tướng Phan Văn Giang n&#38;oacute;i với người đồng cấp Trung Quốc rằng những bức ảnh n&#38;agrave;y được chụp &#38;quot;từ l&#38;uacute;c ch&#38;uacute;ng ta chưa sinh ra&#38;quot;.&#60;/p&#62;&#13;&#10;', 11, '/codephp/MD6/radix/uploads/files/4.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#13;&#10;&#13;&#10;', '2024-05-12 17:04:20', '2024-09-03 18:30:50', 1),
(17, 'Bài viết 3', 'bai-viet-3', 5, 3, '&#60;p&#62;Sau khi rời cửa khẩu, 2 bộ trưởng đến thăm c&#38;ocirc;ng tr&#38;igrave;nh Nh&#38;agrave; văn h&#38;oacute;a hữu nghị Việt - Trung tại Bản Phiệt. C&#38;ocirc;ng tr&#38;igrave;nh được kh&#38;aacute;nh th&#38;agrave;nh để ch&#38;agrave;o mừng Giao lưu hữu nghị quốc ph&#38;ograve;ng bi&#38;ecirc;n giới Việt - Trung lần thứ 8. Trong nh&#38;agrave; văn h&#38;oacute;a treo ảnh chụp cuộc gặp của c&#38;aacute;c vị l&#38;atilde;nh đạo tiền bối 2 nước. Đại tướng Phan Văn Giang n&#38;oacute;i với người đồng cấp Trung Quốc rằng những bức ảnh n&#38;agrave;y được chụp &#38;quot;từ l&#38;uacute;c ch&#38;uacute;ng ta chưa sinh ra&#38;quot;.&#60;/p&#62;&#13;&#10;', 15, '/codephp/MD6/radix/uploads/files/4.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#13;&#10;&#13;&#10;', '2024-05-12 17:04:21', '2024-09-03 18:30:27', 1),
(18, 'Bài viết 1', 'bai-viet-1', 5, 9, '&#60;p&#62;Sau khi rời cửa khẩu, 2 bộ trưởng đến thăm c&#38;ocirc;ng tr&#38;igrave;nh Nh&#38;agrave; văn h&#38;oacute;a hữu nghị Việt - Trung tại Bản Phiệt. C&#38;ocirc;ng tr&#38;igrave;nh được kh&#38;aacute;nh th&#38;agrave;nh để ch&#38;agrave;o mừng Giao lưu hữu nghị quốc ph&#38;ograve;ng bi&#38;ecirc;n giới Việt - Trung lần thứ 8. Trong nh&#38;agrave; văn h&#38;oacute;a treo ảnh chụp cuộc gặp của c&#38;aacute;c vị l&#38;atilde;nh đạo tiền bối 2 nước. Đại tướng Phan Văn Giang n&#38;oacute;i với người đồng cấp Trung Quốc rằng những bức ảnh n&#38;agrave;y được chụp &#38;quot;từ l&#38;uacute;c ch&#38;uacute;ng ta chưa sinh ra&#38;quot;.&#60;/p&#62;&#13;&#10;', 31, '/codephp/MD6/radix/uploads/files/4.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#13;&#10;&#13;&#10;', '2024-05-12 17:04:25', '2024-09-03 18:29:35', 2),
(19, 'Bai viết 2', 'bai-viet-2', 5, 9, '&#60;p&#62;dolor sit amet, consectetur adipiscing elit. Fusce porttitor tristique mi, sed rhoncus sapien mollis vitae. Pellentesque at mauris neque. Vestibulum pulvinar ac sagittis ex consectetur sed. Ut viverra elementum libero, nec tincidunt orci vehicula quis. Vivamus vehicula quis&#38;nbsp;&#60;strong&#62;Lorem ipsum&#60;/strong&#62;&#38;nbsp;nunc quis rutrum. Aliquam consectetur dapibus tortor, blandit lobortis erat dictum sed. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed vitae quam dolor.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;sed eleifend lectus purus id sem. Morbi eget interdum ligula. Cras tincidunt tincidunt odio et accumsan. Aliquam erat volutpat. In iaculis tortor ac congue cursus. In hac habitasse platea dictumst. Maecenas eu dignissim nisi. Donec feugiat, massa vel egestas dapibus, libero purus lacinia eros,&#38;nbsp;&#60;u&#62;magna enim&#60;/u&#62;&#38;nbsp;eu pellentesque lorem purus id orci. Cras tempor, mauris vitae congue sollicitudin, ex justo viverra ipsum, sit amet viverra justo odio ac metus. Aenean tristique odio id lectus accumsan convallis. Praesent tempor elit pulvinar elit ultricies, sed gravida nulla cursus. In condimentum mi ex, vel dapibus arcu accumsan ut.&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;blockquote&#62;Trending Title in ullamcorper sollicitudin, ligula nisi hendrerit magna, eget rhoncus purus urna at risus. Nullam volutpat augue at orci malesuada sollicitudin ut id risus. Ut tincidunt, erat eget feugiat eleifend, eros magna dapibus diam, eu aliquam dolor ipsum fringilla nulla&#60;/blockquote&#62;&#13;&#10;&#13;&#10;&#60;p&#62;dolor sit amet, consectetur adipiscing elit. Fusce porttitor tristique mi, sed rhoncus sapien mollis vitae. Pellentesque at mauris neque. Vestibulum pulvinar ac sagittis ex consectetur sed. Ut viverra elementum libero, nec tincidunt orci vehicula quis. Vivamus vehicula quis nunc quis rutrum. Aliquam consectetur dapibus tortor, blandit lobortis erat dictum sed. Interdum et malesuada fames ac ante ipsum primis in .&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;div class=&#34;ddict_btn&#34; style=&#34;left:1035px; top:9px&#34;&#62;&#60;img src=&#34;chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png&#34; /&#62;&#60;/div&#62;&#13;&#10;', 471, '/codephp/MD6/radix/uploads/files/4.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#13;&#10;&#13;&#10;', '2024-05-12 17:04:25', '2024-09-03 18:29:59', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `duplicate` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `user_id`, `create_at`, `update_at`, `duplicate`) VALUES
(2, 'Danh mục bài viết 4', 'danh-muc-bai-viet-4', 3, '2024-04-10 09:43:51', '2024-09-03 18:35:01', 0),
(3, 'Danh mục bài viết 3', 'danh-muc-bai-viet-3', 3, '2024-04-10 09:44:10', '2024-09-03 18:34:54', 0),
(9, 'Danh mục bài viết 2', 'danh-muc-bai-viet-2', 3, '2024-04-10 10:24:19', '2024-09-03 18:34:45', 0),
(10, 'Danh mục bài viết 1', 'danh-muc-bai-viet-1', 3, '2024-04-10 10:38:01', '2024-09-03 18:34:05', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `parent_id` int(11) DEFAULT 0,
  `blog_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 0 COMMENT 'trạng thái bình luận: 0 (Chưa xử lý), 1 (Đã duyệt)',
  `create_at` datetime DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id`, `name`, `email`, `website`, `content`, `parent_id`, `blog_id`, `user_id`, `status`, `create_at`, `update_at`) VALUES
(7, 'Xuân Thái', 'xuanthai0304@gmail.com', NULL, 'Test comment', 0, 19, 3, 1, '2024-05-08 10:25:27', NULL),
(8, 'ngoc han', 'handuong@gmail.com', NULL, 'test comment', 0, 19, NULL, 1, '2024-05-10 10:25:36', NULL),
(9, 'thien tran', '21t1020687@husc.edu.vn', 'https://facebook.com', 'test comment', 0, 19, NULL, 1, '2024-05-15 18:45:25', NULL),
(11, 'anh tuan', 'anhtuan@gmail.com', '', 'anh tuan dang comment', 0, 19, NULL, 1, '2024-05-16 10:27:12', NULL),
(12, 'Tạ Hoàng An', 'hoanan@gmail.com', '', 'test replay', 11, 19, NULL, 1, '2024-05-16 11:31:19', NULL),
(13, 'Khách hàng', 'quanly1@gmail.com', '', 'test replay', 11, 19, NULL, 1, '2024-05-16 11:32:19', NULL),
(14, 'Quản lý', 'quanly2@gmail.com', '', 'Phản hồi bình luận khách hàng', 0, 19, NULL, 1, '2024-05-16 11:33:08', NULL),
(15, 'Khách hàng', 'khachhang@gmail.com', '', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 7, 19, NULL, 1, '2024-05-16 11:35:15', NULL),
(16, 'Khách hàng', 'fewefwe@gmail.com', '', 'test replay', 11, 19, NULL, 1, '2024-05-17 08:25:25', NULL),
(17, 'Tư vấn doanh nghiệp 2', 'tuvandaonhnghiep@gmail.com', '', 'test replay 2', 16, 19, NULL, 1, '2024-05-17 08:30:07', NULL),
(21, 'thaixuan', 'xuanthai0304@gmail.com', '', 'thật tuyệt vời cảm ơn bạn rất nhiều', 0, 19, NULL, 1, '2024-05-17 08:35:00', NULL),
(22, 'xuan thai', 'xuanthai0304@gmail.com', 'https://facebook.com', 'Tôi test comment ngày 17/5/2024', 0, 19, NULL, 1, '2024-05-17 21:27:03', 2024),
(38, 'xuan thai', 'xuanthai0304@gmail.com', 'https://facebook.com', 'ahahahahahahhahaha', 0, 19, NULL, 1, '2024-05-18 00:02:34', NULL),
(39, 'Đinh Xuân Thái', 'xuanthai0304@gmail.com', NULL, 'ok đại ca', 15, 19, 3, 1, '2024-05-18 00:07:36', NULL),
(40, 'Đinh Xuân Thái', 'xuanthai0304@gmail.com', NULL, 'đã hiểu và đang xử lý hihihi', 15, 19, 3, 1, '2024-05-18 00:10:00', 2024),
(41, 'Thien Tran', '21T1020587@husc.edu.vn', 'https://facebook.com', 'Tôi test comment ngày 20/5/2024', 0, 19, NULL, 0, '2024-05-17 21:27:03', 2024),
(43, 'Đinh Xuân Thái', 'xuanthai0304@gmail.com', NULL, 'bình luận đầu tiên của tôi', 0, 19, 3, 0, '2024-05-30 12:03:13', NULL),
(44, 'Đinh Xuân Thái', 'xuanthai0304@gmail.com', NULL, 'bình luận đầu tiên của tôi', 0, 19, 3, 0, '2024-05-30 12:03:35', NULL),
(45, 'Đinh Xuân Thái', 'xuanthai0304@gmail.com', NULL, 'bình luận đầu tiên của tôi', 0, 19, 3, 0, '2024-05-30 12:03:53', NULL),
(46, 'Đinh Xuân Thái', 'xuanthai0304@gmail.com', NULL, '', 0, 1, 3, 0, '2024-08-20 16:19:43', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `type_id` int(11) DEFAULT 0,
  `message` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT 'trạng thái xử lí: 0 (Chưa xử lý), 1 (Đang xử lý), 2 (Đã xử lý)',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts`
--

INSERT INTO `contacts` (`id`, `fullname`, `email`, `type_id`, `message`, `note`, `status`, `create_at`, `update_at`) VALUES
(1, 'Đinh Xuân Thái', 'xuanthai0304@gmail.com', 1, 'Tôi muốn hỏi giá', 'Khách muốn mua sản phẩm giá rẻ', 2, '2024-04-20 10:06:04', '2024-04-21 15:33:13'),
(3, 'Ngô Hạnh', 'ngohanh@gmail.com', 3, 'Tôi muốn ứng tuyển', '', 2, '2024-04-20 10:06:04', '2024-04-21 15:33:06'),
(4, 'Ngô Mỹ Hạnh', 'ngomyhanh@gmail.com', 3, 'tôi muốn kiểm tra lương của mình', 'Đã gọi cho khách hàng nhưng ko nghe máy', 2, '2024-05-21 16:49:27', '2024-05-21 16:50:53'),
(5, 'Đinh Xuân Thái', '21t1020687@husc.edu.vn', 1, 'Tôi muốn tư vấn về sản phẩm', NULL, 0, '2024-05-22 16:11:32', NULL),
(6, 'Đinh Xuân Thái', 'xuanthai0304@gmail.com', 3, 'check email', NULL, 0, '2024-05-22 16:14:38', NULL),
(7, 'Đinh Xuân Thái', '21t1020687@husc.edu.vn', 3, 'check email', NULL, 0, '2024-05-22 16:15:35', NULL),
(8, 'Đinh Xuân Thái', '21t1020687@husc.edu.vn', 3, 'check email', NULL, 0, '2024-05-22 16:16:44', NULL),
(9, 'Ngô Mỹ Hạnh', '21t1020687@husc.edu.vn', 1, 'Tôi muốn mua hàng', NULL, 0, '2024-05-22 16:20:55', NULL),
(10, 'Ngô Mỹ Hạnh', '21t1020687@husc.edu.vn', 1, 'check sitename', NULL, 0, '2024-05-22 16:23:24', NULL),
(11, 'Ngô Mỹ Hạnh', 'xuanthai0304@gmail.com', 3, 'check site name&#13;&#10;', NULL, 0, '2024-05-22 16:26:20', NULL),
(12, 'Đinh Xuân Thái', '21t1020687@husc.edu.vn', 3, 'Radix lam met vai o', NULL, 0, '2024-05-22 16:33:14', NULL),
(13, 'Nguyễn Văn 7', 'fewefwe@gmail.com', 3, 'aaaaaaaaa aaaaaaaaaaaaa aa', NULL, 0, '2024-05-30 12:00:44', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact_type`
--

CREATE TABLE `contact_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `duplicate` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contact_type`
--

INSERT INTO `contact_type` (`id`, `name`, `create_at`, `update_at`, `duplicate`) VALUES
(1, 'Phòng ban 2', '2024-04-18 22:42:37', '2024-09-03 23:00:44', 0),
(3, 'Phòng ban 1', '2024-04-19 22:57:29', '2024-09-03 23:00:37', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `permission` text DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `groups`
--

INSERT INTO `groups` (`id`, `name`, `permission`, `create_at`, `update_at`) VALUES
(1, 'Super admin', '{\"pages\":[\"lists\",\"add\",\"edit\",\"delete\",\"duplicate\"],\"services\":[\"lists\",\"add\",\"edit\",\"delete\",\"duplicate\"],\"portfolios\":[\"lists\",\"add\",\"edit\",\"delete\",\"duplicate\"],\"blog\":[\"lists\",\"add\",\"edit\",\"delete\",\"duplicate\"],\"blog_categories\":[\"lists\",\"add\",\"edit\",\"duplicate\"],\"groups\":[\"lists\",\"add\",\"edit\",\"delete\",\"permission\"],\"users\":[\"lists\",\"add\",\"edit\",\"delete\"],\"contacts\":[\"lists\",\"edit\",\"delete\"],\"contact_type\":[\"lists\",\"add\",\"edit\",\"delete\",\"duplicate\"],\"comments\":[\"lists\",\"edit\",\"delete\",\"status\"],\"subscribe\":[\"lists\",\"edit\",\"delete\"],\"options\":[\"general\",\"header\",\"footer\",\"about\",\"team\",\"services\",\"portfolios\",\"blog\",\"contact\",\"home\",\"menu\"]}', '2024-03-26 17:19:42', '2024-08-17 16:36:44'),
(3, 'Manager', NULL, '2024-03-23 17:19:42', NULL),
(5, 'Sale', NULL, '2024-03-25 17:19:42', NULL),
(12, 'Nhân viên', NULL, '2024-09-03 22:54:41', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `login_token`
--

CREATE TABLE `login_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `token` varchar(100) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `login_token`
--

INSERT INTO `login_token` (`id`, `user_id`, `token`, `create_at`) VALUES
(173, 3, '43275a751865048e9b5b11f9eb38e786638ef7a5', '2024-12-16 09:47:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `action` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `modules`
--

INSERT INTO `modules` (`id`, `name`, `title`, `action`) VALUES
(1, 'pages', 'Quản lý trang', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xóa\",\"duplicate\":\"Nhân bản\"}'),
(2, 'services', 'Quản lý dịch vụ', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xóa\",\"duplicate\":\"Nhân bản\"}'),
(3, 'portfolios', 'Quản lý dự án', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xóa\",\"duplicate\":\"Nhân bản\"}'),
(4, 'blog', 'Quản lý bài viết', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xóa\",\"duplicate\":\"Nhân bản\"}'),
(5, 'blog_categories', 'Quản lý danh mục bài viết', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xóa\",\"duplicate\":\"Nhân bản\"}'),
(6, 'groups', 'Quản lý nhóm người dùng', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xóa\",\"permission\":\"Phân quyền\"}'),
(7, 'users', 'Quản lý người dùng', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xóa\"}'),
(8, 'contacts', 'Quản lý liên hệ', '{\"lists\":\"Xem\",\"edit\":\"Sửa\",\"delete\":\"Xóa\"}'),
(9, 'contact_type', 'Quản lý phòng ban', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xóa\",\"duplicate\":\"Nhân bản\"}'),
(10, 'comments', 'Quản lý bình luận', '{\"lists\":\"Xem\",\"edit\":\"Sửa\",\"delete\":\"Xóa\",\"status\":\"Duyệt\"}'),
(11, 'subscribe', 'Quản lý đăng ký', '{\"lists\":\"Xem\",\"edit\":\"Sửa\",\"delete\":\"Xóa\"}'),
(12, 'options', 'Thiết lập website', '{\"general\":\"Chung\",\"header\":\"Header\",\"footer\":\"Footer\",\"about\":\"Giới thiệu\",\"team\":\"Đội ngũ\",\"services\":\"dịch vụ\",\"portfolios\":\"dự án\",\"blog\":\"Tiêu đề\",\"contact\":\"Liên hệ\",\"home\":\"Trang chủ\",\"menu\":\"Menu\"}');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `opt_key` varchar(100) DEFAULT NULL,
  `opt_value` text DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `options`
--

INSERT INTO `options` (`id`, `opt_key`, `opt_value`, `name`) VALUES
(1, 'general_hotline', '1234567', 'Hotline công ty'),
(2, 'general_email', 'contact@gmail.com', 'Email'),
(3, 'general_time', 'Thời gian làm việc: 8am-5pm', 'Thời gian làm việc'),
(4, 'header_search_placehoder', 'Tìm kiếm dịch vụ...', 'Từ khóa tìm kiếm'),
(5, 'general_facebook', 'https://facebook.com', 'Facebook'),
(6, 'general_twitter', 'https://twitter.com', 'Twitter'),
(7, 'general_linkedin', 'https://linkedin.com', 'LinkedIn'),
(8, 'general_behance', '#', 'Behance'),
(9, 'general_youtube', 'https://youtube.com', 'Youtube'),
(10, 'header_quote_text', 'Nhận báo giá', 'Nút báo giá'),
(11, 'header_quote_link', '#', 'Link báo giá'),
(12, 'header_logo', '/codephp/MD6/radix/uploads/images/logo.png', 'Logo'),
(13, 'header_favicon', '/codephp/MD6/radix//uploads/images/favicon.png', 'Favicon'),
(14, 'general_sitename', 'Radix', 'Tên website'),
(15, 'general_sitedesc', '&#60;p&#62;Radix chuy&#38;ecirc;n cung cấp dịch vụ tổ chức sự kiện&#60;/p&#62;&#13;&#10;', 'Mô tả website'),
(16, 'home_slide', '[{\"slide_title\":\"Radix &#60;span&#62;Business&#60;\\/span&#62; World That Possible anything&#60;span&#62;!&#60;\\/span&#62;\",\"slide_button_text\":\"Our Portfolio\",\"slide_button_link\":\"#\",\"slide_video\":\"https:\\/\\/www.youtube.com\\/watch?v=FZQPhrdKjow\",\"slide_image_1\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/gallery-image1.jpg\",\"slide_image_2\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/gallery-image2.jpg\",\"slide_desc\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi laoreet urna ante, quis luctus nisi sodales sit amet. Aliquam a enim in massa molestie mollis Proin quis velit at nisl vulputate egestas non in arcu Proin a magna hendrerit, tincidunt neque sed.\",\"slide_bg\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/slider-image1.jpg\",\"slide_position\":\"left\"},{\"slide_title\":\"Radix &#60;span&#62;Business&#60;\\/span&#62; World That Possible anything&#60;span&#62;!&#60;\\/span&#62;\",\"slide_button_text\":\"Our Portfolio\",\"slide_button_link\":\"#\",\"slide_video\":\"https:\\/\\/www.youtube.com\\/watch?v=FZQPhrdKjow\",\"slide_image_1\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/gallery-image1.jpg\",\"slide_image_2\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/gallery-image2.jpg\",\"slide_desc\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi laoreet urna ante, quis luctus nisi sodales sit amet. Aliquam a enim in massa molestie mollis Proin quis velit at nisl vulputate egestas non in arcu Proin a magna hendrerit, tincidunt neque sed.\",\"slide_bg\":\"\\/uploads\\/images\\/slider-image1.jpg\",\"slide_position\":\"right\"},{\"slide_title\":\"Radix &#60;span&#62;Business&#60;\\/span&#62; World That Possible anything&#60;span&#62;!&#60;\\/span&#62;\",\"slide_button_text\":\"Our Portfolio\",\"slide_button_link\":\"#\",\"slide_video\":\"https:\\/\\/www.youtube.com\\/watch?v=FZQPhrdKjow\",\"slide_image_1\":\"\",\"slide_image_2\":\"\",\"slide_desc\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi laoreet urna ante, quis luctus nisi sodales sit amet. Aliquam a enim in massa molestie mollis Proin quis velit at nisl vulputate egestas non in arcu Proin a magna hendrerit, tincidunt neque sed.\",\"slide_bg\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/slider-image1.jpg\",\"slide_position\":\"center\"}]', 'Slide'),
(17, 'home_about', '{\"information\":\"{\\\"title_bg\\\":\\\"About us\\\",\\\"desc\\\":\\\"&#60;h1&#62;V\\\\u1ec1 ch&#38;uacute;ng t&#38;ocirc;i&#60;\\\\\\/h1&#62;&#13;&#10;&#13;&#10;&#60;p&#62;contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old&#60;\\\\\\/p&#62;&#13;&#10;\\\",\\\"image\\\":\\\"\\\\\\/codephp\\\\\\/MD6\\\\\\/radix\\\\\\/uploads\\\\\\/images\\\\\\/gallery-4.jpg\\\",\\\"video\\\":\\\"https:\\\\\\/\\\\\\/www.youtube.com\\\\\\/watch?v=E-2ocmhF6TA\\\",\\\"content\\\":\\\"&#60;h2&#62;We Are Professional Website Design &#38;amp; Development Company!&#60;\\\\\\/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. You think water moves fast? You should see ice.&#60;\\\\\\/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a weeked do incididunt magna Lorem&#60;\\\\\\/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalancip isicing elit, sed do eiusmod tempor incididunt&#60;\\\\\\/p&#62;&#13;&#10;\\\",\\\"skill\\\":{\\\"name\\\":[\\\"N\\\\u0103ng l\\\\u1ef1c 1\\\",\\\"N\\\\u0103ng l\\\\u1ef1c 2\\\",\\\"N\\\\u0103ng l\\\\u1ef1c 3\\\",\\\"N\\\\u0103ng l\\\\u1ef1c 4\\\"],\\\"value\\\":[\\\"96\\\",\\\"28\\\",\\\"30\\\",\\\"40\\\"]}}\",\"skill\":\"[{\\\"name\\\":\\\"N\\\\u0103ng l\\\\u1ef1c 1\\\",\\\"value\\\":\\\"96\\\"},{\\\"name\\\":\\\"N\\\\u0103ng l\\\\u1ef1c 2\\\",\\\"value\\\":\\\"28\\\"},{\\\"name\\\":\\\"N\\\\u0103ng l\\\\u1ef1c 3\\\",\\\"value\\\":\\\"30\\\"},{\\\"name\\\":\\\"N\\\\u0103ng l\\\\u1ef1c 4\\\",\\\"value\\\":\\\"40\\\"}]\"}', 'Thiết lập giới thiệu\r\n'),
(18, 'home_service_title_bg', 'Service', 'Tiêu đề nền'),
(19, 'home_service_title', 'Những gì chúng tôi cung cấp', 'Tiêu đề'),
(20, 'home_service_desc', '&#60;p&#62;Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin&#60;/p&#62;&#13;&#10;', 'Mô tả'),
(21, 'home_fact_title', 'Our achievements', 'Tiêu đề chính'),
(22, 'home_fact_sub_title', 'Thành tựu của chúng tôi', 'Tiêu đề phụ'),
(23, 'home_fact_desc', '&#60;p&#62;Pellentesque vitae gravida nulla. Maecenas molestie ligula quis urna viverra venenatis. Donec at ex metus. Suspendisse ac est et magna viverra eleifend. Etiam varius auctor est eu eleifend.&#60;/p&#62;&#13;&#10;', 'Mô tả'),
(24, 'home_fact_button_text', 'LIÊN HỆ', 'Tiêu đề nút'),
(25, 'home_fact_button_link', 'http://localhost:81/codephp/MD6/radix/lien-he.html', 'Link nút'),
(26, 'home_fact_year_number', '35', 'Năm thành lập'),
(27, 'home_fact_project_number', '88', 'Số lượng dự án'),
(28, 'home_fact_earn_number', '10', 'Tổng doanh thu'),
(29, 'home_fact_award_number', '32', 'Số giải thưởng'),
(30, 'home_portfolio_title', 'Dự án', 'Tiêu đề'),
(31, 'home_portfolio_desc', '&#60;p&#62;Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;', 'Miêu tả'),
(32, 'home_portfolio_title_bg', 'Project', 'Tiêu đề nền'),
(33, 'home_portfolio_more_link', 'http://localhost:81/codephp/MD6/radix/du-an.html', 'Link dự án'),
(34, 'home_portfolio_more_text', 'Tất cả dự án', 'Nút xem dự án'),
(35, 'home_cta_content', '&#60;h2&#62;We Have 35+ Years Of Experiences For Creating Creative Website Project.&#60;/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim feugiat, facilisis arcu vehicula, consequat sem. Cras et vulputate nisi, ac dignissim mi. Etiam laoreet&#60;/p&#62;&#13;&#10;', 'Nội dung kêu gọi hành động'),
(36, 'home_cta_button_text', 'đặt hàng ngay', 'Nút kêu gọi'),
(37, 'home_cta_button_link', 'http://localhost:81/codephp/MD6/radix/lien-he.html', 'Link kêu gọi'),
(38, 'home_blog_title', 'Bài viết mới nhất', 'Tiêu đề'),
(39, 'home_blog_desc', '&#60;p&#62;Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin&#60;/p&#62;&#13;&#10;', 'Miêu tả'),
(41, 'home_blog_title_bg', 'NEWS', 'Tiêu đề nền'),
(42, 'home_partner_title', 'Đối tác của chúng tôi', 'Tiêu đề'),
(43, 'home_partner_desc', '&#60;p&#62;Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin&#60;/p&#62;&#13;&#10;', 'Miêu tả'),
(44, 'home_partner_title_bg', 'Partners', 'Tiêu đề nền'),
(45, 'home_partner_content', '[{\"logo\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/partner-1.png\",\"link\":\"#\"},{\"logo\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/partner-2.png\",\"link\":\"#\"},{\"logo\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/partner-3.png\",\"link\":\"#\"},{\"logo\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/partner-4.png\",\"link\":\"#\"},{\"logo\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/partner-5.png\",\"link\":\"#\"},{\"logo\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/partner-6.png\",\"link\":\"#\"},{\"logo\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/partner-8.png\",\"link\":\"#\"},{\"logo\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/partner-5.png\",\"link\":\"#\"},{\"logo\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/partner-6.png\",\"link\":\"#\"},{\"logo\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/partner-7.png\",\"link\":\"#\"},{\"logo\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/partner-3.png\",\"link\":\"#\"},{\"logo\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/partner-2.png\",\"link\":\"#\"}]', 'Danh sách đối tác'),
(46, 'general_address', 'House 20, Sector-7, Road-5, California, US', 'Địa chỉ'),
(47, 'footer_1_title', 'Địa điểm văn phòng', 'Tiêu đề'),
(48, 'footer_1_content', '&#60;p&#62;Nội dung đang được cập nhật ...&#60;/p&#62;&#13;&#10;', 'Nội dung'),
(49, 'footer_2_title', 'Liên kết', 'Tiêu đề'),
(50, 'footer_2_content', '&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;&#13;&#10;&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;localhost:81/codephp/MD6/radix/#&#34;&#62;Giới thiệu về c&#38;ocirc;ng ty ch&#38;uacute;ng t&#38;ocirc;i&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;http://localhost:81/codephp/MD6/radix/#&#34;&#62;Dịch vụ mới nhất của ch&#38;uacute;ng t&#38;ocirc;i&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;http://localhost:81/codephp/MD6/radix/#&#34;&#62;Dự &#38;aacute;n gần đ&#38;acirc;y của ch&#38;uacute;ng t&#38;ocirc;i&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;http://localhost:81/codephp/MD6/radix/#&#34;&#62;B&#38;agrave;i viết&#38;nbsp;mới nhất&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;http://localhost:81/codephp/MD6/radix/#&#34;&#62;Bạn cần trọ gi&#38;uacute;p&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;http://localhost:81/codephp/MD6/radix/#&#34;&#62;Li&#38;ecirc;n hệ với ch&#38;uacute;ng t&#38;ocirc;i&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;&#13;&#10;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;', 'Nội dung'),
(51, 'footer_3_title', 'Thông tin trên Twetters gần đây', 'Tiêu đề'),
(52, 'footer_3_twitter', 'XDevelopers', 'Tài khoản twitter'),
(53, 'footer_4_content', '&#60;p&#62;Nội dung đang được cập nhật ...&#60;/p&#62;&#13;&#10;', 'Nội dung'),
(54, 'footer_4_title', 'Đăng kí nhận tin', 'Tiêu đề'),
(55, 'footer_copyright', '&#60;p&#62;Copyright&#38;nbsp; &#38;copy; 2024 by Đinh Xu&#38;acirc;n Th&#38;aacute;i. All right reserved&#60;/p&#62;&#13;&#10;', 'Copyright'),
(56, 'about-title', 'Giới thiệu chung', 'Tiêu đề trang'),
(57, 'team-title', 'Đội ngũ', 'Tiêu đề trang'),
(58, 'team-primary-title', 'Our Leaders', 'Tiêu đề chính'),
(59, 'team-desc', '&#60;p&#62;Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin&#60;/p&#62;&#13;&#10;', 'Mô tả'),
(60, 'team-title-bg', 'Team', 'Tiêu đề nền'),
(61, 'team-content', '[{\"name\":\"Collis Molate\",\"position\":\"Founder\",\"image\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/t2.jpg\",\"facebook\":\"#\",\"twitter\":\"#\",\"linkedin\":\"#\",\"behance\":\"#\"},{\"name\":\"Domani Plavon\",\"position\":\"Co-Founder\",\"image\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/t3.jpg\",\"facebook\":\"#\",\"twitter\":\"#\",\"linkedin\":\"#\",\"behance\":\"#\"},{\"name\":\"John Mard\",\"position\":\"Developer\",\"image\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/t4.jpg\",\"facebook\":\"#\",\"twitter\":\"#\",\"linkedin\":\"#\",\"behance\":\"#\"},{\"name\":\"Amanal Frond\",\"position\":\"Marketer\",\"image\":\"\\/codephp\\/MD6\\/radix\\/uploads\\/images\\/t1.jpg\",\"facebook\":\"#\",\"twitter\":\"#\",\"linkedin\":\"#\",\"behance\":\"#\"}]', 'Danh sách đội ngũ'),
(62, 'service-title', 'Dịch vụ Radix', 'Tiêu đề trang'),
(63, 'portfolio-title', 'Dự án Radix', 'Tiêu đề trang'),
(64, 'blog-title', 'Bài viết', 'Tiêu đề trang'),
(65, 'blog-per-page', '9', 'Số lượng bài viết trên một trang'),
(66, 'contact-title-bg', 'Radix', 'Tiêu đề nền'),
(67, 'contact-desc', '&#60;p&#62;contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old&#60;/p&#62;&#13;&#10;', 'Mô tả'),
(68, 'contact-title', 'Liên hệ', 'Tiêu đề trang'),
(69, 'contact-primary-title', 'Contact Us', 'Tiêu đề chính'),
(70, 'menu', '[{&#34;text&#34;:&#34;Trang chủ&#34;,&#34;href&#34;:&#34;http://localhost:81/codephp/MD6/radix/&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Giới Thiệu&#34;,&#34;href&#34;:&#34;http://localhost:81/codephp/MD6/radix/gioi-thieu.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;,&#34;children&#34;:[{&#34;text&#34;:&#34;Giới thiệu chung&#34;,&#34;href&#34;:&#34;http://localhost:81/codephp/MD6/radix/gioi-thieu.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Đội ngũ&#34;,&#34;href&#34;:&#34;http://localhost:81/codephp/MD6/radix/doi-ngu.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;}]},{&#34;text&#34;:&#34;Dịch vụ&#34;,&#34;href&#34;:&#34;http://localhost:81/codephp/MD6/radix/dich-vu.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Dự án&#34;,&#34;href&#34;:&#34;http://localhost:81/codephp/MD6/radix/du-an.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Tin Tức&#34;,&#34;href&#34;:&#34;http://localhost:81/codephp/MD6/radix/tin-tuc.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;,&#34;children&#34;:[{&#34;text&#34;:&#34;Danh mục bài viết 1&#34;,&#34;href&#34;:&#34;http://localhost:81/codephp/MD6/radix/danh-muc/danh-muc-bai-viet-1-10.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Danh mục bài viết 2&#34;,&#34;href&#34;:&#34;http://localhost:81/codephp/MD6/radix/danh-muc/danh-muc-bai-viet-2-9.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Danh mục bài viết 3&#34;,&#34;href&#34;:&#34;http://localhost:81/codephp/MD6/radix/danh-muc/danh-muc-bai-viet-3-3.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Danh mục bài viết 4&#34;,&#34;href&#34;:&#34;http://localhost:81/codephp/MD6/radix/danh-muc/danh-muc-bai-viet-4-2.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;}]},{&#34;text&#34;:&#34;Liên hệ&#34;,&#34;href&#34;:&#34;http://localhost:81/codephp/MD6/radix/lien-he.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;,&#34;children&#34;:[{&#34;text&#34;:&#34;Liên hệ Facebook&#34;,&#34;href&#34;:&#34;https://www.facebook.com/thai.2k3.com.vn&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_blank&#34;,&#34;title&#34;:&#34;&#34;}]},{&#34;text&#34;:&#34;Thông tin&#34;,&#34;href&#34;:&#34;&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;,&#34;children&#34;:[{&#34;text&#34;:&#34;Phương thức thanh toán&#34;,&#34;href&#34;:&#34;http://localhost:81/codephp/MD6/radix/thong-tin/phuong-thuc-thanh-toan-2.html&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Hướng dẫn mua hàng&#34;,&#34;href&#34;:&#34;http://localhost:81/codephp/MD6/radix/thong-tin/huong-dan-mua-hang-1.html&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;}]}]', 'Thiết lập menu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `duplicate` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `user_id`, `create_at`, `update_at`, `duplicate`) VALUES
(1, 'Hướng dẫn mua hàng', 'huong-dan-mua-hang', 'Đang cập nhật...', 5, '2024-04-04 17:00:27', NULL, 2),
(2, 'Phương thức thanh toán trực tiếp', 'phuong-thuc-thanh-toan', '&#60;p&#62;Đang cập nhật...&#60;/p&#62;&#13;&#10;', 3, '2024-04-04 17:10:00', '2024-04-05 07:32:45', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `portfolios`
--

CREATE TABLE `portfolios` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `thumbnail` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `video` varchar(100) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `portfolio_category_id` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `duplicate` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `portfolios`
--

INSERT INTO `portfolios` (`id`, `name`, `slug`, `thumbnail`, `description`, `video`, `content`, `user_id`, `portfolio_category_id`, `create_at`, `update_at`, `duplicate`) VALUES
(14, 'Creative Work', 'creative-work', '/codephp/MD6/radix/uploads/images/p1.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=E-2ocmhF6TA', '&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 3, 25, '2024-05-03 16:27:25', '2024-05-03 18:48:30', 2),
(15, 'Dựa án 5', 'dua-an-5', '/codephp/MD6/radix/uploads/files/p2.jpg', 'Đây là mô tả của dự án 5', 'https://www.youtube.com/watch?v=E-2ocmhF6TA', '&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 3, 2, '2024-05-03 16:28:45', '2024-09-03 18:27:28', 0),
(16, 'Dựa án 4', 'dua-an-4', '/codephp/MD6/radix/uploads/files/p3.jpg', 'Đây là mô tả của dự án 4', 'https://www.youtube.com/watch?v=E-2ocmhF6TA', '&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 3, 24, '2024-05-03 17:17:56', '2024-09-03 18:27:06', 1),
(17, 'Dự án 3', 'du-an-3', '/codephp/MD6/radix/uploads/files/p4.jpg', 'Đây là mô tả của dự án 3', 'https://www.youtube.com/watch?v=E-2ocmhF6TA', '&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 3, 5, '2024-05-03 17:19:22', '2024-09-03 18:26:42', 1),
(18, 'Dự án 2', 'du-an-2', '/codephp/MD6/radix/uploads/files/p5.jpg', 'Đây là mô tả của dự án 2', 'https://www.youtube.com/watch?v=E-2ocmhF6TA', '&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 3, 2, '2024-05-03 17:20:53', '2024-09-03 18:26:22', 1),
(19, 'Dự án 1', 'du-an-1', '/codephp/MD6/radix/uploads/files/p6.jpg', 'Đây là mô tả của dự án 1', 'https://www.youtube.com/watch?v=E-2ocmhF6TA', '&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 3, 8, '2024-05-03 17:21:47', '2024-09-03 18:27:40', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `portfolio_categories`
--

CREATE TABLE `portfolio_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `duplicate` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `portfolio_categories`
--

INSERT INTO `portfolio_categories` (`id`, `name`, `user_id`, `create_at`, `update_at`, `duplicate`) VALUES
(2, 'Danh mục 5', 3, '2024-04-05 17:39:41', '2024-09-03 18:28:25', 0),
(5, 'Danh mục 4', 3, '2024-04-07 10:09:41', '2024-09-03 18:28:19', 0),
(8, 'Danh mục 3', 3, '2024-04-07 17:16:34', '2024-09-03 18:28:12', 1),
(24, 'Danh mục 2', 3, '2024-05-03 16:22:16', '2024-09-03 18:28:05', 0),
(25, 'Danh mục 1', 3, '2024-05-03 16:22:26', '2024-09-03 18:27:57', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `portfolio_images`
--

CREATE TABLE `portfolio_images` (
  `id` int(11) NOT NULL,
  `portfolio_id` int(11) DEFAULT 0,
  `image` varchar(100) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `portfolio_images`
--

INSERT INTO `portfolio_images` (`id`, `portfolio_id`, `image`, `create_at`, `update_at`) VALUES
(42, 19, '/codephp/MD6/radix/uploads/files/52.jpg', '2024-05-12 11:01:58', '2024-09-03 18:27:40'),
(43, 19, '/codephp/MD6/radix/uploads/files/61.jpg', '2024-05-12 11:01:58', '2024-09-03 18:27:40'),
(44, 19, '/codephp/MD6/radix/uploads/files/78.png', '2024-05-12 11:01:58', '2024-09-03 18:27:40'),
(45, 19, '/codephp/MD6/radix/uploads/files/125.jpg', '2024-05-12 11:01:58', '2024-09-03 18:27:40'),
(46, 19, '/codephp/MD6/radix/uploads/files/142.jpg', '2024-05-12 11:01:58', '2024-09-03 18:27:40'),
(47, 19, '/codephp/MD6/radix/uploads/files/125.jpg', '2024-05-12 11:01:58', '2024-09-03 18:27:40'),
(48, 18, '/codephp/MD6/radix/uploads/files/125.jpg', '2024-05-12 11:18:36', '2024-09-03 18:27:40'),
(49, 18, '/codephp/MD6/radix/uploads/files/142.jpg', '2024-05-12 11:18:36', '2024-09-03 18:27:40'),
(50, 18, '/codephp/MD6/radix/uploads/files/196.jpg', '2024-05-12 11:18:36', '2024-09-03 18:26:22'),
(51, 18, '/codephp/MD6/radix/uploads/files/52.jpg', '2024-05-12 11:18:36', '2024-09-03 18:27:40'),
(52, 18, '/codephp/MD6/radix/uploads/files/61.jpg', '2024-05-12 11:18:36', '2024-09-03 18:27:40'),
(53, 18, '/codephp/MD6/radix/uploads/files/78.png', '2024-05-12 11:18:36', '2024-09-03 18:27:40'),
(54, 18, '/codephp/MD6/radix/uploads/files/4.jpg', '2024-05-12 11:18:36', '2024-09-03 18:26:22'),
(55, 18, '/codephp/MD6/radix/uploads/files/p5.jpg', '2024-05-12 11:18:36', '2024-09-03 18:26:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  `duplicate` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `services`
--

INSERT INTO `services` (`id`, `name`, `slug`, `icon`, `description`, `content`, `user_id`, `create_at`, `update_at`, `duplicate`) VALUES
(26, 'Dịch vụ 6', 'dich-vu-6', '&#60;i class=&#34;fa fa-lightbulb-o&#34;&#62;&#60;/i&#62;', '&#60;p&#62;Đang cập nhật ...&#60;/p&#62;&#13;&#10;', '&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 3, '2024-05-01 22:22:54', 2024, 2),
(27, 'Dịch vụ 5', 'dich-vu-5', '&#60;i class=&#34;fa fa-magic&#34;&#62;&#60;/i&#62;', '&#60;p&#62;Đang cập nhật ...&#60;/p&#62;&#13;&#10;', '&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 3, '2024-05-01 22:23:31', 2024, 0),
(28, 'Dịch vụ 4', 'dich-vu-4', '&#60;i class=&#34;fa fa-wordpress&#34;&#62;&#60;/i&#62;', '&#60;p&#62;Đang cập nhật ...&#60;/p&#62;&#13;&#10;', '&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 3, '2024-05-01 22:24:24', 2024, 2),
(29, 'Dịch vụ 3', 'dich-vu-3', '&#60;i class=&#34;fa fa-bullhorn &#34;&#62;&#60;/i&#62;', '&#60;p&#62;Đang cập nhật ...&#60;/p&#62;&#13;&#10;', '&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 3, '2024-05-01 22:25:09', 2024, 2),
(30, 'Dịch vụ 2', 'dich-vu-2', '&#60;i class=&#34;fa fa-bullseye &#34;&#62;&#60;/i&#62;', '&#60;p&#62;Đang cập nhật ...&#60;/p&#62;&#13;&#10;', '&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 3, '2024-05-01 22:25:40', 2024, 2),
(31, 'Dịch vụ 1', 'dich-vu-1', '&#60;i class=&#34;fa fa-cube&#34;&#62;&#60;/i&#62;', '&#60;p&#62;Đang cập nhật ...&#60;/p&#62;&#13;&#10;', '&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 3, '2024-05-01 22:26:25', 2024, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT 'trạng thái xử lí: 0 (Chư xử lý), 1 (Đang xử lý), 2 (Đã xử lý)',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `subscribe`
--

INSERT INTO `subscribe` (`id`, `fullname`, `email`, `status`, `create_at`, `update_at`) VALUES
(1, 'xuan thai', 'xuanthai0304@gmail.com', 0, '2024-05-25 10:53:07', '2024-05-26 17:29:09'),
(3, 'Văn An', 'vanan@gmail.com', 0, '2024-05-26 17:29:44', NULL),
(4, 'hoang an web', 'hoanganweb@gmail.com', 0, '2024-05-30 12:06:35', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `about_content` text DEFAULT NULL,
  `contact_facebook` varchar(100) DEFAULT NULL,
  `contact_twitter` varchar(100) DEFAULT NULL,
  `contact_linkedin` varchar(100) DEFAULT NULL,
  `contact_pinterest` varchar(100) DEFAULT NULL,
  `forget_token` varchar(100) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `group_id` int(11) DEFAULT 0,
  `last_activity` datetime DEFAULT NULL,
  `age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `about_content`, `contact_facebook`, `contact_twitter`, `contact_linkedin`, `contact_pinterest`, `forget_token`, `create_at`, `update_at`, `status`, `group_id`, `last_activity`, `age`) VALUES
(3, 'Đinh Xuân Thái', 'xuanthai0304@gmail.com', '$2y$10$jRTCuW1jqEzyWZ9q6o8GFuu1HtbMqz0hpfIKMcqLdIz4JBmHVbK1O', 'Hi, xin chào các bạn', 'https://facebook.com', 'https://twitter.com', 'https://linkedin.com', 'https://pinterest.com', '9182f5609de6cabb4fce29257287d886958a5f0f', '2024-03-20 19:05:48', '2024-04-16 15:10:05', 1, 1, '2024-12-16 09:47:43', NULL),
(5, 'Ngô Mỹ Hạnh', 'ngomyhanh@gmail.com', '$2y$10$xqweNg5ROpOrmts2T1oxDe.xfEf5786h6KmM5QVboFmDe3.rbIPkW', 'Xin Chào các bạn, mình là Hạnh', 'https://facebook.com', 'https://twitter.com', 'https://linkedin.com', 'https://pinterest.com', NULL, '2024-03-30 16:31:13', NULL, 1, 3, NULL, NULL),
(16, 'Nguyen Van A', 'nguyenvana@gmail.com', '123456789', 'hihi', 'facebook', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(17, 'Nguyen Van A', 'nguyenvana@gmail.com', '123456789', 'hihi', 'facebook', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(18, 'Nguyen Van A', 'nguyenvana@gmail.com', '123456789', 'hihi', 'facebook', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(19, 'Tran Van B', 'tranvanb@gmail.com', '123456789', 'hihi', 'facebook', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(20, 'Tran Van B', 'nguyenthic@gmail.com', '123456789', 'hihi', 'facebook', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Chỉ mục cho bảng `contact_type`
--
ALTER TABLE `contact_type`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `login_token`
--
ALTER TABLE `login_token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `portfolio_category_id` (`portfolio_category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `portfolio_images`
--
ALTER TABLE `portfolio_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `portfolio_id` (`portfolio_id`);

--
-- Chỉ mục cho bảng `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `contact_type`
--
ALTER TABLE `contact_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `login_token`
--
ALTER TABLE `login_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT cho bảng `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT cho bảng `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `portfolio_images`
--
ALTER TABLE `portfolio_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT cho bảng `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`),
  ADD CONSTRAINT `blog_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `contact_type` (`id`);

--
-- Các ràng buộc cho bảng `login_token`
--
ALTER TABLE `login_token`
  ADD CONSTRAINT `login_token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `portfolios`
--
ALTER TABLE `portfolios`
  ADD CONSTRAINT `portfolios_ibfk_1` FOREIGN KEY (`portfolio_category_id`) REFERENCES `portfolio_categories` (`id`),
  ADD CONSTRAINT `portfolios_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  ADD CONSTRAINT `portfolio_categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `portfolio_images`
--
ALTER TABLE `portfolio_images`
  ADD CONSTRAINT `portfolio_images_ibfk_1` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolios` (`id`);

--
-- Các ràng buộc cho bảng `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
