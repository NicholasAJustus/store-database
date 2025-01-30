<?php
// Set page title:
$page_title = 'User List';
// Add header to page:
include ('header.html');

// Page header:
echo '<h1>Users</h1>';

// Connect to the db:
require('connection.php');
if( (isset($_SESSION['user_id'])) && ($_SESSION['user_level'] != 2)){
	header("Location: index.php");
	die();
}
// Records per page:
$display = 25;

// Set how many pages are generated:
if (isset($_GET['p']) && is_numeric($_GET['p']))
{
  $pages = $_GET['p'];
}
else // Record count:
{
  $q = "SELECT COUNT(user_id) FROM users;";
  $r = @mysqli_query($con, $q);
  $row = @mysqli_fetch_array ($r, MYSQLI_NUM);
  $records = $row[0];
  // Calc. number of pages:
  if ($records > $display)
  {
    $pages = ceil ($records/$display);
  }
  else
  {
    $pages = 1;
  }
} // END 'p' IF.

// Determine where in database to return results:
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
  $start = $_GET['s'];
}
else
{
  $start = 0;
}

// Default sort by user id:
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'user_id';

// Determine the sorting order:
$order_by = 'user_id ASC';
switch ($sort)
{
  case 'userId':
    $order_by = 'user_id ASC';
    break;
  case 'username':
    $order_by = 'username ASC';
    break;
  case 'email':
    $order_by = 'email ASC';
    break;
  case 'userLevel':
    $order_by = 'user_level ASC';
    break;
}

// Define the query:
$q = "SELECT * FROM users ORDER BY $order_by LIMIT $start, $display;";
$r = @mysqli_query ($con, $q); // Run query.

// Check to make sure query returns more than 0 records:
if (mysqli_num_rows($r) > 0)
{
  // Table header:
  echo '<table align="center" cellspacing="0" cellpadding="5" width="100%">
  <tr>
    <td style="text-align:left"><b><a href="userDisplay.php?sort=userId">User ID</a></b></td>
    <td style="text-align:left"><b><a href="userDisplay.php?sort=username">Username</a></b></td>
    <td style="text-align:left"><b><a href="userDisplay.php?sort=email">E-mail Address</a></b></td>
    <td style="text-align:left"><b><a href="userDisplay.php?sort=userLevel">User Level</a></b></td>
    </tr>';

    // Fetch and print records:
    $bg = '#eeeeee';

    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
    {
      $bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
      echo
      '<tr bgcolor="' . $bg . '">
      <td style="text-align:left">' . $row['user_id'] . '</td>
      <td style="text-align:left">' . $row['username'] . '</td>
      <td style="text-align:left">' . $row['email'] . '</td>
      <td style="text-align:left">' . $row['user_level'] . '</td>
      </tr>';
    } // END WHILE loop.

    // Close the table.
    echo '</table>';

  }// END IF mysqli_num_rows($r).
else
{
  echo '<p class="error">There are currently no users in the database.</p>';
}// END ELSE mysqli_num_rows($r).

// Close and free resources:
mysqli_free_result ($r);
// Close database connection:
mysqli_close($con);

// Links to other pages if needed.
if ($pages > 1)
{
  // Add some spacing and start a paragraph:
  echo '<br /><p>';
  // Determine what page script is on:
  $current_page = ($start/$display) + 1;

  // Create previous button if not on first page:
  if ($current_page != 1)
  {
    echo '<a href="studentDisplay.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
  }

  // Create all numbered pages:
  for ($i = 1; $i <= $pages; $i++)
  {
    if ($i != $current_page)
    {
      echo '<a href="studentDisplay.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
    }
      else
      {
        echo $i . ' ';
      }
    }// END for loop.

    // Create next button if not on last page:
    if ($current_page != $pages)
    {
      echo '<a href="studentDisplay.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
    }

    echo '</p>';
  }// END links section.

// Add footer to page:
include ('footer.html');
?>
