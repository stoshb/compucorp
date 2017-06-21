<?php
	$file = "/home/stan/compucorp/CivicCRM.txt";

class Line  
	{
	public $price_field_id =  4                           ;
	public $price_field_value_id =  7                     ;
	public $label = "General"                              ;
	public $field_title =  "Membership Amount"              ;
	public $description =  "Regular annual membership."     ;
	public $qty =  1                                      ;
	public $unit_price =  100.00                          ;
	public $line_total =  100                             ;
	public $participant_count =  0                        ;
//	public $max_value =                                   ;
	public $membership_type_id =  1                       ;
//	public $membership_num_terms =                        ;
	public $auto_renew =  0                               ;
	public $html_type =  "Radio"                            ;
	public $financial_type_id =  2                        ;
//	public $tax_amount =                                  ;
	public $non_deductible_amount =  0.00                 ;
	public $contribution_id =  97                         ;
	public $entity_id =  33                               ;
	public $entity_table =  "civicrm_membership"            ;
	}

class Member
	{
	public $total_amount =  100.00                          ;
	public $contact_id =  180                               ;
	public $status_id =  1                                  ;
//	public $source =                                        ;
//	public $is_override =                                   ;
//	public $campaign_id =                                   ;
	public $exclude_is_admin =  1                           ;
	public $financial_type_id =  2                          ;
	public $payment_instrument_id =  4                      ;
//	public $trxn_id =                                       ;
	public $contribution_status_id =  1                     ;
//	public $check_number =                                  ;
	public $receive_date =  "20170606102500"                ;
//	public $card_type_id =                                  ;
//	public $pan_truncation =                                ;
	public $contribution_source =  "General Membership"     ;
	public $processPriceSet =  1                            ;
	public $action =  1                                     ;
	public $membership_type_id =  1                         ;
	public $join_date =  "20170606"                         ;
	public $start_date = "20170606"                         ;
	public $end_date  =  "20190605"                         ;
//	public $max_related =  	                                ;
	}


	$L = new Line;
//	sebhooks_civicrm_pre ("create", "LineItem", 50, (array) $L);

	$M = new Member;
//	sebhooks_civicrm_post ("create", "Membership", 50, (array) $M);

