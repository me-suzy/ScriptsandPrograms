<?
//
// Indonesian Language File for G-Shout version 1.3.1
//
// Made by donie <donie@gravitasi.com>
// last updated : 4 Februari 2005

define("_CHARSET","ISO-8859-1");
define("_YES","Ya");
define("_NO","Tidak");
define("_PAGE","Halaman");
define("_UNWRITEABLE","Ada file yang tidak writeable. Tolong baca README file terlebih dahulu.");

// days
define("_SUNDAY","Minggu");
define("_MONDAY","Senin");
define("_TUESDAY","Selasa");;
define("_WEDNESDAY","Rabu");
define("_THURSDAY","Kamis");
define("_FRIDAY","Jumat");;
define("_SATURDAY","Sabtu");

// months
define("_JANUARY","Januari");
define("_FEBRUARY","Februari");
define("_MARCH","Maret");;
define("_APRIL","April");
define("_MAY","Mei");
define("_JUNE","Juni");;
define("_JULY","Juli");
define("_AUGUST","Agustus");
define("_SEPTEMBER","September");
define("_OCTOBER","Oktober");
define("_NOVEMBER","November");
define("_DECEMBER","Desember");

// front page side
define("_PLEASE_WAIT","Silakan tunggu ".$floodwait." menit dan kirim ulang pesan anda.");
define("_CLOSE_WINDOW","Tutup window");
define("_REPLIED_ON","Terbalas");
define("_SHOUTED_ON","Dikirim");
define("_PROCESS_DELETED","Shout sukses dihapus");

//prevent users submit these values
define("_DEFAULT_NAME","Nama");
define("_DEFAULT_URI","Web/Email");
define("_DEFAULT_MESSAGE","Pesan");

// admin panel side
define("_CONTROL_PANEL","Control Panel");
define("_EDIT_SHOUT_ENTRIES","Edit Shout");
define("_MY_WEBSITE","Website Saya");
define("_CURRENT_TIME","Waktu Sekarang");
define("_MANUAL","Petunjuk");
define("_LOGIN","Login");
define("_ADMIN_LOGIN","Admin Login");
define("_FORGOT_PASSWORD","Lupa Password");
define("_LOGOUT","Log-out");
define("_ID","ID");
define("_EDIT","Edit");
define("_DELETE","Hapus");
define("_CONFIGURATION","Konfigurasi");
define("_EDIT_CONFIGURATION","Edit Konfigurasi");
define("_EDIT_SHOUT","Edit Shout");
define("_EDIT_SHOUTS","Edit Shout");
define("_DATE","Tanggal");
define("_REPLYDATE","Tanggal Balasan");
define("_REPLY","Balasan");
define("_ADMINISTRATION","Administrasi");
define("_DISPLAYING","Menampilkan");
define("_RESULTS","");
define("_SHOUTS","Shout");
define("_MESSAGE","Message");
define("_NAME","Nama");
define("_SEX","Jenis Kelamin (L/P)");
define("_M","L");
define("_F","P");
define("_IP_ADDRESS","ALamat IP");
define("_WEB_EMAIL","Web / Email");
define("_PASSWORD","Password");
define("_FORGOT_PASSWORD","Lupa password anda?");
define("_SUBMIT_EMAIL","Masukkan alamat email");
define("_RETURN_TO_LOGIN","Kembali ke Login");
define("_RETURN_TO_FORGOT","Kembali ke Lupa Password");
define("_OR","Atau");
define("_ANSWER_THIS","Jawab pertanyaan ini");
define("_DISPLAYING_PAGE","Menampilkan halaman");
define("_OF","dari");
define("_TOTAL","Total");
define("_FROM_MAXIMAL","dari maksimal");
define("_LAST_SHOUTS","shout terakhir");
define("_MALE","pria");
define("_FEMALE","wanita");
define("_SHOUTS_PER_PAGE","Shout per halaman");
define("_UPDATE","update");
define("_PAGE_GENERATED_IN","Halaman dibuat dalam");
define("_SECONDS","detik");
define("_ARE_YOU_SURE","Anda yakin ingin menghapusnya?\\n  \'OK\' untuk hapus, \'Cancel\' untuk membatalkan .");


//LOGS
define("_VIEW_LOGS","Lihat Log");
define("_ACTION","Aksi");
define("_LOG_UNWRITABLE","<br />./logs/logs.php tidak ada atau tidak writeable, silakan ganti permisinya ke writeable.<br />Dari SSH anda bisa ketik perintah: chmod ugo+w logs.php<br />or<br />chmod 0666 logs.php (ini membuat file menjadi writeable and readable untuk semua -rw-rw-rw-)<br /><br />atau anda bisa lakukan melalui FTP clients (CuteFTP, LeapFTP, SmartFTP, WS_FTP), silakan baca dokumen petunjuknya.");
define("_LAST_LOGS","log terakhir");
// inside .log file
define("_LOG_LOGIN_SUCCESS","Login Sukses");
define("_LOG_LOGIN_FAIL","Login Gagal");
define("_LOG_LOGOUT","Logout");
define("_LOG_CHANGE_PASS","Password Terganti");
define("_LOG_RIGHT_SECRET_ANSWER","Jawaban Rahasia BENAR");
define("_LOG_WRONG_SECRET_ANSWER","Jawaban Rahasia SALAH");
define("_LOG_LOGIN_EXPIRED","Login Kadaluwarsa");


