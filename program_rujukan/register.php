<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $referral_code = $_POST['referral_code'];

    // Generate a unique referral code for the new user
    $user_referral_code = uniqid();

    // Check if referral code is valid
    $referrer_id = null;
    if ($referral_code) {
        $referrer_query = "SELECT user_id FROM Users WHERE referral_code='$referral_code'";
        $referrer_result = $conn->query($referrer_query);
        if ($referrer_result->num_rows > 0) {
            $referrer_id = $referrer_result->fetch_assoc()['user_id'];
        } else {
            die("Kode rujukan tidak valid.");
        }
    }

    // Insert new user into Users table
    $insert_user = "INSERT INTO Users (name, email, referral_code) VALUES ('$name', '$email', '$user_referral_code')";
    if ($conn->query($insert_user) === TRUE) {
        $new_user_id = $conn->insert_id;

        // If referred, insert into Referrals table and update points
        if ($referrer_id) {
            $insert_referral = "INSERT INTO Referrals (referrer_id, referred_id, status) VALUES ('$referrer_id', '$new_user_id', 'completed')";
            $conn->query($insert_referral);

            // Update points for referrer and new user
            $update_points = "UPDATE Users SET points = points + 50 WHERE user_id IN ('$referrer_id', '$new_user_id')";
            $conn->query($update_points);
        }

        echo "Pendaftaran berhasil. Kode rujukan Anda: <br> " . $user_referral_code;
        // link untuk ke halaman points
        echo '<a href="points.php">Points</a>';
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
