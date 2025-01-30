<?php
$page_title = 'Catalog';

include ('header.html');
require('connection.php');

echo '<h1>Catalog</h1>';

if (isset($_GET['s']) && is_numeric($_GET['s'])) {
  $start = $_GET['s'];
}
else
{
  $start = 0;
}

$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'item_id';

$order_by = 'item_id ASC';
switch ($sort)
{
  case 'item_id':
    $order_by = 'item_id ASC';
    break;
  case 'item_name':
    $order_by = 'item_name ASC';
    break;
  case 'item_price':
    $order_by = 'item_price ASC';
    break;
  case 'item_quantity':
    $order_by = 'item_quantity ASC';
    break;
  case 'item_desc':
    $order_by = 'item_quantity ASC';
    break;
}

$q = "SELECT * FROM catalog ORDER BY $order_by";
$r = @mysqli_query ($con, $q);

if (mysqli_num_rows($r) > 0)
{
  echo '<table align="center" cellspacing="0" cellpadding="5" width="100%">
  <tr>
    <td style="text-align:left; min-width:5vw;"><b><a href="catalogDisplay.php?sort=userId">Item ID</a></b></td>
    <td style="text-align:left; min-width:8vw;"><b><a href="catalogDisplay.php?sort=item_name">Item Name</a></b></td>
    <td style="text-align:left; min-width:5vw;"><b><a href="catalogDisplay.php?sort=item_price">Price</a></b></td>
    <td style="text-align:left; min-width:5vw;"><b><a href="catalogDisplay.php?sort=item_quantity">Quantity</a></b></td>
    <td style="text-align:left; min-width:5vw;"><b><a href="catalogDisplay.php?sort=item_desc">Description</a></b></td>
    </tr>';

    $bg = '#eeeeee';

    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
    {
      $bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
      echo
      '<tr bgcolor="' . $bg . '">';
      if( (isset($_SESSION['user_id'])) && ($_SESSION['user_level'] == 2)){
        echo '<td style="text-align:left">' . '<a href="editItem.php?id=' . $row['item_id'] . '"' . ' id="editLink">' . $row['item_id'] . '</a></td>';
      } else {
        echo '<td style="text-align:left">' . $row['item_id'] . '</td>';
      }
      echo
      '<td style="text-align:left">' . $row['item_name'] . '</td>
      <td style="text-align:left">$' . $row['item_price'] . '</td>
      <td style="text-align:left">' . $row['item_quantity'] . '</td>
      <td style="text-align:left;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;max-width:440px">' . $row['item_desc'] . '</td>
      </tr>';
    }
    echo '</table>';

  }
else
{
  echo '<p class="error">There are currently no items in the database.</p>';
}

mysqli_free_result ($r);
mysqli_close($con);

include ('footer.html');
?>