//MESSAGES
define("_EMAIL_SUBJECT","[G-Shout] Anda mendapat pesan dari ".$name." pada G-Shout Box anda!");
define("_CONF_UPDATED","Konfigurasi ter-update");
define("_PASSWORDS_UNMATCH","Password dan password konfirmasi tidak cocok");
define("_MUST_ENTER_CURRENT_PASSWORD","Anda harus memasukkan password saat ini untuk meng-update halaman ini");
define("_INCORRECT_CURRENT_PASSWORD","Anda harus memasukkan password saat ini dengan benar untuk meng-update halaman ini");
define("_SHOUT_DELETED","Shout sukses terhapus");
define("_SHOUTS_DELETED","Shout-shout tersebut sukses terhapus");
define("_PROCESS_DELETEFAILED","Proses Penghapusan Gagal");
define("_SHOUT_UPDATED","Shout ter-Update");
define("_ERROR_EMPTY","Ada isian yang kosong");
define("_ERROR_NAME","Masukkan nama / nickname anda");
define("_ERROR_SEX","Pilih jenis kelamin");
define("_ERROR_URI","Masukkan Web / alamat Email yang valid");
define("_ERROR_MESSAGE","Ayolah, katakan sesuatu!");
define("_ERROR_WRITE_DATA","Tak dapat menulis ke dalam file $datafile, tolong ganti permisinya ke writeable");
define("_ERROR_WRITE_CONF","Tak dapat menulis ke dalam file config.php, tolong ganti permisinya ke writeable");
define("_ERROR_WRITE_CONF","Tak dapat menulis ke dalam file $logfile, tolong ganti permisinya ke writeable");
define("_DATA_UNWRITABLE","<br />$datafile tidak ada atau tidak writeable, tolong ganti permisinya ke writeable.<br />From SSH you can type: chmod ugo+w $datafile<br />atau<br />chmod 0666 $datafile (ini membuat file menjadi writeable and readable untuk semua -rw-rw-rw-)<br /><br />atau anda bisa lakukan melalui FTP clients (CuteFTP, LeapFTP, SmartFTP, WS_FTP), silakan baca dokumen petunjuknya.");
define("_CONF_UNWRITABLE","<br />config.php tidak ada atau tidak writeable, tolong ganti permisinya ke writeable.<br />From SSH you can type: chmod ugo+w config.php<br />atau<br />chmod 0666 config.php (ini membuat file menjadi writeable and readable untuk semua -rw-rw-rw-)<br /><br />atau anda bisa lakukan melalui FTP clients (CuteFTP, LeapFTP, SmartFTP, WS_FTP), silakan baca dokumen petunjuknya.");
define("_YOUR_PASSWORD_IS","Password Anda adalah");
define("_YOUR_PASSWORD","Password Anda");
define("_RELOGIN","Login kadaluwarsa, silakan Login kembali");
define("_WRONG_PASS","Password salah, coba lagi");


