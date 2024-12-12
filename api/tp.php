<?php include 'dao.php'; ?>
<?php
    $sql = "SELECT mirna_id FROM linking";
    $result = $conn->query($sql);
    
    $all_ans = array() ;
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $all_ans[] = $row["mirna_id"];
        }
    } else {
        // echo "0 results";
    }
    $all_ans = array_unique($all_ans);
    // $conn->close();
    
    // header('Content-Type: application/json');

    // echo $all_ans;
    // echo json_encode($all_ans);
    foreach ($all_ans as $key => $value) {
        // echo $value;
        $sql = "insert into mirna (mirna_id) values ('$value')";
        $conn->query($sql);
        echo $sql ;
        echo $conn->error;
        // break ;
    }