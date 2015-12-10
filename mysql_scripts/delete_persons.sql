SET @pprs_id = NNNN;
DELETE FROM ccuc_user_company WHERE  ccuc_person_id = @pprs_id;	
DELETE FROM `ppxd_person_x_document` WHERE ppxd_pprs_id = @pprs_id;
DELETE FROM `ppxs_person_x_setting` WHERE ppxs_pprs_id = @pprs_id;
DELETE FROM `ppcn_person_contact` WHERE ppcn_pprs_id = @pprs_id;
DELETE FROM `ppxt_person_x_type` WHERE ppxt_pprs_id = @pprs_id;
DELETE FROM `vvat_atbildigais` WHERE vvat_pprs_id = @pprs_id;
DELETE FROM `pprs_person` WHERE pprs_id = @pprs_id;
