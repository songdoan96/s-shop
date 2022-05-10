<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $desc = '<p>Esse recusandae. Cum.</p>
        <h3>Thi&ecirc;́t k&ecirc;́ đẳng cấp h&agrave;ng đầu</h3>
        <p>iPhone mới kế thừa thiết kế đặc trưng từ&nbsp;<a title="Tham khảo gi&aacute; điện thoại iPhone 12 Pro Max ch&iacute;nh h&atilde;ng" href="https://www.thegioididong.com/dtdd/iphone-12-pro-max" target="_blank" rel="noopener">iPhone 12 Pro Max</a>&nbsp;khi sở hữu khung viền vu&ocirc;ng vức, mặt lưng k&iacute;nh c&ugrave;ng m&agrave;n h&igrave;nh tai thỏ tr&agrave;n viền nằm ở ph&iacute;a trước.</p>
        <p><img src="/storage/photos/1/iphone-12-pro-max-xam-new-600x600-600x600.jpg" alt="" width="482" height="482" /></p>
        <p>Với iPhone 13 Pro Max phần tai thỏ đ&atilde; được thu gọn lại 20% so với thế hệ trước, kh&ocirc;ng chỉ giải ph&oacute;ng nhiều kh&ocirc;ng gian hiển thị hơn m&agrave; c&ograve;n gi&uacute;p mặt trước chiếc&nbsp;<a title="Tham khảo điện thoại kinh doanh tại Thế Giới Di Động" href="https://www.thegioididong.com/dtdd" target="_blank" rel="noopener">điện thoại</a>&nbsp;trở n&ecirc;n hấp dẫn hơn m&agrave; vẫn đảm bảo được hoạt động của c&aacute;c cảm biến.</p>
        <p><img src="/storage/photos/1/iphone-se-128gb-2020-do-600x600.jpg" alt="" width="451" height="451" /></p>
        <p>Đi&ecirc;̉m thay đ&ocirc;̉i dễ d&agrave;ng nhận biết tr&ecirc;n&nbsp;<a title="Tham khảo d&ograve;ng iPhone 13 kinh doanh tại TopZone thương hiệu của Thế Giới Di Động" href="https://www.topzone.vn/iphone-13" target="_blank" rel="noopener">iPhone 13</a>&nbsp;Pro Max ch&iacute;nh là k&iacute;ch thước của cảm biến camera sau được l&agrave;m to hơn v&agrave; để tăng độ nhận diện cho sản phẩm mới th&igrave; Apple cũng đ&atilde; bổ sung một t&ugrave;y chọn m&agrave;u sắc&nbsp;Sierra Blue (m&agrave;u xanh dương nhạt hơn so với Pacific Blue của iPhone 12 Pro Max).</p>
        <p><img src="/storage/photos/1/samsung-galaxy-z-fold-2-den-600x600.jpg" alt="" width="492" height="492" /></p>
        <p>M&aacute;y vẫn tiếp tục sử dụng khung viền th&eacute;p cao cấp cho khả năng chống trầy xước v&agrave; va đập một c&aacute;ch vượt trội, kết hợp với khả năng&nbsp;<a title="Tham khảo gi&aacute; điện thoại smartphone chống nước chống bụi" href="https://www.thegioididong.com/dtdd-chong-nuoc-bui" target="_blank" rel="noopener">kh&aacute;ng bụi, nước</a>&nbsp;chu&acirc;̉n IP68.</p>
        <p>&nbsp;</p>
        <h3>M&agrave;n h&igrave;nh giải tr&iacute; si&ecirc;u mượt c&ugrave;ng tần số qu&eacute;t 120 Hz</h3>
        <p>iPhone 13 Pro Max được trang bị m&agrave;n h&igrave;nh k&iacute;ch thước 6.7 inch c&ugrave;ng độ ph&acirc;n giải 1284 x 2778 Pixels, sử dụng tấm nền OLED c&ugrave;ng c&ocirc;ng nghệ Super Retina XDR cho khả năng tiết kiệm năng lượng vượt trội nhưng vẫn đảm bảo hiển thị sắc n&eacute;t sống động ch&acirc;n thực.</p>
        <p>&nbsp;</p>
        <p>iPhone Pro Max năm nay đ&atilde; được n&acirc;ng cấp l&ecirc;n tần số qu&eacute;t 120 Hz, mọi thao t&aacute;c chuyển cảnh khi lướt ng&oacute;n tay tr&ecirc;n m&agrave;n h&igrave;nh trở n&ecirc;n mượt m&agrave; hơn đồng thời hiệu ứng thị gi&aacute;c khi ch&uacute;ng ta chơi game hoặc xem video cũng cực kỳ m&atilde;n nh&atilde;n.</p>
        <p>&nbsp;</p>
        <p>C&ugrave;ng c&ocirc;ng nghệ ProMotion th&ocirc;ng minh c&oacute; thể thay đổi tần số qu&eacute;t từ 10 đến 120 lần mỗi gi&acirc;y t&ugrave;y thuộc v&agrave;o ứng dụng, thao t&aacute;c bạn đang sử dụng, nhằm tối ưu thời lượng sử dụng pin v&agrave; trải nghiệm của bạn.</p>
        <p><img src="/storage/photos/1/iphone-se-128gb-2020-do-600x600.jpg" alt="" width="600" height="600" /></p>
        <p>Nếu bạn d&ugrave;ng iPhone 13 Pro Max để chơi game, tần số qu&eacute;t 120 Hz kết hợp hiệu suất đồ họa tuyệt vời của GPU sẽ khiến m&aacute;y trở n&ecirc;n v&ocirc; c&ugrave;ng ho&agrave;n hảo khi trải nghiệm.</p>
        <p>&nbsp;</p>
        <p>Ngo&agrave;i ra m&aacute;y cũng hỗ trợ c&ocirc;ng nghệ True Tone, dải m&agrave;u rộng chuẩn điện ảnh P3 sẽ cho mọi trải nghiệm của bạn tr&ecirc;n m&aacute;y trở n&ecirc;n ấn tượng hơn bao giờ hết.</p>';




        $catName = ['Tivi',  'Đồng hồ', 'Điện thoại', 'Máy tính', 'Phụ kiện', 'Tủ lạnh', 'Máy giặt', 'Điều hòa'];
        $category_id = rand(1, 8);

        $pathFolder = public_path('upload/' . $category_id);
        $allFile = scandir($pathFolder, 1);
        $selPic = rand(0, count($allFile) - 3);
        $proName = $catName[$category_id - 1];

        $extension = pathinfo($allFile[$selPic], PATHINFO_EXTENSION);

        $image = time() . rand(1000, 9999) . "." . $extension;
        copy(public_path('upload/' . $category_id . '/' . $allFile[$selPic]), public_path('images/' . $image));

        for ($i = 0; $i < 4; $i++) {
            $selPic = rand(0, count($allFile) - 3);

            $imgName = time() . rand(1000, 9999) . "." . $extension;
            $imgArr[] = $imgName;
            copy(public_path('upload/' . $category_id . '/' . $allFile[$selPic]), public_path('images/' . $imgName));
        }
        $images = (implode('|', $imgArr));

        $name = $proName . " " . $this->faker->unique()->words(4, true);
        $slug = Str::slug($name);

        return [
            'name' => $name,
            'slug' => $slug,
            'price' => $this->faker->numberBetween(1000000, 50000000),
            'category_id' => $category_id,
            'brand_id' => $this->faker->numberBetween(1, 7),
            'desc' => $desc,
            'status' => $this->faker->randomElement(['0', '1']),
            'quantity' => $this->faker->numberBetween(10, 50),
            'featured' => $this->faker->randomElement(['0', '1']),
            'image' => $image,
            'images' => $images,
        ];
    }
}
