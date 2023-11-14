Blog Case Study Çalışması
Kurulum Adımları
composer install komutunu çalıştırın.
.env dosyasını oluşturun. (.env.example dosyasını çoğaltabilirsiniz.)
php artisan key:generate komutunu çalıştırın.
Bir veritabanı oluşturun.
.env veritabanı konfigürasyonunu yapın. Aşağıdaki ayarları kullanabilirsiniz.
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=blogcasestudy
DB_USERNAME=root
DB_PASSWORD=12345678
php artisan migrate ve php artisan db:seed komutlarını çalıştırın ya da proje ana dizininde bulunan blogcasestudy.sql dosyasını import edin.
