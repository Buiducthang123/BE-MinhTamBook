<?php

namespace Database\Seeders;

use App\Models\Author;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $authors = [
            [
                'name' => 'Xuân Quỳnh',
                'avatar' => 'https://upload.wikimedia.org/wikipedia/vi/8/80/Xuan_Quynh.jpg',
                'description' => 'Xuân Quỳnh là một nữ nhà thơ tiêu biểu của văn học Việt Nam hiện đại. Bà nổi tiếng với các tác phẩm đầy cảm xúc như "Thuyền và biển", "Sóng". Với ngôn ngữ giản dị nhưng sâu sắc, thơ bà thường thể hiện tình yêu, nỗi nhớ và khát vọng sống. Cuộc đời bà gắn liền với những biến động lịch sử nhưng vẫn sáng tạo nên những áng thơ bất hủ. Bà được truy tặng Giải thưởng Hồ Chí Minh về văn học nghệ thuật.',
            ],
            [
                'name' => 'Nam Cao',
                'avatar' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b0/Portrait_of_Nam_Cao.jpg/220px-Portrait_of_Nam_Cao.jpg',
                'description' => 'Nam Cao là một trong những nhà văn hiện thực lớn nhất của văn học Việt Nam trước Cách mạng Tháng Tám. Ông nổi tiếng với các tác phẩm như "Chí Phèo", "Lão Hạc", mang đậm tính nhân văn và hiện thực. Văn chương của ông thường phản ánh đời sống nghèo khổ và những mâu thuẫn xã hội đương thời. Sau Cách mạng, ông tham gia kháng chiến và hy sinh trên đường làm nhiệm vụ. Tên tuổi Nam Cao gắn liền với sự phát triển của truyện ngắn Việt Nam.',
            ],
            [
                'name' => 'Lý Bạch',
                'avatar' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4c/LiBai.jpg/151px-LiBai.jpg',
                'description' => 'Lý Bạch, tự Thái Bạch, là một trong những thi nhân vĩ đại nhất của Trung Quốc thời Đường. Ông được mệnh danh là "Thi Tiên" nhờ tài thơ lãng mạn và sáng tạo vượt thời đại. Với cảm hứng từ thiên nhiên và con người, thơ Lý Bạch thường chứa đựng vẻ đẹp hoang dã và mạnh mẽ. Ông sống một cuộc đời phiêu bạt, tìm kiếm tự do và nghệ thuật. Những tác phẩm của ông đã để lại dấu ấn không phai trong lịch sử văn học Đông Á.',
            ],
            [
                'name' => 'Nguyễn Du',
                'avatar' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e3/T%C6%B0%E1%BB%A3ng_%C4%91%C3%A0i_c%E1%BB%A5_Nguy%E1%BB%85n_Du.jpg/222px-T%C6%B0%E1%BB%A3ng_%C4%91%C3%A0i_c%E1%BB%A5_Nguy%E1%BB%85n_Du.jpg',
                'description' => 'Nguyễn Du là đại thi hào dân tộc, tác giả kiệt tác "Truyện Kiều" - viên ngọc quý của văn học Việt Nam. Cuộc đời ông chứng kiến nhiều biến động lịch sử, ảnh hưởng sâu sắc đến phong cách sáng tác. Thơ ông không chỉ là tiếng lòng của một con người mà còn là tiếng nói của thời đại. Với "Truyện Kiều", Nguyễn Du đã đưa văn học Việt Nam lên tầm cao mới, được UNESCO vinh danh là Danh nhân văn hóa thế giới.',
            ],
            [
                'name' => 'Nguyễn Trãi',
                'avatar' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c6/Nguyen_Trai.jpg/220px-Nguyen_Trai.jpg',
                'description' => 'Nguyễn Trãi là một nhà chính trị, nhà quân sự và nhà văn hóa lớn của Việt Nam thời Lê sơ. Ông đóng vai trò quan trọng trong cuộc kháng chiến chống quân Minh, nổi tiếng với Bình Ngô đại cáo - bản tuyên ngôn độc lập đầu tiên của nước ta. Văn chương của ông mang đậm triết lý nhân văn, yêu nước và yêu dân. Cuộc đời ông tuy bi thảm nhưng để lại di sản tinh thần lớn lao, được hậu thế kính trọng.',
            ],
            [
                'name' => 'Hàn Mặc Tử',
                'avatar' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/08/Hanmactu.jpg/220px-Hanmactu.jpg',
                'description' => 'Hàn Mặc Tử là một nhà thơ lớn của phong trào Thơ mới Việt Nam. Ông nổi bật với phong cách siêu thực và đầy cảm xúc mãnh liệt. Dù phải sống trong bệnh tật và nghèo khó, thơ ông vẫn tràn đầy sức sống và đam mê nghệ thuật. Các tập thơ như "Gái quê", "Xuân như ý" đã khẳng định tài năng thiên phú của ông. Hàn Mặc Tử là biểu tượng của sự dâng hiến hết mình cho nghệ thuật.',
            ],
            [
                'name' => 'Tố Hữu',
                'avatar' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/df/To_Huu.jpg/220px-To_Huu.jpg',
                'description' => 'Tố Hữu là một nhà thơ cách mạng xuất sắc, người đi đầu trong việc kết hợp thơ ca và lý tưởng chính trị. Ông nổi tiếng với tập thơ "Từ ấy", ghi lại những bước chuyển biến trong cuộc đời cách mạng của mình. Thơ Tố Hữu mang đậm chất trữ tình và nhiệt huyết yêu nước. Cuộc đời và sự nghiệp của ông gắn liền với các giai đoạn lịch sử quan trọng của dân tộc. Ông được coi là "lá cờ đầu" của nền thơ ca cách mạng Việt Nam.',
            ],
            [
                'name' => 'Đỗ Phủ',
                'avatar' => 'https://revelogue.com/wp-content/uploads/2021/01/do-phu-1-e1610207862475.jpg',
                'description' => 'Đỗ Phủ, tự Tử Mỹ, là một nhà thơ hiện thực lỗi lạc của Trung Hoa thời Đường. Ông thường được gọi là "Thi Thánh" vì những đóng góp vĩ đại cho văn học. Thơ của Đỗ Phủ phản ánh sâu sắc xã hội đương thời, đặc biệt là nỗi khổ của dân nghèo. Cuộc đời ông tuy gặp nhiều bất hạnh, nhưng lại tạo nên những áng thơ đầy cảm xúc và giá trị lịch sử. Đỗ Phủ là biểu tượng lớn của văn học hiện thực Trung Quốc.',
            ],
            [
                'name' => 'Phạm Tiến Duật',
                'avatar' => 'https://www.thivien.net/attachment/ozV37-JqLhiT3bwGuaolVA.1119858171.jpg',
                'description' => 'Phạm Tiến Duật là nhà thơ tiêu biểu của thế hệ trẻ Việt Nam thời kỳ kháng chiến chống Mỹ. Thơ ông nổi bật với giọng điệu trẻ trung, hài hước nhưng sâu sắc, thể hiện tinh thần lạc quan của người lính. Tập thơ "Vầng trăng quầng lửa" của ông đã khắc họa chân thực hình ảnh cuộc chiến tranh bảo vệ Tổ quốc. Phạm Tiến Duật để lại dấu ấn đặc biệt trong văn học hiện đại Việt Nam.',
            ],
            [
                'name' => 'Nguyễn Bính',
                'avatar' => 'https://th.bing.com/th/id/OIP.lJgXFl4ObSjRG_e74glgVgHaJ4?rs=1&pid=ImgDetMain',
                'description' => 'Nguyễn Bính là nhà thơ lãng mạn nổi tiếng với những bài thơ mang đậm hồn quê Việt Nam. Thơ ông thường gợi lên hình ảnh làng quê thanh bình, mộc mạc nhưng đầy chất thơ. Các tập thơ như "Lỡ bước sang ngang", "Tâm hồn tôi" đã làm say đắm biết bao thế hệ độc giả. Nguyễn Bính được coi là "thi sĩ của thôn quê", người mang hơi thở của làng Việt vào từng câu chữ.',
            ],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
