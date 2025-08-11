<?php // $Revision: 2.0 $



/************************************************************************/

/* phpAdsNew 2                                                          */

/* ===========                                                          */

/*                                                                      */

/* Copyright (c) 2000-2005 by the phpAdsNew developers                  */

/* For more information visit: http://www.phpadsnew.com                 */

/*                                                                      */

/* This program is free software. You can redistribute it and/or modify */

/* it under the terms of the GNU General Public License as published by */

/* the Free Software Foundation; either version 2 of the License.       */

/************************************************************************/







// Settings help translation strings

$GLOBALS['phpAds_hlp_dbhost'] = "

        ½Ð«ü©w±z­n³s±µªº".$phpAds_dbmsname."¸ê®Æ®w¦øªA¾¹ªº¥D¾÷¦W.

		";

		

$GLOBALS['phpAds_hlp_dbport'] = "

        ½Ð«ü©w±z­n³s±µªº".$phpAds_dbmsname."¸ê®Æ®w¦øªA¾¹ªº³s±µ°ð. 

		".$phpAds_dbmsname."¦øªA¾¹ªº¤º©w³s±µ°ð¬O<i>".

		($phpAds_productname == 'phpAdsNew' ? '3306' : '5432')."</i>.

		";

		

$GLOBALS['phpAds_hlp_dbuser'] = "

        ½Ð«ü©w".$phpAds_productname."¥Î¨Ó¦s¨ú".$phpAds_dbmsname."¸ê®Æ®w¦øªA¾¹ªº¥Î¤á¦W.

		";

		

$GLOBALS['phpAds_hlp_dbpassword'] = "

        ½Ð«ü©w".$phpAds_productname."¥Î¨Ó¦s¨ú".$phpAds_dbmsname."¸ê®Æ®w¦øªA¾¹ªº±K½X.

		";

		

$GLOBALS['phpAds_hlp_dbname'] = "

        ½Ð«ü©w".$phpAds_productname."¦b".$phpAds_dbmsname."¸ê®Æ®w¦øªA¾¹¤W¥Î¨Ó¦s©ñ¼Æ¾Úªº¸ê®Æ®w¦W.

		»Ý­nª`·Nªº¬O¦b¸ê®Æ®w¦øªA¾¹¤W¦¹¸ê®Æ®w¥²¶·¤w¸g¦s¦b.

		¦pªG¦¹¸ê®Æ®w¤£¦s¦bªº¸Ü,".$phpAds_productname."±N<b>¤£·|</b>¦Û°Ê³Ð«Ø¦¹¸ê®Æ®w.

		";

		

$GLOBALS['phpAds_hlp_persistent_connections'] = "

        ¥Ã¤[³s±µªº¨Ï¥Î¥i¥H«Ü¤jªº´£°ª".$phpAds_productname."ªº³t«×©M´î¤p¦øªA¾¹ªº­t¸ü¡C 

		¦ý¬O¦³¤@­Ó¯ÊÂI¡A¦pªG¬O¤@­Ó¤j³X°Ý¶qªº¯¸ÂI¡A¨º»ò¦øªA¾¹ªº­t¸ü·|¤ñ¨Ï¥Î´¶³q³s±µ­n¼W¥[ªº§Ö¡A·|«Ü§Ö¹F¨ì«Ü­«ªº­t¸ü¡C

		¨Ï¥Î´¶³q³s±µÁÙ¬O¥Ã¤[³s±µ­n®Ú¾Ú§Aªº¯¸ÂIªº³X°Ý¶q©Mµw¥ó±ø¥ó¨Ó¨M©w¡C

		¦pªG".$phpAds_productname."¨Ï¥Î¤F¤Ó¦hªº¸ê·½¡A±zÀ³¸Ó¥ý¬d¬Ý³o­Ó³]¸m¡C

		";

		

$GLOBALS['phpAds_hlp_insert_delayed'] = "

        ".$phpAds_dbmsname." ¦b´¡¤J¼Æ¾Úªº®É­Ô­nÂê©w¸ê®Æ®w¡C¦pªG¯¸ÂI¦³«Ü¦hªº³X°ÝªÌ¡A 

		«Ü¥i¯à".$phpAds_productname."¥²¶·µ¥«Ý«Üªøªº®É¶¡¤~¯à´¡¤J¤@¦æ·s¼Æ¾Ú¡A¦]¬°¸ê®Æ®w¤´µM³QÂê©w¡C 

		¦pªG§A¨Ï¥Î©µ¿ð´¡¤J¡A§A¤£»Ý­nµ¥«Ý¡A·í¤@¬q®É¶¡¤§«á¡A¦pªG¼Æ¾Úªí¨S¦³¨ä¥L½uµ{¨Ï¥Î¡A¦¹·s¦æ·|³Q´¡¤J¨ì¼Æ¾Úªí¤¤¡C 

		";

		

$GLOBALS['phpAds_hlp_compatibility_mode'] = "

        ¦pªG§A¦b¾ã¦X".$phpAds_productname."»P¨ä¥L²Ä¤T¤è²£«~ªº®É­Ô¦³°ÝÃD¡A¦¹¿ï¶µ¥i¯àÀ°§U§A¥´¶}¸ê®Æ®wªº­Ý®e¼Ò¦¡¡C

		¦pªG§A¥¿¦b¨Ï¥Î¥»¦a½Õ¥Î¼Ò¦¡¨Ã¥B¸ê®Æ®wªº­Ý®e¼Ò¦¡¤w¸g¥´¶}¡A 

		".$phpAds_productname."À³¸Ó«O«ù¸ê®Æ®w³s±µª¬ºA©M".$phpAds_productname."¹B¦æ«e¤@­P¡C 

		¦¹¿ï¶µ¦³¤@¨ÇºC¡]«Ü¤p¡^©Ò¥H¤º©wª¬ºA¬OÃö³¬ªº¡C

		";

		

$GLOBALS['phpAds_hlp_table_prefix'] = "

        ¦pªG".$phpAds_productname."¨Ï¥Îªº¸ê®Æ®w¬O»P¨ä¥L¦h­Ó³n¥ó¦@¥Î,µ¹¸ê®Æ®w¥[¤@­Ó«eºó¬O¤@­Ó¤ñ¸û¦nªº¿ï¾Ü¡C

		¦pªG§A¦b¦P¤@­Ó¸ê®Æ®w¤¤¨Ï¥Î".$phpAds_productname."ªº¦h­Ó¦w¸Ëª©¥»¡A§A­n«OÃÒ³o­Ó«eºó¦b©Ò¦³ªº¦w¸Ëª©¥»¸Ì¬O°ß¤@ªº¡C

		";

		

$GLOBALS['phpAds_hlp_table_type'] = "

        ".$phpAds_dbmsname."¤ä«ù¦hºØ¼Æ¾ÚªíÃþ«¬¡C¨CºØ¸ê®Æ®w³£¦³¿W¦³ªº¯S¼x¦Ó¥B¦³ªº¯à°÷«Ü¤j´£°ª".$phpAds_productname."ªº¹B¦æ³t«×¡C

		MyISAM¬O¤º©wªº¼Æ¾ÚªíÃþ«¬¨Ã¥B¥i¥H¦b".$phpAds_dbmsname."ªº©Ò¦³¦w¸Ëª©¥»¤W¨Ï¥Î¡C¨ä¥LÃþ«¬ªº¼Æ¾Úªí¥i¯à¤£¯à¦b§Aªº¦øªA¾¹¤W¨Ï¥Î¡C

		";

		

$GLOBALS['phpAds_hlp_url_prefix'] = "

        ".$phpAds_productname."»Ý­nª¾¹D¥¦¦Û¤v¦bºô­¶¦øªA¾¹ªº¦ì¸m¤~¯à¥¿±`¤u§@¡C§A¥²¶·´£¨Ñ".$phpAds_productname."¦w¸Ë¥Ø¿ýªºURL¦a§}¡A 

        ¨Ò¦p¡G  http://www.your-url.com/".$phpAds_productname.".

		";

		

