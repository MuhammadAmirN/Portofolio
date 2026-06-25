# 🎫 Sistem Pemesanan Tiket Sepak Bola

Aplikasi pemesanan tiket sepak bola berbasis **Python** dengan fitur booking, kursi selection, pembayaran, dan laporan.

## ✨ Features

✅ Browse upcoming football events  
✅ Select & book stadium seats  
✅ Multiple payment methods  
✅ Booking confirmation & e-tickets  
✅ Refund handling  
✅ Admin reports & analytics  
✅ User accounts & booking history  

## 🛠️ Tech Stack

- Python 3.9+
- OOP principles
- SQLite/MySQL database
- JDBC for connections

## 📊 Database

**Events:** event_id, team1, team2, stadium, date, price, capacity  
**Bookings:** booking_id, user_id, event_id, seat_number, date, status  
**Users:** user_id, name, email, phone  
**Payments:** payment_id, booking_id, amount, method, status

## 🚀 Installation

```bash
git clone https://github.com/MuhammadAmirN/pemesanan_tiket_bola.git
cd pemesanan-tiket
python -m venv venv
source venv/bin/activate
pip install -r requirements.txt
python main.py
```

## 🎯 Features

- Real-time seat availability
- Secure payment processing
- Email ticket delivery
- Booking history
- Cancellation system
- Admin dashboard
- Reports generation

## 📞 Contact

GitHub: [pemesanan_tiket_bola](https://github.com/MuhammadAmirN/pemesanan_tiket_bola)  
Email: muhamir6n@gmail.com

---

**Author:** Muhammad Amir Nurudin | **License:** MIT
