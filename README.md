# Portfolio Website - Laravel CRUD System

A modern, professional portfolio website for IT students with complete CRUD functionality, admin panel, and beautiful glassmorphism design.

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=flat-square&logo=php)
![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-3.0-38B2AC?style=flat-square&logo=tailwind-css)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql)

## ✨ Features

### Public Website
- 🏠 **Stunning Homepage** - Hero section, about, featured projects, certificates, and skills
- 📂 **Projects Showcase** - Filter by category, detailed project pages with gallery
- 🏆 **Certificates Gallery** - Display professional certifications
- 📧 **Contact Form** - With validation and spam protection
- 🌓 **Dark/Light Mode** - System preference detection
- 📱 **Fully Responsive** - Mobile-first design

### Admin Panel
- 📊 **Dashboard** - Statistics overview, recent activities
- 📝 **Projects CRUD** - Full management with image upload, tags, gallery
- 🎓 **Certificates CRUD** - Manage certifications with credentials
- 💻 **Skills CRUD** - Technical and soft skills with proficiency levels
- 📬 **Contact Messages** - View and manage messages

### Design
- 🎨 **Glassmorphism** - Modern frosted glass effects
- 🌈 **Gradient Accents** - Beautiful color transitions
- ✨ **Smooth Animations** - Scroll reveals and hover effects
- 🎯 **Clean Typography** - Inter & Poppins fonts

## 🚀 Installation

### Requirements
- PHP 8.1+
- Composer
- MySQL 8.0+
- Node.js & NPM (optional for assets)

### Steps

1. **Clone the repository**
```bash
git clone https://github.com/username/portfolio.git
cd portfolio
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database**
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio
DB_USERNAME=root
DB_PASSWORD=
```

5. **Run migrations and seeders**
```bash
php artisan migrate --seed
```

6. **Create storage link**
```bash
php artisan storage:link
```

7. **Start the server**
```bash
php artisan serve
```

8. **Access the website**
- Public: http://localhost:8000
- Admin: http://localhost:8000/admin
- Login: admin@portfolio.dev / password

## 📁 Project Structure

```
portfolio/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/           # Admin CRUD controllers
│   │   │   ├── Api/             # API controllers
│   │   │   └── ...              # Public controllers
│   │   └── Requests/            # Form validation
│   ├── Models/                  # Eloquent models
│   └── Services/                # Business logic
├── config/
│   └── portfolio.php            # Portfolio configuration
├── database/
│   ├── migrations/              # Database schema
│   └── seeders/                 # Sample data
├── resources/
│   └── views/
│       ├── admin/               # Admin panel views
│       ├── auth/                # Authentication views
│       ├── layouts/             # Blade layouts
│       └── public/              # Public pages
├── routes/
│   ├── web.php                  # Web routes
│   └── api.php                  # API routes
└── public/                      # Public assets
```

## ⚙️ Configuration

### Portfolio Settings
Edit `config/portfolio.php` to customize:
- Owner information (name, title, bio)
- Social media links
- Project/Certificate/Skill categories
- SEO settings

### Environment Variables
```env
# Portfolio Owner
PORTFOLIO_OWNER_NAME="Your Name"
PORTFOLIO_OWNER_TITLE="Full Stack Developer"
PORTFOLIO_OWNER_EMAIL="your@email.com"

# Social Links
PORTFOLIO_GITHUB_URL="https://github.com/username"
PORTFOLIO_LINKEDIN_URL="https://linkedin.com/in/username"
```

## 🔧 Customization

### Colors
The primary color scheme uses Tailwind CSS custom colors. Modify in layout files:
```html
<style>
    :root {
        --color-primary-500: #6366f1;
        --color-secondary-500: #a855f7;
    }
</style>
```

### Adding New Categories
Edit `config/portfolio.php`:
```php
'projects' => [
    'categories' => [
        'web' => 'Web Application',
        'mobile' => 'Mobile App',
        // Add more...
    ],
],
```

## 🔒 Security

- CSRF protection on all forms
- Password hashing with bcrypt
- SQL injection prevention via Eloquent
- XSS protection with Blade escaping
- Rate limiting on API endpoints

## 🌐 cPanel Hosting Deployment

Jika menggunakan shared hosting cPanel, ikuti langkah berikut:

### 1. Upload Files
Upload semua file ke hosting. Struktur folder seharusnya:
```
/home/username/
├── public_html/          # Isi folder public Laravel
│   ├── index.php
│   ├── storage/          # Folder storage (manual, bukan symlink)
│   └── ...
└── laravel/              # Folder utama Laravel (di luar public_html)
    ├── app/
    ├── config/
    ├── storage/
    └── ...
```

### 2. Edit index.php
Edit `public_html/index.php` untuk mengarah ke folder Laravel:
```php
require __DIR__.'/../laravel/vendor/autoload.php';
$app = require_once __DIR__.'/../laravel/bootstrap/app.php';
```

### 3. Konfigurasi .env
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

FORCE_HTTPS=true
```

### 4. Fix Storage/Gambar Tidak Tampil

Di cPanel shared hosting, **symlink biasanya tidak berfungsi**. Solusi:

**Opsi A: Sync via Admin Panel**
- Login ke Admin Panel → Settings
- Klik tombol "Sync Storage Files"

**Opsi B: Sync via Terminal/SSH**
```bash
php artisan storage:sync
```

**Opsi C: Manual**
- Copy semua isi dari `storage/app/public/` ke `public_html/storage/`

### 5. Set Permissions
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod -R 755 public_html/storage
```

### Troubleshooting Gambar Tidak Tampil
1. Pastikan folder `public_html/storage` ada dan writable
2. Pastikan URL di `.env` (APP_URL) benar
3. Gunakan fitur "Sync Storage Files" setelah upload gambar baru
4. Cek permission folder: harus `755` atau `775`

## 📝 API Documentation

### Projects
- `GET /api/projects` - List all projects
- `GET /api/projects/{slug}` - Get single project

### Certificates
- `GET /api/certificates` - List all certificates

### Skills
- `GET /api/skills` - List all skills

## 🤝 Contributing

1. Fork the repository
2. Create feature branch (`git checkout -b feature/amazing`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing`)
5. Open Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).


⭐ Star this repository if you found it helpful!
