<?php
// we need this so that PHP does not complain about deprectaed functions
error_reporting( 0 );

// Connect to MySQL
$link = mysql_connect( 'localhost', 'root', '' );
if ( !$link ) {
  die( 'Could not connect: ' . mysql_error() );
}

// Select the data base
$db = mysql_select_db( 'lr', $link );
if ( !$db ) {
  die ( 'Error selecting database \'test\' : ' . mysql_error() );
}

// Fetch the data
$query = "
  SELECT *
  FROM daily_supply WHERE supplier_code = '0001'
  ORDER BY date ASC";
$result = mysql_query( $query );

// All good?
if ( !$result ) {
  // Nope
  $message  = 'Invalid query: ' . mysql_error() . "\n";
  $message .= 'Whole query: ' . $query;
  die( $message );
}

// Print out rows
$prefix = '';
echo "[\n";
while ( $row = mysql_fetch_assoc( $result ) ) {
  echo $prefix . " {\n";
  echo '  "y": "' . $row['date'] . '",' . "\n";
  echo '  "item1": ' . $row['approved_kgs'] . ',' . "\n";
  echo '  "item2": ' . $row['supplied_kgs'] . '' . "\n";
  echo " }";
  $prefix = ",\n";
}
echo "\n]";

// Close the connection
mysql_close( $link );
?>