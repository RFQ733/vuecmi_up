<?php include 'dao.php'; ?>
<?php
    // $sql = "SELECT mirna_id,mirna_key FROM linking WHERE organism = " . $_GET['organism'];
    $sql = "SELECT l.mirna_id, m.mirna_key 
        FROM linking l 
        JOIN mirna m ON l.mirna_id = m.mirna_id 
        WHERE l.organism = " . $_GET['organism'];
    $result = $conn->query($sql);
    
    $all_ans = array() ;
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $all_ans[] = [
                "title" => $row["mirna_id"],
                "id" => $row["mirna_key"]
            ];
        }
    } else {
        // echo "0 results";
    }
    $conn->close();
    
    header('Content-Type: application/json');
    echo json_encode($all_ans);
?>