function sebhooks_civicrm_pre($op, $objectName, $id, $params)
	{    
	include 'CbConnect.txt';

//	print_r( $params );
	$file = "/home/stan/compucorp/CivicCRM.txt";
	file_put_contents($file, "\nPRE:  OBJECT: $objectName - Action: $op - Date: " . date(DATE_RSS) . " id: $id\n", FILE_APPEND);
	switch ( $objectName )
		{
		case "Activity":
//			file_put_contents($file, "$objectName: " . print_r($params, true) . "\n", FILE_APPEND);
//			file_put_contents($file, "Pre:  source: " . $params["source"] . "\n", FILE_APPEND);
			break;
		case "Address":
//			file_put_contents($file, "Pre:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
			break;
		case "Email":
//			file_put_contents($file, "Pre:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
			break;
		case "FinancialItem":
//			file_put_contents($file, "Pre:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
			file_put_contents($file, "Pre:  entity_table: " . $params["entity_table"] . "  ID: " . $params["entity_id"] . "\n", FILE_APPEND);
			break;
		case "Contribution":
//			file_put_contents($file, "Pre:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
			file_put_contents($file, "Pre:  source: " . $params["source"] . "\n", FILE_APPEND);
			break;
		case "IM":
//			file_put_contents($file, "Pre:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
			break;
		case "Individual":
//			file_put_contents($file, "Pre:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
			file_put_contents($file, "Pre:  found " . $params["first_name"] . "\n", FILE_APPEND);
			break;
		case "LineItem":
//			file_put_contents($file, "Pre:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
//			file_put_contents($file, "Pre:  entity_table: " . $params["entity_table"] . "  ID: " . $params["entity_id"] . "\n", FILE_APPEND);
		
			break;
		case "Membership":
//			file_put_contents($file, "Pre:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
			file_put_contents($file, "Pre:  contribution_source: " . $params["contribution_source"] . "\n", FILE_APPEND);
			break;
		case "MembershipPayment":
//			file_put_contents($file, "Pre:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
			file_put_contents($file, "Pre:  membership_id: " . $params["membership_id"] . "   contribution_id: " . $params["contribution_id"] . "\n", FILE_APPEND);
			break;
		case "Phone":
//			file_put_contents($file, "Pre:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
			break;
		default:
			file_put_contents($file, "Pre:  Unknown -- $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
			break;
		}
		
	file_put_contents($file, "Pre: Bye\n", FILE_APPEND);
	
	}

function sebhooks_civicrm_post($op, $objectName, $id, $params)
	{    
	include 'CbConnect.txt';

	$file = "/home/stan/compucorp/CivicCRM.txt";
	file_put_contents($file, "\nPOST: OBJECT: $objectName - Action: $op - Date: " . date(DATE_RSS) . " id: $id\n", FILE_APPEND);
	switch ( $objectName )
		{
		case "Activity":
//			file_put_contents($file, "Post:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
//			file_put_contents($file, "Post:  source: " . $params["source"] . "\n", FILE_APPEND);
			break;
		case "Address":
//			file_put_contents($file, "Post:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
			break;
		case "Email":
//			file_put_contents($file, "Post:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
			break;
		case "FinancialItem":
//			file_put_contents($file, "Post:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
//			file_put_contents($file, "Post:  entity_table: " . $params["entity_table"] . "  ID: " . $params["entity_id"] . "\n", FILE_APPEND);
			break;
		case "Contribution":
//			file_put_contents($file, "Post:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
//			file_put_contents($file, "Post:  source: " . $params["source"] . "\n", FILE_APPEND);
			break;
		case "IM":
//			file_put_contents($file, "Post:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
			break;
		case "Individual":
//			file_put_contents($file, "Post:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
//			file_put_contents($file, "Post:  found " . $params["first_name"] . "\n", FILE_APPEND);
			break;
		case "LineItem":
//			file_put_contents($file, "Post:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
//			file_put_contents($file, "Post:  entity_table: " . $params["entity_table"] . "  ID: " . $params["entity_id"] . "\n", FILE_APPEND);
		
//			if ( ($params["entity_table"] == "civicrm_membership")  && ($op == 'create'))
//				{
//				$gid = SaveRenewal( $id, $params);
//				}

			break;
		case "Membership":
//			file_put_contents($file, "Post:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
			$gid = SaveNewMember( $id, $params);
			break;
		case "MembershipPayment":
//			file_put_contents($file, "Post:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
//			file_put_contents($file, "Post:  membership_id: " . $params["membership_id"] . "   contribution_id: " . $params["contribution_id"] . "\n", FILE_APPEND);
			$gid = SaveMemberPayment( $id, $params);
			file_put_contents($file, "Post:  Saved payment\n", FILE_APPEND);
			break;
		case "Phone":
//			file_put_contents($file, "Post:  $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
			break;
		default:
			file_put_contents($file, "Post:  Unknown -- $objectName: " . print_r($params, true) . "\n", FILE_APPEND);
			break;
		}
		
	file_put_contents($file, "Post: Bye\n", FILE_APPEND);
	
	}



function SaveRenewal( $id, $params)
	{
	include 'CbConnect.txt';
	$file = "/home/stan/compucorp/CivicCRM.txt";
	include_once 'CbConnect.txt';
	file_put_contents($file, "params: " . print_r($params,true) . "\n", FILE_APPEND);
	$mysqli->close();

	}


function SaveNewMember( $id, $params)
	{
	include 'CbConnect.txt';
	$file = "/home/stan/compucorp/CivicCRM.txt";
//	file_put_contents($file, "Post:  " . print_r($params, true) . "\n", FILE_APPEND);
	$sql3 = "INSERT INTO `civicrm`.`sebhooks_term` (`start_date`, `end_date`, `contact_id`,  `membership_id`) "
		.	"VALUES ('" . $params->start_date . "', '" . $params->end_date . "', " 
		.	$params->contact_id . ", " . $params->id . ");";
	file_put_contents($file, "sql3: $sql3\n", FILE_APPEND);
	$mysqli->query( $sql3 ) or die("<BR>Query $sql3\nFailed: " . $mysqli->error);
	$gid = $mysqli->insert_id;	
	$mysqli->close();
	return $gid;
	}

function SaveMemberPayment( $id, $params)
	{
	include 'CbConnect.txt';
	$file = "/home/stan/compucorp/CivicCRM.txt";
	$sql3 = "UPDATE `civicrm`.`sebhooks_term` "
		.	"SET contribution_id = " . $params->contribution_id 
		.	" WHERE membership_id = " . $params->membership_id. ";";
	file_put_contents($file, "sql3: $sql3\n", FILE_APPEND);
	$mysqli->query( $sql3 ) or die("<BR>Query $sql3\nFailed: " . $mysqli->error);
	$gid = $mysqli->insert_id;	
	$mysqli->close();
	return $gid;
	}


?>