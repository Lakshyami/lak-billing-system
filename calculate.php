<?php
/**
 * Get the submitted data, calculate bill, pass the response.
 * @param NULL
 * @return string
 */
function calculateTotal() {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName = $_POST['productName'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $datetime = date('Y-m-d H:i:s');
    $totalValue = $quantity * $price;

    $data = [
        'productName' => $productName,
        'quantity' => $quantity,
        'price' => $price,
        'datetime' => $datetime,
        'totalValue' => $totalValue
    ];

    $jsonData = file_get_contents('data.json');
    $jsonArray = json_decode($jsonData, true);
    $jsonArray[] = $data;
    file_put_contents('data.json', json_encode($jsonArray));

    echo json_encode([
        'success' => true,
        'productName' => $productName,
        'quantity' => $quantity,
        'price' => $price,
        'datetime' => $datetime,
        'totalValue' => $totalValue
    ]);

  } else {
    echo "Something wrong!";
  }
}


try {
  calculateTotal();
}
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
?>