$GLOBALS['phpAds_hlp_my_header'] =

$GLOBALS['phpAds_hlp_my_footer'] = "

        ¶ñ¤Jºô­¶ªº³»¤å¥ó©M©³¤å¥óªº¸ô®|(e.g.: /home/login/www/header.htm)¥i¥H¦bºÞ²z­û¬É­±ªº¨C­Ó­¶­±¤W²K¥[³»©M©³¤å¥ó¡C 

        §A¥i¥H©ñ¤å¥»©ÎªÌhtml¤å¥ó(¦pªG§A¨Ï¥Î¦b¤å¥ó¤¤¨Ï¥Îhtml¥N½X¡A½Ð¤£­n¨Ï¥Î¶H &lt;body> or &lt;html>ªº¼Ð°O)¡C

		";

		

$GLOBALS['phpAds_hlp_content_gzip_compression'] = "

		±Ò¥ÎGZIP¤º®eÀ£ÁY¡A·|·¥¤jªº´î¤p¨C¦¸ºÞ²z­û­¶­±¥´¶}®Éµo°eµ¹ÂsÄý¾¹ªº¼Æ¾Ú¡C 

		PHPª©¥»°ª©ó4.0.5¨Ã¦w¸Ë¤FGZIPªþ¥[¼Ò¶ô¤~¯à±Ò¥Î¦¹¥\¯à¡C

		";

		

$GLOBALS['phpAds_hlp_language'] = "

        ¿ï¾Ü".$phpAds_productname."¨Ï¥Îªº¤º©w»y¨¥¡C³o­Ó»y¨¥±N³Q¥Î§@ºÞ²z­û©M«È¤á¬É­±ªº¤º©w»y¨¥¡C 

        ½Ðª`·N¡G§A¥i¥H¬°±qºÞ²z­û¬É­±¬°¨C¤@­Ó«È¤á³]¸m¤£¦Pªº»y¨¥©M¬O§_¤¹³\«È¤á­×§ï¥L­Ì¦Û¤vªº»y¨¥³]¸m¡C

		";

		

$GLOBALS['phpAds_hlp_name'] = "

        ±z«ü©w¦¹µ{§Çªº¦W¦r. ¦¹¦r²Å¦ê±N¦bºÞ²z­û©M«È¤á¬É­±ªº©Ò¦³­¶­±¤WÅã¥Ü. 

		¦pªG¬°ªÅ(¤º©w),±NÅã¥Ü¤@­Ó".$phpAds_productname."ªº¹Ï¼Ð.

		";

		

$GLOBALS['phpAds_hlp_company_name'] = "

        ³o­Ó¦W¦r¬O".$phpAds_productname."µo°e¹q¤lªº¶l¥óªº®É­Ô¨Ï¥Îªº¡C

		";

		

$GLOBALS['phpAds_hlp_override_gd_imageformat'] = "

        ".$phpAds_productname."³q±`­nÀË´úGD®w¬O§_¦w¸Ë©M¤ä«ù­þºØ¹Ï¤ù®æ¦¡. ¦ý¬OÀË´ú¦³¥i¯à¤£·Ç½T©ÎªÌ¿ù»~,

		¤@¨Çª©¥»ªºPHP¤£¤¹³\ÀË´ú¤ä«ùªº¹Ï¤ù®æ¦¡. ¦pªG".$phpAds_productname."¦Û°ÊÀË´ú¹Ï¤ù®æ¦¡¥¢±Ñ,

		§A¥i¥H¨î©w¥¿½Tªº¹Ï¤ù®æ¦¡. ¥i¯àªº­È:none, png, jpeg, gif.

		";

		

$GLOBALS['phpAds_hlp_p3p_policies'] = "

        ¦pªG§A·Q±Ò¥Î".$phpAds_productname."'P3PÁô¨pµ¦²¤',§A¥²¶·¥´¶}¦¹¿ï¶µ. 

		";

		

$GLOBALS['phpAds_hlp_p3p_compact_policy'] = "

        ÁY²¤µ¦²¤¬O©Mcookie¤@°_µo°eªº. ¤º©wªº³]¸m¬O:'CUR ADM OUR NOR STA NID', 

		¤¹³\Internet Explorer 6 ±µ¨ü".$phpAds_productname."¨Ï¥Îªºcookie.

		±z¥i¥H§ó§ï¦¹³]¸m¥H²Å¦X±z¦Û¤vªºÁô¨pÁn©ú.

		";

		

$GLOBALS['phpAds_hlp_p3p_policy_location'] = "

        ¦pªG±z·Q¨Ï¥Î§¹¾ãÁô¨pµ¦²¤,±z¥i¥H¨î©wµ¦²¤ªº¦ì¸m.

		";

		

