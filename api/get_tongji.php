<?php include "dao.php"; ?>
<?php
    $query = "SELECT 
                COUNT(*) as total,
                COUNT(DISTINCT circrna_id) as circrna_count,
                COUNT(DISTINCT mirna_id) as mirna_count,
                COUNT(DISTINCT organism) as organism_count,
                COUNT(DISTINCT disease) as disease_count,
                COUNT(DISTINCT mrna) as mrna_count,
                COUNT(DISTINCT gene) as gene_count,
                COUNT(DISTINCT virus_name) as virus_name_count,
                COUNT(DISTINCT tissue_cells) as tissue_cells_count,
                COUNT(DISTINCT experiment) as experiment_count
              FROM linking WHERE organism = ?";
    $stmt = $conn->prepare($query);
    
    $organism = $_GET['organism'];
    
    $stmt->bind_param("s", $organism);

    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $data["num_count"] = $data["total"];
    $data["organism"] = $organism;
    echo json_encode($data);
    // <!--     ('Rattus'),
//     ('Rattus norvegicus'),
//     ('Bos taurus'),
//     ('Homo sapiens'),
//     ('Anas platyrhynchos'),
//     ('Ovine'),
//     ('Mus musculus'),
//     ('Ovis aries'),
//     ('Capra hircus'),
//     ('Danio rerio'),
//     ('Teleost fish'),
//     ('Homo sapiens'),
//     ('Capra aegagrus'),
//     ('Gallus gallus');
//  -->
?>
