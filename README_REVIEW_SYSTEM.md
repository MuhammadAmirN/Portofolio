# ⭐ Sistem Penilaian Review (Java)

Aplikasi sistem penilaian dan review berbasis **Java** dengan GUI interface. User dapat memberikan rating dan review terhadap produk/layanan dengan database terintegrasi.

## ✨ Features

✅ Product/Service listing  
✅ Rating system (1-5 stars)  
✅ Review text input  
✅ Review display & sorting  
✅ Average rating calculation  
✅ User authentication  
✅ Admin moderation panel  
✅ Statistical reports  

## 🛠️ Tech Stack

| Component | Technology |
|-----------|-----------|
| **Language** | Java 11+ |
| **GUI** | Swing/JavaFX |
| **Database** | MySQL/SQLite |
| **JDBC** | Database connectivity |

## 📋 Database Schema

**Products:**
- product_id, product_name, category, description

**Reviews:**
- review_id, product_id, user_id, rating, text, date

**Users:**
- user_id, username, email, password

## 🚀 Installation

```bash
git clone https://github.com/MuhammadAmirN/membuat-penilaian-review.git
cd review-system
javac -cp src src/**/*.java
java -cp src Main
```

## 🎯 Features

- Browse products with reviews
- Submit new reviews with rating
- View review statistics
- Filter by rating
- User comment moderation
- Admin dashboard
- Rating analytics

## 🎓 OOP Concepts Demonstrated

✅ Encapsulation (private fields, public getters)  
✅ Inheritance (base entity classes)  
✅ Polymorphism (interface implementation)  
✅ Abstraction (abstract classes)  

## 📞 Contact

GitHub: [membuat-penilaian-review](https://github.com/MuhammadAmirN/membuat-penilaian-review)  
Email: muhamir6n@gmail.com

---

**Author:** Muhammad Amir Nurudin | **License:** MIT
