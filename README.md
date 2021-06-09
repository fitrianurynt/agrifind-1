# AGRIFIND
<p>Aplikasi berbasis web untuk mencari dan menemukan mahasiswa IPB yang memiliki kemampuan khusus berdasarkan kategori departemen dan fakultas untuk membuat suatu projek.</p>

# ANGGOTA KELOMPOK
<ol>
	<li>Annisa Dwi Quintho 		G64190006</li>
	<li>Imaduddin Abdurrahman	G64190023</li>
	<li>Fitria Nuryantika		G64190058</li>
	<li>Abdul Hakim			G64190078</li>
</ol>

# LATAR BELAKANG
<p>Teknologi Informasi adalah suatu teknologi yang digunakan untuk mengolah data,
termasuk memproses, mendapatkan, menyusun, menyimpan, memanipulasi data dalam berbagai
cara untuk menghasilkan informasi yang berkualitas, yaitu informasi yang relevan, akurat dan
tepat waktu, yang digunakan untuk keperluan pribadi, bisnis, dan pemerintahan dan merupakan
informasi yang strategis untuk pengambilan keputusan (Wardiana 2002).
Saat ini, teknologi berkembang dengan sangat pesat sehingga menyebabkan banyak
orang memanfaatkan teknologi dalam berbagai bidang kehidupan salah satunya dalam
pemanfaatan sumber daya manusia. Sekarang, orang-orang dapat lebih mudah untuk mencari
pekerjaan atau sebaliknya perusahaan dapat lebih mudah untuk merekrut seseorang dengan profil
yang terlampir. Namun, pada mahasiswa, terdapat sedikit kesulitan dalam mencari teman atau
kelompok belajar yang memiliki kriteria tertentu. Seperti misalnya mencari teman untuk pkm,
membuat kelompok belajar, maupun ajakan untuk mengikuti proyekan. Solusi yang dapat
ditawarkan yaitu dengan membuat aplikasi berbasis web yang dapat mempermudah mahasiswa
dalam mengatasi hal tersebut. Sehingga pemanfaatan sumberdaya manusia di bidang teknologi
tidak hanya dalam mencari pekerjaan di perusahaan namun juga bisa digunakan di dalam lingkup
kampus.
Agri-Find hadir untuk menyelesaikan permasalahan ini. Bagaimana mahasiswa IPB dapat
memenuhi kebutuhan akan mendapatkan teman yang memiliki kemampuan untuk melengkapi
projek maupun kebutuhan anggota kelompoknya. Memudahkan orang-orang untuk saling
melengkapi satu sama lain ketika ingin membuat suatu hal. Harapannya apa yang kami buat ini
dapat membantu menyelesaikan permasalahan yang terjadi di lingkungan kami.</p>

# TUJUAN
1. Memudahkan mahasiswa untuk menemukan orang yang memiliki kemampuan dalam
bidang tertentu.
2. Sebagai wadah untuk memperlihatkan keahlian yang dimiliki.
3. Menambah relasi dan koneksi baru antar mahasiswa.

# RUANG LINGKUP
1. Mahasiswa IPB University yang jarang menggunakan website harus terbiasa karena belum ada versi Mobile Appsnya

# DESKRIPSI APLIKASI
<p>Agri-Find merupakan aplikasi berbasis web yang berfungsi untuk mencari dan
menemukan mahasiswa IPB yang memiliki kemampuan yang sesuai dalam menjalankan suatu
proyek. Web ini juga menampilkan kategori-kategori berdasarkan angkatan dan departemen
untuk mempermudah dalam menentukan kriteria diinginkan. Pada Agri-Find akan dilampirkan
identitas diri serta kemampuan yang dimiliki untuk mendapatkan rekan yang sesuai. Juga
terdapat fitur pencarian tersaring serta fitur chat.

# USER ANALYSIS
<ul>
	<li> Sebagai seorang mahasiswa, saya ingin menyalurakan kreatifitas saya dengan membuat proyek bersama-sama.
	<li> Sebagai seorang manusia, saya ingin bersosialisasi dan menyelesaikan suatu hal bersama-sama.
	<li> Sebagai seorang individu, saya ingin memiliki teman yang bisa membantu saya merealisasikan ide saya.
