import json
with open('repos.json', 'r', encoding='utf-8') as f:
    repos = json.load(f)
for r in repos:
    if r['name'] in ['NFA_DASHBOARD', 'PEMESANAN_TIKET_BOLA', 'RESERVASI_CAFE', 'MANAJEMEN-DATA-MAHASISWA-MENGGUNAKAN-FLASK-DAN-SQLITE']:
        print(f"Name: {r['name']}")
        print(f"Language: {r['language']}")
        print(f"Desc: {r['description']}\n")
