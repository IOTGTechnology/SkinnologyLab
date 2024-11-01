<?php
// Proses pengiriman formulir kontak
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST["message"]));

    // Validasi data
    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Mohon isi semua kolom dengan benar.";
        exit;
    }

    // Set penerima dan subjek email
    $to = "internetofthingsindonesiagreen@gmail.com";  // Ganti dengan alamat email Anda
    $subject = "Pesan Kontak dari " . $name;

    // Isi email
    $email_content = "Nama: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Pesan:\n$message\n";

    // Header email untuk detail pengirim
    $email_headers = "From: $name <$email>";

    // Pengiriman email
    if (mail($to, $subject, $email_content, $email_headers)) {
        echo "Terima kasih! Pesan Anda telah terkirim.";
    } else {
        echo "Maaf, terjadi masalah saat mengirim pesan. Silakan coba lagi.";
    }
} else {
    // Pengalihan ke halaman utama jika file diakses langsung
    header("Location: index.html");
    exit;
}
?>