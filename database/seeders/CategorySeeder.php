<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo danh mục cha
        $categories = [
            [
                'name'        => 'Truyện Tranh',
                'slug'        => 'truyen-tranh',
                'description' => '<p>Các bộ truyện tranh nổi tiếng.</p>',
                'avatar'      => 'https://eltimes.vn/wp-content/uploads/2021/02/2-2.jpg',
            ],
            [
                'name'        => 'Sách Giáo Dục',
                'slug'        => 'sach-giao-duc',
                'description' => '<p>Các sách giáo dục cho trẻ em và người lớn.</p>',
                'avatar'      => 'https://image.nhandan.vn/1200x630/Uploaded/2025/genaghlrgybna/2022_11_18/10cuonsach-4406.jpg.webp',
            ],
            [
                'name'        => 'Sách Hướng Nghiệp - Phát Triển Bản Thân',
                'slug'        => 'sach-huong-nghiep-phat-trien-ban-than',
                'description' => '<p>Các sách về hướng nghiệp, phát triển bản thân.</p>',
                'avatar'      => 'https://nxbhcm.com.vn/Image/Biasach/0cd2906e883f166d2cbe9e99b0c8147d.jpg',
            ],
            [
                'name'        => 'Sách Kinh Tế',
                'slug'        => 'sach-kinh-te',
                'description' => '<p>Các sách về kinh tế, quản trị kinh doanh.</p>',
                'avatar'      => 'https://govi.vn/wp-content/uploads/2023/02/luoc-su-kinh-te-hoc.jpg',
            ],
            [
                'name'        => 'Văn Học Kinh Điển',
                'slug'        => 'van-hoc-kinh-dien',
                'description' => '<p>Các tác phẩm văn học kinh điển của thế giới.</p>',
                'avatar'      => 'https://307a0e78.vws.vegacdn.vn/view/v2/image/img.media/bai-van-phan-tich-tac-pham-vo-nhat-so-10-403385.jpg',
            ],
            [
                'name'        => 'Sách Học Ngoại Ngữ',
                'slug'        => 'sach-hoc-ngoai-ngu',
                'description' => '<p>Các sách học ngoại ngữ, từ vựng, ngữ pháp.</p>',
                'avatar'      => 'https://pos.nvncdn.com/fd5775-40602/ps/20241120_YplWL2DvUX.png',
            ],
            [
                'name'        => 'Tiểu Thuyết',
                'slug'        => 'tieu-thuyet',
                'description' => '<p>Sách tiểu thuyết đủ thể loại.</p>',
                'avatar'      => 'https://cdn0.fahasa.com/media/catalog/product/i/m/image_217480.jpg',
            ],
            [
                'name'        => 'Cuộc Chiến VN',
                'slug'        => 'cuoc-chien-vn',
                'description' => '<p>Tư liệu và sách về cuộc chiến Việt Nam.</p>',
                'avatar'      => 'https://lh6.googleusercontent.com/proxy/Z54373aygJAuIbGuhDHOzXzOROVQexAUYT_HjN7EFfQYrD97CmAkYREgbtHpAlOR0E1w4WWbowgGd5hk7OQHUIxPQjVKNJ-DFvRhYxHox95Bu5xRvhp31BoAvomPjObkvXkrf40alQmBZznjKYxd',
            ],
            [
                'name'        => 'Khác',
                'slug'        => 'khac',
                'description' => '<p>Danh mục tổng hợp các chủ đề khác.</p>',
                'avatar'      => 'https://hoanghamobile.com/tin-tuc/wp-content/uploads/2023/06/Sach-hay.jpg',
            ],
        ];

        // Tạo danh mục cha
        $parentCategories = [];
        foreach ($categories as $category) {
            $parentCategories[$category['slug']] = Category::create(
                array_merge($category, ['parent_id' => null])
            );
        }

        // Tạo danh mục con
        $subCategories = [
            [
                'name'        => 'Trinh Thám, Hình Sự',
                'slug'        => 'trinh-tham-hinh-su',
                'parent_id'   => 1,
                'description' => '<p>Truyện trinh thám và hình sự đầy hồi hộp.</p>',
                'avatar'      => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbp7EAowkcyGoCt2OHSgAgwmB3QZi9QrAVhg&s',
            ],
            [
                'name'        => 'Phiêu Lưu, Mạo Hiểm',
                'slug'        => 'phieu-luu-mao-hiem',
                'parent_id'   => 2,
                'description' => '<p>Sách phiêu lưu và mạo hiểm hấp dẫn.</p>',
                'avatar'      => 'https://topxephang.com/wp-content/uploads/2018/01/NXBTreStoryFull_28102012_031031.jpg',
            ],
            [
                'name'        => 'Ngôn Tình',
                'slug'        => 'ngon-tinh',
                'parent_id'   => 3,
                'description' => '<p>Truyện ngôn tình cảm động.</p>',
                'avatar'      => 'https://sachxua.vn/wp-content/uploads/2020/01/se-co-thien-than-thay-anh-yeu-em-sach-nt.jpg',
            ],
            [
                'name'        => 'Khoa Học Viễn Tưởng',
                'slug'        => 'khoa-hoc-vien-tuong',
                'parent_id'   => 4,
                'description' => '<p>Sách khoa học viễn tưởng hấp dẫn.</p>',
                'avatar'      => 'https://newshop.vn/public/uploads/content/vi-sao-nhu-the-nao-khong-gian-min.jpg',
            ],
            [
                'name'        => 'Khoa Học',
                'slug'        => 'khoa-hoc',
                'parent_id'   => 5,
                'description' => '<p>Bài viết về khoa học và khám phá.</p>',
                'avatar'      => 'https://bvtb.org.vn/wp-content/uploads/2024/03/hinh-anh-de-tai-nghien-cuu-khoa-hoc-0.jpg',
            ],
            [
                'name'        => 'Triết Học, Kinh Tế',
                'slug'        => 'triet-hoc-kinh-te',
                'parent_id'   => 6,
                'description' => '<p>Bài viết phân tích về triết học và kinh tế.</p>',
                'avatar'      => 'https://stbook.vn/static/covers/CP111BK120211115134605/cover.clsbi',
            ],
            [
                'name'        => 'Nhân Vật Lịch Sử',
                'slug'        => 'nhan-vat-lich-su',
                'parent_id'   => 7,
                'description' => '<p>Tiểu sử các nhân vật lịch sử nổi tiếng.</p>',
                'avatar'      => 'https://lh4.googleusercontent.com/proxy/kwcGvc1FtHBlFMDm_oS3Dq9QgiPEF13hf9unQV7B5bHx0HBWaNOuch_zg9vfDNY7794YWZCaFNLz-dAtwjtsflBdQlsLqTwNV_GMQgDwTQ',
            ],
            [
                'name'        => 'Hồi Ký, Tùy Bút',
                'slug'        => 'hoi-ky-tuy-but',
                'parent_id'   => 7,
                'description' => '<p>Những ký ức, câu chuyện thời chiến tranh.</p>',
                'avatar'      => 'https://cungdocsach.vn/wp-content/uploads/2019/08/c%C3%A1t-b%E1%BB%A5i-ch%C3%A2n-ai.gif',
            ],
            [
                'name'        => 'Tư Liệu Chiến Tranh',
                'slug'        => 'tu-lieu-chien-tranh',
                'parent_id'   => 8,
                'description' => '<p>Tư liệu và phân tích về chiến tranh.</p>',
                'avatar'      => 'https://cdn0.fahasa.com/media/flashmagazine/images/page_images/lich_su_chien_tranh_qua_100_tran_danh___nghe_thuat_quan_su_dinh_cao_theo_dong_thoi_gian___bia_cung/2024_03_29_16_50_47_1-390x510.jpg',
            ],
        ];

        foreach ($subCategories as $subCategory) {
            Category::create($subCategory);
        }
    }
}
