<? include 'dao.php'; ?>
<?php
        $num = $_GET['num'];
        
        $sql = "SELECT * FROM linking WHERE num = ?" ;
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $num);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_assoc();
        echo json_encode($rows);

?>