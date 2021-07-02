<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-03-04 05:29:21 --> Severity: error --> Exception: Call to a member function row() on null /home/tech599/public_html/tech599.com/johnsum/erp_new/application/models/AdminModel.php 35
ERROR - 2020-03-04 05:41:47 --> Severity: error --> Exception: Call to a member function row() on null /home/tech599/public_html/tech599.com/johnsum/erp_new/application/models/AdminModel.php 35
ERROR - 2020-03-04 05:45:00 --> Severity: error --> Exception: Call to a member function row() on null /home/tech599/public_html/tech599.com/johnsum/erp_new/application/models/AdminModel.php 35
ERROR - 2020-03-04 05:55:01 --> 404 Page Not Found: Fi_home/getCustContactInfo
ERROR - 2020-03-04 06:16:20 --> 404 Page Not Found: Fi_home/getCustContactInfo
ERROR - 2020-03-04 06:51:14 --> Severity: error --> Exception: Call to a member function row() on null /home/tech599/public_html/tech599.com/johnsum/erp_new/application/models/AdminModel.php 35
ERROR - 2020-03-04 06:57:21 --> Severity: error --> Exception: syntax error, unexpected end of file /home/tech599/public_html/tech599.com/johnsum/erp_new/application/models/AdminModel.php 15258
ERROR - 2020-03-04 07:09:48 --> Severity: error --> Exception: syntax error, unexpected end of file, expecting '(' /home/tech599/public_html/tech599.com/johnsum/erp_new/application/models/AdminModel.php 17128
ERROR - 2020-03-04 07:56:50 --> Severity: error --> Exception: syntax error, unexpected '"time"' (T_CONSTANT_ENCAPSED_STRING), expecting ')' /home/tech599/public_html/tech599.com/johnsum/erp_new/application/models/AdminModel.php 15209
ERROR - 2020-03-04 07:56:53 --> Severity: error --> Exception: syntax error, unexpected '"time"' (T_CONSTANT_ENCAPSED_STRING), expecting ')' /home/tech599/public_html/tech599.com/johnsum/erp_new/application/models/AdminModel.php 15209
ERROR - 2020-03-04 07:56:57 --> Severity: error --> Exception: syntax error, unexpected '"time"' (T_CONSTANT_ENCAPSED_STRING), expecting ')' /home/tech599/public_html/tech599.com/johnsum/erp_new/application/models/AdminModel.php 15209
ERROR - 2020-03-04 07:57:00 --> Severity: error --> Exception: syntax error, unexpected '"time"' (T_CONSTANT_ENCAPSED_STRING), expecting ')' /home/tech599/public_html/tech599.com/johnsum/erp_new/application/models/AdminModel.php 15209
ERROR - 2020-03-04 09:25:42 --> Query error: Expression #1 of ORDER BY clause is not in GROUP BY clause and contains nonaggregated column 'tech599_erpsystem.r.cus_id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT count(`r`.`cus_id`) count_, `c`.`type` `type_`, sum(`c`.`amount`) amount_
FROM `register_customer` `r`
JOIN `customer_payment_history` `c` ON `c`.`cust_id` = `r`.`cus_id`
JOIN `users` `u` ON `u`.`id` = `c`.`usrename`
WHERE `c`.`do_deposite` != 1
AND `c`.`status` = 1
GROUP BY `type_`
ORDER BY `r`.`cus_id` DESC
ERROR - 2020-03-04 12:49:42 --> Severity: error --> Exception: Call to a member function row() on null /home/tech599/public_html/tech599.com/johnsum/erp_new/application/models/AdminModel.php 42
ERROR - 2020-03-04 12:51:36 --> 404 Page Not Found: Fi_home/getCustContactInfo
ERROR - 2020-03-04 12:51:52 --> 404 Page Not Found: Fi_home/getCustContactInfo
ERROR - 2020-03-04 13:01:13 --> Severity: error --> Exception: Call to a member function row() on null /home/tech599/public_html/tech599.com/johnsum/erp_new/application/models/AdminModel.php 42
ERROR - 2020-03-04 13:29:51 --> 404 Page Not Found: Fi_home/getCustContactInfo
ERROR - 2020-03-04 13:30:47 --> 404 Page Not Found: Fi_home/getCustContactInfo
ERROR - 2020-03-04 13:30:54 --> 404 Page Not Found: Fi_home/getCustContactInfo
ERROR - 2020-03-04 14:03:56 --> Query error: Unknown column 'item_discnt_amt' in 'field list' - Invalid query: UPDATE `invoices_create` SET `invoice_amount` = 0, `invoice_balance_due` = 0, `small_dis` = 0, `item_discnt_amt` = NULL
WHERE `invoice_id` = ''
AND `cust_id` = '32'
ERROR - 2020-03-04 14:03:59 --> Query error: Unknown column 'item_discnt_amt' in 'field list' - Invalid query: UPDATE `invoices_create` SET `invoice_amount` = 0, `invoice_balance_due` = 0, `small_dis` = 0, `item_discnt_amt` = '3'
WHERE `invoice_id` = ''
AND `cust_id` = '32'
ERROR - 2020-03-04 14:04:46 --> Query error: Unknown column 'item_discnt_amt' in 'field list' - Invalid query: UPDATE `invoices_create` SET `invoice_amount` = 0, `invoice_balance_due` = 0, `small_dis` = 0, `item_discnt_amt` = NULL
WHERE `invoice_id` = ''
AND `cust_id` = '32'
ERROR - 2020-03-04 14:04:51 --> Query error: Unknown column 'item_discnt_amt' in 'field list' - Invalid query: UPDATE `invoices_create` SET `invoice_amount` = 0, `invoice_balance_due` = 0, `small_dis` = 0, `item_discnt_amt` = NULL
WHERE `invoice_id` = ''
AND `cust_id` = '32'
