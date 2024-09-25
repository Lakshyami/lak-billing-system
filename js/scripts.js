$(document).ready(function() {
  $('#productForm').on('submit', function(e) {
    e.preventDefault();
    let productName = $('#product_name').val();
    let quantity = $('#product_quantity').val();
    let price = $('#price_per_item').val();

    $.ajax({
      url: 'calculate.php',
      type: 'POST',
      data: {productName, quantity, price},
      dataType: 'json',
      success: function(response) {
        if(response.success) {
          let newRow = `<tr>
                          <td>${response.productName}</td>
                          <td>${response.quantity}</td>
                          <td>${response.price}</td>
                          <td>${response.datetime}</td>
                          <td>${response.totalValue}</td>
                        </tr>`;
          $('#dataRows').append(newRow);
          calculateTotal();
        }
      }
    });
  });

  function calculateTotal() {
    let total = 0;
    $('#dataRows tr').each(function() {
      let totalValue = parseFloat($(this).find('td').eq(4).text());
      total += totalValue;
    });
    $('#total').text(total.toFixed(2));
  }
});

