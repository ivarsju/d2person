DELETE FROM ccuc_user_company WHERE ccuc_person_id > 4 OR ccuc_person_id = 3;	
DELETE FROM `ppxd_person_x_document` WHERE ppxd_pprs_id > 4 OR ppxd_pprs_id = 3;
DELETE FROM `ppxs_person_x_setting` WHERE ppxs_pprs_id > 4 OR ppxs_pprs_id = 3;
DELETE FROM `ppcn_person_contact` WHERE ppcn_pprs_id > 4 OR ppcn_pprs_id = 3;
DELETE FROM `ppxt_person_x_type` WHERE ppxt_pprs_id > 4 OR ppxt_pprs_id = 3;
DELETE FROM `vvat_atbildigais` WHERE vvat_pprs_id > 4 OR vvat_pprs_id = 3;
DELETE FROM `pprs_person` WHERE pprs_id > 4 OR pprs_id = 3;
