<?php include "dao.php"; ?>
<?php
    $miRNA_key = $_GET['mirna_key'];
    $org = $_GET['organism'];  
    // echo "miRNA_key: " . $miRNA_key . "<br>";
    // Get miRNA_id from mirna table
    $query = "SELECT mirna_id FROM mirna WHERE mirna_key = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $miRNA_key);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $mirna_id = $row['mirna_id'];
    // echo "mirna_id: " . $mirna_id . "<br>";
    // Get corresponding rows from linking table
    $query = "SELECT * FROM linking WHERE mirna_id = ? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $mirna_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        //  add a new property to the row
        //  $row['more_detail'] = $num;
        $data[] = $row;
        
    }

    echo json_encode($data);
?>