</ul>

# SPESIFIKASI ENVIRONMENT
Hardware   : <ul>
	    	 <li>Processor : Intel Core i5-8250 Core Clock 1.8 GHz
	    	 <li>Memory : 12 GB DDR4
	     	 <li>Graphics Card : NVIDIA GeForce GTX 1050
   	    	 <li>Storage : 1 TB HDD + 256 GB SSD
	     </ul>
	     
Software   : <ul>
	     	<li>OS : WIndows 10
	     	<li>Browser : Chrome, Firefox, Edge
		<li>Visual Studio Code
	     	<li>Sublime Text
	     </ul>
	     
Tech Stack : <ul>
	     	<li>Figma
	     	<li>Trello
	      	<li>MySql
	      	<li>PHP
	        <li>Laravel
		<li>Apache
	     </ul>

# HASIL DAN PEMBAHASAN

## A. USE CASE DIAGRAM
![USE CASE DIAGRAM-USE CASE DIAGRAM](https://user-images.githubusercontent.com/63392797/121227947-bde25400-c8be-11eb-98bf-007ce8314367.png)
## B. ACTIVITY DIAGRAM
![AgriFind-User Flow](https://user-images.githubusercontent.com/63392797/121228192-0732a380-c8bf-11eb-8619-46211a1d0559.png)

<p>Membuat Akun</p>

![RPL-LOGIN](https://user-images.githubusercontent.com/63392797/121229886-1c103680-c8c1-11eb-83ce-e02c87ee187d.png)

<p>Melihat dan Mengedit Profile</p>

![RPL-Page-4](https://user-images.githubusercontent.com/63392797/121232983-ba51cb80-c8c4-11eb-9dda-68285570ef70.png)

<Melihat Profile orang lain</p>

![RPL-Page-5](https://user-images.githubusercontent.com/63392797/121237257-701f1900-c8c9-11eb-9329-e5570f58f2db.png)

<p>Mengirim Pesan ke orang lain</p>

![RPL-Page-6](https://user-images.githubusercontent.com/63392797/121238298-87aad180-c8ca-11eb-8dbf-9d2c17dff141.png)


## C. CLASS DIAGRAM
## D. ERD
![ERD RPL](https://user-images.githubusercontent.com/63392797/121227882-a905c080-c8be-11eb-86e2-93deda8a8d62.png)
## E. ARSITEKTUR

## F. CRUD
<ul>
	<li>CREATE
		<ol> <li> Membuat akun pada web AgriFind </li></ol>
	<li>READ
		<ol> 	<li> Membaca email dan password akun User pada saat login</li>
			<li>Menampilkan Skill dan Achievement User </li></ol>
	<li>UPDATE
		<ol>	<li> Mengubah password </li>
			<li> Mengubah informasi akun atau info kontak </li>
			<li>Menambah achievement dan skill </li> </ol>
	<li>DELETE
		<ol>	<li> Menghapus akun </li> </ol>
</ul>

# HASIL IMPLEMENTASI

# TESTING

# OUR JOURNAL
## TRELLO
![AgriFind _ Trello - Google Chrome 09_06_2021 01_41_46 (2)](https://user-images.githubusercontent.com/63392797/121232399-254ed280-c8c4-11eb-9b1c-e17e3438b272.png)
## G-SITES
![Screenshot (218)](https://user-images.githubusercontent.com/79956203/121248117-3d771f80-c8cd-11eb-9c09-cda0b3b3fddb.png)
# SARAN
# PENUTUP
Puji Syukur kepada Allah SWT atas segala rahmat yang diberikan sehingga kelompok kami dapat menyelesaikan tugas project praktium dari Mata Kuliah Rekayasa Perangkat Lunak Departemen Ilmu Komputer IPB University. Dalam project ini, kami belajar banyak hal-hal baru dalam bidang software engineering, mulai dari task management, user analisis, stakeholder, time managament dan sebagainya. Kelompok kami ingin mengucapkan terimakasih kepada Para dosen mata kuliah RPL beserta asisten praktikum atas ilmu yang sudah diberikan sehingga kami dapat menyelesaikan project aplikasi web ini dengan sebaik mungkin.
