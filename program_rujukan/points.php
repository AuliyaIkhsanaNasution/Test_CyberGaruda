<?php
include 'db.php';

$query = "SELECT * FROM users";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Points</title>
    <!-- Tambahkan link CDN Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">User Points Table</h1>
        <!-- Tabel yang diambil dari db untuk menampilkan point -->
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">No</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Referral Code</th>
                    <th class="py-2 px-4 border-b">Points</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = $result->fetch_assoc()) { ?>
                    <tr class="text-center">
                        <td class="py-2 px-4 border-b"><?= $no++ ?></td>
                        <td class="py-2 px-4 border-b"><?= $row['name'] ?></td>
                        <td class="py-2 px-4 border-b"><?= $row['email'] ?></td>
                        <td class="py-2 px-4 border-b"><?= $row['referral_code'] ?></td>
                        <td class="py-2 px-4 border-b"><?= $row['points'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>