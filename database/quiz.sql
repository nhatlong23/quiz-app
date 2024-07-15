/*
 Navicat Premium Data Transfer

 Source Server         : quiz-app-local
 Source Server Type    : MySQL
 Source Server Version : 50744 (5.7.44)
 Source Host           : localhost:3306
 Source Schema         : quiz

 Target Server Type    : MySQL
 Target Server Version : 50744 (5.7.44)
 File Encoding         : 65001

 Date: 05/07/2024 16:50:39
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for blocks
-- ----------------------------
DROP TABLE IF EXISTS `blocks`;
CREATE TABLE `blocks`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of blocks
-- ----------------------------
INSERT INTO `blocks` VALUES (1, '12', 'Khối 12', 1, '2024-04-23 23:04:07', '2024-05-04 00:08:21');
INSERT INTO `blocks` VALUES (2, '11', 'Khối 11', 1, '2024-04-23 23:04:19', NULL);
INSERT INTO `blocks` VALUES (3, '10', 'Khối 10', 1, '2024-04-23 23:04:35', '2024-05-04 00:08:18');

-- ----------------------------
-- Table structure for blogs
-- ----------------------------
DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `users_id`(`users_id`) USING BTREE,
  CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = sjis COLLATE = sjis_japanese_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of blogs
-- ----------------------------
INSERT INTO `blogs` VALUES (1, 'Kiếm Tiền Từ Viết Blog', 'kiem-tien-tu-viet-blog', 2, 'aa,a,aaa', '<p>Bạn có thâm niên trong&nbsp;<a href=\"https://ngocdenroi.com/podcast/tu-duy-kiem-tien-tu-nghe-viet.html\">nghề viết</a> bao lâu rồi?</p><p>Sáu tháng, 1 năm, 2 năm hay lâu hơn…</p><p>Kiếm tiền từ viết blog cá nhân: bạn đã làm được chưa?</p><p>Nếu bạn nói rằng, bạn viết vì đam mê, tiền bạc không quan trọng thì bài viết này không dành cho bạn. Nhưng thực tế chỉ ra rằng, hầu hết chúng ta viết blog là để kiếm tiền. Và tôi cũng viết blog, làm website Affiliate là để kiếm tiền. Vì thế, hãy ở lại đây nếu bạn cũng giống tôi nhé.</p><p>Có nhiều bạn tâm sự với tôi rằng: “6 tháng qua, 1 năm qua em đang làm không công anh ạ!”.</p><p>Ồ, chuyện đó bình thường thôi. Đâu phải riêng bạn chịu nỗi đau đó, rất nhiều người ngoài kia cũng từng như bạn. Chẳng thế mà, <a href=\"https://www.quora.com/Why-did-90-people-fail-when-they-start-a-blog\">hơn 90% số người viết blog đang không kiếm được tiền</a> . Để rồi cuối cùng quay trở lại công việc 8/5 (8 tiếng/ngày, 5 ngày/tuần) và sống phần đời còn lại cùng công việc đó.</p><p>Nếu không tin, bạn có thể khảo sát trong các forum, group chia sẻ kỹ thuật viết blog xem bao nhiêu phần trăm con người trong đó thực sự kiếm được tiền từ blog của họ.</p><p>Và số người sống toàn thời gian với nghề viết thực sự đếm trên đầu ngón tay.</p><p>Vì thế, hãy mạnh mẽ lên, bạn của tôi. Kiếm tiền từ viết blog cá nhân không dành cho tất cả mọi người nhưng đó là một con đường xây dựng tương lai tài chính bền vững. Tuy nhiên, hãy nhớ rằng những đồng tiền đầu tiên từ blog không đến sau 1 đêm mà nó chỉ xuất hiện khi bạn nỗ lực nhiều tháng hoặc nhiều năm làm việc liên tục phía sau cánh cửa đóng kín.</p><p>Vậy câu hỏi đặt ra là…</p><p>Nội dung bài viết</p><figure class=\"table\"><table><tbody><tr><td><a href=\"https://ngocdenroi.com/blog/kiem-tien-tu-viet-blog.html#1_Tai_sao_ban_van_chua_kiem_duoc_tien\">1. Tại sao bạn vẫn chưa kiếm được tiền?</a></td></tr><tr><td><a href=\"https://ngocdenroi.com/blog/kiem-tien-tu-viet-blog.html#2_Hay_bat_dau_tu_khach_hang_dung_bat_dau_tu_san_pham\">2. Hãy bắt đầu từ khách hàng, đừng bắt đầu từ sản phẩm</a></td></tr><tr><td><a href=\"https://ngocdenroi.com/blog/kiem-tien-tu-viet-blog.html#3_Quen_tien_di\">3. Quên tiền đi</a></td></tr><tr><td><a href=\"https://ngocdenroi.com/blog/kiem-tien-tu-viet-blog.html#4_Tao_ra_su_khac_biet\">4. Tạo ra sự khác biệt</a></td></tr><tr><td><a href=\"https://ngocdenroi.com/blog/kiem-tien-tu-viet-blog.html#5_San_pham_cua_ban_la_gi\">5. Sản phẩm của bạn là gì</a></td></tr><tr><td><a href=\"https://ngocdenroi.com/blog/kiem-tien-tu-viet-blog.html#6_Dam_me_va_kien_tri\">6. Đam mê và kiên trì</a></td></tr></tbody></table></figure><h2>1. Tại sao bạn vẫn chưa kiếm được tiền?</h2><p>Đơn giản là vì bạn chưa kiếm được tiền. Thế thôi.</p><p>Nhưng xét cho cùng bạn phải hiểu chính xác blog là gì? Bởi hiểu rõ nó thì bạn mới biết cần làm gì để nó lớn mạnh và có thể tạo ra những đồng tiền đầu tiên.</p><p>Blog là một doanh nghiệp online. Chính xác là vậy.</p><p>Có nghĩa, khi bạn bắt đầu viết blog là bạn đang bắt đầu startup một doanh nghiệp cho riêng mình.&nbsp;</p><p>Và theo thống kê thì tỉ lệ startup thất bại trên thế giới nói chung dao động từ 75 đến 90%. Vì thế, bạn chưa kiếm được từ blog của mình cũng là chuyện bình thường như cân đường hộp sữa thôi.&nbsp;</p><p>Đừng đau lòng vì chuyện đó.</p><p>Cho nên bây giờ, thay vì ngồi kêu than thì hãy tìm hiểu xem tại sao có nhiều người ngoài kia lại kiếm được tiền, thậm chí rất nhiều tiền từ blog của họ. Và tại sao bạn cũng viết và viết nhưng vẫn mãi “tiền khô cháy túi có ai hiểu cho”.</p><p>Làm thế nào để có những đồng tiền đầu tiên từ công việc này?</p><p>Đơn giản thôi.</p><p>Trước tiên, hãy thay đổi tư duy của mình. Hãy coi viết blog là một công việc nghiêm túc giống như bạn đang khởi nghiệp một cửa hàng quần áo thời trang hay hoành tráng hơn là nghĩ nó giống như một salon bán ô tô,… Tôi không đùa đâu, hãy tưởng tượng bạn phải đổ cả trăm triệu, cả tỉ bạc vào doanh nghiệp này của mình. Vì chỉ có như thế bạn mới có thể sống chết với doanh nghiệp online của mình được.</p><p>Và điều thứ hai là…</p><h2>2. Hãy bắt đầu từ khách hàng, đừng bắt đầu từ sản phẩm</h2><p>Bạn đã&nbsp;<a href=\"https://ngocdenroi.com/blog/cach-tao-blog-kiem-tien.html\">xây dựng một blog cho riêng mình</a> nhưng vẫn loay hoay tìm cách kiếm tiền từ nó.Bạn đã&nbsp;<a href=\"https://ngocdenroi.com/the/viet-blog/\">xuất bản nội dung</a> với hàng trăm bài viết nhưng vẫn không giữ chân và biến người đọc trở thành khách hàng của bạn. Bạn đã áp dụng rất nhiều kỹ thuật khác nhau để&nbsp;<a href=\"https://ngocdenroi.com/blog/cach-quang-ba-blog-moi.html\">tăng lưu lượng người dùng</a> nhưng vẫn không có chuyển đổi.</p><p>Đúng. Những gì bạn đã làm là không sai. Nhưng có một điều vô cùng quan trọng mà bạn không nhớ đó là: <i><strong>để kiếm tiền từ viết blog thì bạn phải bắt đầu từ khách hàng (người đọc mơ ước), chứ không phải bắt đầu từ sản phẩm.</strong></i></p><p>Vì một lý do nào đó bạn KHÔNG bắt đầu blog của mình từ khách hàng. Bạn KHÔNG vẽ chính xác độc giả mơ ước của mình là ai. Và KHÔNG biết ai là người trả tiền cho sản phẩm mà bạn muốn bán.</p><p>Vô lý nhỉ. Blog của tôi vẫn có hàng chục thậm chí hàng trăm người vào đọc mỗi ngày mà. Đó là độc giả của tôi.</p><p>Đúng rồi. Nhưng ý tôi là bạn không biết chính xác ai sẽ là người sẵn sàng trả tiền cho những sản phẩm, dịch vụ mà bạn bán. Bởi vì, khi bắt đầu một blog, hầu hết chúng ta thường nghĩ ngay đến sản phẩm mà mình muốn bán. Chúng ta ra sức quảng cáo (PR) cho sản phẩm đó mà quên mất độc giả của mình RẤT THÍCH&nbsp; mua hàng nhưng lại KHÔNG muốn bị bán.</p><p>Vì vậy, thay vì nói về sản phẩm thì bạn cần vẽ chính xác chân dung khách hàng của mình bao gồm đặc điểm NHÂN KHẨU HỌC và quan hơn hơn đó là ĐẶC ĐIỂM TÂM LÝ HỌC (<i>đây mới là điều giúp bạn kiếm được tiền</i>).</p><p>Bạn hãy trả lời những câu hỏi: họ là ai? tên? tuổi? địa chỉ?…. sau đó đi sâu vào tìm hiểu tâm trí họ xem họ cần gì? nỗi đau lớn nhất của họ là gì? điều gì làm họ mất ngủ hàng đêm? điều gì khiến họ Aha…nhảy cẫng lên vì sung sướng?</p><p>Tóm lại hiểu càng sâu thì nhu cầu khách hàng càng cao và bạn mới dễ dàng cho họ vào nồi để xào nấu, áp chảo hoặc chiên xù,….tùy thích.</p><p>Thứ ba…</p><h2>3. Quên tiền đi</h2><p>Ô hay. Chúng ta viết blog để kiếm tiền mà. Sao giờ lại quên tiền đi.</p><p>Sự thật tréo ngoe là chúng ta vì tiền mà viết blog nhưng chúng ta phải vì khách hàng mà quên tiền đi để trao giá trị hữu ích nhất dành cho họ.</p><p>Nhắc lại cho bạn nhớ “Mọi khách hàng đều muốn mua hàng, nhưng họ lại không muốn bị bán”.</p><p>Vì thế, bạn phải nhớ là trong suốt hành trình mua hàng (<a href=\"https://vi.wikipedia.org/wiki/AIDA_(ti%E1%BA%BFp_th%E1%BB%8B)\">tham khảo quy trình AIDA</a>), nếu bất kỳ một bước nào khách hàng ngửi thấy mùi bạn tìm cách bán hàng cho họ thì ngay lập tức họ bật chế độ phòng vệ của mình lên, và cuộc giao dịch sẽ bị gián đoạn. Tỉ lệ chốt sale giảm 25% sau mỗi giai đoạn.&nbsp;</p><p>Vậy để tăng tỉ lệ chuyển đổi bạn cần làm gì?</p><p>Chính xác là bạn cần tạo ra trải nghiệm cho khách hàng bằng cách trao đi VÔ ĐIỀU KIỆN những gì QUÝ GIÁ NHẤT của bạn. Đó là cách duy nhất để bạn đến gần hơn với độc giả của mình, kết nối cảm xúc với họ và biến họ trở thành “người trả tiền trung thành” của mình.&nbsp;</p><p>Cụ thể làm như thế nào?</p><p>Hãy nói về đau đớn họ đang chịu đựng. Hãy nói về lợi ích sản phẩm của bạn. Hãy nói về giải pháp của bạn có thể loại bỏ nỗi đau của họ như thế nào, giúp họ tiến gần hơn với sự sung sướng ra sao?&nbsp;</p><p>Hãy nói về tiền bạc, sức khỏe và mối quan hệ. Bởi hầu hết cuộc sống của loài người đều cố gắng đạt được 3 điều này. Kiếm thật nhiều tiền để bảo vệ sức khỏe và duy trì mối quan hệ hữu ích.</p><p>Tóm lại, tạm thời QUÊN TIỀN ĐI và trao cho khách hàng những gì họ cần.</p><p>Tiếp theo, bạn cần…</p><h2>4. Tạo ra sự khác biệt</h2><p>Bạn nghĩ xem, 7 tỉ người trên trái đất thì có đến 1 tỉ blog đang tồn tại. Nghĩa là cứ 7 người thì có 1 người sở hữu blog riêng. Và chỉ có 10 kết quả xuất sắc nhất trong cùng cùng thị trường ngách được hiển thị trên công cụ tìm kiếm Google.</p><p>Thật đáng sợ. Phải không?</p><p>Vậy còn cơ hội nào dành cho bạn khi tất cả mọi lĩnh vực, mọi ngóc ngách đều có người viết về nó rồi.</p><p>Yên tâm đi. Bảy tỉ người trên trái đất nhưng có ai giống bạn không?</p><p>Không. Chắc chắn là không. Bạn là một cá thể độc lập và duy nhất có bộ GEN không giống bất cứ ai trong 6,9 tỉ người còn lại.</p><p>Vì vậy, hãy tận dụng điều đó để tạo nên sự khác biệt bằng phong cách cá nhân, bằng suy nghĩ và bằng cá tính riêng của bạn.</p><p>Làm như thế nào?</p><ul><li>Nghĩ xem bạn là người như thế nào: hài hước? nghiêm trang? trung thực? giản dị? phóng khoáng?… hãy thể hiện đúng bản chất con người bạn trong khi viết văn bản của mình.</li><li>Sau đó, sử dụng ngôn từ vẽ lên hình ảnh sống động để tăng trải nghiệm thực tế trong tâm trí khách hàng.</li><li>Tiếp đến, kể những câu chuyện nhằm kết nối cảm xúc cá nhân và truyền cảm hứng cho họ, giúp họ thực hiện những hành động cụ thể theo yêu cầu của bạn.</li><li>Cuối cùng, viết bằng cả trái tim, tìm mọi cách trao đi giá trị lớn nhất cho độc giả của mình.&nbsp;</li></ul><p>&nbsp;Và bây giờ, đã đến lúc bạn cần nghĩ xem…</p><h2>5. Sản phẩm của bạn là gì</h2><p>Tất nhiên rồi, viết blog để thu hút độc giả và biến họ thành khách hàng trả tiền cho bạn.</p><p>Bạn có thấy không, tất cả những gì mà bạn đã làm là thu hút, kết nối và duy trì mối quan hệ thân thiết với khách hàng tiềm năng của mình. Biến họ từ người lạ thành người quen. Từ người quen thành thân thiết. Và bây giờ là bán hàng.</p><p>Khi bắt đầu viết blog, bạn phải QUÊN TIỀN ĐI thì ở đây bạn cần phải YÊU TIỀN. Bạn phải nghĩ xem nên bán sản phẩm gì, giá cả ra sao.</p><p>Làm thế nào biết khách hàng thích gì?&nbsp;</p><p>Quay trở lại giai đoạn vẽ chân dung khách hàng ở đầu bài viết này. Bạn đã tìm ra nỗi đau, niềm sung sướng của khách hàng rồi, đúng không?</p><p>Vậy thì hãy trả lời câu hỏi:&nbsp;</p><ul><li>Những <a href=\"https://noidunglavua.com/tinh-nang-cua-san-pham/\">lợi ích sản phẩm dịch vụ</a> nào của bạn giải quyết được đau đớn đó và nhanh chóng giúp họ đạt được ước mơ?</li><li>Trên thị trường hiện đã có sản phẩm nào khác chưa?</li><li>Lợi thế bán hàng độc nhất (USP) trên sản phẩm của bạn là gì?</li><li>Sản phẩm của bạn có giúp giải quyết được các vấn đề về TIỀN BẠC, SỨC KHỎE và MỐI QUAN HỆ của khách hàng không?</li></ul><p>Sau khi tìm ra sản phẩm mà khách hàng sẵn sàng trả tiền, bạn tiếp tục tìm kiếm hàng loạt các sản phẩm khác có thể giải quyết được những đau đớn lớn hơn cho khách hàng của mình. Đó là tư duy xây dựng chuỗi sản phẩm.</p><p>Như vậy là, bạn đã biết chính xác để kiếm được tiền từ doanh nghiệp online thì về bản chất chúng ta phải là NGƯỜI CÓ GIÁ TRỊ và trao đi miễn phí SỰ HỮU ÍCH cho độc giả của mình. Nói cách khác bạn cần phải PHỤNG SỰ độc giả của mình vô điều kiện.</p><p>Và điều cuối cùng, nếu muốn thành công với blog thì bạn cần phải…</p><h2>6. Đam mê và kiên trì</h2><p>Có câu “Theo đuổi đam mê, thành công sẽ theo đuổi bạn”.</p><p>Vì thế, nếu bạn chỉ coi viết blog là một cuộc dạo chơi. Bạn “nghe nói” có người kiếm được tiền từ viết blog, sau đó bạn lao vào thử xem có kiếm được chút nào không thì tôi khuyên bạn hãy dừng lại cho đỡ mất thời gian, kiếm công việc khác và dành thời gian cho những người thân yêu của bạn. Hãy nhớ, viết blog không có THỬ mà phải làm THẬT thì mới có tiền.</p><p>Vậy làm sao để biết mình có đam mê với công việc viết lách này hay không?</p><p>Hãy tự trả lời những câu hỏi sau:</p><ul><li>Vì sao bạn viết blog? vì muốn tự do thời gian, độc lập tài chính?&nbsp; hay chỉ vì mình thích viết?</li><li>Nếu có rất nhiều tiền rồi bạn có tiếp tục viết lách nữa hay không?</li><li>Giả sử 6 tháng, 1 năm hoặc thậm chí 2 năm nữa nếu vẫn chưa kiếm được tiền từ blog thì bạn có tiếp tục công việc này nữa không?</li></ul><p>Nếu bạn trả lời là YES. Thì xin chúc mừng bạn, hãy tiếp tục với niềm đam mê và kiên trì theo đuổi mục tiêu của mình. Viết vì ĐAM MÊ hay viết vì TIỀN BẠC thì tôi tin bạn cũng sẽ thành công. Và việc kiếm được tiền từ viết blog cá nhân chỉ còn là vấn đề thời gian.</p><p>Cuối cùng, tôi muốn mượn câu nói của Steve Job để kết thúc cho những chia sẻ trong bài viết này “ Stay hungry. Stay foolish”, dịch ra có nghĩa là “ Hãy cứ khát khao. Hãy cứ dại khờ”.</p><p>Chúc bạn một ngày làm việc tràn đầy năng lượng.</p><p>Chào thân ái và quyết thắng 🙂</p>', 'https://res.cloudinary.com/quizz-local/image/upload/v1714985227/quizz_local/kiem-tien-tu-viet-blog.jpg', 1, '2024-05-06 15:02:30', '2024-05-08 15:39:51');
INSERT INTO `blogs` VALUES (2, '23 bài học trong năm 2023', '23-bai-hoc-trong-nam-2023', 1, '', '<p>Lại sắp kết thúc một năm nữa rồi. Thời gian thật sự quá nhanh.</p><p>Có khi nào bạn luôn cảm thấy một ngày thì rất dài. Nhưng một năm thì lại quá ngắn?</p><p>Năm 2023 đối với Ngọc là một năm chuyển biến về nội tâm rất lớn. Và qua đó Ngọc cũng cảm nhận được rất nhiều điều, rất nhiều bài học.</p><p>Thật sự ngay bây giờ Ngọc có thể liệt kê 100 bài học cho năm 2023. Nhưng để rút gọn lại Ngọc sẽ chắt lọc và chia sẽ với bạn:</p><h2>23 bài học cho năm 2023</h2><p><strong>1. Luôn thiết lập mục đích cho riêng mình</strong></p><p>Nếu bạn không biết mình muốn gì, bạn sẽ được cho biết bạn muốn gì và bạn sẽ tin vào điều đó – rất dễ bị lừa. Rất dễ bị dẫn dắt.</p><p><strong>2. Mục tiêu hiệu suất thay vì mục tiêu phù phiếm</strong></p><p>Thay vì đặt mục tiêu “1000 người truy cập blog mỗi ngày” (mục tiêu phù phiếm).</p><p>Hãy thực hiện mục tiêu hiệu suất “tạo ra 2 bài đăng trên blog mỗi tuần, có thể thu hút 1000 người đọc mỗi ngày”</p><p>Thay vì đặt mục tiêu tạo ra một “bài viết hay có khả năng viral trên mạng xã hội” thì hãy đặt mục tiêu “viết 1500 từ” sau đó quay trở lại chỉnh sửa cho bài viết hay hơn.</p><p><strong>3. 10 năm trước &amp; 10 năm sau</strong></p><p>Tình trạng hiện tại là sự phản ánh của nỗ lực 10 năm trước của bạn.</p><p>Tại thời điểm này trong cuộc đời, bạn là biểu hiện của tất cả những lựa chọn trong quá khứ của bạn. Những lựa chọn này không chỉ về thể chất… mà còn về tinh thần, tài chính, thậm chí tâm linh.</p><p>Và vì thế cuộc sống của bạn, 10 năm sau, sẽ là sự thể hiện những lựa chọn của bạn hôm nay, ngày mai và những ngày tiếp theo.</p><p>Con người không có số phận. Số phận là một tập hợp của sự lựa chọn trong 10 năm &amp; lặp lại (cuộc đời có mấy lần 10 năm?)</p><p><strong>4. Đừng bao giờ khoá tâm trí của mình lại</strong></p><p>Hãy đạt được sự hiểu biết đa chiều. Nhìn nhận tình hình từ nhiều góc độ.</p><p>Thế giới hiện nay thay đổi quá nhanh, do đó hãy mở lòng để đón nhận kiến thức, cơ hội (và cả nguy cơ)</p><p>Hiện nay trí tuệ nhân tạo (AI) đang bắt đầu được nhắc đến &amp; rất nhiều người “khoá tâm trí” của mình lại. Họ kỳ thị, thậm chí phản đối AI, họ cho rằng AI sẽ cướp việc làm của họ &amp; của nhân loại</p><p>14 năm trước, khi Bitcoin ra đời cũng có rất nhiều người “khoá tâm trí” &amp; trong 14 năm qua họ vẫn tiếp tục kỳ thị, phản đối.</p><p>Về cơ bản họ đã (và sẽ còn) đánh mất một cơ hội. Còn nhiều lĩnh vực khác nữa, đừng “khoá tâm trí” lại nữa!</p><p><strong>5. Thực hành lòng biết ơn sẽ giúp bạn thay đổi hành vi</strong></p><p>Nếu buổi sáng bạn không thể rời khỏi giường để hình thành thói quen tập thể dục, bạn luôn tắt báo thức.</p><p>Hãy nghĩ như sau:</p><p>Có những người không có chân, nên họ không thể ra khỏi giường nếu không có sự giúp đỡ.</p><p>Có những người không có giường, không có thức ăn để nấu vào buổi sáng.</p><p>Biết ơn là cách giúp bạn thay đổi hành vi.</p><p>Thay đổi hành vi giúp thay đổi thói quen.</p><p>Thay đổi thói quen giúp thay đổi cuộc đời.</p><p><strong>6. Tự do tài chính chỉ là trạng thái</strong></p><p>Bạn thực sự không cần có 5 tỷ, 12 tỷ… 100 tỷ để được tự do tài chính. (Đọc thêm bài → <a href=\"https://ngocdenroi.com/finlancer/con-duong-den-tu-do-tai-chinh.html\">Đây là con đường đến tự do tài chính mà… không cần tiết kiệm đủ 12 tỷ!</a> )</p><p>Tự do tài chính không được định nghĩa bởi số tiền cụ thể. Tự do tài chính là khi bạn có dòng thu nhập (chủ động + thụ động) lớn hơn số tiền mà bạn cần để chi cho cuộc sống mỗi tháng.</p><p>Tự do tài chính là khi bạn không có nợ. Khi bạn biết kiểm soát điều gì cần, điều gì muốn.</p><p>Tự do tài chính là khi bạn sở hữu những kỹ năng tạo thu nhập bền vững.</p><p>Vì thế tự do tài chính với mỗi người đều khác nhau &amp; nó chỉ là một trạng thái.</p><p><strong>7. Đám đông luôn sai</strong></p><p>Hãy quan sát đám đông, nhận ra loại cuộc sống mà bạn không muốn sống và đi theo hướng ngược lại.</p><p>Hãy quan sát đám đông, nhận ra sự fomo (fear of missing out – sợ bị bỏ lỡ cơ hội) và rời đi đúng lúc.</p><p><strong>8. Cám ơn những người đã ganh ghét, đố kỵ</strong></p><p>Vì họ chính là dấu hiệu nhận biết &amp; họ cũng là “người đẩy thuyền”</p><p>Dấu hiệu nhận biết: Nếu không có họ, bạn sẽ không biết mình đang làm tốt đến mức nào</p><p>“Người đẩy thuyền”: Chính họ là động cơ giúp đẩy “con thuyền” của bạn tiến xa hơn về phía trước</p><p><strong>9. Trong vòng 100 năm, không ai nhớ, không ai ghét bạn nữa</strong></p><p>Trong vòng 100 năm thì số người thích bạn &amp; số người ghét bạn rồi cũng sẽ “ra đi”. Trong vòng 100 năm bạn cũng sẽ chẳng còn nhớ đến họ nữa, vậy tại sao ngay lúc này bạn lại phải quá bận tâm đến họ làm gì?</p><p><strong>10. Trân trọng từng khoảnh khắc</strong></p><p>Chúng ta đang sống trong một thế giới mất tập trung, mất đi sự kiểm soát</p><p>Cách để chống lại sự mất tập trung, thiếu kiểm soát đơn giản là: Luôn ý thức trân trọng từng khoảnh khắc!</p><p>Khi ăn hay chú tâm bạn đang ăn gì (rời khỏi điện thoại, tivi)</p><p>Khi bạn đang nghe con gái kể câu chuyện trong lớp học. Hãy loại bỏ tất cả những thứ khác để lắng nghe trọn vẹn câu chuyện của con.</p><p><img src=\"https://ngocdenroi.com/wp-content/uploads/2023/12/23-bai-hoc-nam-2023.jpg\" alt=\"23 bài học năm 2023\" width=\"800\" height=\"1067\"></p><p><strong>11. Nhận thức sẽ sinh ra nhận thức</strong></p><p>Trong thời điểm hiện tại, không có lựa chọn đúng hay sai. Không có cách nào bạn có thể biết chắc chắn 100% hành động của mình sẽ dẫn đến đâu.</p><p>Bạn không biết phải cải thiện điều gì nếu không phạm sai lầm.</p><p>Vì thế, nhận thức được điều này bạn sẽ biết mình phải làm gì (sinh ra nhận thức tiếp theo)</p><p><strong>12. Không bao giờ có người bạn đời hoàn hảo</strong></p><p>Đừng cố gắng tìm kiếm một người bạn đời hoàn hảo. Trước hết, chính mình hãy trở thành con người tốt hơn &amp; sau đó bạn sẽ cùng người bạn đời trở thành phiên bản tốt hơn mỗi ngày.</p><p><strong>13. Ai là người đi cùng bạn lâu nhất trong cuộc đời?</strong></p><p>Người chúng ta đồng hành lâu nhất trong cuộc đời không phải là cha mẹ hay con cái. Bạn bè thì càng không phải. Đó chính là người vợ/ chồng sẽ đi cùng ta lâu nhất.</p><p><strong>14. Tin tức, đừng bao giờ tin vào tin tức</strong></p><p>Tin tức được xây dựng xung quanh những vấn đề tiêu cực, vì thế tin tức sẽ kéo tâm trạng &amp; cuộc sống của bạn về hướng tiêu cực.</p><p>Ở góc độ đầu tư cũng đừng bao giờ tin vào tin tức. Giá tăng bởi kỳ vọng, giá không tăng bởi tin tức. Khi tin ra cũng là lúc mọi chuyện sắp kết thúc.</p><p><strong>15. Càng né tránh chuyện tiền bạc, tiền bạc càng né tránh bạn</strong></p><p>Nói chuyện (với vợ/chồng/con) về tiền bạc nên được trở thành hoạt động thường xuyên trong gia đình.</p><p>Cuộc sống còn rất nhiều điều quan trọng hơn tiền, nhưng tất cả những điều quan đó hầu hết có thể giải quyết bằng tiền. Đừng né tránh tiền bạc!</p><p><strong>16. Điểm mạnh giúp kiếm tiền &amp; đam mê giúp tiêu tiền</strong></p><p>Thật sự đam mê không giúp chi trả các hoá đơn hàng tháng. Đam mê chỉ giúp bạn tăng tính sáng tạo</p><p>Điểm mạnh của bạn sẽ giúp bạn tiếp thị bản thân tốt hơn. Điểm mạnh mới thật sự là thứ giúp bạn kiếm tiền.</p><p>Do đó hãy theo đuổi &amp; kiếm tiền từ điểm mạnh trước. Sau đó hãy theo đuổi đam mê &amp; tiếp tục sáng tạo để kinh doanh đam mê của chính bạn.</p><p><strong>17. Tiền lương được tạo ra ở nơi làm việc, sự “giàu có” được tạo ra tại nhà</strong></p><p>Hiểu lầm về tài chính lớn nhất của mình từ nhỏ là mọi người trở nên giàu có nhờ được trả lương cao.</p><p>Sự thực rất khó để trở nên giàu có nếu bạn chỉ đánh đổi thời gian &amp; công sức để nhận một mức lương cố định. Mà cho dù có một mức lương rất cao thì bạn cũng không thể tự do, mà mất tự do thì chắc chắn chưa thể “giàu có”</p><p><strong>18. Công việc nhàm chán lúc này sẽ là phần thưởng của tương lai</strong></p><p>Lặp đi lặp lại là bí quyết để giỏi lên mỗi ngày. Việc lặp đi lặp lại một công việc giúp bạn sở hữu thành thạo một kỹ năng.</p><p>Cứ làm thật nhanh – lặp lại liên tục – sai – làm lại liên tục → chất lượng sẽ đến sau mỗi chu trình như vậy.</p><p><strong>19. Coi thường kết quả hàng ngày, coi trọng kết quả của năm &amp; thập kỷ</strong></p><p>Chúng ta thường có xu hướng đánh giá quá cao kết quả của một ngày, nhưng lại coi thường thành quả của một năm.</p><p>Đừng đánh giá thành công theo ngày hay tuần. Hãy nhìn nhận, xem xét nó trong suốt một năm hoặc một thập kỷ. Bạn sẽ có một tầm nhìn, kế hoạch, tư duy dài hạn hơn.</p><p><strong>20. Dành nhiều thời gian cho “con người bên trong” hơn là “bên ngoài”.</strong></p><p>Sự tự tin không phải là tư thế, quần áo, mái tóc, đồng hồ hay xe hơi, ngôi nhà của bạn. Nếu bạn chú tâm vào những thứ này thì bạn đang sống cho người khác.</p><p>Mọi người đều có thể thấy bạn thực sự là ai, trong sâu thẳm. Vì vậy, hãy dành nhiều thời gian hơn để phát triển “phiên bản bên trong” của chính bạn.</p><p><strong>21. Tập cách nói “không” với người khác là lúc bạn học cách nói “có” với chính mình</strong></p><p>Khi bạn càng thành công bạn sẽ càng nhận được nhiều cơ hội (có cả cạm bẫy). Đây là lúc bạn cần thường xuyên nói “không”, đó chính là lúc bạn đang nói “có” cho chính mình.</p><p><strong>22. Ngày không làm gì, ngày để reset</strong></p><p>Mỗi tuần, hoặc mỗi tháng hãy cho chính bản thân mình một ngày… không làm gì.</p><p>Không viết lách, không đọc sách, không gặp gỡ bạn bè,… tóm lại là một ngày không có công việc cụ thể.</p><p>Hãy thả lỏng với một ngày không mục tiêu mục đích, kệ một ngày trôi qua bạn muốn làm gì thì làm.</p><p>Thực sự những ngày như này là lúc reset lại toàn bộ tâm trí, cơ thể.</p><p><strong>23. Tương lai không biết trước, nhưng tương lai có thể kiểm soát</strong></p><p>Không ai biết trước điều gì sẽ xảy ra trong tương lai. Nhưng mỗi chúng ta đều có thể lên kế hoạch cho phương án A, phương án B, C… trong tương lai.</p><p>Ví dụ: Nếu năm 2024 có xảy ra khủng hoảng kinh tế thì bạn sẽ làm gì? Và nếu không thì bạn sẽ làm gì?</p><p>Hoặc bạn không thể biết tuần sau, tháng sau, năm sau bạn có bị thất nghiệp, bị ốm nặng hay không? Nhưng bạn hoàn toàn có thể lên kế hoạch cho một quỹ dự phòng để lỡ xảy ra thì bạn sẽ làm gì?</p><p>Ngọc hy vọng bạn sẽ nhận thêm được giá trị với 23 bài học trong năm 2023 này.</p><p>Cá nhân Ngọc thì với 23 bài học này vẫn sẽ còn giữ nguyên giá trị, thậm chí áp dụng tốt trong năm 2024 &amp; những năm sau này nữa.</p><p>Bạn có bài học nào trong năm 2023 muốn chia sẻ?</p>', 'https://res.cloudinary.com/quizz-local/image/upload/v1715253971/quizz_local/23-bai-hoc-nam-2023-final.png', 1, '2024-05-09 18:26:07', '2024-06-18 14:10:38');

-- ----------------------------
-- Table structure for class
-- ----------------------------
DROP TABLE IF EXISTS `class`;
CREATE TABLE `class`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `block_id` bigint(20) UNSIGNED NOT NULL,
  `number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `class_block_id_index`(`block_id`) USING BTREE,
  CONSTRAINT `class_ibfk_1` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of class
-- ----------------------------
INSERT INTO `class` VALUES (1, '12A3', 'Lớp 12A3', 1, '65', 1, '2024-04-23 23:05:08', '2024-04-28 02:29:14');
INSERT INTO `class` VALUES (2, '11A3', 'Lớp 11A3', 2, '22', 1, NULL, '2024-05-04 00:11:54');
INSERT INTO `class` VALUES (6, '10A1', 'Lớp 10A1', 3, '44', 1, '2024-06-10 14:38:53', NULL);

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `parent_comment_id` bigint(20) NULL DEFAULT NULL,
  `likes` bigint(20) NULL DEFAULT 0,
  `blogs_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `blogs_id`(`blogs_id`) USING BTREE,
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blogs_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES (1, 'bài này hay nha', 'long', 'nhatlong2356@gmail.com', NULL, 6, 2, 1, '2024-06-27 15:42:38', '2024-06-27 15:42:48');
INSERT INTO `comments` VALUES (2, 'cảm ơn bạn nhiều ạ', 'Root', 'root@gmail.com', 1, 19, 2, 1, NULL, '2024-06-27 15:43:08');
INSERT INTO `comments` VALUES (3, 'chúc mừng bạn đã trúng thưởng mời bạn ib shop để xác nhận thông tin nhé', 'Root', 'root@gmail.com', 1, 11, 2, 1, NULL, '2024-06-27 15:54:22');
INSERT INTO `comments` VALUES (5, 'ok lallallal', 'Tuấn', 'tuan@gmail.com', NULL, 0, 2, 1, '2024-06-27 16:07:50', '2024-06-27 16:08:02');
INSERT INTO `comments` VALUES (6, 'cái gì vậy tuấn', 'Root', 'root@gmail.com', 5, 0, 2, 1, NULL, '2024-06-27 16:08:13');
INSERT INTO `comments` VALUES (7, 'hi ae', 'Nguyễn Nhật Thịnh', 'thinh@ued.udn.vn', NULL, 5, 2, 1, '2024-06-27 16:14:03', '2024-06-27 16:14:13');
INSERT INTO `comments` VALUES (8, 'hi thịnh nhé', 'Root', 'root@gmail.com', 7, 0, 2, 1, NULL, '2024-06-27 16:14:23');
INSERT INTO `comments` VALUES (9, 'aaaa', 'Nguyễn Nhật Thịnh', 'thinh@ued.udn.vn', NULL, 0, 2, 0, '2024-06-27 23:10:02', '2024-06-28 10:11:33');
INSERT INTO `comments` VALUES (10, 'cái gì đây mọi người', 'longnguyen', 'nhatlong2356@gmail.com', NULL, 1, 1, 1, '2024-06-28 16:07:44', '2024-06-28 16:08:05');
INSERT INTO `comments` VALUES (11, 'Hi chào bạn nhé', 'Root', 'root@gmail.com', 10, 0, 1, 1, NULL, '2024-06-28 16:08:15');

-- ----------------------------
-- Table structure for exam
-- ----------------------------
DROP TABLE IF EXISTS `exam`;
CREATE TABLE `exam`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `audio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `max_questions` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_time` datetime NOT NULL,
  `closing_time` datetime NOT NULL,
  `duration` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjects_id` bigint(20) UNSIGNED NOT NULL,
  `blocks_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `exam_subjects_id_index`(`subjects_id`) USING BTREE,
  INDEX `blocks_id`(`blocks_id`) USING BTREE,
  CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`subjects_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exam_ibfk_2` FOREIGN KEY (`blocks_id`) REFERENCES `blocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exam
-- ----------------------------
INSERT INTO `exam` VALUES (14, '', 'Bài thi cuối kì môn hoá', NULL, '1', '$2y$12$ZkYYyPNp0oXWEK0s6nyqy.WvvhRvqMi2eZzodq9/9t4sNQmSFe6bO', '2024-05-04 12:48:00', '2024-05-08 12:48:00', '1', 3, 1, 1, '2024-04-26 12:48:39', '2024-04-28 02:21:13');
INSERT INTO `exam` VALUES (15, '', 'Bài thi cuối kì môn tin', NULL, '2', '$2y$12$X9GVCuxlK7SXdRMcLiMmR.gpiHucDfelhZEfB7rsv.OGrorhpmHIK', '2024-05-02 17:45:00', '2024-05-23 17:46:00', '50', 2, 1, 1, '2024-05-02 17:46:29', '2024-05-04 00:04:44');
INSERT INTO `exam` VALUES (16, '', 'Bài thi cuối kì môn toán', NULL, '3', '$2y$12$vU9stl8K.v5eGq.CrDrQUONC2ijVqfe7IHHU/OA/Q5AerZhZ1o.Ba', '2024-05-04 13:00:00', '2024-05-10 13:00:00', '15', 1, 1, 1, '2024-05-04 13:01:49', NULL);
INSERT INTO `exam` VALUES (17, '', 'Bài thi Lịch Sử', NULL, '40', '$2y$12$KNeEJlNUKr6I8liU7pSqweC0PZF6Hqw2gEWBwAUPLgMcUH5eCSqY.', '2024-05-12 14:07:00', '2024-05-19 14:08:00', '60', 4, 1, 1, '2024-05-12 14:08:46', '2024-06-09 21:42:42');
INSERT INTO `exam` VALUES (19, '', 'Bài thi 15p môn lịch sử lớp 10', NULL, '20', '$2y$12$94p7QEZSmRgbhJItKUsOQOI8D7MFKnob7Nvkn4h.eCYv3eO6OdUAy', '2024-06-10 14:48:00', '2024-06-11 14:48:00', '15', 4, 3, 1, '2024-06-10 14:48:52', NULL);
INSERT INTO `exam` VALUES (21, 'm0tf9oooJ3Vmi2r9', 'test', NULL, '2', '$2y$12$vmMeZOsaFyOCp4Zsv.2RU.i2ji33TKDpB95AkfQIpzakORnG5y9G6', '2024-07-05 10:58:00', '2024-07-10 10:58:00', '12', 2, 2, 1, '2024-07-05 11:00:43', NULL);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for levels
-- ----------------------------
DROP TABLE IF EXISTS `levels`;
CREATE TABLE `levels`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of levels
-- ----------------------------
INSERT INTO `levels` VALUES (1, 'Dễ', 'Mức độ câu hỏi dễ', 1, '2024-04-23 22:55:29', '2024-04-24 15:12:52');
INSERT INTO `levels` VALUES (2, 'Trung bình', 'Mức độ câu hỏi trung bình', 1, '2024-04-23 22:56:15', '2024-04-28 02:08:17');
INSERT INTO `levels` VALUES (3, 'Khó', 'Mức độ câu hỏi khó', 1, '2024-04-23 22:55:43', '2024-05-04 00:14:18');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 295 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (279, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (280, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` VALUES (281, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (282, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (283, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (284, '2024_04_20_190212_create_subjects_table', 1);
INSERT INTO `migrations` VALUES (285, '2024_04_21_062800_create_students_table', 1);
INSERT INTO `migrations` VALUES (286, '2024_04_21_074031_create_class_table', 1);
INSERT INTO `migrations` VALUES (287, '2024_04_22_063429_create_questions_table', 1);
INSERT INTO `migrations` VALUES (288, '2024_04_22_085743_create_exam_table', 1);
INSERT INTO `migrations` VALUES (289, '2024_04_22_091635_create_result_table', 1);
INSERT INTO `migrations` VALUES (290, '2024_04_22_092117_create_permission_table', 1);
INSERT INTO `migrations` VALUES (291, '2024_04_22_092135_create_account_table', 1);
INSERT INTO `migrations` VALUES (292, '2024_04_22_092231_create_standardize_question_table', 1);
INSERT INTO `migrations` VALUES (293, '2024_04_23_095006_create_blocks_table', 1);
INSERT INTO `migrations` VALUES (294, '2024_04_23_153551_create_levels_table', 1);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `role_id`(`role_id`) USING BTREE,
  INDEX `permission_id`(`permission_id`) USING BTREE,
  CONSTRAINT `permission_role_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 141 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
INSERT INTO `permission_role` VALUES (3, 8, 4, NULL, NULL);
INSERT INTO `permission_role` VALUES (4, 4, 4, NULL, NULL);
INSERT INTO `permission_role` VALUES (5, 7, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (6, 8, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (7, 9, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (8, 10, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (9, 3, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (10, 4, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (11, 5, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (12, 6, 3, NULL, NULL);
INSERT INTO `permission_role` VALUES (13, 7, 2, NULL, NULL);
INSERT INTO `permission_role` VALUES (14, 3, 2, NULL, NULL);
INSERT INTO `permission_role` VALUES (15, 7, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (16, 8, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (17, 9, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (18, 10, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (19, 3, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (20, 4, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (21, 5, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (22, 6, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (25, 12, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (26, 13, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (27, 14, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (28, 15, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (29, 17, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (30, 18, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (31, 19, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (32, 20, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (33, 22, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (34, 23, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (35, 24, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (36, 25, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (38, 26, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (39, 28, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (40, 29, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (41, 30, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (42, 31, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (43, 32, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (44, 34, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (45, 35, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (46, 36, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (47, 37, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (48, 39, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (49, 40, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (50, 41, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (51, 42, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (52, 44, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (53, 45, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (54, 46, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (55, 47, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (61, 55, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (62, 56, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (63, 57, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (64, 58, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (65, 12, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (66, 14, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (67, 17, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (68, 19, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (69, 22, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (70, 24, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (71, 28, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (72, 30, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (73, 34, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (74, 36, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (75, 39, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (76, 41, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (77, 44, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (78, 46, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (79, 49, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (80, 51, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (81, 7, 4, NULL, NULL);
INSERT INTO `permission_role` VALUES (82, 3, 4, NULL, NULL);
INSERT INTO `permission_role` VALUES (83, 12, 4, NULL, NULL);
INSERT INTO `permission_role` VALUES (84, 13, 4, NULL, NULL);
INSERT INTO `permission_role` VALUES (85, 17, 4, NULL, NULL);
INSERT INTO `permission_role` VALUES (86, 18, 4, NULL, NULL);
INSERT INTO `permission_role` VALUES (87, 22, 4, NULL, NULL);
INSERT INTO `permission_role` VALUES (88, 23, 4, NULL, NULL);
INSERT INTO `permission_role` VALUES (89, 28, 4, NULL, NULL);
INSERT INTO `permission_role` VALUES (90, 29, 4, NULL, NULL);
INSERT INTO `permission_role` VALUES (91, 34, 4, NULL, NULL);
INSERT INTO `permission_role` VALUES (92, 35, 4, NULL, NULL);
INSERT INTO `permission_role` VALUES (93, 39, 4, NULL, NULL);
INSERT INTO `permission_role` VALUES (94, 40, 4, NULL, NULL);
INSERT INTO `permission_role` VALUES (95, 44, 4, NULL, NULL);
INSERT INTO `permission_role` VALUES (96, 45, 4, NULL, NULL);
INSERT INTO `permission_role` VALUES (97, 49, 4, NULL, NULL);
INSERT INTO `permission_role` VALUES (98, 50, 4, NULL, NULL);
INSERT INTO `permission_role` VALUES (99, 12, 2, NULL, NULL);
INSERT INTO `permission_role` VALUES (100, 17, 2, NULL, NULL);
INSERT INTO `permission_role` VALUES (101, 22, 2, NULL, NULL);
INSERT INTO `permission_role` VALUES (102, 28, 2, NULL, NULL);
INSERT INTO `permission_role` VALUES (103, 34, 2, NULL, NULL);
INSERT INTO `permission_role` VALUES (104, 39, 2, NULL, NULL);
INSERT INTO `permission_role` VALUES (105, 44, 2, NULL, NULL);
INSERT INTO `permission_role` VALUES (106, 49, 2, NULL, NULL);
INSERT INTO `permission_role` VALUES (107, 59, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (109, 60, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (111, 32, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (112, 53, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (113, 26, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (114, 61, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (115, 62, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (116, 63, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (117, 64, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (118, 65, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (119, 66, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (120, 67, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (121, 68, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (122, 69, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (123, 70, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (124, 71, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (125, 73, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (126, 72, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (128, 76, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (129, 77, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (130, 76, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (131, 77, 7, NULL, NULL);
INSERT INTO `permission_role` VALUES (132, 78, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (133, 49, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (134, 50, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (135, 51, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (136, 52, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (137, 53, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (138, 74, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (139, 79, 1, NULL, NULL);
INSERT INTO `permission_role` VALUES (140, 80, 1, NULL, NULL);

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) NULL DEFAULT 0,
  `key_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `route_id`(`description`) USING BTREE,
  INDEX `role_id`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 81 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'Quản lý người quản trị', 'Quản lý người quản trị', 0, NULL, '2024-05-20 13:02:01', NULL);
INSERT INTO `permissions` VALUES (2, 'Quản lý vai trò', 'Quản lý vai trò', 0, NULL, '2024-05-20 13:02:17', NULL);
INSERT INTO `permissions` VALUES (3, 'Hiển thị vai trò', 'Hiển thị vai trò', 2, 'roles.index', '2024-05-20 13:03:29', NULL);
INSERT INTO `permissions` VALUES (4, 'Tạo vai trò', 'Tạo vai trò', 2, 'roles.create', '2024-05-20 13:03:55', NULL);
INSERT INTO `permissions` VALUES (5, 'Sửa vai trò', 'Sửa vai trò', 2, 'roles.edit', '2024-05-20 13:04:31', NULL);
INSERT INTO `permissions` VALUES (6, 'Xoá vai trò', 'Xoá vai trò', 2, 'roles.destroy', '2024-05-20 13:05:07', NULL);
INSERT INTO `permissions` VALUES (7, 'Hiển thị người quản trị', 'Hiển thị người quản trị', 1, 'users.index', '2024-05-20 13:06:03', NULL);
INSERT INTO `permissions` VALUES (8, 'Tạo người quản trị', 'Tạo người quản trị', 1, 'users.create', '2024-05-20 13:06:27', NULL);
INSERT INTO `permissions` VALUES (9, 'Sửa người quản trị', 'Sửa người quản trị', 1, 'users.edit', '2024-05-20 13:06:59', NULL);
INSERT INTO `permissions` VALUES (10, 'Xoá người quản trị', 'Xoá người quản trị', 1, 'users.destroy', '2024-05-20 13:07:18', NULL);
INSERT INTO `permissions` VALUES (11, 'Quản lý môn học', 'Quản lý môn học', 0, NULL, '2024-05-20 17:02:43', NULL);
INSERT INTO `permissions` VALUES (12, 'Hiển thị môn học', 'Hiển thị môn học', 11, 'subjects.index', '2024-05-20 17:03:22', NULL);
INSERT INTO `permissions` VALUES (13, 'Tạo môn học', 'Tạo môn học', 11, 'subjects.create', '2024-05-20 17:04:06', NULL);
INSERT INTO `permissions` VALUES (14, 'Sửa môn học', 'Sửa môn học', 11, 'subjects.edit', '2024-05-20 17:04:35', NULL);
INSERT INTO `permissions` VALUES (15, 'Xoá môn học', 'Xoá môn học', 11, 'subjects.destroy', '2024-05-20 17:05:01', NULL);
INSERT INTO `permissions` VALUES (16, 'Quản lý thí sinh', 'Quản lý thí sinh', 0, NULL, '2024-05-20 17:09:23', NULL);
INSERT INTO `permissions` VALUES (17, 'Hiển thị thí sinh', 'Hiển thị thí sinh', 16, 'students.index', '2024-05-20 17:09:50', '2024-05-20 17:13:06');
INSERT INTO `permissions` VALUES (18, 'Tạo thí sinh', 'Tạo thí sinh', 16, 'students.create', '2024-05-20 17:10:12', '2024-05-20 17:12:54');
INSERT INTO `permissions` VALUES (19, 'Sửa thí sinh', 'Sửa thí sinh', 16, 'students.edit', '2024-05-20 17:10:40', '2024-05-20 17:12:37');
INSERT INTO `permissions` VALUES (20, 'Xoá thí sinh', 'Xoá thí sinh', 16, 'students.destroy', '2024-05-20 17:10:57', '2024-05-20 17:12:22');
INSERT INTO `permissions` VALUES (21, 'Quản lý lớp học', 'Quản lý lớp học', 0, NULL, '2024-05-20 17:13:54', NULL);
INSERT INTO `permissions` VALUES (22, 'Hiển thị lớp học', 'Hiển thị lớp học', 21, 'class.index', '2024-05-20 17:14:46', NULL);
INSERT INTO `permissions` VALUES (23, 'Tạo lớp học', 'Tạo lớp học', 21, 'class.create', '2024-05-20 17:15:08', NULL);
INSERT INTO `permissions` VALUES (24, 'Sửa lớp học', 'Sửa lớp học', 21, 'class.edit', '2024-05-20 17:15:30', NULL);
INSERT INTO `permissions` VALUES (25, 'Xoá lớp học', 'Xoá lớp học', 21, 'class.destroy', '2024-05-20 17:15:49', NULL);
INSERT INTO `permissions` VALUES (26, 'Hiển thị chi tiết lớp học', 'Hiển thị chi tiết lớp học', 21, 'class.show', '2024-05-20 17:21:11', NULL);
INSERT INTO `permissions` VALUES (27, 'Quản lý câu hỏi', 'Quản lý câu hỏi', 0, NULL, '2024-05-20 17:34:29', NULL);
INSERT INTO `permissions` VALUES (28, 'Hiển thị câu hỏi', 'Hiển thị câu hỏi', 27, 'questions.index', '2024-05-20 17:34:49', NULL);
INSERT INTO `permissions` VALUES (29, 'Tạo câu hỏi', 'Tạo câu hỏi', 27, 'questions.create', '2024-05-20 17:35:09', NULL);
INSERT INTO `permissions` VALUES (30, 'Sửa câu hỏi', 'Sửa câu hỏi', 27, 'questions.edit', '2024-05-20 17:35:24', NULL);
INSERT INTO `permissions` VALUES (31, 'Xoá câu hỏi', 'Xoá câu hỏi', 27, 'questions.destroy', '2024-05-20 17:35:43', NULL);
INSERT INTO `permissions` VALUES (32, 'Hiển thị chi tiết câu hỏi', 'Hiển thị chi tiết câu hỏi', 27, 'questions.show', '2024-05-20 17:37:25', NULL);
INSERT INTO `permissions` VALUES (33, 'Quản lý khối học', 'Quản lý khối học', 0, NULL, '2024-05-20 17:40:54', NULL);
INSERT INTO `permissions` VALUES (34, 'Hiển thị khối học', 'Hiển thị khối học', 33, 'blocks.index', '2024-05-20 17:41:09', NULL);
INSERT INTO `permissions` VALUES (35, 'Tạo khối học', 'Tạo khối học', 33, 'blocks.create', '2024-05-20 17:41:26', NULL);
INSERT INTO `permissions` VALUES (36, 'Sửa khối học', 'Sửa khối học', 33, 'blocks.edit', '2024-05-20 17:41:43', NULL);
INSERT INTO `permissions` VALUES (37, 'Xoá khối học', 'Xoá khối học', 33, 'blocks.destroy', '2024-05-20 17:41:57', NULL);
INSERT INTO `permissions` VALUES (38, 'Quản lý mức độ câu hỏi', 'Quản lý mức độ câu hỏi', 0, NULL, '2024-05-20 17:44:21', NULL);
INSERT INTO `permissions` VALUES (39, 'Hiển thị mức độ câu hỏi', 'Hiển thị mức độ câu hỏi', 38, 'levels.index', '2024-05-20 17:44:41', NULL);
INSERT INTO `permissions` VALUES (40, 'Tạo mức độ câu hỏi', 'Tạo mức độ câu hỏi', 38, 'levels.create', '2024-05-20 17:44:58', NULL);
INSERT INTO `permissions` VALUES (41, 'Sửa mức độ câu hỏi', 'Sửa mức độ câu hỏi', 38, 'levels.edit', '2024-05-20 17:45:16', NULL);
INSERT INTO `permissions` VALUES (42, 'Xoá mức độ câu hỏi', 'Xoá mức độ câu hỏi', 38, 'levels.destroy', '2024-05-20 17:45:32', NULL);
INSERT INTO `permissions` VALUES (43, 'Quản lý bộ đề thi', 'Quản lý bộ đề thi', 0, NULL, '2024-05-20 17:47:47', NULL);
INSERT INTO `permissions` VALUES (44, 'Hiển thị bộ đề thi', 'Hiển thị bộ đề thi', 43, 'exams.index', '2024-05-20 17:48:06', NULL);
INSERT INTO `permissions` VALUES (45, 'Tạo bộ đề thi', 'Tạo bộ đề thi', 43, 'exams.create', '2024-05-20 17:48:22', NULL);
INSERT INTO `permissions` VALUES (46, 'Sửa bộ đề thi', 'Sửa bộ đề thi', 43, 'exams.edit', '2024-05-20 17:48:38', NULL);
INSERT INTO `permissions` VALUES (47, 'Xoá bộ đề thi', 'Xoá bộ đề thi', 43, 'exams.destroy', '2024-05-20 17:48:56', NULL);
INSERT INTO `permissions` VALUES (48, 'Quản lý blog', 'Quản lý blog', 0, NULL, '2024-05-20 17:53:41', NULL);
INSERT INTO `permissions` VALUES (49, 'Hiển thị blogs', 'Hiển thị blogs', 48, 'blogs.index', '2024-05-20 17:53:59', NULL);
INSERT INTO `permissions` VALUES (50, 'Tạo blogs', 'Tạo blogs', 48, 'blogs.create', '2024-05-20 17:54:13', NULL);
INSERT INTO `permissions` VALUES (51, 'Sửa blogs', 'Sửa blogs', 48, 'blogs.edit', '2024-05-20 17:54:28', NULL);
INSERT INTO `permissions` VALUES (52, 'Xoá blogs', 'Xoá blogs', 48, 'blogs.destroy', '2024-05-20 17:54:42', NULL);
INSERT INTO `permissions` VALUES (53, 'Hiển thị chi tiết blogs', 'Hiển thị chi tiết blogs', 48, 'blogs.show', '2024-05-20 17:56:36', NULL);
INSERT INTO `permissions` VALUES (54, 'Quản lý route quyền', 'Quản lý route quyền', 0, NULL, '2024-05-20 18:00:01', NULL);
INSERT INTO `permissions` VALUES (55, 'Hiển thị route quyền', 'Hiển thị route quyền', 54, 'permissions.index', '2024-05-20 18:00:21', NULL);
INSERT INTO `permissions` VALUES (56, 'Tạo route quyền', 'Tạo route quyền', 54, 'permissions.create', '2024-05-20 18:00:38', NULL);
INSERT INTO `permissions` VALUES (57, 'Sửa route quyền', 'Sửa route quyền', 54, 'permissions.edit', '2024-05-20 18:00:56', NULL);
INSERT INTO `permissions` VALUES (58, 'Xoá route quyền', 'Xoá route quyền', 54, 'permissions.destroy', '2024-05-20 18:01:16', NULL);
INSERT INTO `permissions` VALUES (59, 'Hiển thị nhanh câu hỏi', 'Hiển thị nhanh câu hỏi', 27, 'quick_view_question', '2024-05-20 18:09:19', NULL);
INSERT INTO `permissions` VALUES (60, 'Cập nhật trạng thái câu hỏi', 'Cập nhật trạng thái câu hỏi', 27, 'updateStatusQuestions', '2024-05-20 18:14:02', NULL);
INSERT INTO `permissions` VALUES (61, 'Thêm danh sách câu hỏi từ file excel', 'Thêm danh sách câu hỏi từ file excel', 27, 'questions.import', '2024-05-20 20:28:40', NULL);
INSERT INTO `permissions` VALUES (62, 'Hiển thị nhanh bộ đề thi', 'Hiển thị nhanh bộ đề thi', 43, 'quick_view_exam', '2024-05-20 20:41:54', NULL);
INSERT INTO `permissions` VALUES (63, 'Tạo đề thi với câu hỏi ngẫu nhiên', 'Tạo đề thi với câu hỏi ngẫu nhiên', 43, 'exams_request', '2024-05-20 20:43:36', '2024-05-20 20:44:09');
INSERT INTO `permissions` VALUES (64, 'Thêm đề thi vào lớp học', 'Thêm đề thi vào lớp học', 43, 'addExamToClass', '2024-05-20 20:44:37', NULL);
INSERT INTO `permissions` VALUES (65, 'Cập nhật trạng thái bộ đề', 'Cập nhật trạng thái bộ đề', 43, 'updateStatusExams', '2024-05-20 20:45:03', NULL);
INSERT INTO `permissions` VALUES (66, 'Xoá câu hỏi từ đề thi', 'Xoá câu hỏi từ đề thi', 43, 'deleteQuestionFromExam', '2024-05-20 20:45:28', NULL);
INSERT INTO `permissions` VALUES (67, 'Hiển thị nhanh lớp học', 'Hiển thị nhanh lớp học', 21, 'quick_view_class', '2024-05-20 20:55:26', NULL);
INSERT INTO `permissions` VALUES (68, 'Cập nhật trạng thái lớp học', 'Cập nhật trạng thái lớp học', 21, 'updateStatusClasss', '2024-05-20 20:55:51', NULL);
INSERT INTO `permissions` VALUES (69, 'Hiển thị nhanh thí sinh', 'Hiển thị nhanh thí sinh', 16, 'quick_view_students', '2024-05-20 20:59:15', NULL);
INSERT INTO `permissions` VALUES (70, 'Cập nhật trạng thái thí sinh', 'Cập nhật trạng thái thí sinh', 16, 'updateStatusStudents', '2024-05-20 20:59:32', NULL);
INSERT INTO `permissions` VALUES (71, 'Cập nhật trạng thái môn học', 'Cập nhật trạng thái môn học', 11, 'updateStatusSubjects', '2024-05-20 21:01:58', NULL);
INSERT INTO `permissions` VALUES (72, 'Cập nhật trạng thái mức độ câu hỏi', 'Cập nhật trạng thái mức độ câu hỏi', 38, 'updateStatusLevels', '2024-05-20 21:03:29', NULL);
INSERT INTO `permissions` VALUES (73, 'Cập nhật trạng thái khối lớp học', 'Cập nhật trạng thái khối lớp học', 33, 'updateStatusBlocks', '2024-05-20 21:05:07', NULL);
INSERT INTO `permissions` VALUES (74, 'Cập nhật trạng thái blogs', 'Cập nhật trạng thái blogs', 48, 'updateStatusBlogs', '2024-05-20 21:06:18', NULL);
INSERT INTO `permissions` VALUES (75, 'Quản lý kết quả thi thí sinh', 'Quản lý kết quả thi thí sinh', 0, NULL, '2024-05-22 12:39:02', NULL);
INSERT INTO `permissions` VALUES (76, 'Hiển thị kết quả thí sinh', 'Hiển thị kết quả thí sinh', 75, 'result.index', '2024-05-22 12:39:25', NULL);
INSERT INTO `permissions` VALUES (77, 'Hiển thị chi tiết kết quả thí sinh', 'Hiển thị chi tiết kết quả thí sinh', 75, 'result.show', '2024-05-22 12:40:04', NULL);
INSERT INTO `permissions` VALUES (78, 'Hiển thị comment', 'Hiển thị comment người dùng', 48, 'review_comment', '2024-06-28 09:41:59', '2024-06-28 09:45:18');
INSERT INTO `permissions` VALUES (79, 'Trả lời comment', 'Trả lời comment người dùng', 48, 'reply_comment', '2024-06-28 09:44:00', NULL);
INSERT INTO `permissions` VALUES (80, 'Duyệt comment', 'Duyệt comment người dùng', 48, 'updateStatusComments', '2024-06-28 09:45:45', NULL);

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for questions
-- ----------------------------
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `level_id` bigint(20) UNSIGNED NOT NULL,
  `block_id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_a` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_b` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_c` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_d` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `questions_subject_id_index`(`subject_id`) USING BTREE,
  INDEX `questions_ibfk_2`(`level_id`) USING BTREE,
  INDEX `block_id`(`block_id`) USING BTREE,
  CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `questions_ibfk_3` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 161 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of questions
-- ----------------------------
INSERT INTO `questions` VALUES (1, 2, 1, 2, 'Thiết bị nào sau đây dùng để kết nối mạng?', 'Ram', 'Rom', 'Route', 'CPU', 'C', NULL, 1, '2024-04-23 23:57:39', NULL);
INSERT INTO `questions` VALUES (2, 3, 2, 2, 'Amin no, đơn chức, mạch hở có công thức tổng quát là', 'CnH2nN.', 'CnH2n+1N.', 'CnH2n+3N.', 'CnH2n+2N.', 'C', NULL, 1, '2024-04-23 23:59:01', NULL);
INSERT INTO `questions` VALUES (3, 2, 1, 2, 'Tin là gì', 'Toán học', 'Tin học', 'tin', 'học', 'B', NULL, 1, '2024-04-24 15:05:12', '2024-04-24 15:11:00');
INSERT INTO `questions` VALUES (4, 1, 1, 2, 'What is 1+1?', '1', '2', '3', '4', 'B', NULL, 1, NULL, '2024-06-09 20:38:04');
INSERT INTO `questions` VALUES (5, 1, 1, 1, 'What is 1+2? ', '1', '2', '3', '4', 'C', NULL, 0, NULL, '2024-06-09 20:58:59');
INSERT INTO `questions` VALUES (6, 1, 2, 1, 'What is 1+3? ', '1', '2', '3', '4', 'D', NULL, 1, NULL, '2024-06-09 20:58:59');
INSERT INTO `questions` VALUES (7, 1, 1, 1, 'What is 10^3? ', '20', '30', '40', '88', 'A', NULL, 1, NULL, '2024-06-09 20:58:59');
INSERT INTO `questions` VALUES (8, 1, 3, 1, 'What is 10^100? ', '10000', '20000', '30000', '40000', 'C', NULL, 1, NULL, '2024-06-09 20:58:59');
INSERT INTO `questions` VALUES (109, 4, 1, 3, 'Thời gian thực dân Pháp tiến hành khai thác thuộc địa lần thứ nhất ở Việt Nam khi nào ?', '1858-1884', '1884-1896', '1896-1913', '1914-1917', 'C', NULL, 1, NULL, '2024-05-22 14:27:10');
INSERT INTO `questions` VALUES (110, 4, 3, 3, 'Trong đợt khai thác thuộc địa lần thứ nhất của thực dân Pháp ở nước ta có giai cấp mới nào được hình thành?', 'Giai cấp tư sản', 'Giai cấp tư sản và công nhân', 'Giai cấp công nhân', 'Giai cấp tiểu tư sản', 'C', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (111, 4, 2, 3, 'Trước Chiến tranh thế giới thứ nhất, ở Việt Nam có những giai cấp nào?', 'Địa chủ phong kiến và nông dân', 'Địa chủ phong kiến, nông dân, tư sản, tiểu tư sản và công nhân', 'Địa chủ phong kiến, nông dân và tiểu tư sản', 'Địa chủ phong kiến, nông dân và công nhân', 'B', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (112, 4, 1, 3, 'Dưới chế độ thực dân phong kiến, giai cấp nông dân Việt Nam có yêu cầu bức thiết nhất là gì?', 'Độc lập dân tộc', 'Ruộng đất', 'Quyền bình đẳng nam, nữ', 'Được giảm tô, giảm tức', 'A', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (113, 4, 3, 3, 'Mâu thuẫn cơ bản và chủ yếu ở Việt Nam đầu thế kỷ XX là mâu thuẫn nào?', 'Mâu thuẫn giữa giai cấp nông dân với giai cấp địa chủ phong kiến', 'Mâu thuẫn giữa giai cấp công nhân với giai cấp tư sản', 'Mâu thuẫn giữa công nhân và nông dân với đế quốc và phong kiến', 'Mâu thuẫn giữa dân tộc Việt Nam với đế quốc xâm lược và tay sai của chúng', 'D', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (114, 4, 2, 3, 'Đặc điểm ra đời của giai cấp công nhân Việt Nam như thế nào?', 'Ra đời trước giai cấp tư sản, trong cuộc khai thác thuộc địa lần thứ nhất của thực dân Pháp.', 'Phần lớn xuất thân từ nông dân.', 'Chịu sự áp bức và bóc lột của đế quốc, phong kiến và tư sản', 'Cả a, b và c', 'D', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (115, 4, 2, 3, 'Những giai cấp bị trị ở Việt Nam dưới chế độ thuộc địa của đế quốc Pháp là:', 'Công nhân và nông dân', 'Công nhân, nông dân, tiểu tư sản', 'Công nhân, nông dân, tiểu tư sản, tư sản dân tộc', 'Công nhân, nông dân, tiểu tư sản, tư sản dân tộc, địa chủ vừa và nhỏ', 'D', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (116, 4, 1, 3, 'Khi nào phong trào công nhân Việt Nam hoàn toàn trở thành một phong trào tự giác?', 'Năm 1920 (tổ chức công hội ở Sài Gòn được thành lập)', 'Năm 1925 (cuộc bãi công Ba Son)', 'Năm 1929 (sự ra đời ba tổ chức cộng sản)', 'Năm 1930 (Đảng Cộng sản Việt Nam ra đời)', 'B', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (117, 4, 1, 3, 'Nguyễn ái Quốc lựa chọn con đường giải phóng dân tộc theo khuynh hướng chính trị vô sản vào thời gian nào?', '1917', '1918', '1919', '1920', 'D', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (118, 4, 1, 3, 'Báo Đời sống công nhân là của tổ chức nào?', 'Đảng Xã hội Pháp', 'Đảng Cộng sản Pháp', 'Tổng Liên đoàn Lao động Pháp', 'Hội Liên hiệp thuộc địa', 'C', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (119, 4, 2, 3, 'Hội Liên hiệp thuộc địa được thành lập vào năm nào?', '1920', '1921', '1923', '1924', 'B', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (120, 4, 3, 3, 'Nguyễn ái Quốc đã đọc Sơ thảo lần thứ nhất Luận cương về vấn đề dân tộc và vấn đề thuộc địa khi nào? ở đâu?', '7/ 1920 - Liên Xô', '7/ 1920 – Pháp', '7/1920 - Quảng Châu (Trung Quốc)', '8/1920 - Trung Quốc', 'B', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (121, 4, 2, 3, 'Sự kiện nào được Nguyễn ái Quốc đánh giá \"như chim én nhỏ báo hiệu mùa Xuân\"?', 'Cách mạng tháng Mười Nga bùng nổ và thắng lợi', 'Sự thành lập Đảng Cộng sản Pháp', 'Vụ mưu sát tên toàn quyền Méclanh của Phạm Hồng Thái', 'Sự thành lập Hội Việt Nam cách mạng thanh niên', 'C', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (122, 4, 1, 3, 'Phong trào đòi trả tự do cho cụ Phan Bội Châu diễn ra sôi nổi năm nào?', '1924', '1925', '1926', '1927', 'B', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (123, 4, 1, 3, 'Nguyễn ái Quốc từ Liên Xô về Quảng Châu (Trung Quốc) vào thời gian nào?', '9102', '9467', '9072', '9041', 'C', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (124, 4, 1, 3, 'Hội Việt Nam Cách mạng Thanh niên thực hiện chủ trương \"vô sản hoá\" khi nào?', 'Cuối năm 1926 đầu năm 1927', 'Cuối năm 1927 đầu năm 1928', 'Cuối năm 1928 đầu năm 1929', 'Cuối năm 1929 đầu năm 1930', 'C', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (125, 4, 1, 3, 'Tên chính thức của tổ chức này được đặt tại Đại hội lần thứ nhất ở Quảng Châu (tháng 5-1929) là gì?', 'Việt Nam Thanh niên cách mạng đồng chí Hội', ' Hội Việt Nam cách mạng đồng minh', 'Hội Việt Nam độc lập đồng minh', 'Hội Việt Nam Cách mạng Thanh niên', 'D', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (126, 4, 1, 3, 'Việt Nam Quốc dân Đảng được thành lập vào thời gian nào?', '10197', '9802', '9345', '9314', 'A', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (127, 4, 1, 3, 'Ai là người đã tham gia sáng lập Việt Nam Quốc dân Đảng 1927 ?', 'Tôn Quang Phiệt', 'Trần Huy Liệu', 'Phạm Tuấn Tài', 'Nguyễn Thái Học', 'C', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (128, 4, 1, 3, 'Khởi nghĩa Yên Bái nổ ra vào thời gian nào?', '1998', '1996', '1992', '1991', 'A', NULL, 1, NULL, '2024-06-10 15:51:30');
INSERT INTO `questions` VALUES (129, 4, 2, 3, 'Tổ chức cộng sản nào ra đời đầu tiên ở Việt Nam?', 'Hội Việt Nam cách mạng thanh niên', ' Đông Dương cộng sản Đảng', 'An Nam cộng sản Đảng', ' Đông Dương cộng sản liên đoàn', 'B', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (130, 4, 2, 3, 'Chi bộ cộng sản đầu tiên ở Việt Nam được thành lập khi nào?', 'Cuối tháng 3/1929', 'Đầu tháng 3/1929', '10684', '10714', 'A', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (131, 4, 2, 3, 'Chi bộ cộng sản đầu tiên gồm mấy đảng viên? Ai làm bí thư chi bộ?', '5 đảng viên - Bí thư Trịnh Đình Cửu', '6 đảng viên - Bí thư Ngô Gia Tự', '7 đảng viên - Bí thư Trịnh Đình Cửu', '7 đảng viên - Bí thư Trần Văn Cung', 'D', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (132, 4, 2, 3, 'Đông Dương Cộng sản Đảng và An nam Cộng sản Đảng được ra đời từ tổ chức tiền thân nào?', 'Tân Việt cách mạng Đảng', 'Hội Việt Nam cách mạng Thanh niên', 'Việt Nam cách mạng đồng chí Hội', ' Cả a, b và c', 'B', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (133, 4, 2, 3, 'Đông Dương cộng sản liên đoàn hợp nhất vào Đảng Cộng sản Việt Nam khi nào?', '11011', '11013', '11378', '11374', 'B', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (134, 4, 2, 3, 'Tổ chức Đông Dương Cộng sản Đảng được thành lập vào thời gian nào?', '10014', '10380', '10745', '10714', 'C', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (135, 4, 2, 3, 'Tổ chức An Nam Cộng sản Đảng được thành lập vào thời gian nào?', '10014', '10380', '10806', '10775', 'C', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (136, 4, 2, 3, 'Tổ chức Đông Dương Cộng sản liên Đoàn được thành lập vào thời gian nào?', '10044', '10959', '10990', '11018', 'B', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (137, 4, 2, 3, 'Thời gian ra bản Tuyên đạt nêu rõ việc thành lập Đông Dương Cộng sản Liên đoàn?', '10775', '10837', '10867', '10959', 'B', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (138, 4, 2, 3, 'Ban Thường vụ Trung ương Đảng ra Quyết nghị chấp nhận Đông Dương cộng sản liên đoàn là một bộ phận của Đảng Cộng sản Việt Nam vào thời gian nào?', '11011', ' 20-2-1930', '11013', '11039', 'C', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (139, 4, 3, 3, 'Do đâu Nguyễn ái Quốc đã triệu tập và chủ trì Hội nghị thành lập Đảng đầu năm 1930?', 'Được sự uỷ nhiệm của Quốc tế Cộng sản', 'Nhận được chỉ thị của Quốc tế Cộng sản', 'Sự chủ động của Nguyễn ái Quốc', 'Các tổ chức cộng sản trong nước đề nghị', 'D', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (140, 4, 3, 3, 'Đại biểu các tổ chức cộng sản nào đã tham dự Hội nghị thành lập Đảng đầu năm 1930?', 'Đông Dương cộng sản Đảng, An Nam cộng sản Đảng và Đông Dương cộng sản liên đoàn', 'Đông Dương cộng sản Đảng và An Nam cộng sản Đảng', 'An Nam cộng sản Đảng và Đông Dương cộng sản liên đoàn', 'Đông Dương cộng sản Đảng và Đông Dương cộng sản liên đoàn', 'B', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (141, 4, 3, 3, 'Hội nghị Hợp nhất thành lập Đảng CSVN (3/2/1930) thông qua các văn kiện nào sau đây:', 'Chánh cương vắn tắt', 'Sách lược vắn tắt', 'Điều lệ vắn tắt và Chương trình vắn tắt', 'Cả A, B và C đáp án', 'D', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (142, 4, 3, 3, 'Hội nghị thành lập Đảng Cộng sản Việt Nam đã thông qua mấy văn kiện?', '3 văn kiện', '4 văn kiện', '5 văn kiện', '6 văn kiện', 'D', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (143, 4, 3, 3, 'Nội dung nào sau đây nằm trong Cương lĩnh đầu tiên của Đảng?', 'Đánh đổ đế quốc chủ nghĩa Pháp và bọn phong kiến, làm cho nước Nam hoàn toàn độc lập.', 'Tư sản dân quyền cách mạng là thời kỳ dự bị để làm xã hội cách mạng.', 'Chỉ có giải phóng giai cấp vô sản thì mới giải phóng được dân tộc.', 'Đảng có vững cách mạng mới thành công', 'B', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (144, 4, 3, 3, 'Cương lĩnh đầu tiên của Đảng đã xác định mục tiêu chiến lược của cách mạng Việt Nam là gì?', 'Làm tư sản dân quyền cách mạng và thổ địa cách mạng để đi tới xã hội cộng sản.', 'Xây dựng một nước Việt Nam dân giàu nước mạnh xã hội công bằng, dân chủ và văn minh.', 'Cách mạng tư sản dân quyền - phản đế và điền địa - lập chính quyền của công nông bằng hình thức Xô viết, để dự bị điều kiện đi tới cách mạng xã hội chủ nghĩa.', 'Cả a và b.', 'A', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (145, 4, 3, 3, 'Sau Hội nghị thành lập Đảng, Ban chấp hành Trung ương lâm thời của Đảng được thành lập do ai đứng đầu?', 'Hà Huy Tập', 'Trần Phú', 'Lê Hồng Phong', 'Trịnh Đình Cửu', 'D', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (146, 4, 3, 3, 'Vào thời điểm nào Nguyễn Ái Quốc gửi Quốc tế Cộng sản bản Báo cáo về việc thành lập Đảng Cộng sản Việt Nam?', 'ngày 8-2-1930', 'Ngày 10-2-1920', 'Ngày 18-2-1930', 'Ngày 28-2-1930', 'C', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (147, 4, 3, 3, 'Văn kiện nào của Đảng đặt nhiệm vụ chống đế quốc lên hàng đầu?', 'Chính cương vắn tắt, Sách lược vắn tắt do Hội nghị thành lập Đảng thông qua', ' Luận cương chính trị tháng 10-1930 (Dự án cương lĩnh để thảo luận trong Đảng)', 'Thư của Trung ương gửi cho các cấp đảng bộ (12-1930)', 'Nghị quyết Đại hội lần thứ nhất của Đảng (3-1935)', 'A', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (148, 4, 3, 3, 'Trong các điểm sau, chỉ rõ điểm khác nhau giữa Cương lĩnh chính trị đầu tiên của Đảng và Luận cương chính trị tháng 10-1930 là:', 'Phương hướng chiến lược của cách mạng.', 'Chủ trương tập hợp lực lượng cách mạng', 'Vai trò lãnh đạo cách mạng.', 'Phương pháp cách mạng.', 'B', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (149, 4, 2, 3, 'Văn kiện nào của Đảng nhấn mạnh \"vấn đề thổ địa là cái cốt của cách mạng tư sản dân quyền\"?', 'Chính cương vắn tắt, Sách lược vắn tắt.', 'Chỉ thị thành lập Hội phản đế đồng minh (18-11-1930).', 'Luận cương chính trị tháng 10-1930', 'Chung quanh vấn đề chiến sách mới của Đảng (10-1936).', 'C', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (150, 4, 2, 3, 'Lần đầu tiên nhân dân Việt Nam kỷ niệm ngày Quốc tế lao động vào năm nào?', '1930', '1931', '1936', '1938', 'A', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (151, 4, 2, 3, 'Cao trào cách mạng Việt Nam năm 1930 bắt đầu bị đế quốc Pháp đàn áp khốc liệt từ khi nào?', 'Đầu năm 1930', 'Cuối năm 1930', 'Đầu năm 1931', 'Cuối năm 1931', 'B', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (152, 4, 2, 3, 'Tên của lực lượng vũ trang được thành lập ở Nghệ Tĩnh trong cao trào cách mạng năm 1930 là gì?Chính quyền Xô viết ở một số vùng nông thôn Nghệ - Tĩnh được thành lập trong khoảng thời gian nào?', 'Du kích', 'Tự vệ', 'Tự vệ đỏ', 'Tự vệ chiến đấu', 'C', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (153, 4, 2, 3, 'Chính quyền Xô viết ở một số vùng nông thôn Nghệ - Tĩnh được thành lập trong khoảng thời gian nào?', 'Đầu năm 1930', 'Cuối năm 1930', ' Đầu năm 1931', 'Cuối năm 1931', 'B', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (154, 4, 3, 3, 'Nguyên nhân chủ yếu và có ý nghĩa quyết định sự bùng nổ và phát triển của cao trào cách mạng Việt Nam năm 1930?', 'Tác động tiêu cực của cuộc khủng hoảng kinh tế 1929-1933', 'Chính sách khủng bố trắng của đế quốc Pháp', 'Chính sách tăng cường vơ vét bóc lột của đế quốc Pháp', 'Sự lãnh đạo của Đảng Cộng sản Việt Nam', 'D', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (155, 4, 3, 3, 'Luận cương Chính trị do đồng chí Trần Phú khởi thảo ra đời vào thời gian nào?', '10990', '11232', '11202', '11171', 'B', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (156, 4, 3, 3, 'Hội nghị lần thứ nhất Ban chấp hành Trung ương 10/1930 do ai chủ trì?', 'Hồ Chí Minh ', 'Lê Duẫn ', 'Trường Chinh', 'Trần Phú', 'D', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (157, 4, 3, 3, 'Hội nghị Ban chấp hành TƯ tháng 10 năm 1930 đã cử ra bao nhiêu uỷ viên?', '4 uỷ viên', '5 uỷ viên', '6 uỷ viên', '7 uỷ viên', 'C', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (158, 4, 3, 3, 'Ai là Tổng Bí thư đầu tiên của Đảng?', 'Hồ Chí Minh ', 'Trần Văn Cung', 'Trần Phú', 'Lê Hồng Phong', 'C', NULL, 1, NULL, NULL);
INSERT INTO `questions` VALUES (159, 2, 3, 3, 'test tin học', 'aa', 'test', 'testt', 'teest', 'A', '/tmp/phpr7qAw8', 1, '2024-06-09 13:27:25', '2024-06-09 13:34:06');
INSERT INTO `questions` VALUES (160, 1, 3, 1, 'test', 'test', 'test', 'test', 'test', 'B', NULL, 1, NULL, '2024-06-09 20:58:59');

-- ----------------------------
-- Table structure for result
-- ----------------------------
DROP TABLE IF EXISTS `result`;
CREATE TABLE `result`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `students_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `point` double(8, 2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `result_students_id_index`(`students_id`) USING BTREE,
  INDEX `result_exam_id_index`(`exam_id`) USING BTREE,
  CONSTRAINT `result_ibfk_1` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `result_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of result
-- ----------------------------
INSERT INTO `result` VALUES (13, 1, 15, 5.00, 1, '2024-05-09 13:50:18', NULL);
INSERT INTO `result` VALUES (14, 1, 16, 3.33, 1, '2024-05-10 09:06:04', NULL);
INSERT INTO `result` VALUES (15, 1, 17, 4.50, 1, '2024-05-12 14:12:09', NULL);
INSERT INTO `result` VALUES (16, 2, 15, 5.00, 1, '2024-05-22 00:29:10', NULL);
INSERT INTO `result` VALUES (17, 4, 19, 2.00, 1, '2024-06-10 15:48:14', NULL);
INSERT INTO `result` VALUES (18, 4, 21, 5.00, 1, '2024-07-05 11:10:20', NULL);

-- ----------------------------
-- Table structure for result_question
-- ----------------------------
DROP TABLE IF EXISTS `result_question`;
CREATE TABLE `result_question`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `students_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `selected_option` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_correct` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `question_id`(`question_id`) USING BTREE,
  INDEX `students_id`(`students_id`) USING BTREE,
  INDEX `exam_id`(`exam_id`) USING BTREE,
  CONSTRAINT `result_question_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `result_question_ibfk_2` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `result_question_ibfk_3` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 88 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of result_question
-- ----------------------------
INSERT INTO `result_question` VALUES (19, 1, 1, 15, 'no_answer', 0, '2024-05-09 13:50:18', NULL);
INSERT INTO `result_question` VALUES (20, 3, 1, 15, 'B', 1, '2024-05-09 13:50:18', NULL);
INSERT INTO `result_question` VALUES (21, 4, 1, 16, 'B', 1, '2024-05-10 09:06:04', NULL);
INSERT INTO `result_question` VALUES (22, 7, 1, 16, 'C', 0, '2024-05-10 09:06:04', NULL);
INSERT INTO `result_question` VALUES (23, 8, 1, 16, 'no_answer', 0, '2024-05-10 09:06:04', NULL);
INSERT INTO `result_question` VALUES (24, 109, 1, 17, 'A', 0, '2024-05-12 14:12:08', NULL);
INSERT INTO `result_question` VALUES (25, 110, 1, 17, 'C', 1, '2024-05-12 14:12:08', NULL);
INSERT INTO `result_question` VALUES (26, 111, 1, 17, 'B', 1, '2024-05-12 14:12:08', NULL);
INSERT INTO `result_question` VALUES (27, 112, 1, 17, 'A', 1, '2024-05-12 14:12:08', NULL);
INSERT INTO `result_question` VALUES (28, 113, 1, 17, 'B', 0, '2024-05-12 14:12:08', NULL);
INSERT INTO `result_question` VALUES (29, 114, 1, 17, 'D', 1, '2024-05-12 14:12:08', NULL);
INSERT INTO `result_question` VALUES (30, 115, 1, 17, 'D', 1, '2024-05-12 14:12:08', NULL);
INSERT INTO `result_question` VALUES (31, 116, 1, 17, 'B', 1, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (32, 117, 1, 17, 'D', 1, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (33, 118, 1, 17, 'A', 0, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (34, 119, 1, 17, 'D', 0, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (35, 120, 1, 17, 'B', 1, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (36, 121, 1, 17, 'A', 0, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (37, 122, 1, 17, 'A', 0, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (38, 123, 1, 17, 'B', 0, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (39, 124, 1, 17, 'D', 0, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (40, 125, 1, 17, 'D', 1, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (41, 126, 1, 17, 'A', 1, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (42, 127, 1, 17, 'A', 0, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (43, 128, 1, 17, 'D', 0, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (44, 129, 1, 17, 'C', 0, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (45, 130, 1, 17, 'B', 0, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (46, 131, 1, 17, 'D', 1, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (47, 132, 1, 17, 'D', 0, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (48, 137, 1, 17, 'A', 0, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (49, 138, 1, 17, 'A', 0, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (50, 140, 1, 17, 'B', 1, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (51, 141, 1, 17, 'D', 1, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (52, 142, 1, 17, 'A', 0, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (53, 144, 1, 17, 'A', 1, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (54, 145, 1, 17, 'C', 0, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (55, 146, 1, 17, 'B', 0, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (56, 149, 1, 17, 'D', 0, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (57, 150, 1, 17, 'A', 1, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (58, 152, 1, 17, 'C', 1, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (59, 153, 1, 17, 'A', 0, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (60, 155, 1, 17, 'C', 0, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (61, 156, 1, 17, 'A', 0, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (62, 157, 1, 17, 'C', 1, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (63, 158, 1, 17, 'C', 1, '2024-05-12 14:12:09', NULL);
INSERT INTO `result_question` VALUES (64, 1, 2, 15, 'C', 1, '2024-05-22 00:29:10', NULL);
INSERT INTO `result_question` VALUES (65, 3, 2, 15, 'A', 0, '2024-05-22 00:29:10', NULL);
INSERT INTO `result_question` VALUES (66, 109, 4, 19, 'A', 0, '2024-06-10 15:48:14', NULL);
INSERT INTO `result_question` VALUES (67, 111, 4, 19, 'D', 0, '2024-06-10 15:48:14', NULL);
INSERT INTO `result_question` VALUES (68, 116, 4, 19, 'B', 1, '2024-06-10 15:48:14', NULL);
INSERT INTO `result_question` VALUES (69, 117, 4, 19, 'A', 0, '2024-06-10 15:48:14', NULL);
INSERT INTO `result_question` VALUES (70, 118, 4, 19, 'D', 0, '2024-06-10 15:48:14', NULL);
INSERT INTO `result_question` VALUES (71, 119, 4, 19, 'D', 0, '2024-06-10 15:48:14', NULL);
INSERT INTO `result_question` VALUES (72, 121, 4, 19, 'B', 0, '2024-06-10 15:48:14', NULL);
INSERT INTO `result_question` VALUES (73, 122, 4, 19, 'B', 1, '2024-06-10 15:48:14', NULL);
INSERT INTO `result_question` VALUES (74, 123, 4, 19, 'B', 0, '2024-06-10 15:48:14', NULL);
INSERT INTO `result_question` VALUES (75, 124, 4, 19, 'D', 0, '2024-06-10 15:48:14', NULL);
INSERT INTO `result_question` VALUES (76, 126, 4, 19, 'D', 0, '2024-06-10 15:48:14', NULL);
INSERT INTO `result_question` VALUES (77, 127, 4, 19, 'B', 0, '2024-06-10 15:48:14', NULL);
INSERT INTO `result_question` VALUES (78, 128, 4, 19, 'A', 1, '2024-06-10 15:48:14', NULL);
INSERT INTO `result_question` VALUES (79, 130, 4, 19, 'D', 0, '2024-06-10 15:48:14', NULL);
INSERT INTO `result_question` VALUES (80, 135, 4, 19, 'A', 0, '2024-06-10 15:48:14', NULL);
INSERT INTO `result_question` VALUES (81, 136, 4, 19, 'A', 0, '2024-06-10 15:48:14', NULL);
INSERT INTO `result_question` VALUES (82, 138, 4, 19, 'D', 0, '2024-06-10 15:48:14', NULL);
INSERT INTO `result_question` VALUES (83, 150, 4, 19, 'A', 1, '2024-06-10 15:48:14', NULL);
INSERT INTO `result_question` VALUES (84, 151, 4, 19, 'C', 0, '2024-06-10 15:48:14', NULL);
INSERT INTO `result_question` VALUES (85, 153, 4, 19, 'C', 0, '2024-06-10 15:48:14', NULL);
INSERT INTO `result_question` VALUES (86, 1, 4, 21, 'B', 0, '2024-07-05 11:10:20', NULL);
INSERT INTO `result_question` VALUES (87, 3, 4, 21, 'B', 1, '2024-07-05 11:10:20', NULL);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Admin', 'Quản trị viên cao cấp', '2024-05-17 08:43:43', NULL);
INSERT INTO `roles` VALUES (2, 'Guest', 'Khách hàng', '2024-05-17 08:43:43', NULL);
INSERT INTO `roles` VALUES (3, 'Developer', 'Phát triển hệ thống', '2024-05-17 08:43:43', NULL);
INSERT INTO `roles` VALUES (4, 'Content', 'Tạo nội dung', '2024-05-17 08:43:43', NULL);
INSERT INTO `roles` VALUES (7, 'Editor', 'Người chỉnh sửa', NULL, NULL);

-- ----------------------------
-- Table structure for standardize_exam
-- ----------------------------
DROP TABLE IF EXISTS `standardize_exam`;
CREATE TABLE `standardize_exam`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `exam_id`(`exam_id`) USING BTREE,
  INDEX `class_id`(`class_id`) USING BTREE,
  CONSTRAINT `standardize_exam_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `standardize_exam_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of standardize_exam
-- ----------------------------
INSERT INTO `standardize_exam` VALUES (20, 16, 2, '2024-05-09 11:31:42', NULL);
INSERT INTO `standardize_exam` VALUES (21, 15, 2, '2024-05-09 11:33:28', NULL);
INSERT INTO `standardize_exam` VALUES (22, 15, 1, '2024-05-09 11:33:36', NULL);
INSERT INTO `standardize_exam` VALUES (23, 16, 1, '2024-05-09 11:34:40', NULL);
INSERT INTO `standardize_exam` VALUES (24, 14, 1, '2024-05-09 12:00:52', NULL);
INSERT INTO `standardize_exam` VALUES (25, 17, 1, '2024-05-12 14:09:02', NULL);
INSERT INTO `standardize_exam` VALUES (26, 17, 2, '2024-05-13 01:09:14', NULL);
INSERT INTO `standardize_exam` VALUES (28, 19, 6, '2024-06-10 14:49:08', NULL);
INSERT INTO `standardize_exam` VALUES (29, 21, 6, '2024-07-05 11:02:27', NULL);

-- ----------------------------
-- Table structure for standardize_question
-- ----------------------------
DROP TABLE IF EXISTS `standardize_question`;
CREATE TABLE `standardize_question`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `questions_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `standardize_question_exam_id_index`(`exam_id`) USING BTREE,
  INDEX `standardize_question_questions_id_index`(`questions_id`) USING BTREE,
  CONSTRAINT `standardize_question_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `standardize_question_ibfk_2` FOREIGN KEY (`questions_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 108 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of standardize_question
-- ----------------------------
INSERT INTO `standardize_question` VALUES (18, 14, 2, '2024-04-26 12:48:39', NULL);
INSERT INTO `standardize_question` VALUES (19, 15, 1, '2024-05-02 17:46:29', NULL);
INSERT INTO `standardize_question` VALUES (20, 15, 3, '2024-05-02 17:46:29', NULL);
INSERT INTO `standardize_question` VALUES (21, 16, 7, '2024-05-04 13:01:49', NULL);
INSERT INTO `standardize_question` VALUES (22, 16, 4, '2024-05-04 13:01:49', NULL);
INSERT INTO `standardize_question` VALUES (23, 16, 8, '2024-05-04 13:01:49', NULL);
INSERT INTO `standardize_question` VALUES (24, 17, 117, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (25, 17, 122, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (26, 17, 123, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (27, 17, 112, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (28, 17, 124, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (29, 17, 118, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (30, 17, 126, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (31, 17, 128, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (32, 17, 125, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (33, 17, 127, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (34, 17, 116, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (35, 17, 109, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (36, 17, 149, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (37, 17, 129, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (38, 17, 111, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (39, 17, 153, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (40, 17, 130, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (41, 17, 137, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (42, 17, 138, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (43, 17, 132, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (44, 17, 114, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (45, 17, 121, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (46, 17, 152, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (47, 17, 115, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (48, 17, 119, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (49, 17, 150, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (50, 17, 131, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (51, 17, 158, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (52, 17, 140, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (53, 17, 145, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (54, 17, 141, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (55, 17, 155, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (56, 17, 113, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (57, 17, 142, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (58, 17, 146, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (59, 17, 110, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (60, 17, 120, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (61, 17, 156, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (62, 17, 157, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (63, 17, 144, '2024-05-12 14:08:46', NULL);
INSERT INTO `standardize_question` VALUES (84, 19, 116, '2024-06-10 14:48:52', NULL);
INSERT INTO `standardize_question` VALUES (85, 19, 128, '2024-06-10 14:48:52', NULL);
INSERT INTO `standardize_question` VALUES (86, 19, 123, '2024-06-10 14:48:52', NULL);
INSERT INTO `standardize_question` VALUES (87, 19, 124, '2024-06-10 14:48:52', NULL);
INSERT INTO `standardize_question` VALUES (88, 19, 109, '2024-06-10 14:48:52', NULL);
INSERT INTO `standardize_question` VALUES (89, 19, 118, '2024-06-10 14:48:52', NULL);
INSERT INTO `standardize_question` VALUES (90, 19, 127, '2024-06-10 14:48:52', NULL);
INSERT INTO `standardize_question` VALUES (91, 19, 122, '2024-06-10 14:48:52', NULL);
INSERT INTO `standardize_question` VALUES (92, 19, 126, '2024-06-10 14:48:52', NULL);
INSERT INTO `standardize_question` VALUES (93, 19, 117, '2024-06-10 14:48:52', NULL);
INSERT INTO `standardize_question` VALUES (94, 19, 135, '2024-06-10 14:48:52', NULL);
INSERT INTO `standardize_question` VALUES (95, 19, 119, '2024-06-10 14:48:52', NULL);
INSERT INTO `standardize_question` VALUES (96, 19, 151, '2024-06-10 14:48:52', NULL);
INSERT INTO `standardize_question` VALUES (97, 19, 136, '2024-06-10 14:48:52', NULL);
INSERT INTO `standardize_question` VALUES (98, 19, 153, '2024-06-10 14:48:52', NULL);
INSERT INTO `standardize_question` VALUES (99, 19, 130, '2024-06-10 14:48:52', NULL);
INSERT INTO `standardize_question` VALUES (100, 19, 111, '2024-06-10 14:48:52', NULL);
INSERT INTO `standardize_question` VALUES (101, 19, 121, '2024-06-10 14:48:52', NULL);
INSERT INTO `standardize_question` VALUES (102, 19, 138, '2024-06-10 14:48:52', NULL);
INSERT INTO `standardize_question` VALUES (103, 19, 150, '2024-06-10 14:48:52', NULL);
INSERT INTO `standardize_question` VALUES (106, 21, 1, '2024-07-05 11:00:43', NULL);
INSERT INTO `standardize_question` VALUES (107, 21, 3, '2024-07-05 11:00:43', NULL);

-- ----------------------------
-- Table structure for students
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth` date NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `school_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cccd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `students_class_id_index`(`class_id`) USING BTREE,
  CONSTRAINT `students_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of students
-- ----------------------------
INSERT INTO `students` VALUES (1, '3120219089', 'Nguyễn Nhật Long', 'male', '2024-04-12', 1, '2021 - 2022', 'https://res.cloudinary.com/quizz-local/image/upload/v1713728945/quizz_local/t%E1%BA%A3i%20xu%E1%BB%91ng.png', '$2y$12$tqz50ZeEAkZ.75OTUBmVjOyb4U7aMBAyDQZ1nm2OqZDeawWT5YX1i', '048201002386', '0899244850', 'q@ued.udn.vn', 1, '2024-04-23 23:06:03', '2024-05-10 11:01:42');
INSERT INTO `students` VALUES (2, '3120219099', 'Trần Minh Tuấn', 'male', '2001-06-06', 2, '2021-2022', NULL, '$2y$12$3v6ZTRPjRvAh3IHWT46a1uU.Q.rMev2eSno8IMLDoz1YtTcMc98Vu', '048201002385', '0899244851', 't@ued.udn.vn', 1, '2024-04-24 15:24:00', '2024-05-13 01:11:24');
INSERT INTO `students` VALUES (3, '3120219091', 'Trần Minh Long', 'male', '2001-05-10', 1, '2019-2024', NULL, '$2y$12$IBa2Yb4pqoAy1Yk9jjwmIuNGfakD83fj8kiXaTGOc15piGBxsZLc6', '048201002387', '0899244856', 'l@ued.udn.vn', 1, '2024-04-26 20:06:57', '2024-05-20 18:25:23');
INSERT INTO `students` VALUES (4, '3120219111', 'Nguyễn Nhật Thịnh', 'male', '1999-06-10', 6, '2023', 'https://res.cloudinary.com/quizz-local/image/upload/v1713728945/quizz_local/t%E1%BA%A3i%20xu%E1%BB%91ng.png', '$2y$12$/2p6rb.PXtJNaM2/kkhBe.6CU2LC0eX1930XfDmf5cj.Kd3Ue5EUS', '048201001231', '0899244331', 'thinh@ued.udn.vn', 1, '2024-06-10 14:41:13', NULL);

-- ----------------------------
-- Table structure for subjects
-- ----------------------------
DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subjects
-- ----------------------------
INSERT INTO `subjects` VALUES (1, 'Toán', 1, '2024-04-23 23:03:32', '2024-04-28 02:01:48');
INSERT INTO `subjects` VALUES (2, 'Tin', 1, '2024-04-23 23:03:36', '2024-04-28 02:01:46');
INSERT INTO `subjects` VALUES (3, 'Hoá', 1, '2024-04-23 23:03:40', '2024-04-28 14:03:31');
INSERT INTO `subjects` VALUES (4, 'Lịch sử', 1, '2024-05-12 01:26:03', '2024-07-01 11:43:52');

-- ----------------------------
-- Table structure for user_role
-- ----------------------------
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  INDEX `role_id`(`role_id`) USING BTREE,
  CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_role
-- ----------------------------
INSERT INTO `user_role` VALUES (1, 5, 4, NULL, NULL);
INSERT INTO `user_role` VALUES (4, 2, 1, NULL, NULL);
INSERT INTO `user_role` VALUES (5, 1, 7, NULL, NULL);
INSERT INTO `user_role` VALUES (6, 6, 2, NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Editor', 'editor@gmail.com', NULL, '$2y$12$XUphuqZKS8DyMCpVeZWK1ep0d/CwmNU3cFLntgRKENkkOXefiWupm', 'Vprite4N0kNPTeX7lehEcwgB1aviiqnlwuyCdtQ13M9et1B67QIjbM4HbgvA', '2024-04-23 15:41:31', '2024-04-23 15:41:31');
INSERT INTO `users` VALUES (2, 'Root', 'root@gmail.com', NULL, '$2y$12$NlRu7dQkxjXpWmOXoOax5O9zKGUON2xDsYXLF6i8hIt6l0mTe07wS', NULL, '2024-05-17 05:56:35', NULL);
INSERT INTO `users` VALUES (5, 'Content', 'content@gmail.com', NULL, '$2y$12$8q4YHYmUxBgnOKfcikWBTONDTjE.Kv6TNaf5Va3H1PWiW/S/qGNY6', NULL, '2024-05-17 10:00:07', '2024-05-17 10:00:07');
INSERT INTO `users` VALUES (6, 'Guest', 'guest@gmail.com', NULL, '$2y$12$iZg0wW905HQQnCNfAESScuumpI6cED2nFuUjX8t4DoRWCVhwtZsrS', NULL, '2024-05-17 10:02:04', '2024-05-17 16:03:08');

-- ----------------------------
-- Table structure for visitors
-- ----------------------------
DROP TABLE IF EXISTS `visitors`;
CREATE TABLE `visitors`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `students_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_id`(`students_id`) USING BTREE,
  CONSTRAINT `visitors_ibfk_1` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of visitors
-- ----------------------------
INSERT INTO `visitors` VALUES (4, '172.18.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-07-05 11:10:21', 4, '2024-07-05 04:10:21', '2024-07-05 04:10:21');
INSERT INTO `visitors` VALUES (5, '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', '2024-07-05 16:50:11', NULL, '2024-07-05 09:50:11', '2024-07-05 09:50:11');

SET FOREIGN_KEY_CHECKS = 1;
