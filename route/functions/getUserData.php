<?php

include "../../connection/database.php";

if(isset($_POST['id'])) {
    $userId = mysqli_real_escape_string($conn, $_POST['id']);

    $selectSql = "SELECT * FROM tbl_user_management WHERE user_management_id = '$userId'";

    $result = mysqli_query($conn, $selectSql);

    if($result) {
        $userData = mysqli_fetch_assoc($result);


        echo json_encode($userData);

        $insertSql = "INSERT INTO tbl_user_archive (user_management_id, firstname, middleinitial, lastname, username, password, user_role, position)
                        VALUES ('".$userData['user_management_id']."', '".$userData['firstname']."', '".$userData['middleinitial']."', '".$userData['lastname']."', '".$userData['username']."', '".$userData['password']."', '".$userData['user_role']."', '".$userData['position']."')";

echo "INSERT INTO tbl_user_archive (user_management_id, firstname, middleinitial, lastname, username, password, user_role, position)
VALUES ('".$userData['user_management_id']."', '".$userData['firstname']."', '".$userData['middleinitial']."', '".$userData['lastname']."', '".$userData['username']."', '".$userData['password']."', '".$userData['user_role']."', '".$userData['position']."')";
        $insertResult = mysqli_query($conn, $insertSql);

        if($insertResult) {
            echo json_encode(['success' => 'Data inserted successfully into tbl_archive_user']);
        } else {
            echo json_encode(['error' => 'Failed to insert data into tbl_archive_user']);
        }
    } else {
        echo json_encode(['error' => 'Failed to retrieve user data from tbl_user_management']);
    }
} else {
    echo json_encode(['error' => 'User ID parameter not provided']);
}

mysqli_close($conn);
?>
