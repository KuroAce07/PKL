Langkah-langkah untuk menginstall aplikasi
1. Install composer 
```bash
composer install / composer update
```
2 Install NPM Dependencies
```bash
npm install && npm run dev
```
3. Buat file .env dan ganti nama db
```bash
cp .env.example .env
```

4. Generate Application key

```bash
php artisan key:generate
```

5. Run migration seed untuk mendapatkan admin dan role
```bash
php artisan migrate --seed
```

6. Login Admin
```bash
Username - admin@admin.com
Password - Admin@123#
```

7. add ini di .env untuk Bot WA (security token didapat dari webnya dan domain servernya)
SECURITY_TOKEN_WABLAS=d9No4d296O16A0kJZiCXfJqPWKPt4yrHD6w0qvWPhhm2gIWy9RxPaeYxtTDXGB6V
DOMAIN_SERVER_WABLAS=https://solo.wablas.com


