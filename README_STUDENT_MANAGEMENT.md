# 👨‍🎓 Manajemen Data Mahasiswa (Flask)

Aplikasi manajemen data mahasiswa berbasis **Python Flask** dengan database **SQLite**. CRUD operations lengkap untuk input, edit, delete, dan laporan data mahasiswa.

## ✨ Features

✅ Input data mahasiswa (NIM, nama, program studi)  
✅ View all students dalam tabel  
✅ Edit data mahasiswa  
✅ Delete student records  
✅ Search & filter functionality  
✅ Export reports (PDF/Excel)  
✅ Simple & clean UI  
✅ Form validation  
✅ Database persistence  

## 🛠️ Tech Stack

| Component | Technology |
|-----------|-----------|
| **Backend** | Python 3.9+, Flask |
| **Frontend** | HTML5, CSS3, Bootstrap 5 |
| **Database** | SQLite |
| **Additional** | SQLAlchemy ORM |

## 📋 Requirements

```
Python 3.9+
Flask
Flask-SQLAlchemy
WTForms
```

## 🚀 Installation

```bash
git clone https://github.com/MuhammadAmirN/MANAJEMEN-DATA-MAHASISWA-MENGGUNAKAN-FLASK-DAN-SQlite.git
cd manajemen-mahasiswa

# Create virtual environment
python -m venv venv
source venv/bin/activate  # Windows: venv\Scripts\activate

# Install dependencies
pip install -r requirements.txt

# Run application
python app.py
```

Access: http://localhost:5000

## 📊 Database Schema

### Mahasiswa Table
```
- id (Primary Key)
- nim (Unique Student ID)
- nama (Student Name)
- program_studi (Major/Program)
- tahun_angkatan (Enrollment Year)
- email
- phone
- created_at (Timestamp)
```

## 📁 Project Structure

```
manajemen-mahasiswa/
├── app.py              # Main application
├── models.py           # Database models
├── routes.py           # URL routes
├── templates/
│   ├── base.html
│   ├── index.html
│   ├── add.html
│   ├── edit.html
│   └── view.html
├── static/
│   └── css/
├── database.sqlite     # SQLite database
├── requirements.txt
└── README.md
```

## 🎯 CRUD Operations

**Create:**
- Click "Add Student"
- Fill form
- Submit
- Auto validation

**Read:**
- View all students in dashboard
- Search by NIM/name
- Filter by program

**Update:**
- Click edit icon
- Modify data
- Submit changes

**Delete:**
- Click delete button
- Confirm deletion
- Record removed from database

## 📋 Features

**Dashboard:**
- Total students count
- Quick stats
- Recent entries
- Search bar

**Student Form:**
- Auto-validation
- Error messages
- Success notifications
- Form reset option

**Table View:**
- Sortable columns
- Pagination
- Action buttons (Edit/Delete)
- Export option

## 🔒 Features

- Input validation
- Error handling
- Data persistence
- Responsive design
- User-friendly interface

## 🚀 Deployment

Simple Flask deployment:
- Heroku
- PythonAnywhere
- Railway
- Any Python hosting

## 📊 Usage Example

```python
from app import app, db, Mahasiswa

with app.app_context():
    # Create
    mahasiswa = Mahasiswa(
        nim='2023001',
        nama='Amir Nurudin',
        program_studi='Teknik Informatika'
    )
    db.session.add(mahasiswa)
    db.session.commit()
    
    # Read
    all_students = Mahasiswa.query.all()
    
    # Update
    student = Mahasiswa.query.get(1)
    student.nama = 'New Name'
    db.session.commit()
    
    # Delete
    db.session.delete(student)
    db.session.commit()
```

## 📱 Responsive Design

Works on:
- Desktop computers
- Tablets
- Mobile phones
- All modern browsers

## 📞 Support

GitHub: [MANAJEMEN-DATA-MAHASISWA-MENGGUNAKAN-FLASK-DAN-SQlite](https://github.com/MuhammadAmirN/MANAJEMEN-DATA-MAHASISWA-MENGGUNAKAN-FLASK-DAN-SQlite)
Email: muhamir6n@gmail.com

---

**Author:** Muhammad Amir Nurudin  
**License:** MIT  
**Status:** Complete & Production-ready
