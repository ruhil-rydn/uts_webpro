// Test sederhana di file terpisah (test_mail.php)
<?php
$to = "email_anda@gmail.com";
$subject = "Test Email";
$message = "Ini test email dari localhost";
$headers = "From: kaniyano0104@gmail.com";

if(mail($to, $subject, $message, $headers)) {
    echo "✅ Email terkirim!";
} else {
    echo "❌ Email gagal";
}
?>