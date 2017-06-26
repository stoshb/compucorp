<?php
//	$file = "/home/stan/compucorp/CivicCRM.txt";
//	file_put_contents($file, "\nrun Renewal Page: " . date(DATE_RSS) . " \n");

//#	//require_once '/home/stan/compucorp/drupal/sites/default/files/civicrm/ext/com.example.sebext/CRM/Sebext/DAO/Renewal.php';
	class CRM_Sebext_Page_RenewalPage extends CRM_Core_Page
	{
//}

	public function run()
		{
//		$file = "/home/stan/compucorp/CivicCRM.txt";
//		file_put_contents($file, "\nrun " . date(DATE_RSS) . " \n", FILE_APPEND);
		CRM_Utils_System::setTitle(ts('RenePage'));

		$this->browse();
		// parent run
		return parent::run();
		}

	public function browse()
		{
		$file = "/home/stan/compucorp/CivicCRM.txt";
//		file_put_contents($file, "hcBrowse: 1 \n", FILE_APPEND);
//		$links = self::links();

		//	Get data via direct access to data base
		$startdateID	= CRM_Core_BAO_CustomField::getCustomFieldID('StartDate',		"Renewals");
		$enddateID  	= CRM_Core_BAO_CustomField::getCustomFieldID('EndDate',			"Renewals");
		$membershipID	= CRM_Core_BAO_CustomField::getCustomFieldID('membership_id',	"Renewals");
		$contributionID= CRM_Core_BAO_CustomField::getCustomFieldID('contribution_id',"Renewals");
 		$sd = "startdate_$startdateID";
		$ed = "enddate_$enddateID";
		$mi = "membership_id_$membershipID";
		$ci = "contribution_id_$contributionID";

		$params = array('id' => $startdateID);
		$defaults = array();
		CRM_Core_DAO::commonRetrieve('CRM_Core_DAO_CustomField', $params, $defaults);
		$tableName = CRM_Core_DAO::getFieldValue('CRM_Core_DAO_CustomGroup',
			$defaults['custom_group_id'], 'table_name', 'id');

		$renewals = array();
		$row_id = 0;
		$Sql = "SELECT * "
		.	"FROM $tableName "
		.	"inner join civicrm_membership "
		.	"	on civicrm_membership.id = $tableName.entity_id "
		.	"inner join civicrm_membership_type "
		.	"	on civicrm_membership.membership_type_id = civicrm_membership_type.id "
		.	"left outer join civicrm_contribution "
		.	"	on civicrm_contribution.id = $ci "
		.	"WHERE civicrm_membership.contact_id = " . $_GET['cid'] . " "
		.	"ORDER BY StartDate_$startdateID, name ";
		file_put_contents($file, "hcBrowse: 3: $Sql \n", FILE_APPEND);

		$dao = CRM_Core_DAO::executeQuery( $Sql, CRM_Core_DAO::$_nullArray );
		while ($dao->fetch())
			{
 		 	$row = array();
			$row['startdate'			]	= substr($dao->$sd, 0, 10);
			$row['enddate'				]	= substr($dao->$ed, 0, 10);
			$row['membership_id'		]	= $dao->$mi;
			$row['membership_type'	]	= $dao->name;
			$row['contact_id'			]	= $dao->contact_id;
			$row['contribution_id'	]	= $dao->$ci;
			$row['net_amount'			]	= $dao->net_amount;
			$row['currency'			]	= $dao->currency;
			$row['id'					]	= $row_id;
//			file_put_contents($file, "end row: " . print_r($row, true) . " \n", FILE_APPEND);
			$renewals[$row_id] = $row;
			$row_id++;
			}

//		file_put_contents($file, "end renewal: " . print_r($renewals, true) . " \n", FILE_APPEND);
		$this->assign('rows', $renewals);
		}

	public function api_browse()
		{
		// get all membership types sorted by startdate
		$file = "/home/stan/compucorp/CivicCRM.txt";
		file_put_contents($file, "renewal: in browse \n", FILE_APPEND);

	  $params = array(
	    'membership_type_id' => 23,
	  );

	//  try{
	//    $result = civicrm_api3('Membership', 'get', $params);
	//		file_put_contents($file, "api_renewal:  " . print_r($result, true) . "\n" , FILE_APPEND);
	//  }
	//  catch (CiviCRM_API3_Exception $e) {
	//    // Handle error here.
	//    $errorMessage = $e->getMessage();
	//    $errorCode = $e->getErrorCode();
	//    $errorData = $e->getExtraParams();
	//    return array(
	//      'is_error' => 1,
	//      'error_message' => $errorMessage,
	//      'error_code' => $errorCode,
	//      'error_data' => $errorData,
	//    );
	//
	//
	//
	//	$this->assign('rows', $renewals);
		}

	public function old_browse()
		{
		// get all membership types sorted by startdate
		$file = "/home/stan/compucorp/CivicCRM.txt";
		file_put_contents($file, "renewal: in browse \n", FILE_APPEND);
		$renewals= array();
		$dao = new CRM_DAO_Renewal();
	//	file_put_contents($file, "renewal: created dao " . print_r($dao, true) . "\n" , FILE_APPEND);


	//	function createSQLFilter($fieldName, $filter, $type = NULL, $alias = NULL, $returnSanitisedArray = FALSE)
		$filter = array("=" => 27, "LIKE" => "2016%");

		foreach ($filter as $operator => $criteria)
			{
			file_put_contents($file, "WherLoop: $operator - $criteria\n", FILE_APPEND);
			}

		$W = $dao->createSQLFilter("membership_id", $filter );
		file_put_contents($file, "SQLFilter: $W\n", FILE_APPEND);

	//	$dao->orderBy('startdate');
		$dao->find();
	//m
	//x	file_put_contents($file, "past dao->find \n", FILE_APPEND);
		while ($dao->fetch())
			{
	//m		if (CRM_Financial_BAO_FinancialType::isACLFinancialTypeStatus()
	//m	    && !CRM_Core_Permission::check('view contributions of type ' . CRM_Contribute_PseudoConstant::financialType($dao->financial_type_id))
	//m	  		)
	//m	  	{
	//m	    		continue;
	//m	  	}
	//m	$links = self::links();
			$renewals[$dao->id] = array();
	//q		file_put_contents($file, "start renewal:  " . print_r($dao, true) . " \n", FILE_APPEND);
	//q		file_put_contents($file, "renewal fields: " . print_r($dao->fields(), true) . " \n", FILE_APPEND);
			CRM_Core_DAO::storeValues($dao, $renewals[$dao->id]);
	$values = array();
	$fields = $dao->fields();
	foreach ($fields as $name => $value)
		{
		$dbName = $value['name'];
		if (isset($dao->$dbName) && $dao->$dbName !== 'null')
			{
			$values[$dbName] = $dao->$dbName;
			if ($name != $dbName)
				{
				$values[$name] = $object->$dbName;
	    		}
	  		}
	}
	file_put_contents($file, "renewal values: " . print_r($values, true) . " \n", FILE_APPEND);

	$renewals[$dao->id]['startdate'			]	= $dao->startdate_7;
	$renewals[$dao->id]['enddate'				]	= $dao->enddate_8;
	$renewals[$dao->id]['membership_id'		]	= $dao->membership_id_10;
	$renewals[$dao->id]['contribution_id'	]	= $dao->contribution_id_11;


			$renewals[$dao->id]['period_type'] = CRM_Utils_Array::value($dao->period_type, CRM_Core_SelectValues::periodType(), '');
			$renewals[$dao->id]['visibility'] = CRM_Utils_Array::value($dao->visibility, CRM_Core_SelectValues::memberVisibility(), '');

			//adding column for relationship type label. CRM-4178.
			if ($dao->relationship_type_id)
				{
				//If membership associated with 2 or more relationship then display all relationship with comma separated
				$relTypeIds = explode(CRM_Core_DAO::VALUE_SEPARATOR, $dao->relationship_type_id);
				$relTypeNames = explode(CRM_Core_DAO::VALUE_SEPARATOR, $dao->relationship_direction);
				$renewals[$dao->id]['relationshipTypeName'] = NULL;
				foreach ($relTypeIds as $key => $value)
				{
			   	$relationshipName = 'label_' . $relTypeNames[$key];
			   	if ($renewals[$dao->id]['relationshipTypeName']) {
			   		$renewals[$dao->id]['relationshipTypeName'] .= ", ";
			   	}
			   	$renewals[$dao->id]['relationshipTypeName'] .= CRM_Core_DAO::getFieldValue('CRM_Contact_DAO_RelationshipType',
			   		$value, $relationshipName
			   	);
			  	}
				$renewals[$dao->id]['maxRelated'] = CRM_Utils_Array::value('max_related', $renewals[$dao->id]);
				}
			if (CRM_Financial_BAO_FinancialType::isACLFinancialTypeStatus()
				&& !CRM_Core_Permission::check('edit contributions of type ' . CRM_Contribute_PseudoConstant::financialType($dao->financial_type_id))) {
					unset($links[CRM_Core_Action::UPDATE], $links[CRM_Core_Action::ENABLE], $links[CRM_Core_Action::DISABLE]);
				}
			if (CRM_Financial_BAO_FinancialType::isACLFinancialTypeStatus()
				&& !CRM_Core_Permission::check('delete contributions of type ' . CRM_Contribute_PseudoConstant::financialType($dao->financial_type_id))) {
					unset($links[CRM_Core_Action::DELETE]);
				}
	//			// form all action links
	//			$action = array_sum(array_keys($this->links()));
	//
			// update enable/disable links depending on if it is is_reserved or is_active
			if (!isset($dao->is_reserved))
				{
				if ($dao->is_active) {$action -= CRM_Core_Action::ENABLE;}
				else 						{$action -= CRM_Core_Action::DISABLE;}
				$renewals[$dao->id]['order'] = $renewals[$dao->id]['weight'];
				$renewals[$dao->id]['action'] = CRM_Core_Action::formLink($links, $action,
					array('id' => $dao->id),
					ts('more'),
					FALSE,
					'renewals.manage.action',
					'MembershipType',
					$dao->id
					);
				}
	//q		file_put_contents($file, "end renewal: " . print_r($renewals[$dao->id], true) . " \n", FILE_APPEND);
			}

			$returnURL = CRM_Utils_System::url('civicrm/admin/contribution/renewals', "reset=1&action=browse");
			CRM_Utils_Weight::addOrder($renewals, 'CRM_Member_DAO_MembershipType',
			  'id', $returnURL
			);

			CRM_Member_BAO_MembershipType::convertDayFormat($renewals);
			$this->assign('rows', $renewals);
		}
	}

//  static $_links = NULL;

//  public $useLivePageJS = TRUE;

  /**
   * Get action Links.
   *
   * @return array
   *   (reference) of action links
   */
//  public function &links() {
//    if (!(self::$_links)) {
//      self::$_links = array(
//        CRM_Core_Action::UPDATE => array(
//          'name' => ts('Edit'),
//          'url' => 'civicrm/admin/contribution/contribution/add',
//          'qs' => 'action=update&id=%%id%%&reset=1',
//          'title' => ts('Edit Contribution'),
//        ),
//        CRM_Core_Action::DISABLE => array(
//          'name' => ts('Disable'),
//          'ref' => 'crm-enable-disable',
//          'title' => ts('Disable Contribution'),
//        ),
//        CRM_Core_Action::ENABLE => array(
//          'name' => ts('Enable'),
//          'ref' => 'crm-enable-disable',
//          'title' => ts('Enable Contribution'),
//        ),
//        CRM_Core_Action::DELETE => array(
//          'name' => ts('Delete'),
//          'url' => 'civicrm/admin/contribution/contribution/add',
//          'qs' => 'action=delete&id=%%id%%',
//          'title' => ts('Delete Membership Type'),
//        ),
//      );
//    }
//    return self::$_links;
//  }


?>