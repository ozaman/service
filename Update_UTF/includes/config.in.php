<?php
if (eregi("config.in.php",$PHP_SELF)) {
    Header("Location: ../index.php");
    die();
}
$webroot=$_SERVER['DOCUMENT_ROOT'];
$webpart="$webroot/";
$ip_sv_cn = "http://223.223.218.85/~admin/";
define("ip_sv_cn","http://223.223.218.85/~admin/"); 
//define("ip_sv_cn","http://www.t-bookingcn.com/"); 
//Version ///// golden phuket
define("_SCRIPT","t-booking.com v. 2"); 
//Web Config
define("WEB_TITLE"," "._SCRIPT.""); 
define("WEB_URL","http://localhost/web") ; 
define("WEB_EMAIL","dee-day@hotmail.com") ; 
define("TIMESTAMP",time()) ;
define("USE_CAPCHA", true); // true or false
define("CAPCHA_TYPE","2"); //TYPE 1 or 2
define("CAPCHA_NUM","4"); //NUM
define("CAPCHA_WIDTH","80"); //WIDTH
define("CAPCHA_HEIGHT","20"); //HEIGHT
	//MySQL Connect mainweb
define("DB_HOST","localhost");
define("DB_NAME","admin_web");
define("DB_USERNAME","admin_MANbooking");
define("DB_PASSWORD","252631MANbooking");
//MySQL Connect history
define("DB_HOST_HIS","localhost");
define("DB_NAME_HIS","admin_his");
define("DB_USERNAME_HIS","admin_MANbooking");
define("DB_PASSWORD_HIS","252631MANbooking");
//MySQL Connect account
define("DB_HOST_ACC","localhost");
define("DB_NAME_ACC","admin_acc");
define("DB_USERNAME_ACC","admin_MANbooking");
define("DB_PASSWORD_ACC","252631MANbooking");
/////////////////// Hotel
define("DB_HOST_HOTEL","localhost");
define("DB_NAME_DATA","admin_data");
define("DB_NAME_HOTEL","admin_hoteldemo");
define("DB_NAME_HOTEL_LIMIT","admin_hotellimit");
define("DB_NAME_HOTEL_HISTORY","admin_hotelhistory");
define("DB_NAME_HOTEL_DAY","admin_hotelday");
//MySQL Connect limit product
define("DB_HOST_LIMIT","localhost");
define("DB_NAME_LIMIT","admin_limit");
define("DB_USERNAME_LIMIT","admin_MANbooking");
define("DB_PASSWORD_LIMIT","252631MANbooking");
//////////////////  AUTO PICKUP TIMESTAMP
define("DB_HOST_TIME","localhost");
define("DB_NAME_TIME","admin_time");
//////////////////  AUTO PICKUP TIMESTAMP
define("DB_HOST_DESIGN","localhost");
define("DB_NAME_DESIGN","admin_design");
//echo $_SESSION[sess_companya].'aaa';
define("DB_HOST_DATA","localhost");
define("DB_NAME_DATA","admin_data");
define("DB_NAME_CHAT","admin_chat");
//////////////////  Rate And Period && CONTROLLER
define("DB_NAME_RATECONTROL","admin_ratecontrol");
define("RCT_period","web_period");
define("RCT_periodofagent","web_periodofagent");
define("RCT_rate_agent","web_rate_agent");
define("RCT_rate_province","web_rate_province");
define("RCT_voucher_prefix","web_voucher_prefix");
define("RCT_voucher_type","web_voucher_type");
define("RCT_taxcontrol","web_taxcontrol");
define("RCT_taxcontrol_product","web_taxcontrol_product");
//Calendar
define("USE_THAIYEAR", true); //
/*
//MySQL Connect
define("DB_HOST","localhost");
define("DB_NAME","work_golden");
define("DB_USERNAME","deeday_web");
define("DB_PASSWORD","3440300965++");
*/
//MySQL table
define("TB_product_shopping_brand","web_product_shopping_brand");
define("TB_product_shopping_type","web_product_shopping_type");
define("TB_product_shopping","web_product_shopping");
define("TB_transfer_report_all","transfer_report_all");
define("TB_user_supplier","web_user_supplier");
define("TB_user_agent","web_user_agent");
define("TB_user_customer","web_user_customer");
define("TB_user_support","web_user_support");
define("TB_user_support_group","web_user_support_group");
define("TB_user_support_sub","web_user_support_sub");
define("TB_user_support_user","web_user_support_user");
define("TB_user_support_usermain","web_user_support_usermain");
define("TB_book_supplier","web_book_supplier");
define("TB_book_agent","web_book_agent");
define("TB_book_agentweb","web_book_agentweb");
define("TB_book_customer","web_book_customer");
define("TB_order_hotel","web_order_hotel");
define("TB_orderhotel","web_orderhotel");
define("TB_order_diving","web_order_diving");
define("TB_order_tour","web_order_tour");
define("TB_order_other","web_order_other");
define("TB_order","web_order");
define("TB_order_detail_diving","web_order_detail_diving");
define("TB_order_detail_shop","web_order_detail_shop");
define("TB_order_detail_sport","web_order_detail_sport");
define("TB_account_detail_simcard","web_account_detail_simcard");
define("TB_order_detail_simcard","web_order_detail_simcard");
define("TB_simcard","web_simcard");
define("TB_simcard_all","web_simcard_all");
define("TB_simcard_cat","web_simcard_category");
define("TB_simcard_company","web_simcard_company");
define("TB_simcard_type","web_simcard_type");
define("TB_ref","web_ref");
define("TB_simcardproduct","web_simcardproduct");
define("TB_roomtype","web_roomtype");
define("TB_agentlist","web_agentlist");
define("TB_agentref","web_agentref");
define("TB_roomlist","web_roomlist");
//////////////  product
define("TB_product","web_product");
define("TB_product_old","web_product_old");
define("TB_product_detail_diving","web_product_detail_diving");
define("TB_product_detail_golf","web_product_detail_golf");
define("TB_product_subcontrol","web_product_subcontrol");
define("TB_product_limit","web_product_limit");
define("TB_product_simcard","web_product_simcard");
define("TB_product_package","web_product_package");
define("TB_product_time","web_product_time");
define("TB_product_country","web_product_country");
define("TB_product_country_time","web_product_country_time");
define("TB_product_seasport","web_product_seasport");
define("TB_product_detail_seasport","web_product_detail_seasport");
define("TB_country","web_country");
//////////////  transfer
define("TB_transferproduct","web_transferproduct");
define("TB_transferproduct_old","web_transferproduct_old");
define("TB_transferplace","web_transferplace");
define("TB_transferplace_old","web_transferplace_old");
define("TB_transferplace_new","web_transferplace_new");
define("TB_transfercharge","web_transfercharge");
define("TB_transfercharge_clone","web_transfercharge_clone");
define("TB_transfercharge_hotel","web_transfercharge_hotel");
define("TB_transfercharge_hotel_main","web_transfercharge_hotel_main");
define("TB_showtime","web_showtime");
define("TB_transfer_clone","web_transfer_clone");
define("TB_transfer_charge","web_transfer_charge");
define("TB_transferplace2","web_transferplace2");
define("TB_transfer","web_transfer");
define("TB_transfercompany","web_transfercompany");
define("TB_driver","web_driver");
////////
define("TB_driver_sub","web_driver_sub");
define("TB_transferproduct_sub","web_transferproduct_sub");
define("TB_ordertransfer","web_ordertransfer");
/////// content
define("TB_dailytour","web_dailytour");
define("TB_daily_golf","web_daily_golf");
define("TB_daily_spa","web_daily_spa");
define("TB_daily_food","web_daily_food");
define("TB_daily_show","web_daily_show");
define("TB_daily_diving","web_daily_diving");
define("TB_daily_minitour","web_daily_minitour");
///////////////
define("TB_amphur","web_amphur");
define("TB_province","web_province");
define("TB_config","web_config");
define("TB_member","web_member");
define("TB_message","web_message");
define("TB_history","web_history");
define("TB_user","web_user");
define("TB_userjob","web_user_category");
define("TB_accountgroup","web_account_category");
define("TB_accountdetail","web_account_detail");
define("TB_account_all","web_account_all");
define("TB_account_vat","web_account_vat");
define("TB_account_nonvat","web_account_nonvat");
define("TB_account_detail_diving","web_account_detail_diving");
define("TB_account_detail_golf","web_account_detail_golf");
define("TB_account_detail_shop","web_account_detail_shop");
define("TB_account_detail_hotel","web_account_detail_hotel");
define("TB_account_detail_sport","web_account_detail_sport");
define("TB_account","web_account");
define("TB_account_transfer","web_accounttransfer");
define("TB_ADMIN","web_admin");
define("TB_admin","web_admin");
define("TB_admin_company","web_admin_company");
define("TB_ADMIN_GROUP","web_groups");
define("TB_NEWS","web_news");
define("TB_NEWS_COMMENT","web_news_comment");
define("TB_NEWS_CAT","web_news_category");
define("TB_gallery","web_gallery");
define("TB_galleryday","web_galleryday");
define("TB_galleryhotel","web_galleryhotel");
define("TB_gallerycar","web_gallerycar");
define("TB_gallery_place","web_gallery_place");
define("TB_gallery_COMMENT","web_gallery_comment");
define("TB_gallery_CAT","web_gallery_category");
define("TB_tour","web_tour");
define("TB_tour_COMMENT","web_tour_comment");
define("TB_tour_CAT","web_tour_category");
define("TB_guestbook_COMMENT","web_guestbook_comment");
define("TB_travel","web_travel");
define("TB_travel_COMMENT","web_travel_comment");
define("TB_travel_CAT","web_travel_category");
define("TB_hotel","web_hotel");
define("TB_hotelroomlist","web_hotelroomlist");
define("TB_hotelday","web_hotelday");
define("TB_hotel_season","web_hotel_season");
define("TB_hotelroom","web_hotelroom");
define("TB_hotel_COMMENT","web_hotel_comment");
define("TB_hotel_CAT","web_hotel_category");
define("TB_room","web_room");
define("TB_room_gallery","web_room_gallery");
define("TB_room_CAT","web_room_category");
define("TB_car","web_car");
define("TB_cargo","web_cargo");
define("TB_car_COMMENT","web_car_comment");
define("TB_car_CAT","web_car_category");
define("TB_carall","web_carall");
define("TB_carall_type","web_carall_type");
define("TB_cartype_area","web_cartype_area");
define("TB_cartype_area_clone","web_cartype_area_clone");
define("TB_cartype_area_cat","web_cartype_area_cat");
define("TB_billroom","web_billroom");
define("TB_billhotel","web_billhotel");
define("TB_billtour","web_billtour");
define("TB_billcar","web_billcar");
define("TB_billgo","web_billgo");
define("TB_banner_r","web_banner_r");
define("TB_banner_c","web_banner_c");
define("TB_galleryroom","web_galleryroom");
define("TB_diving_COMMENT","web_diving_comment");
define("TB_diving_CAT","web_diving_category");
define("TB_show","web_show");
define("TB_show_COMMENT","web_show_comment");
define("TB_show_CAT","web_show_category");
define("TB_media","web_media");
define("TB_media_COMMENT","web_media_comment");
define("TB_media_CAT","web_media_category");
define("TB_manager","web_manager");
define("TB_manager_COMMENT","web_manager_comment");
define("TB_manager_CAT","web_manager_category");
define("TB_teen","web_teen");
define("TB_teen_COMMENT","web_teen_comment");
define("TB_teen_CAT","web_teen_category");
define("TB_center","web_center");
define("TB_center_COMMENT","web_center_comment");
define("TB_center_CAT","web_center_category");
define("TB_download","web_download");
define("TB_download_COMMENT","web_download_comment");
define("TB_download_CAT","web_download_category");
define("TB_knowledge","web_knowledge");
define("TB_knowledge_COMMENT","web_knowledge_comment");
define("TB_knowledge_CAT","web_knowledge_category");
define("TB_CALENDAR","web_calendar");
define("TB_WEBBOARD","web_webboard");
define("TB_WEBBOARD_COMMENT","web_webboard_comment");
define("TB_WEBBOARD_CAT","web_webboard_category");
define("TB_bidboard","web_bookboard");
define("TB_bidboard_CAT","web_bookboard_category");
define("TB_project","web_project");
define("TB_project_CAT","web_project_category");
define("TB_project_TYPE","web_project_type");
define("TB_project_AREA","web_project_area");
define("TB_project_COMMENT","web_project_comment");
define("TB_tour_CAT","web_tour_category");
define("TB_spa","web_spa");
define("TB_golf","web_golf");
define("TB_diving","web_diving");
define("TB_booking","web_booking");
define("TB_golf","web_golf");
define("TB_diving","web_diving");
define("TB_diving_school","web_diving_school");
define("TB_diving_size","web_diving_size");
define("TB_other","web_other");
define("TB_box","web_box");
define("TB_deposit","web_deposit");
define("TB_credit_pay","web_credit_pay");
define("TB_credit_invoice","web_credit_invoice");
define("TB_credit_type","web_credit_type");
define("TB_credit_transfer","web_credit_transfer");
define("TB_credit_transfer_sale","web_credit_transfer_sale");
///// user
define("TB_credit_pay_user","web_credit_pay_user");
define("TB_credit_invoice_user","web_credit_invoice_user");
define("TB_credit_transfer_user","web_credit_transfer_user");
define("TB_message","web_message");
define("TB_shop","web_shop");
define("TB_shop_cat","web_shop_cat");
define("TB_shop_brand","web_shop_category");
define("TB_detail_bank","web_detail_bank");
define("TB_detail_bank_list","web_detail_bank_list");
define("TB_detail_doc","web_detail_doc");
define("TB_detail_doc_group","web_detail_doc_group");
define("TB_detail_doc_list","web_detail_doc_list");
define("TB_bank_list","web_bank_list");
define("TB_detail_bank_showagent","web_detail_bank_showagent");
define("TB_province_product","web_province_product");
define("TB_guide","web_guide");
define("TB_product_type","web_product_type");
define("TB_product_newprice","web_product_newprice");
define("TB_account_detail_seasport","web_account_detail_seasport");
define("TB_order_detail_seasport","web_order_detail_seasport");
define("TB_music","web_music");
define("TB_transferport","web_transferport");
////// limit
define("TB_product_limit_2014","web_product_limit_2014");
define("TB_product_limit_2015","web_product_limit_2015");
define("TB_product_limit_2016","web_product_limit_2016");
define("TB_product_limit_2017","web_product_limit_2017");
////// hotel
define("TB_hotel","web_hotel");
define("TB_roomtype","web_roomtype");
define("TB_product_agent","web_product_agent");
define("TB_transferproduct_agent","web_transferproduct_agent");
define("TB_supplier_agent","web_supplier_agent");
define("TB_backtime","web_backtime");
define("TB_product_transfer","web_product_transfer"); 
define("TB_product_point_place","web_product_point_place");
define("TB_product_video","web_product_video");
?>