$GLOBALS['phpAds_hlp_log_beacon'] = "

		«H¸¹¿O¬O¤pªº¤£¥i¨£ªº¹Ï¤ù,¥i¥H©ñ¸m¦b¼s§iÅã¥Üªº­¶­±¤W.¦pªG±z¥´¶}¤F¦¹¿ï¶µ,

		".$phpAds_productname."±N¨Ï¥Î¦¹«H¸¹¿O¨Ó­pºâ¼s§iÅã¥Üªº¦¸¼Æ. 

		¦pªG±zÃö³¬¤F¦¹¿ï¶µ,¼s§iªºÅã¥Ü¦¸¼Æ±N¦bµo°eªº®É­Ô­pºâ, ¦ý¬O³o¼Ë¤£§¹¥þ·Ç½T, 

		¦]¬°¤@­Ó¤w¸gµo°eªº¼s§i¤£¤@©wÁ`¬OÅã¥Ü¦b«Ì¹õ¤W. 

		";

		

$GLOBALS['phpAds_hlp_compact_stats'] = "

        ¶Ç²Î¤W,".$phpAds_productname."¨Ï¥Î¤F¬Û·í¼sªxªº°O¿ý,«D±`¸Ô²Ó¦ý¬O¹ï¸ê®Æ®w¦øªA¾¹­n¨D«Ü°ª.

		¹ï©ó¤@­Ó³X°ÝªÌ«Ü¦hªº¯¸ÂI,³o¬O¤@­Ó«Ü¤jªº°ÝÃD. ¬°¤F¸Ñ¨M³o­Ó°ÝÃD,".$phpAds_productname."¤]¤ä«ù¤@ºØ·sªº²Î­p¤è¦¡:

		Â²¼ä²Î­p¼Ò¦¡,¹ï¸ê®Æ®w¦øªA¾¹­n¨D¤p¤@¨Ç,¦ý¬O¤£¬O«Ü¸Ô²Ó.Â²¤¶²Î­p¼Ò¦¡²Î­p¨C¤p®Éªº³X°Ý¼Æ©MÂIÀ»¼Æ,

		¦pªG±z»Ý­n§ó¸Ô²Óªº«H®§,±z»Ý­nÃö³¬Â²¼ä²Î­p¼Ò¦¡.

		";

		

$GLOBALS['phpAds_hlp_log_adviews'] = "

        ³q±`©Ò¦³ªº³X°Ý¼Æ³£³Q°O¿ý,¦pªG±z¤£·Q¦¬¶°³X°Ý¼Æªº¼Æ¾Ú,¥i¥HÃö³¬¦¹¿ï¶µ.

		";

		

$GLOBALS['phpAds_hlp_block_adviews'] = "

		¦pªG¤@­Ó³X°ÝªÌ¨ê·s­¶­±,¨C¦¸".$phpAds_productname."³£·|°O¿ý³X°Ý¼Æ. 

		¦¹¿ï¶µ¥Î¨Ó«OÃÒ¦b±z«ü©wªº®É¶¡¶¡¹j¤º¹ï¤@­Ó¼s§iªº¦h¦¸³X°Ý¶È°O¿ý¤@¦¸³X°Ý¼Æ.

		¦p:¦pªG±z³]¸m¦¹­È¬°300¬í,".$phpAds_productname."¶È·í5¤ÀÄÁ¤º¦¹¼s§i¹ï¦¹³X°ÝªÌ¨S¦³Åã¥Ü¹L¤~°O¿ý¸Ó³X°Ý¼Æ.

		¦¹¿ï¶µ¶È·íÂsÄý¾¹±µ¨ücookiesªº®É­Ô¤~°_§@¥Î.

		";

		

$GLOBALS['phpAds_hlp_log_adclicks'] = "

        ³q±`©Ò¦³ªºÂIÀ»¼Æ³£³Q°O¿ý,¦pªG±z¤£·Q¦¬¶°ÂIÀ»¼Æªº¼Æ¾Ú,¥i¥HÃö³¬¦¹¿ï¶µ.

		";

		

$GLOBALS['phpAds_hlp_block_adclicks'] = "

		¦pªG¤@­Ó³X°ÝªÌÂIÀ»¤@­Ó¼s§i¤F¦h¦¸,¨C¦¸".$phpAds_productname."³£·|°O¿ýÂIÀ»¼Æ.

		¦¹¿ï¶µ¥Î¨Ó«OÃÒ¦b±z«ü©wªº®É¶¡¶¡¹j¤º¹ï¤@­Ó¼s§iªº¦h¦¸ÂIÀ»¶È°O¿ý¤@¦¸ÂIÀ»¼Æ. 

		¦p:¦pªG±z³]¸m¦¹­È¬°300¬í,".$phpAds_productname."¶È·í5¤ÀÄÁ¤º¦¹³X°ÝªÌ¨S¦³ÂIÀ»¹L¦¹¼s§i¤~°O¿ý¸ÓÂIÀ»¼Æ.

		¦¹¿ï¶µ¶È·íÂsÄý¾¹±µ¨ücookiesªº®É­Ô¤~°_§@¥Î.

		";

			

$GLOBALS['phpAds_hlp_log_source'] = "

		¦pªG±z¥¿¦b¼s§i½Õ¥Î¥N½X¤¤¨Ï¥Î·½°Ñ¼Æ,±z¥i¥H§â³o­Ó«H®§¦s¨ì¸ê®Æ®w¤¤,

		³o¼Ë±z¥i¥H¦b²Î­p¼Æ¾Ú¤¤¬Ý¨ì¹B¦æ¤¤ªº¤£¦P·½°Ñ¼Æ«H®§.

		¦pªG±z¨S¦³¨Ï¥Î·½°Ñ¼Æ©ÎªÌ±z¤£·Q¨Ï¥Î¦¹°Ñ¼Æ¨Ó«O¦s«H®§,

		±z¥i¥H¦w¥þªºÃö³¬¦¹¿ï¶µ.

		";

		

$GLOBALS['phpAds_hlp_geotracking_stats'] = "

		¦pªG±z¥¿¦b¨Ï¥Î¤@­Ógeotargeting¸ê®Æ®w,±z¥i¥H§â¦a²z«H®§¦s¤J¸ê®Æ®w.

		i¦pªG±z±Ò¥Î¦¹¿ï¶µ,±z¥i¥H¦b²Î­p¼Æ¾Ú¤¤¬Ý¨ì±zªº³X°ÝªÌªº¦a²z¦ì¸m

		©M¨C­Ó¼s§i¦b¤£¦P°ê®aµo§Gªº±¡ªp.

		¦¹¿ï¶µ¶È·í±z¨Ï¥Î¸Ô²Ó²Î­p¤è¦¡ªº®É­Ô¤~¯à¨Ï¥Î.

		";

		

$GLOBALS['phpAds_hlp_log_hostname'] = "

		¦pªG±z·Q«O¦s¨C­Ó³X°ÝªÌªº¥D¾÷¦W©ÎªÌIP¦a§},±z¥i¥H±Ò¥Î¦¹¿ï¶µ.

		«O¦s¦¹«H®§±z¥i¥H¬Ý¨ì¨º¨Ç¥D¾÷ÀË¯Á¤F³Ì¦hªº¼s§i.

		¦¹¿ï¶µ¶È·í±z¨Ï¥Î¸Ô²Ó²Î­p¤è¦¡ªº®É­Ô¤~¯à¨Ï¥Î.

		";

		

