# 🧺 Sistem Laundry Mataram

Sistem manajemen laundry lengkap berbasis **Laravel** dengan fitur **CRUD**, **role-based access control**, dan **laporan keuangan** komprehensif. Dirancang untuk memudahkan operasional bisnis laundry modern.

## ✨ Features

✅ **User Management**: Admin, Staff, Customer roles dengan permissions berbeda  
✅ **CRUD Operations**: Manage services, orders, pricing  
✅ **Order Management**: Customer orders tracking & status updates  
✅ **Financial Reports**: Revenue, profit, expense tracking  
✅ **Dashboard Analytics**: Real-time business metrics  
✅ **Responsive UI**: Mobile-friendly interface  
✅ **Invoice Generator**: Automated invoice PDF  
✅ **Payment Tracking**: Track payments & outstanding balance  

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| **Backend** | Laravel 10.x, PHP 8.1+ |
| **Frontend** | Blade Templating, Bootstrap 5, JavaScript |
| **Database** | MySQL 8.0 |
| **Authentication** | Laravel Auth, Session |
| **PDF Generation** | DOMPDF / Laravel PDF |
| **Version Control** | Git |

## 📋 Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL 8.0+
- Node.js & npm
- Git

## 🚀 Quick Start

### 1. Clone & Setup
```bash
git clone https://github.com/MuhammadAmirN/loundry_mataram-laravel.git
cd loundry_mataram-laravel
composer install
npm install
```

### 2. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database Setup
```bash
# Update .env database credentials
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laundry_mataram
DB_USERNAME=root
DB_PASSWORD=

# Run migrations
php artisan migrate

# Seed demo data (optional)
php artisan db:seed
```

### 4. Build & Serve
```bash
npm run dev
php artisan serve
```

Access: http://localhost:8000

## 👥 User Roles & Permissions

| Role | Permissions |
|------|------------|
| **Admin** | Full access, create/edit/delete users, reports, settings |
| **Staff** | Manage orders, update status, view reports |
| **Customer** | View own orders, track status, make payments |

## 🗄️ Database Schema

### Core Tables
- `users` - User accounts & authentication
- `roles` - User roles (admin, staff, customer)
- `services` - Laundry services offered (wash, dry clean, iron, etc)
- `orders` - Customer orders
- `order_items` - Individual items in order
- `payments` - Payment records
- `expenses` - Business expenses
- `reports` - Financial reports cache

### Sample Services
```
Standard Wash - Rp 5,000/kg
Dry Clean - Rp 15,000/piece
Express Service - Rp 8,000/kg
Iron Service - Rp 3,000/item
```

## 🖥️ Dashboard Features

### Admin Dashboard
- Total orders today
- Revenue summary
- Pending orders
- Customer statistics
- Staff performance

### Financial Reports
- Daily/weekly/monthly revenue
- Expense tracking
- Profit analysis
- Outstanding balance
- Payment methods breakdown

### Order Management
- New orders queue
- In-progress orders
- Completed orders
- Search & filter
- Bulk status update

## 📊 API Endpoints (if available)

```
GET    /api/orders            - List all orders
POST   /api/orders            - Create new order
GET    /api/orders/{id}       - Get order details
PUT    /api/orders/{id}       - Update order
DELETE /api/orders/{id}       - Delete order

GET    /api/services          - List services
POST   /api/services          - Create service
PUT    /api/services/{id}     - Update service

GET    /api/reports/revenue   - Revenue report
GET    /api/reports/expenses  - Expense report
```

## 📁 Project Structure

```
loundry_mataram-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── OrderController.php
│   │   │   ├── ServiceController.php
│   │   │   ├── ReportController.php
│   │   │   └── PaymentController.php
│   │   └── Middleware/
│   ├── Models/
│   │   ├── Order.php
│   │   ├── Service.php
│   │   ├── Payment.php
│   │   └── User.php
│   └── Services/
│       ├── OrderService.php
│       ├── ReportService.php
│       └── PaymentService.php
├── resources/
│   ├── views/
│   │   ├── dashboard.blade.php
│   │   ├── orders/
│   │   ├── services/
│   │   ├── reports/
│   │   └── layout/
│   └── css/
├── database/
│   └── migrations/
├── routes/
│   ├── web.php
│   └── api.php (if applicable)
└── public/
    └── assets/
```

## 🎯 Key Features in Detail

