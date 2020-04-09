cd toproject
git clone https://github.com/silvesterwali/elganstiki.git
cd elganstiki

composer install

npm install

cp .env.example
copy .env.example menjadi .env lalu ubah nama database sesuai dengan database
----sseting koneksi data table--

php artisan key:generate

php artisan migrate:refresh --seed
###npm run dev....jika menggunkan npm

php artisan serve ----untuk jalankan server

menyimpan ke git
-git add .
-git commit -m "komentar anda disini"
-git push origin master

menarik data dari github
-pull origin master

check status
-git status
