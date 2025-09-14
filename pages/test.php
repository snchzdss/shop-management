<?php
    $data = ["name" => "Dessa", "age" => 24];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <script>
    let data = <?php echo json_encode($data)?>;
    console.log(data);
</script>
</body>
</html>