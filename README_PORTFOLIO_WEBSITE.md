# 🌐 Portfolio Website (This Project)

Portfolio website personal berbasis **Laravel** dengan fitur project showcase, skills display, contact form, dan CV download. Designed untuk recruitment & professional presentation.

## ✨ Features

✅ Hero section dengan intro  
✅ Projects showcase dengan filtering  
✅ Skills section terorganisir per kategori  
✅ About section dengan stats  
✅ Contact form dengan email integration  
✅ CV preview modal & download  
✅ Admin dashboard untuk manage content  
✅ Fully responsive design  
✅ Dark modern theme dengan glassmorphism  
✅ GitHub project auto-sync  

## 🛠️ Tech Stack

| Category | Technology |
|----------|-----------|
| **Backend** | Laravel 10.x, PHP 8.1+ |
| **Frontend** | Blade, Bootstrap 5, Tailwind CSS |
| **Database** | MySQL |
| **Styling** | Custom CSS, Glassmorphism |
| **Build** | Vite, npm |
| **Hosting** | Railway |

## 🚀 Installation

```bash
git clone https://github.com/MuhammadAmirN/Portofolio.git
cd Portofolio
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve
```

Visit: http://localhost:8000

## 📁 Structure

```
Portofolio/
├── app/Models/ (Project, Skill, Message)
├── app/Http/Controllers/
├── resources/views/ (Blade templates)
├── resources/css/ (Tailwind config)
├── database/migrations/
└── public/ (Assets)
```

## 🎯 Key Modules

**Admin Panel:**
- Manage projects (CRUD)
- Auto-sync GitHub repositories
- Manage skills per category
- View contact messages

**Public Pages:**
- Home (hero + projects)
- Projects with filtering
- Skills showcase
- About with stats
- Contact form
- CV modal

## 📊 Database Tables

- `projects` - Portfolio projects
- `skills` - Technical skills
- `messages` - Contact submissions
- `users` - Admin authentication

## 🚀 Deployment

```bash
# Deploy to Railway
railway login
railway init
git push heroku main
```

## 📈 Features

✅ Glassmorphism design
✅ Dark modern theme
✅ Smooth animations
✅ Mobile responsive
✅ Accessibility compliant
✅ Performance optimized
✅ SEO friendly

## 👤 Author Info

- **Name:** Muhammad Amir Nurudin
- **Email:** muhamir6n@gmail.com
- **Phone:** +62 821-4515-3914
- **Location:** Klaten, Jawa Tengah
- **Status:** Semester 6 Student, Internship Ready

## 🔗 Links

- Portfolio: https://amir-portfolio.com
- GitHub: https://github.com/MuhammadAmirN
- LinkedIn: https://linkedin.com/in/muh-amir-n-a1a94b418/

## 📄 License

MIT License - See LICENSE file

---

**Status:** ✅ Production Ready | **Version:** 1.0 | **Last Updated:** 2026-06-23