$GLOBALS['phpAds_hlp_log_iponly'] = "

		«O¦s³X°ÝªÌªº¥D¾÷¦W·|¦û¥Î¸ê®Æ®w«Ü¦hªºªÅ¶¡.

		¦pªG±z±Ò¥Î¦¹¿ï¶µ,".$phpAds_productname."±NÁÙ¬O«O¦s¥D¾÷ªº«H®§,

		¦ý¬O¶È«O¦s¦û¥ÎªÅ¶¡¤ÖªºIP¦a§}«H®§.

		¦pªG¦øªA¾¹¤£´£¨Ñ¥D¾÷¦W©ÎªÌ".$phpAds_productname."³]¸m°ÝÃD,¦¹¿ï¶µ¤£¥i¥Î.

		¦]¬°¦¹±¡ªp¤UÁ`¬O°O¿ýIP¦a§}.

		";

	

$GLOBALS['phpAds_hlp_reverse_lookup'] = "

        	ºô­¶¦øªA¾¹¥i¥H¦Û°ÊÀË´ú¨ì¥D¾÷¦W,¦ý¬O¤@¨Ç±¡ªp¤U¦¹¿ï¶µ¬OÃö³¬ªº.

		¦pªG±z·Q¦bµo°e­­¨î¤¤¨Ï¥Î³X°ÝªÌªº¥D¾÷¦W«H®§©M/©Î«O¦s¦¹²Î­p¼Æ¾Ú,

		¨Ã¥B¦øªA¾¹¨S¦³´£¨Ñ¦¹«H®§,±z»Ý­n¥´¶}¦¹¿ï¶µ.

		¤Ï¦V°ì¦W¬d¸ß»Ý­n¤@©wªº®É¶¡,¥i¯à´îºC¼s§iµo°eªº³t«×.

		";

		

$GLOBALS['phpAds_hlp_proxy_lookup'] = "

		¤@¨Ç¥Î¤á¨Ï¥Î¥N²z¦øªA¾¹¨Ó³X°Ý¤¬Ápºô.¦b¦¹±¡ªp¤U,".$phpAds_productname."±N°O¿ý¥N²z¦øªA¾¹ªºIP¦a§}©ÎªÌ¥D¾÷¦W,

		¦Ó¤£¬O¥Î¤áªº. ¦pªG±z±Ò¥Î¦¹¿ï¶µ,".$phpAds_productname."±N¬d§ä³q¹L¥N²z¦øªA¾¹¤Wºôªº¥Î¤áªº¯u¹êIP¦a§}©M¥D¾÷¦W. 

		¦pªG¤£¯à§ä¨ì¥Î¤áªº¯u¹ê¦a§},´N¨Ï¥Î¥N²z¦øªA¾¹ªº¦a§}.¦¹¿ï¶µ¤º©w¨Ã¨S¦³±Ò¥Î,¦]¬°¥i¯à·|´îºC¼s§iµo°eªº³t«×.

		";

				

$GLOBALS['phpAds_hlp_auto_clean_tables'] = 

$GLOBALS['phpAds_hlp_auto_clean_tables_interval'] = "

		¦pªG±z±Ò¥Î¦¹¿ï¶µ,¶W¹L±z¦b¦¹¿ï¾Ü®Ø¤U­±«ü©w®É¶¡ªº²Î­p¼Æ¾Ú±N³Q¦Û°Ê§R°£.

		¨Ò¦p,¦pªG±z³]¸m¬°5­Ó¬P´Á,¨º»ò5­Ó¬P´Á¤§«eªº²Î­p¼Æ¾Ú±N³Q¦Û°Ê§R°£.

		";

		

$GLOBALS['phpAds_hlp_auto_clean_userlog'] = 

$GLOBALS['phpAds_hlp_auto_clean_userlog_interval'] = "

		¦pªG±z±Ò¥Î¦¹¿ï¶µ,¶W¹L±z¦b¦¹¿ï¾Ü®Ø¤U­±«ü©w®É¶¡ªº¥Î¤á°O¿ý±N³Q¦Û°Ê§R°£.

		¨Ò¦p,¦pªG±z³]¸m¬°5­Ó¬P´Á,¨º»ò5­Ó¬P´Á¤§«eªº¥Î¤á°O¿ý±N³Q¦Û°Ê§R°£.

		";

		

$GLOBALS['phpAds_hlp_geotracking_type'] = substr("

		Geotargeting¤¹³\ ", 0, -1).$phpAds_productname."§â³X°ÝªÌªºIP¦a§}Âà´«¦¨¦a²z«H®§.

		±z¥i¥H¦b¦¹«H®§ªº°òÂ¦¤W³]¸mµo°e­­¨î,©ÎªÌ±z¥i¥H«O¦s¦¹«H®§¨Ó¬d¬Ý

		­þ­Ó°ê®a¦³³Ì¦hªº¼s§iµo°e©MÂIÀ»²v.

		¦pªG±z·Q±Ò¥Îgeotargeting,±z»Ý­n¿ï¾Ü±z²{¦³ªº¸ê®Æ®wÃþ«¬.

		".$phpAds_productname."²{¦b¤ä«ùIP2Country 

		©M <a href='http://www.maxmind.com/?rId=phpadsnew2' target='_blank'>GeoIP</a> ¸ê®Æ®w.

		";

		

$GLOBALS['phpAds_hlp_geotracking_location'] = "

		°£«D±z¨Ï¥ÎGeoIPªºApache¼Ò¶ô, §_«h±zÀ³¸Ó§i¶D".$phpAds_productname."

		geotargeting¸ê®Æ®wªº¦ì¸m. ±j¯P±ÀÂË§â¦¹¸ê®Æ®w©ñ¨ìºô­¶¦øªA¾¹ªº¤åÀÉ¥Ø¿ý¥~­±,

		§_«hªº¸Ü¨ä¥L¤H¥i¥Hª½±µ¤U¸ü¦¹¸ê®Æ®w.

		";

		

$GLOBALS['phpAds_hlp_geotracking_cookie'] = "

		§âIP¦a§}Âà´«¦¨¦a²z«H®§»Ý­n¤@©wªº®É¶¡.

		¬°¤F¨¾¤î".$phpAds_productname."¦b¨C­Ó¼s§iµo°eªº®É­Ô³£¶i¦æÂà´«,

		¥i¥H§âµ²ªG«O¦s¦bcookie¤¤. ¦pªG³o­Ócookie¤w¸g¦s¦b,

		".$phpAds_productname."±Nª½±µ¨Ï¥Î¦¹«H®§¦Ó¤£¥Î¦AÂà´«IP.

		";

		



$GLOBALS['phpAds_hlp_ignore_hosts'] = "

        ¦pªG±z¤£·Q°O¿ý¯S©w­pºâ¾÷ªº³X°Ý¼Æ©MÂIÀ»¼Æ,±z¥i¥H§â¥L­Ì¥[¤J¦¹¦Cªí. ¦pªG±z±Ò¥Î¤F¤Ï¦V°ì¦W¬d¸ß,

		±z¥i¥H²K¥[°ì¦W©MIP¦a§},§_«h±z¥u¯à¨Ï¥ÎIP¦a§}. ±z¤]¥i¥H¨Ï¥Î³q°t²Å(¤]´N¬O'*.altavista.com'©ÎªÌ'192.168.*').

		";

		

$GLOBALS['phpAds_hlp_begin_of_week'] = "

        ¹ï«Ü¦h¤H¨Ó»¡¬P´Á¤@¬O¤@©Pªº¶}©l,¦ý¬O±z¥i¥H³]¸m¬P´Á¤Ñ§@¬°¤@©Pªº¶}©l.

		";

		

$GLOBALS['phpAds_hlp_percentage_decimals'] = "

        «ü©wÅã¥Ü²Î­p¼Æ¾Úªº­¶­±ªº¼Æ¾Úºë½T¨ì¤p¼ÆÂI¤§«á´X¦ì.

		";

		

$GLOBALS['phpAds_hlp_warn_admin'] = "

        ¦pªG¤@­Ó¶µ¥Ø¥u³Ñ¤U¦³­­ªº³X°Ý¼Æ©MÂIÀ»¼Æ¦s¶q,".$phpAds_productname." ¯à°÷µo¹q¤l¶l¥ó¨Ó´£¿ô±z.¦¹¿ï¶µ¤º©w¬O¥´¶}ªº.

		";

		

$GLOBALS['phpAds_hlp_warn_client'] = "

        ¦pªG¤@­Ó«È¤áªº¬Y­Ó¶µ¥Ø¥u³Ñ¤U¦³­­ªº³X°Ý¼Æ©MÂIÀ»¼Æ¦s¶q".$phpAds_productname."¯à°÷µo¹q¤l¶l¥ó¨Ó´£¿ô«È¤á.¦¹¿ï¶µ¤º©w¬O¥´¶}ªº.

		";

		

$GLOBALS['phpAds_hlp_qmail_patch'] = "

		qmailªº¤@¨Çª©¥»¦]¬°¨ü¨ì¤@­Óbugªº¼vÅT,³y¦¨".$phpAds_productname."µo°eªº¹q¤l¶l¥ó¦b¶l¥óªº¤º®e¸Ì­±Åã¥Ü¶l¥óÀY.

		¦pªG±z±Ò¥Î¦¹¿ï¶µ,".$phpAds_productname."±N¨Ï¥Îqmail­Ý®e®æ¦¡¨Óµo°e¹q¤l¶l¥ó.

		";

		

$GLOBALS['phpAds_hlp_warn_limit'] = "

        ".$phpAds_productname."¶}©lµo°eÄµ§i¹q¤l¶l¥óªº»Ö­È,¤º©w¬O100.

		";

		

$GLOBALS['phpAds_hlp_allow_invocation_plain'] = 

$GLOBALS['phpAds_hlp_allow_invocation_js'] = 

$GLOBALS['phpAds_hlp_allow_invocation_frame'] = 

$GLOBALS['phpAds_hlp_allow_invocation_xmlrpc'] = 

$GLOBALS['phpAds_hlp_allow_invocation_local'] = 

$GLOBALS['phpAds_hlp_allow_invocation_interstitial'] = 

$GLOBALS['phpAds_hlp_allow_invocation_popup'] = "

		³o¨Ç³]¸m¹B¦æ±z±±¨î¤¹³\¨Ï¥Îªº½Õ¥Î¤è¦¡.¦pªG¬Y­Ó½Õ¥Î¤è¦¡°±¥Î,±N¤£¦A¥X²{¦b½Õ¥Î¥N½X/¼s§i¥N½X²£¥Í­¶­±.

		­«­n:½Õ¥Î¤è¦¡¦pªG°±¥Î«á±NÄ~Äò¤u§@,´N¬O»¡­ì¦³ªº¥N½XÁÙ¬O¥i¥HÄ~Äò¨Ï¥Î,

		¥u¬O¦b²£¥Í½Õ¥Î¥N½Xªº®É­Ô¤£¯à¨Ï¥Î.

		";

		

$GLOBALS['phpAds_hlp_con_key'] = "

        ".$phpAds_productname."¥]§t¤@­Ó¨Ï¥Îª½±µ¿ï¨ú¤è¦¡ªº±j¤jªº¼s§i¿ï¾Ü¨t²Î.

		§ó¦h¸Ô²Óªº«H®§½Ð°Ñ¦Ò¥Î¤á¤â¥U. ³q¹L¦¹¿ï¶µ,±z¥i¥H±Ò¥Î±ø¥óÃöÁä¦r.³o­Ó¿ï¶µ¤º©w¬O¥´¶}ªº.

		";

		

$GLOBALS['phpAds_hlp_mult_key'] = "

        ¦pªG±z¥¿¦b¨Ï¥Îª½±µ¿ï¨ú¤è¦¡¨ÓÅã¥Ü¼s§i,±z¥i¥H¬°¨C­Ó¼s§i«ü©w¤@­Ó©Î¦h­ÓÃöÁä¦r.

		µ¶µÁ±z·Q«ü©w¦h­ÓÃöÁä¦r,¥²¶·±Ò¥Î¦¹¿ï¶µ.³o­Ó¿ï¶µ¤º©w¬O¥´¶}ªº.

		";

		

$GLOBALS['phpAds_hlp_acl'] = "

        ¦pªG±z¨S¦³¨Ï¥Îµo°e­­¨î¿ï¶µ,±z¥i¥HÃö³¬¦¹¿ï¶µ,³o±N¨Ï".$phpAds_productname."³t«×µy·L¥[§Ö.

		";

		

$GLOBALS['phpAds_hlp_default_banner_url'] = 

$GLOBALS['phpAds_hlp_default_banner_target'] = "

        ¦pªG".$phpAds_productname."¤£¯à³s±µ¨ì¸ê®Æ®w¦øªA¾¹,©ÎªÌ¤£¯à§ä¨ì²Å¦Xªº¼s§i,¦p¸ê®Æ®w±Y¼ì©ÎªÌ³Q§R°£,

		±N¤£Åã¥Ü¥ô¦óªF¦è.¤@¨Ç¥Î¤á¥i¯à·Q¦b³oºØ±¡ªp¤U¨ÓÅã¥Ü¤@­Ó«ü©wªº¤º©w¼s§i.¦¹«ü©wªº¤º©w¼s§i±N¤£³Q°O¿ý,

		¦pªG¸ê®Æ®w¤¤¤´ÂÂ¦³±Ò¥Îªº¼s§i,¦¹«ü©wªº¤º©w¼s§i¤]±N¤£³Q¨Ï¥Î.³o­Ó¿ï¶µ¤º©w¬OÃö³¬ªº.

		";

			

$GLOBALS['phpAds_hlp_delivery_caching'] = "

		¬°¤FÀ°§U´£°ª¼s§iµo°eªº³t«×,".$phpAds_productname."¨Ï¥Î¤F½w¦s,uses a cache which includes all

		½w¦s¤¤¥]§t¤Fµo°e¤@­Ó¼s§iµ¹§Aªººô¯¸³X°ÝªÌªº©Ò¦³»Ý­nªº«H®§.he information needed to delivery the banner to the visitor of your website. The delivery

		³o­Óµo°e½w¦s°Ï¤º©w¬O¦s©ñ¦b¸ê®Æ®w¸Ì,¬°¤F¶i¤@¨B´£°ª³t«×,

		¥¦¤]¥i¥H¦s©ñ¦b¤@­Ó¤å¥ó©ÎªÌ¦@¨É¤º¦s¤¤.

		¦@¨É¤º¦s¬O³Ì§Öªº,¤å¥ó¤]¬O«Ü§Öªº. «ØÄ³¤£­nÃö³¬¦¹½w¦s°Ï, 

		¦]¬°·|¹ï©Ê¯à¼vÅT·¥¤j.

		";

		

$GLOBALS['phpAds_hlp_type_sql_allow'] = 

$GLOBALS['phpAds_hlp_type_web_allow'] = 

$GLOBALS['phpAds_hlp_type_url_allow'] = 

$GLOBALS['phpAds_hlp_type_html_allow'] = 

$GLOBALS['phpAds_hlp_type_txt_allow'] = "

        ".$phpAds_productname."¥i¥H¨Ï¥Î¤£¦PÃþ«¬ªº¼s§i,¥Î¤£¦Pªº¤è¦¡¦s©ñ¼s§i.ÀY¨â­Ó¿ï¶µ¥Î¨Ó¦b¥»¦a¦s©ñ¼s§i.

		±z¥i¥H¨Ï¥ÎºÞ²z­û¬É­±¨Ó¤W¶Ç¼s§i,".$phpAds_productname."±N¦bSQL¸ê®Æ®w©ÎªÌºô­¶¦øªA¾¹¤W¦s©ñ¼s§i.

		§A¤]¥i¥H§â¼s§i¦s©ñ¦b¥~³¡ºô­¶¦øªA¾¹,©ÎªÌ¨Ï¥ÎHTML©ÎÂ²³æ¤å¦r¨Ó¥Í¦¨¼s§i.

		";

		

$GLOBALS['phpAds_hlp_type_web_mode'] = "

        ¦pªG±z·Q¨Ï¥Î¦s©ñ¦bºô­¶¦øªA¾¹¤Wªº¼s§i,±z»Ý­n°t¸m¦¹³]¸m.¦pªG±z·Q¦b¥»¦a¥Ø¿ý¦s©ñ¼s§i,§â¦¹¿ï¶µ³]¸m¬°<i>¥»¦a¥Ø¿ý</i>.

		¦pªG±z·Q§â¼s§i¦s©ñ¨ì¥~ÃäFTP¦øªA¾¹¤W,§â¦¹¿ï¶µ³]¸m¬°<i>¥~³¡FTP¦øªA¾¹</i>.

		¦b¤@¨Ç¯S©wªººô­¶¦øªA¾¹¤W,±z¥i¯à¬Æ¦Ü·Q¦b¥»¦aªººô­¶¦øªA¾¹¤W¨Ï¥ÎFTP¿ï¶µ.

		";

		

$GLOBALS['phpAds_hlp_type_web_dir'] = "

        «ü©w¤@­Ó¥Ø¿ý,".$phpAds_productname."»Ý­n§â¤W¶Çªº¼s§i½Æ»s¨ì¦¹¥Ø¿ý.¦¹¥Ø¿ýPHP¥²¶·¦³¼gÅv­­,

		´N¬O»¡±z¥i¯à»Ý­n­×§ï¦¹¥Ø¿ýªºUNIXÅv­­(chmod).«ü©wªº¥Ø¿ý¥²¶·¦bºô­¶¦øªA¾¹ªº'¤åÀÉ®Ú¥Ø¿ý'¤U,

		ºô­¶¦øªA¾¹¥²¶·¥i¥Hª½±µµo§G¦¹¤å¥ó.¤£­n«ü©wµ²§Àªº±×½u(/).±z¶È¦b§â¦s©ñ¤è¦¡³]¸m¬°<i>¥»¦a¥Ø¿ý</i>®É¤~»Ý­n°t¸m¦¹¿ï¶µ.

		";

		

$GLOBALS['phpAds_hlp_type_web_ftp_host'] = "

		¦pªG±z³]¸m¦s©ñ¤è¦¡¬°<i>¥~³¡FTP¦øªA¾¹</i>,±z»Ý­n«ü©wFTP¦øªA¾¹ªºIP¦a§}©ÎªÌ°ì¦W,¥H¨Ï".$phpAds_productname."

		¯à°÷§â¤W¶Çªº¼s§i½Æ»s¨ì¦¹¦øªA¾¹¤W.

		";

      

$GLOBALS['phpAds_hlp_type_web_ftp_path'] = "

		¦pªG±z³]¸m¦s©ñ¤è¦¡¬°<i>¥~³¡FTP¦øªA¾¹</i>,±z»Ý­n«ü©w¥~³¡FTP¦øªA¾¹ªº¥Ø¿ý,¥H¨Ï".$phpAds_productname."

		¯à°÷§â¤W¶Çªº¼s§i½Æ»s¨ì¦¹¥Ø¿ý.

		";

      

$GLOBALS['phpAds_hlp_type_web_ftp_user'] = "

		¦pªG±z³]¸m¦s©ñ¤è¦¡¬°<i>¥~³¡FTP¦øªA¾¹</i>,±z»Ý­n«ü©w¥~³¡FTP¦øªA¾¹ªº¥Î¤á¦W,¥H¨Ï".$phpAds_productname."

		¯à°÷³s±µ¨ì¥~³¡FTP¦øªA¾¹.

		";

      

$GLOBALS['phpAds_hlp_type_web_ftp_password'] = "

		¦pªG±z³]¸m¦s©ñ¤è¦¡¬°<i>¥~³¡FTP¦øªA¾¹</i>,±z»Ý­n«ü©w¥~³¡FTP¦øªA¾¹ªº±K½X,¥H¨Ï".$phpAds_productname."

		¯à°÷³s±µ¨ì¥~³¡FTP¦øªA¾¹.

		";

      

$GLOBALS['phpAds_hlp_type_web_url'] = "

        ¦pªG±z¦bºô­¶¦øªA¾¹¤W¦s©ñ¼s§i,".$phpAds_productname."»Ý­nª¾¹D¤U­±±z«ü©wªº¥Ø¿ýªº¤½¶}ªº³X°Ý¦a§}.

		¤£­n«ü©wµ²§Àªº±×½u(/).

		";

		

$GLOBALS['phpAds_hlp_type_html_auto'] = "

        ¦pªG¥´¶}¦¹¿ï¶µ,".$phpAds_productname."±N¦Û°Ê­×§ïHTML¼s§i¥N½X¥H°O¿ýÂIÀ»¼Æ.

		¦ý¬O§Y¨Ï¦¹¿ï¶µ¥´¶},¤´µM¥i¥H¹ï¨C­Ó¼s§i°±¥Î¦¹¥\¯à. 

		";

		

$GLOBALS['phpAds_hlp_type_html_php'] = "

        ¥i¥H¨Ï".$phpAds_productname."¦bHTML¼s§i¥N½X¤¤°õ¦æPHP¥N½X,¦¹¿ï¶µ¤º©w¬OÃö³¬ªº.

		";

		

$GLOBALS['phpAds_hlp_admin'] = "

        ½Ð¿é¤JºÞ²z­ûªº¥Î¤á¦W. ³q¹L¦¹¥Î¤á¦W±z¥i¥Hµn¿ý¨ìºÞ²z­û¬É­±.

		";

		

$GLOBALS['phpAds_hlp_admin_pw'] =

$GLOBALS['phpAds_hlp_admin_pw2'] = "

        ½Ð¿é¤JºÞ²z­ûªº±K½X. ³q¹L¦¹¥Î¤á¦W±z¥i¥Hµn¿ý¨ìºÞ²z­û¬É­±.±z»Ý­n¿é¤J¨â¦¸¥H§K¿é¤J¿ù»~.

		";

		

$GLOBALS['phpAds_hlp_pwold'] = 

$GLOBALS['phpAds_hlp_pw'] = 

$GLOBALS['phpAds_hlp_pw2'] = "

        ­×§ïÂÂ±K½X,±z»Ý­n¦b¤W­±¿é¤JÂÂ±K½X. §A¤]»Ý­n¿é¤J·s±K½X¨â¦¸,¥HÁ×§K¿é¤J¿ù»~.

		";

		

$GLOBALS['phpAds_hlp_admin_fullname'] = "

        «ü©wºÞ²z­ûªº¥þ¦W,¥Î¨Ó³q¹L¹q¤l¶l¥óµo°e²Î­p³øªí.

		";

		

$GLOBALS['phpAds_hlp_admin_email'] = "

        ºÞ²z­ûªº¹q¤l¶l¥ó¦a§},¥Î¨Ó§@¬°µo«H¤H¦a§}³q¹L¹q¤l¶l¥óµo°e²Î­p³øªí.

		";

		

$GLOBALS['phpAds_hlp_admin_email_headers'] = "

        ±z¥i¥H­×§ï".$phpAds_productname."µo°e¹q¤l¶l¥óªº¶l¥óÀY.

		";

		

$GLOBALS['phpAds_hlp_admin_novice'] = "

        ¦pªG±z·Q¦b§R°£«È¤á,¶µ¥Ø,¼s§i,µo§GªÌ©Mª©¦ìªº®É­Ô±o¨ì¤@­ÓÄµ§i«H®§,³]¸m¦¹¿ï¶µ¬°true.

		";

		

$GLOBALS['phpAds_hlp_client_welcome'] = "

		¦pªG¥´¶}¦¹¿ï¶µ,¨C­Ó«È¤áµn¿ý«áªº­º­¶±NÅã¥Ü¤@­ÓÅwªï«H®§.±z¥i¥H³q¹L­×§ïadmin/templates¥Ø¿ý¤Uªº

		welcome.html¤å¥ó¨Ó­×§ï¦¹«H®§.±z¥i¯à·Q­n¥]¬Aªº«H®§¦p:±z¤½¥qªº¦W¦r,ÁpÃ´«H®§,±z¤½¥qªº¹Ï¼Ð,¤@­Ó¼s§i»ù®æ­¶­±Ãì±µµ¥.

		";



$GLOBALS['phpAds_hlp_client_welcome_msg'] = "

		¥N´À½s¿èwelcome.html¤å¥ó,±z¥i¥H¦b³o¸Ì«ü©w¤@¨Ç¤å¦r.¦pªG±z¦b³o¸Ì¿é¤J¤F¤å¦r,welcome.html¤å¥ó±N³Q©¿²¤.

		³o¸Ì¤¹³\¿é¤Jhtml¼Ð°O.

		";

		

$GLOBALS['phpAds_hlp_updates_frequency'] = "

		¦pªG±z·Q¬d¬Ý".$phpAds_productname."ªºª©¥»,±z¥i¥H±Ò¥Î¦¹¿ï¶µ.¥i¥H«ü©w".$phpAds_productname."³s¨ì¤É¯Å¦øªA¾¹

		¶i¦æ¤É¯Åªº®É¶¡¶¡¹j.¦pªG§ä¨ì·sª©¥»,±N¼u¥X¥]§t¦¹¦¸¤É¯Å«H®§ªº¤@­Ó¹ï¸Ü®Ø 

		";

		

$GLOBALS['phpAds_hlp_userlog_email'] = "

		¦pªG±z·Q«O¦s".$phpAds_productname."µo°eªº©Ò¦³¹q¤l¶l¥ó«H®§ªº¤@­Ó°Æ¥»,±z¥i¥H±Ò¥Î¦¹¿ï¶µ.¹q¤l¶l¥ó«H®§±N«O¦s¦b¥Î¤á°O¿ý¸Ì.

		";

		

$GLOBALS['phpAds_hlp_userlog_priority'] = "

		¬°¤F«OÃÒÀu¥ýÅv­pºâªº¥¿½T,±z¥i¥H¬°¨C­Ó¤p®Éªº­pºâ«O¦s¤@¥÷³øªí. ³o­Ó³øªí¥]¬A¹w¦ôªº±¡ªp©M¨C­Ó¼s§i¤À°tªºÀu¥ýÅv.

		³o­Ó«H®§¦b±z·Q´£¥æ¤@­Óbug³ø§iªº®É­Ô¤ñ¸û¦³¥Î. ³o­Ó³øªí¦s©ñ¦b¥Î¤á°O¿ý¸Ì.

		";

				

$GLOBALS['phpAds_hlp_userlog_autoclean'] = "

		¬°¤F«OÃÒ¸ê®Æ®w¥¿½T§R´î,

		±z¥i¥H«O¦s¤@¥÷Ãö©ó§R´î´Á¶¡©Ò¦³µo¥Í±¡ªpªº³ø§i.

		³o­Ó«H®§±N«O¦s¦b¥Î¤á°O¿ý¤¤.

		";

		

$GLOBALS['phpAds_hlp_default_banner_weight'] = "

		¦pªG±z·Q¨Ï¥Î¤@­Ó¤º©w§ó°ªªº¼s§iÅv­È,±z¥i¥H¦b³o¸Ì«ü©w±z´Á±æªºÅv­È.³o­Ó¿ï¶µ¤º©w³]¸m¬°1.

		";

		

$GLOBALS['phpAds_hlp_default_campaign_weight'] = "

		¦pªG±z·Q¨Ï¥Î¤@­Ó¤º©w§ó°ªªº¶µ¥ØÅv­È,±z¥i¥H¦b³o¸Ì«ü©w±z´Á±æªºÅv­È.³o­Ó¿ï¶µ¤º©w³]¸m¬°1.

		";

		

$GLOBALS['phpAds_hlp_gui_show_campaign_info'] = "

		¦pªG¥´¶}¦¹¿ï¶µ,¨C­Ó¶µ¥ØªºÃB¥~ªº«H®§±N¦b<i>¶µ¥ØÁ`Äý</i>­¶­±¤WÅã¥Ü. ÃB¥~«H®§¥]¬A³X°Ý¼Æªº¦s¶q,ÂIÀ»¼Æªº¦s¶q,

		±Ò¥Î¤é´Á,¥¢®Ä¤é´Á©MÅv­È³]¸m.

		";

		

