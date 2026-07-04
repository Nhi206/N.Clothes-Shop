# N.clothes - Digital Tailor

Ứng dụng thương mại điện tử Laravel dành cho cửa hàng thời trang số.

## Tổng quan

Dự án này là một hệ thống e-commerce gồm:
- Trang sản phẩm, danh mục và tìm kiếm
- Giỏ hàng, wishlist và đặt đơn hàng
- Trang thiết kế cá nhân cho khách hàng
- Quản lý tin tức, khuyến mãi, kho hàng
- Dashboard admin và staff
- Profile, settings, đổi mật khẩu, xóa tài khoản

## Tính năng chính

- Quản lý người dùng với role `admin`, `staff`, `customer`
- Dashboard admin/staff xử lý users, products, categories, orders, promotions, suppliers, inventories
- Giao diện người dùng cho khách: sản phẩm, thiết kế, tin tức, profile
- Hệ thống xác thực Laravel Breeze với login/register
- Route admin an toàn: chỉ admin và staff mới truy cập được

## Chi tiết chức năng

### 1. Quản lý người dùng (Admin/Staff)
- **Dashboard**: Thống kê tổng quan (khách hàng, nhân viên, sản phẩm, đơn hàng, doanh thu, danh mục, khuyến mãi)
- **Quản lý Users**: Thêm/sửa/xóa người dùng, phân quyền role (admin/staff/customer)
- **Quản lý Sản phẩm**: CRUD sản phẩm, quản lý hình ảnh, biến thể (size, màu), danh mục
- **Quản lý Danh mục**: Thêm/sửa/xóa danh mục sản phẩm
- **Quản lý Đơn hàng**: Xem chi tiết đơn hàng, cập nhật trạng thái (đang xử lý, đã giao, hủy)
- **Quản lý Khuyến mãi**: Tạo/sửa/xóa khuyến mãi, áp dụng cho sản phẩm
- **Quản lý Nhà cung cấp**: CRUD nhà cung cấp
- **Quản lý Kho**: Theo dõi tồn kho, nhập hàng, xuất hàng
- **Báo cáo**: Thống kê doanh thu, đơn hàng theo thời gian

### 2. Giao diện khách hàng
- **Trang chủ**: Banner, sản phẩm nổi bật, danh mục
- **Sản phẩm**: Danh sách sản phẩm, chi tiết sản phẩm, tìm kiếm, lọc theo danh mục
- **Giỏ hàng**: Thêm/xóa sản phẩm, cập nhật số lượng, tính tổng tiền
- **Wishlist**: Thêm/xóa sản phẩm yêu thích, đồng bộ số lượng
- **Đặt hàng**: Form checkout, chọn địa chỉ giao hàng, thanh toán
- **Lịch sử đơn hàng**: Xem chi tiết đơn hàng đã đặt
- **Thiết kế**: Trang thiết kế cá nhân, lưu thiết kế, xem thiết kế đã tạo
- **Tin tức**: Danh sách tin tức, chi tiết bài viết
- **Profile**: Cập nhật thông tin cá nhân (tên, email, số điện thoại)
- **Settings**: Cài đặt thông báo, thông tin liên hệ
- **Đổi mật khẩu**: Form đổi mật khẩu an toàn
- **Xóa tài khoản**: Xóa tài khoản với xác nhận mật khẩu

### 3. Hệ thống xác thực
- **Đăng ký**: Form đăng ký với validation
- **Đăng nhập**: Login với email/password
- **Xác minh email**: Gửi email xác minh sau đăng ký
- **Quên mật khẩu**: Reset password qua email
- **Đăng xuất**: Logout an toàn
- **Middleware**: Bảo vệ route theo role (admin/staff/customer)

### 4. Tính năng bổ sung
- **Responsive Design**: Giao diện mobile-friendly với Tailwind CSS
- **Material Design Icons**: Sử dụng Google Material Symbols
- **AJAX**: Cập nhật giỏ hàng, wishlist không reload trang
- **Validation**: Form validation phía server và client
- **Flash Messages**: Thông báo thành công/lỗi
- **Pagination**: Phân trang cho danh sách dài
- **Search**: Tìm kiếm sản phẩm theo tên, danh mục
- **File Upload**: Upload hình ảnh sản phẩm
- **Soft Delete**: Xóa mềm cho dữ liệu quan trọng

## Yêu cầu

- PHP ^8.2
- Laravel 12
- Node.js + npm
- SQLite (mặc định) hoặc MySQL/PostgreSQL

## Khởi tạo dự án

```bash
git clone <repository-url>
cd TTTN-PROJECT
composer install
cp .env.example .env
php artisan key:generate
```

### Thiết lập database

Mặc định dùng SQLite. Nếu dùng SQLite, tạo file:

```bash
touch database/database.sqlite
```

Nếu dùng MySQL hoặc PostgreSQL, cập nhật `.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## Migrate và seed dữ liệu

```bash
php artisan migrate --seed
```

## Frontend

```bash
npm install
npm run build
```

## Chạy ứng dụng

```bash
php artisan serve
```

Mở trình duyệt tại: `http://127.0.0.1:8000`

## Lệnh hữu ích

- `composer run setup` - cài đặt nhanh toàn bộ môi trường
- `npm run dev` - chạy Vite ở chế độ phát triển
- `npm run build` - build frontend
- `composer test` - chạy PHPUnit

## Tài khoản mẫu

- Admin
  - Email: `admin@example.com`
  - Password: `Password123!`

- Staff
  - Email: `staff@example.com`
  - Password: `Password123!`

- Customer
  - Email: `customer.nguyen@example.com`
  - Password: `Password123!`

- Staff/Designer
  - Email: `hoa.designer@example.com`
  - Password: `Password123!`

## Structure chính

- `app/Http/Controllers` - controller cho client, admin, auth
- `app/Models` - model dữ liệu
- `resources/views` - view Blade
- `routes/web.php` - route ứng dụng
- `database/migrations` - schema database
- `database/seeders` - seed dữ liệu mẫu

## Các route quan trọng

- `/home` - trang chủ
- `/products` - danh sách sản phẩm
- `/cart` - giỏ hàng
- `/wishlist` - wishlist
- `/profile` - chỉnh sửa thông tin cá nhân
- `/settings` - cài đặt tài khoản
- `/admin` - admin dashboard

## Chạy lại dữ liệu mẫu

```bash
php artisan migrate:fresh --seed
```

## Ghi chú

Sau khi thay đổi `.env`, chạy:

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```

## License

Dự án này sử dụng giấy phép MIT.
