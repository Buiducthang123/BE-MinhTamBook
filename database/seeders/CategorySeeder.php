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
                'name' => 'Truyện Tranh',
                'slug' => 'truyen-tranh',
                'description' => '<p>Các bộ truyện tranh nổi tiếng.</p>',
                'avatar' => 'https://eltimes.vn/wp-content/uploads/2021/02/2-2.jpg',
                'sub_categories' => [
                    [
                        'name' => 'Truyện Tranh Cổ Tích',
                        'slug' => 'truyen-tranh-co-tich',
                        'description' => '<p>Các bộ truyện tranh cổ tích.</p>',
                        'avatar' => 'https://www.nxbtre.com.vn/Images/Book/NXBTreStoryFull_19242015_102435.jpg',
                    ],
                    [
                        'name' => 'Truyện Tranh Hành Động',
                        'slug' => 'truyen-tranh-hanh-dong',
                        'description' => '<p>Các bộ truyện tranh hành động.</p>',
                        'avatar' => 'https://product.hstatic.net/200000122283/product/truyen-tranh-phong-cach-nhat-ban-nhan-vat-hanh-dong-va-bien-hinh-tr5uc_5f9f636a3c0b4db890846275f705a721_master.jpg',
                    ],
                    [
                        'name' => 'Truyện Tranh Học Đường',
                        'slug' => 'truyen-tranh-hoc-duong',
                        'description' => '<p>Các bộ truyện tranh học đường.</p>',
                        'avatar' => 'https://vn-live-01.slatic.net/p/d9c2069a67c06e7720a46015430e123e.jpg',
                    ],
                ],
            ],
            [
                'name' => 'Sách Giáo Dục',
                'slug' => 'sach-giao-duc',
                'description' => '<p>Các sách giáo dục cho trẻ em và người lớn.</p>',
                'avatar' => 'https://image.nhandan.vn/1200x630/Uploaded/2025/genaghlrgybna/2022_11_18/10cuonsach-4406.jpg.webp',
                'sub_categories' => [
                    [
                        'name' => 'Sách Giáo Khoa',
                        'slug' => 'sach-giao-khoa',
                        'description' => '<p>Các sách giáo khoa dành cho học sinh.</p>',
                        'avatar' => 'https://intranphu.vn/wp-content/uploads/2016/04/SGK_final.jpg',
                    ],
                    [
                        'name' => 'Sách Học Ngoại Ngữ',
                        'slug' => 'sach-hoc-ngoai-ngu',
                        'description' => '<p>Các sách học ngoại ngữ, từ vựng, ngữ pháp.</p>',
                        'avatar' => 'https://salt.tikicdn.com/cache/280x280/ts/product/e1/04/31/7763d9035552760f627c34acfec0e12f.jpg',
                    ],
                    [
                        'name' => 'Sách Hướng Nghiệp - Phát Triển Bản Thân',
                        'slug' => 'sach-huong-nghiep-phat-trien-ban-than',
                        'description' => '<p>Các sách về hướng nghiệp, phát triển bản thân.</p>',
                        'avatar' => 'https://nxbhcm.com.vn/Image/Biasach/0cd2906e883f166d2cbe9e99b0c8147d.jpg',
                    ],
                ],
            ],
            [
                'name' => 'Sách Kinh Tế',
                'slug' => 'sach-kinh-te',
                'description' => '<p>Các sách về kinh tế, quản trị kinh doanh.</p>',
                'avatar' => 'https://govi.vn/wp-content/uploads/2023/02/luoc-su-kinh-te-hoc.jpg',
                'sub_categories' => [
                    [
                        'name' => 'Sách Quản Trị Kinh Doanh',
                        'slug' => 'sach-quan-tri-kinh-doanh',
                        'description' => '<p>Các sách về quản trị kinh doanh.</p>',
                        'avatar' => 'https://govi.vn/wp-content/uploads/2023/03/khong-den-mot.jpg',
                    ],
                    [
                        'name' => 'Sách Marketing',
                        'slug' => 'sach-marketing',
                        'description' => '<p>Các sách về marketing, quảng cáo.</p>',
                        'avatar' => 'https://bizweb.dktcdn.net/100/197/269/products/ke-hoach-marketing-outline-15-7-2019.png?v=1563325959247',
                    ],
                ],

            ],
            [
                'name' => 'Văn Học Kinh Điển',
                'slug' => 'van-hoc-kinh-dien',
                'description' => '<p>Các tác phẩm văn học kinh điển của thế giới.</p>',
                'avatar' => 'https://307a0e78.vws.vegacdn.vn/view/v2/image/img.media/bai-van-phan-tich-tac-pham-vo-nhat-so-10-403385.jpg',
                'sub_categories' => [
                    [
                        'name' => 'Văn Học Việt Nam',
                        'slug' => 'van-hoc-viet-nam',
                        'description' => '<p>Các tác phẩm văn học của tác giả Việt Nam.</p>',
                        'avatar' => 'https://www.sachbaokhang.vn/uploads/files/2023/05/01/van-10.jpg',
                    ],
                    [
                        'name' => 'Văn Học Nước Ngoài',
                        'slug' => 'van-hoc-nuoc-ngoai',
                        'description' => '<p>Các tác phẩm văn học của tác giả nước ngoài.</p>',
                        'avatar' => 'https://cdn0.fahasa.com/media/catalog/product/i/m/image_217480.jpg',
                    ],
                ],
            ],
            [
                'name' => 'Tiểu Thuyết',
                'slug' => 'tieu-thuyet',
                'description' => '<p>Sách tiểu thuyết đủ thể loại.</p>',
                'avatar' => 'https://cdn0.fahasa.com/media/catalog/product/i/m/image_217480.jpg',
                'sub_categories' => [
                    [
                        'name' => 'Tiểu Thuyết Ngôn Tình',
                        'slug' => 'tieu-thuyet-ngon-tinh',
                        'description' => '<p>Sách tiểu thuyết ngôn tình.</p>',
                        'avatar' => 'https://simg.zalopay.com.vn/zlp-website/assets/dung_noi_voi_anh_ay_6790ecb41b.jpg',
                    ],
                    [
                        'name' => 'Tiểu Thuyết Huyền Bí',
                        'slug' => 'tieu-thuyet-huyen-bi',
                        'description' => '<p>Sách tiểu thuyết huyền bí.</p>',
                        'avatar' => 'https://cdn0.fahasa.com/media/catalog/product/2/4/24d0a082-972d-44c5-bcc3-5b41f575cbd5.jpg',
                    ],
                ],
            ],
            [
                'name' => 'Cuộc Chiến VN',
                'slug' => 'cuoc-chien-vn',
                'description' => '<p>Tư liệu và sách về cuộc chiến Việt Nam.</p>',
                'avatar' => 'https://lh6.googleusercontent.com/proxy/Z54373aygJAuIbGuhDHOzXzOROVQexAUYT_HjN7EFfQYrD97CmAkYREgbtHpAlOR0E1w4WWbowgGd5hk7OQHUIxPQjVKNJ-DFvRhYxHox95Bu5xRvhp31BoAvomPjObkvXkrf40alQmBZznjKYxd',
                'sub_categories' => [
                    [
                        'name' => 'Tư Liệu Chiến Tranh',
                        'slug' => 'tu-lieu-chien-tranh',
                        'description' => '<p>Tư liệu và phân tích về chiến tranh.</p>',
                        'avatar' => 'https://cdn0.fahasa.com/media/flashmagazine/images/page_images/lich_su_chien_tranh_qua_100_tran_danh___nghe_thuat_quan_su_dinh_cao_theo_dong_thoi_gian___bia_cung/2024_03_29_16_50_47_1-390x510.jpg',
                    ],
                    [
                        'name' => 'Nhân Vật Lịch Sử',
                        'slug' => 'nhan-vat-lich-su',
                        'description' => '<p>Tiểu sử các nhân vật lịch sử nổi tiếng.</p>',
                        'avatar' => 'https://lh4.googleusercontent.com/proxy/kwcGvc1FtHBlFMDm_oS3Dq9QgiPEF13hf9unQV7B5bHx0HBWaNOuch_zg9vfDNY7794YWZCaFNLz-dAtwjtsflBdQlsLqTwNV_GMQgDwTQ',
                    ],
                ],
            ],
            [
                'name' => 'Khác',
                'slug' => 'khac',
                'description' => '<p>Danh mục tổng hợp các chủ đề khác.</p>',
                'avatar' => 'https://hoanghamobile.com/tin-tuc/wp-content/uploads/2023/06/Sach-hay.jpg',
            ],
        ];

        // Tạo danh mục cha

        foreach ($categories as $category) {
            $data = [
                'name' => $category['name'],
                'slug' => $category['slug'],
                'description' => $category['description'],
                'avatar' => $category['avatar'],
            ];
            $categoryCreate = Category::create($data);

            // Kiểm tra và tạo danh mục con nếu có
            if (isset($category['sub_categories']) && is_array($category['sub_categories'])) {
                foreach ($category['sub_categories'] as $sub_category) {
                    $sub_category_data = [
                        'name' => $sub_category['name'],
                        'slug' => $sub_category['slug'],
                        'description' => $sub_category['description'],
                        'avatar' => $sub_category['avatar'],
                        'parent_id' => $categoryCreate->id,
                    ];
                    Category::create($sub_category_data);
                }
            }
        }

    }
}
