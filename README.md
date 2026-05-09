# Portfolio Website - Laravel CRUD System

A modern, professional portfolio website for showcasing projects, certificates, and skills with complete CRUD functionality and an elegant admin panel.

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=flat-square&logo=php)
![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-3.0-38B2AC?style=flat-square&logo=tailwind-css)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

## 📖 About

**Portofoliov2** is a comprehensive portfolio management system built with Laravel. It allows users to showcase their projects, certifications, and skills with a beautiful interface featuring glassmorphism design, dark/light mode, and a powerful admin panel for content management.

## ✨ Key Features

### Public Website
- 🏠 **Stunning Homepage** - Hero section, about section, featured projects, certificates, and skills showcase
- 📂 **Projects Showcase** - Filter by category, detailed project pages with gallery
- 🏆 **Certificates Gallery** - Display professional certifications and achievements
- 📧 **Contact Form** - With validation and spam protection
- 🌓 **Dark/Light Mode** - Automatic system preference detection with manual toggle
- 📱 **Fully Responsive** - Mobile-first design that works on all devices

### Admin Panel
- 📊 **Dashboard** - Statistics overview and recent activities
- 📝 **Projects CRUD** - Full management with image upload, tags, and gallery
- 🎓 **Certificates CRUD** - Manage certifications with credentials and dates
- 💻 **Skills CRUD** - Technical and soft skills with proficiency levels
- 📬 **Contact Messages** - View and manage incoming messages
- ⚙️ **Settings** - Configure portfolio information and social links

### Design
- 🎨 **Glassmorphism** - Modern frosted glass effects throughout the interface
- 🌈 **Gradient Accents** - Beautiful color transitions and visual hierarchy
- ✨ **Smooth Animations** - Scroll reveals and hover effects for engagement
- 🎯 **Clean Typography** - Professional fonts (Inter & Poppins)

## 🛠️ Tech Stack

- **Framework:** Laravel 12 (31% PHP, 69% Blade)
- **Frontend:** Blade Templating, Alpine.js
- **Styling:** Tailwind CSS
- **Database:** MySQL 8.0+
- **Build Tool:** Vite
- **Package Manager:** Composer, NPM

## 🚀 Installation

### Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL 8.0 or higher
- Node.js & NPM

### Step-by-Step Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/PrasetyaRiski/Portofoliov2.git
   cd Portofoliov2
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies:**
   ```bash
   npm install
   ```

4. **Setup environment file:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database in `.env`:**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=portfolio
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Run database migrations:**
   ```bash
   php artisan migrate --seed
   ```

7. **Create storage link for image uploads:**
   ```bash
   php artisan storage:link
   ```

8. **Start development server:**
   ```bash
   npm run dev        # Terminal 1 - Build assets
   php artisan serve  # Terminal 2 - Laravel server
   ```

9. **Access the application:**
   - Public: `http://localhost:8000`
   - Admin: `http://localhost:8000/admin`
   - Default credentials: `admin@portfolio.dev` / `password`

## 📁 Project Structure

```
Portofoliov2/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/           # Admin CRUD controllers
│   │   │   ├── Auth/            # Authentication controllers
│   │   │   └── PublicController # Public site controllers
│   │   └── Requests/            # Form validation requests
│   └── Models/
│       ├── Project.php
│       ├── Certificate.php
│       ├── Skill.php
│       └── ContactMessage.php
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
├── public/                      # Public accessible assets
├── storage/                     # File uploads directory
└── README.md
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
# Application
APP_NAME=Portfolio
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=portfolio

# Portfolio Owner
PORTFOLIO_OWNER_NAME="Your Name"
PORTFOLIO_OWNER_TITLE="Full Stack Developer"
PORTFOLIO_OWNER_EMAIL="your@email.com"

# Social Links
PORTFOLIO_GITHUB_URL="https://github.com/username"
PORTFOLIO_LINKEDIN_URL="https://linkedin.com/in/username"
```

## 🔧 Customization

### Change Colors

Modify Tailwind CSS custom colors in layout files:

```html
<style>
    :root {
        --color-primary-500: #6366f1;
        --color-secondary-500: #a855f7;
    }
</style>
```

### Add New Project Categories

Edit `config/portfolio.php`:

```php
'projects' => [
    'categories' => [
        'web' => 'Web Application',
        'mobile' => 'Mobile App',
        'ui-design' => 'UI Design',
    ],
],
```

### Upload Custom Logo

Place your logo in `public/images/` and update the view file:

```blade
<img src="{{ asset('images/logo.png') }}" alt="Logo">
```

## 🔒 Security

- ✅ CSRF protection on all forms
- ✅ Password hashing with bcrypt
- ✅ SQL injection prevention via Eloquent ORM
- ✅ XSS protection with Blade template escaping
- ✅ Rate limiting on API endpoints
- ✅ Authentication middleware for admin routes

## 🌐 Deployment (cPanel Hosting)

### Requirements

- Shared hosting with PHP 8.1+
- SSH/Terminal access
- MySQL database

### Steps

1. **Upload files to hosting:**
   ```
   /home/username/
   ├── public_html/          # Public files (index.php, storage/)
   └── laravel/              # Private Laravel files
   ```

2. **Edit `public_html/index.php`:**
   ```php
   require __DIR__.'/../laravel/vendor/autoload.php';
   $app = require_once __DIR__.'/../laravel/bootstrap/app.php';
   ```

3. **Configure `.env`:**
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com
   ```

4. **Fix image display issues:**
   - Sync storage: `php artisan storage:sync`
   - Or copy: `storage/app/public/*` → `public_html/storage/`
   - Set permissions: `chmod -R 755 storage bootstrap/cache`

## 📝 API Documentation

### Projects Endpoint
- `GET /api/projects` - List all projects
- `GET /api/projects/{slug}` - Get single project
- `POST /api/projects` - Create project (admin)
- `PUT /api/projects/{id}` - Update project (admin)
- `DELETE /api/projects/{id}` - Delete project (admin)

### Certificates Endpoint
- `GET /api/certificates` - List all certificates
- `POST /api/certificates` - Create certificate (admin)

### Skills Endpoint
- `GET /api/skills` - List all skills
- `POST /api/skills` - Create skill (admin)

## 🤝 Contributing

We welcome contributions! To contribute:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

## 👤 Author

**Prasetya Riski Wa'afan**

---

⭐ **If you find this project helpful, please give it a star!**

*Last Updated: May 9, 2026*