//CONFIGURATION
define("_PREFERENCE","Parameter");
define("_VALUE","Nilai");
define("_NICKNAME","Nickname ditampilkan dan diprotek");
define("_NICKNAME_SUBTEXT","Nickname anda saat membalas pesan pada halaman depan dan orang lain ngga' bisa pake");
define("_WEBSITE","Website URL");
define("_WEBSITE_SUBTEXT","Masukkan alamat website anda sendiri");
define("_SKINS","Skins");
define("_SKINS_SUBTEXT","Pilihan tampilan untuk Control Panel");
define("_LANGUAGES","Bahasa");
define("_LANGUAGES_SUBTEXT","Pilihan bahasa");
define("_AMOUNT_OF_SHOUTS","Jumlah Shout");
define("_AMOUNT_OF_SHOUTS_SUBTEXT","Jumlah shout per halaman pada halaman depan");
define("_ALLOWED_TAGS","Tag HTML dibolehkan");
define("_ALLOWED_TAGS_SUBTEXT","Tag HTML yang dibolehkan untuk komentar. Silakan dikosongkan jika anda tidak membolehkan semua tag HTML.");
define("_MAXCHARS","Karakter Maksimal");
define("_MAXCHARS_SUBTEXT","Karakter maksimal untuk tiap shout. Silakan dikosongkan jika tidak ada batasan");
define("_KEEP","Keep the last ... shouts");
define("_KEEP_SUBTEXT","Biarkan ... shout terakhir. Shout sebelumnya akan otomatis terhapus. Isi dengan \"all\" jika anda ingin menyimpan semua shout");
define("_KEEP_LOGS","Biarkan ... log terakhir");
define("_KEEP_LOGS_SUBTEXT","Semua log sebelumnya akan otomatis terhapus. Isi dengan \"all\", jika anda ingin menyimpan semua log");
define("_AUTOLOGOUT","Auto Log-Out on idle (menit)");
define("_AUTOLOGOUT_SUBTEXT","Jika idle (tidak ada aktivitas) dalam sekian menit, akan otomatis ter-logout.");
define("_DELETE_TIME","Waktu Hapus (menit)");
define("_DELETE_TIME_SUBTEXT","Lama waktu user dapat menghapus pesan mereka sendiri pada halaman depan (dalam menit). Isi dengan 0 (angka 0) untuk tanpa penghapusan.");
define("_FLOOD_PROT","Proteksi Flood (menit)");
define("_FLOOD_PROT_SUBTEXT","Selang waktu bagi user untuk mengisi pesan berikutnya (dalam menit). Isi dengan 0 (angka 0) untuk tanpa flood protection.");
define("_TEXT_WRAPPING_WIDTH","Text Wrapping Width");
define("_TEXT_WRAPPING_WIDTH_SUBTEXT","Lebar dari text wrapping. Nilainya tergantung pada lebar font. Lebar dari 'A' tidak sama dengan 'i'. Coba periksa dengan menggunakan banyak A (AAAAAAAAA dst) sampai memenuhi ifram anda. Isi dengan \"0\" untuk menonaktifkannya.");
define("_WRAPPING_SEPARATOR","Pemisah Wrapping");
define("_WRAPPING_SEPARATOR_SUBTEXT","Karakter yang digunakan untuk memisah kata ter-wrap. '- ' berarti akan dipisah seperti ini: abcde- fghi. Dengan mengosongkannya ('') berarti menonaktifkan wordwrap. Gunakan ' ' (spasi) untuk text wrapping tanpa karakter..");
define("_URI_REQUIRED","Web/Email wajib diisi?");
define("_URI_REQUIRED_SUBTEXT","Haruskan pengunjung mengisi Web/Email?");
define("_USE_HTML_ENCODE","Gunakan HTML Encode");
define("_USE_HTML_ENCODE_SUBTEXT","Ini akan mengubah URL atau Email DALAM PESAN menjadi URL Link. Contoh: 'www.domainanda.com' akan dirubah menjadi <a href=\"http://www.domainanda.com\" target=\"_blank\" title=\"http://www.domainanda.com\">".$urltextreplacement."</a> and 'email@domainanda.com' akan dirubah menjadi <a href=\"mailto:email@domainanda.com\" target=\"_blank\" title=\"email@domainanda.com\">[MAIL]</a>.");
define("_SEND_TO_EMAIL","Kirim isian shout ke Email anda?");
define("_SEND_TO_EMAIL_SUBTEXT","Jika anda ingin menerima setiap pesan ditulis pada halaman depan lewat email, pilih YA.");
define("_EMAIL_ADDRESS","Alamat Email");
define("_EMAIL_ADDRESS_SUBTEXT","Email yang digunakan untuk menerima pesan shout.");
define("_DATE_FORMAT","Format Tanggal");
define("_DATE_FORMAT_SUBTEXT","Sintaks yang digunakan sama dengan <a href=\"http://www.php.net/date\" target=\"_blank\">PHP date() function</a>. Silakan update untuk melihat outputnya");
define("_OUTPUT","Output");
define("_TIMEZONE","Zona Waktu");
define("_GMT_IS","Waktu <acronym title='Greenwich Mean Time'>GMT</acronym> sekarang");
define("_SECRET_QUESTION","Pertanyaan Rahasia");
define("_SECRET_QUESTION_SUBTEXT","Pertanyaan rahasia untuk melihat password anda jika anda menggunakan fasilitas 'Lupa Password'.");
define("_SECRET_ANSWER","Jawaban Rahasia");
define("_SECRET_ANSWER_SUBTEXT","Jawaban rahasia untuk melihat password anda jika anda menggunakan fasilitas 'Lupa Password'. Usahakan hanya anda yang tahu jawabannya.");
define("_PASS_CHANGE_FORM","Form Ganti Password");
define("_LEAVE_BLANK","Biarkan kosong jika anda tidak ingin mengganti password saat ini");
define("_NEW_PASS","Password Baru");
define("_NEW_PASS_CONFIRM","Ketik ulang Password Baru anda");
define("_HAVE_LOG_BACK_IN","Catatan: Jika Anda mengganti password anda, maka anda harus log in kembali");
define("_EXISTING_PASS","Password Saat Ini");
define("_SUBMIT_CURRENT_PASS","Anda harus memasukkan password saat ini untuk meng-update halaman ini");



// I have not done to do all language system

?>