### Order Management Flow
```
1. Customer submits order
   ↓
2. Admin/Staff reviews & confirms
   ↓
3. Service type & price assigned
   ↓
4. Order processing begins
   ↓
5. Status updates (pending → processing → ready → completed)
   ↓
6. Customer notification
   ↓
7. Payment & invoice
```

### Financial Reporting
- Automatic calculation dari completed orders
- Daily revenue tracking
- Expense categorization
- Profit margin analysis
- Tax calculation (if applicable)
- Export to PDF/Excel

### Invoice Generation
```
Sample Invoice:
─────────────────
Order ID: #001
Customer: Amir
Service: Standard Wash (5kg)
Price: Rp 25,000
─────────────────
Total: Rp 25,000
Status: Paid
Date: 2026-06-23
─────────────────
```

## 🧪 Testing

### Manual Testing Checklist
```
[ ] Create order flow
[ ] Update order status
[ ] Generate invoice
[ ] View reports
[ ] User authentication
[ ] Permission checks
```

### Automated Tests
```bash
php artisan test
```

## 🚀 Production Deployment

### Pre-Deployment Checklist
```
[ ] .env configured untuk production
[ ] Database migrated
[ ] Assets compiled (npm run build)
[ ] Session & cache drivers configured
[ ] SSL certificate installed
[ ] Backup strategy planned
```

### Deploy Commands
```bash
# Update code
git pull origin main

# Install dependencies
composer install --no-dev

# Compile assets
npm run build

# Run migrations
php artisan migrate --force

# Clear caches
php artisan cache:clear
php artisan config:cache
php artisan route:cache
```

## 📱 Responsive Design

✅ Mobile-friendly interface (< 768px)  
✅ Tablet optimized (768px - 1024px)  
✅ Desktop full features (> 1024px)  
✅ Touch-friendly buttons & inputs  
✅ Fast load times  

## 🔒 Security Features

- CSRF protection
- SQL injection prevention
- XSS protection
- Password hashing (bcrypt)
- Role-based access control
- Audit logs (optional)
- Rate limiting

## 🐛 Troubleshooting

### Database connection error?
```bash
# Check .env database credentials
php artisan tinker
# Test connection
DB::connection()->getPdo();
```

### Permission denied?
- Check user role in database
- Verify middleware applied
- Check policy/gate configuration

### Styles not loading?
```bash
npm run dev
# or for production
npm run build
```

## 📊 Performance Optimization

- Database indexing on frequently queried fields
- Query caching untuk reports
- Lazy loading untuk order items
- CSS/JS minification
- Image optimization
- Database query optimization

## 📚 Additional Documentation

- [Setup Guide](./docs/setup.md)
- [User Manual](./docs/user-manual.md)
- [API Documentation](./docs/api.md)
- [Troubleshooting](./docs/troubleshooting.md)

## 🎯 Future Enhancements

- [ ] Mobile app (React Native/Flutter)
- [ ] WhatsApp integration untuk order notifications
- [ ] Online payment gateway (Midtrans/Stripe)
- [ ] SMS alerts untuk customers
- [ ] Inventory management untuk supplies
- [ ] Staff performance metrics
- [ ] Customer loyalty program
- [ ] Multi-branch support

## 👨‍💻 Development Workflow

### Adding New Feature
1. Create feature branch: `git checkout -b feature/new-feature`
2. Make changes
3. Test thoroughly
4. Create pull request
5. Merge to main

### Code Style
- Follow PSR-12 PHP standards
- Use meaningful variable names
- Comment complex logic
- Keep functions small & focused

## 📞 Support & Contact

Issues or questions?
- GitHub Issues: https://github.com/MuhammadAmirN/loundry_mataram-laravel/issues
- Email: muhamir6n@gmail.com
- LinkedIn: linkedin.com/in/muh-amir-n-a1a94b418/

## 👤 Author

**Muhammad Amir Nurudin**
- GitHub: [@MuhammadAmirN](https://github.com/MuhammadAmirN)
- Email: muhamir6n@gmail.com
- LinkedIn: [muh-amir-n](https://linkedin.com/in/muh-amir-n-a1a94b418/)
- Portfolio: [amir-portfolio.com](https://amir-portfolio.com)

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

## 🙏 Acknowledgments

- Laravel framework & community
- Bootstrap framework
- All contributors
- Universitas Duta Bangsa Surakarta