$GLOBALS['phpAds_hlp_gui_show_banner_info'] = "

		¦pªG¥´¶}¦¹¿ï¶µ,¨C­Ó¼s§iªºÃB¥~ªº«H®§±N¦b<i>¼s§iÁ`Äý</i>­¶­±¤WÅã¥Ü. ÃB¥~«H®§¥]¬A¥Ø¼ÐURL,ÃöÁä¦r,¤Ø¤o©MÅv­È.

		";

		

$GLOBALS['phpAds_hlp_gui_show_campaign_preview'] = "

		¦pªG¥´¶}¦¹¿ï¶µ,<i>¼s§iÁ`Äý</i>­¶­±±NÅã¥Ü©Ò¦³¼s§iªº¹wÄý.¦pªGÃö³¬¦¹¿ï¶µ,¦b<i>¼s§iÁ`Äý</i>­¶ÄÑÂIÀ»

		¨C­Ó¼s§i«á­±ªº¤T¨¤¹Ï¼Ð,¤]¥i¥HÅã¥Ü¨C­Ó¼s§iªº¹wÄý.

		";

		

$GLOBALS['phpAds_hlp_gui_show_banner_html'] = "

		±NÅã¥Ü¹ê»ÚªºHTML¼s§i,¦Ó¤£¬OHTML¥N½X.¦¹¿ï¶µ¤º©w¬OÃö³¬ªº,¦]¬°HTML¼s§i¥i¯à»P¥Î¤áªº¬É­±½Ä¬ð.

		¦pªGÃö³¬¦¹¿ï¶µ,ÂIÀ»HTML¥N½X«á­±ªº<i>Åã¥Ü¼s§i</i>«ö¶s,¤]¥i¥HÅã¥Ü¹ê»ÚªºHTML¼s§i.

		";

		

$GLOBALS['phpAds_hlp_gui_show_banner_preview'] = "

		¦pªG¥´¶}¦¹¿ï¶µ,¦b<i>¼s§iÄÝ©Ê</i>,<i>µo°e¿ï¶µ</i>©M<i>³s±µ¼s§i</i>­¶­±,±NÅã¥Ü¼s§iªº¹wÄý.

		¦pªGÃö³¬¦¹¿ï¶µ,ÂIÀ»­¶­±³»³¡ªº<i>Åã¥Ü¼s§i</i>«ö¶s,¤]¥i¥H¬Ý¨ì¼s§iªº¹wÄý.

		";

		

$GLOBALS['phpAds_hlp_gui_hide_inactive'] = "

		¦pªG±Ò¥Î¦¹¿ï¶µ,©Ò¦³°±¥Îªº¼s§i,¶µ¥Ø,«È¤á±N¦b<i>«È¤á&¶µ¥Ø</i>©M<i>¶µ¥ØÁ`Äý</i>­¶­±³QÁôÂÃ. 

		·í±Ò¥Î¦¹¿ï¶µ,±z¤´ÂÂ¥i¥HÂIÀ»­¶­±©³³¡ªº<i>Åã¥Ü©Ò¦³</i>«ö¶s¨Ó¬d¬ÝÁôÂÃªº±ø¥Ø.

		";

		

