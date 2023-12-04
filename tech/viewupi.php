<?php
ob_start();
session_start();
require_once 'config/connect.php';
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('location: login.php');
}

include 'inc/header.php';
include 'inc/nav.php';

// Retrieve data from the ewaste table where the status is 111
$sql = "SELECT * FROM ewaste WHERE status = '555'";
$res = mysqli_query($connection, $sql);
?>

<html>
<head>
    <!-- Include SweetAlert script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <br><br><br><table class=table>
        <tr>
            <th>Customer email-id</th>
            <th>Device Description</th>
            <th>Amount</th>
            <th>Mobile</th>
            <th>UPI Id</th>
            <th>Status</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<tr>";
            echo "<td>{$row['u_id']}</td>";
            echo "<td>{$row['description']}</td>";
            echo "<td>{$row['userprice']}</td>";
            echo "<td>{$row['mob']}</td>";
            echo "<td>{$row['upi']}</td>";

            echo "<td>
                <form action='acceptupi.php' method='post'>
                    <input type='hidden' name='id' value={$row['id']}>

<button type='button' class='btn btn-success' onclick='confirmPayment(" . $row['userprice'] . ", \"" . $row['upi'] . "\", " . $row['id'] . ")'>Pay</button>




                </form><br>

                <form action='rejectupi.php' method='post'>
                    <input type='hidden' name='id' value={$row['id']}>
                    <button type='submit' class='btn btn-danger'>Cancel</button>
                </form>
            </td>";

            echo "</tr>";
        }
        ?>
    </table>

    <script>
       function confirmPayment(userprice, upi, productId) {
    Swal.fire({
        title: `Are you sure you want to pay Rs ${userprice} to ${upi}?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Pay',
    }).then((result) => {
        if (result.isConfirmed) {
            // Create a hidden form and submit it
            const form = document.createElement('form');
            form.method = 'post';
            form.action = 'acceptupi.php';

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'id';
            input.value = productId;

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    });
}

    </script>
</body>
</html>
