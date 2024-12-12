<?php include 'dao.php'; ?>
<?php
    // 从 POST 请求中获取 JSON 格式的数据
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $miRNA_name = $data->mirna;
    $circRNA_name = $data->circrna;

    // 初始化查询和参数数组
    $query = "SELECT * FROM linking WHERE 1=1";
    $params = array();
    $types = "";

    // 根据 miRNA_name 是否为空添加查询条件
    if (!empty($miRNA_name)) {
        $query .= " AND mirna_id = ?";
        $params[] = $miRNA_name;
        $types .= "s";
    }

    // 根据 circRNA_name 是否为空添加查询条件
    if (!empty($circRNA_name)) {
        $query .= " AND circrna_id = ?";
        $params[] = $circRNA_name;
        $types .= "s";
    }

    // 准备和执行查询
    $stmt = $conn->prepare($query);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $datax = [];
    while ($row = $result->fetch_assoc()) {
        //  add a new property to the row
        //  $row['more_detail'] = $num;
        $datax[] = $row;
        
    }
    echo json_encode($datax);
?>