$GLOBALS['phpAds_hlp_gui_show_matching'] = "

		¦pªG±Ò¥Î¦¹¿ï¶µ,µM«á¿ï©w<i>¶µ¥Ø¿ï¾Ü</i>¼Ò¦¡,

		¨º»ò²Å¦X±ø¥óªº¼s§i±N¦b<i>³s±µ¼s§i</i>­¶­±Åã¥Ü.

		³o¤¹³\±z·Ç½Tª¾¹D¦pªGÃì±µ¨ì¦¹¶µ¥Ø,¨º¨Ç¼s§i¥i¥Hµo°e.

		±z¤]¥i¥H¹wÄý¤@¤U²Å¦X±ø¥óªº¼s§i.

		";

		

$GLOBALS['phpAds_hlp_gui_show_parents'] = "

		¦pªG±Ò¥Î¦¹¿ï¶µ,µM«á¿ï©w<i>¼s§i¿ï¾Ü</i>¼Ò¦¡,

		¼s§iªº¤÷¶µ¥Ø±NÅã¥Ü¦b<i>³s±µ¼s§i</i>­¶­±.

		³o¤¹³\±zª¾¹D¦b¦¹¼s§i«e­þ­Ó¶µ¥Øªº­þ­Ó¼s§i¤w¸g³s±µ¤F.

		³o·N¨ýµÛ¼s§i®Ú¾Ú¤÷¶µ¥Ø¨Ó¤À²Õ,¦Ó¤£¬O¹³¥H«e®Ú¾Ú¦r¥À¶¶§Ç±Æ§Ç.

		";

		

$GLOBALS['phpAds_hlp_gui_link_compact_limit'] = "

		¤º©w©Ò¦³¥i¥Îªº¼s§i©M¶µ¥Ø³£¦b<i>³s±µ¼s§i</i>­¶­±Åã¥Ü.

		©Ò¥H¦pªG¥Ø¿ý¤¤¦³«Ü¦h¤£¦Pªº¥i¥Î¼s§iªº¸Ü,³o­Ó­¶­±·|ÅÜªº«D±`ªø.

		³o­Ó¿ï¶µ¤¹³\±z³]¸m¦¹­¶­±³Ì¦hÅã¥Üªº±ø¥Ø.

		¦pªG¦³§ó¦h±ø¥Ø©M¤£¦P³s±µ¤è¦¡,±NÅã¥Ü¦û¥ÎªÅ¶¡³Ì¤Öªº¼s§i.

		";

		

?>

