<?php

/**
 * Initialize the database
 */

global $wpdb, $btcpay_donors_donors_table_name;
$charset_collate = $wpdb->get_charset_collate();

// TABLES NAMES
$btcpay_donors_donors_table_name = $wpdb->prefix . "btcpay_donors_donors";
$TABLE = [
  "deletedonor" => $btcpay_donors_donors_table_name,
  "donors" => $btcpay_donors_donors_table_name,
];

/**
 * Create donors table
 */
$btcpay_donors_donors_sql = "CREATE TABLE IF NOT EXISTS $btcpay_donors_donors_table_name (
	id int NOT NULL AUTO_INCREMENT,
	name varchar(45) UNIQUE,
	PRIMARY KEY  (id)
) $charset_collate;";

require_once ABSPATH . "wp-admin/includes/upgrade.php";

dbDelta($btcpay_donors_donors_sql);
/******************************************************/

/**
 * Get donors from database
 */
function btcpay_donors_get_donors()
{
  global $wpdb;
  global $btcpay_donors_donors_table_name;

  $sql = $wpdb->prepare("SELECT id, name FROM $btcpay_donors_donors_table_name");
  return $wpdb->get_results($sql);
}

/*
 * Add donor to database
 */
function btcpay_donors_add_donor($name)
{
  global $wpdb;
  global $btcpay_donors_donors_table_name;

  return $wpdb->insert($btcpay_donors_donors_table_name, [
    "name" => $name,
  ]);
}

/*
 * Delete donor from database
 */
function btcpay_donors_delete_donor($id)
{
  global $wpdb;
  global $btcpay_donors_donors_table_name;

  return $wpdb->delete($btcpay_donors_donors_table_name, [
    "id" => $id,
  ]);
}
