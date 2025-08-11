-- $Id: all.sql,v 2.2.2.13 2005/06/07 10:37:28 ciaccia Exp $


-- Table structure for table 'phpads_cache'


CREATE TABLE phpads_cache (
   cacheid varchar(255) NOT NULL,
   content oid NOT NULL,
   contentsize int4 DEFAULT 0 NOT NULL,
   PRIMARY KEY (cacheid)
);


-- Table structure for table 'phpads_userlog'

CREATE TABLE phpads_userlog (
   userlogid serial NOT NULL,
   timestamp int4 DEFAULT 0 NOT NULL,
   usertype int2 DEFAULT 0 NOT NULL,
   userid int4 DEFAULT 0 NOT NULL,
   action int4 DEFAULT 0 NOT NULL,
   object int4,
   details text,
   PRIMARY KEY (userlogid)
);


-- Table structure for table 'phpads_clients'

CREATE TABLE phpads_clients (
   clientid serial NOT NULL,
   clientname varchar(255) DEFAULT '' NOT NULL,
   contact varchar(255),
   email varchar(64),
   views int4,
   clicks int4,
   clientusername varchar(64),
   clientpassword varchar(64),
   expire date,
   activate date,
   permissions int2,
   language varchar(64),
   active boolean,
   weight int2 DEFAULT 1,   
   target int4 DEFAULT 0,   
   parent int4,
   report boolean,
   reportinterval int4 DEFAULT 7,
   reportlastdate date,
   reportdeactivate boolean,
   PRIMARY KEY (clientid),
   FOREIGN KEY (parent) REFERENCES phpads_clients (clientid) ON UPDATE CASCADE ON DELETE CASCADE DEFERRABLE
);

CREATE INDEX phpads_clients_parent_idx ON phpads_clients (parent);


-- Table structure for table 'phpads_images'

CREATE TABLE phpads_images (
   filename varchar(128) NOT NULL,
   contents oid NOT NULL,
   t_stamp timestamp,
   PRIMARY KEY (filename)
);


-- Table structure for table 'phpads_banners'

CREATE TABLE phpads_banners (
   bannerid serial NOT NULL,
   clientid int4 DEFAULT 0 NOT NULL,
   active boolean DEFAULT 't' NOT NULL,
   priority int4 DEFAULT 0 NOT NULL,
   contenttype varchar(4) DEFAULT 'gif' NOT NULL,
   pluginversion int4 DEFAULT 0 NOT NULL,
   storagetype varchar(10) DEFAULT 'sql' NOT NULL,
   filename varchar(255) DEFAULT '' NOT NULL,
   imageurl varchar(255) DEFAULT '' NOT NULL,
   htmltemplate text DEFAULT '' NOT NULL,
   htmlcache text DEFAULT '' NOT NULL,
   width int2 DEFAULT 0 NOT NULL,
   height int2 DEFAULT 0 NOT NULL,
   weight int2 DEFAULT 1 NOT NULL,
   seq int2 DEFAULT 0 NOT NULL,
   target varchar(24) DEFAULT '' NOT NULL,
   url varchar(255) DEFAULT '' NOT NULL,
   alt varchar(255) DEFAULT '' NOT NULL,
   status varchar(255) DEFAULT '' NOT NULL,
   keyword varchar(255) DEFAULT '' NOT NULL,
   bannertext text DEFAULT '' NOT NULL,
   description varchar(255) DEFAULT '' NOT NULL,
   autohtml boolean DEFAULT 't' NOT NULL,
   block int4 DEFAULT 0 NOT NULL,
   capping int4 DEFAULT 0 NOT NULL,
   compiledlimitation text DEFAULT '' NOT NULL,
   append text DEFAULT '' NOT NULL,
   appendtype int2 DEFAULT 0 NOT NULL,
   bannertype int2 DEFAULT 0 NOT NULL,
   transparent boolean DEFAULT 'f' NOT NULL,
   PRIMARY KEY (bannerid),
   FOREIGN KEY (clientid) REFERENCES phpads_clients (clientid) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE INDEX phpads_banners_clientid_idx ON phpads_banners (clientid);


-- Table structure for table 'phpads_affiliates'

CREATE TABLE phpads_affiliates (
   affiliateid serial NOT NULL AUTO_INCREMENT,
   name varchar(255) DEFAULT '' NOT NULL,
   website varchar(255),
   contact varchar(255),
   email varchar(64) DEFAULT '' NOT NULL,
   username varchar(64),
   password varchar(64),
   permissions int2,
   language varchar(64),
   publiczones boolean DEFAULT 'f' NOT NULL,
   PRIMARY KEY (affiliateid)
);


-- Table structure for table 'phpads_zones'

CREATE TABLE phpads_zones (
   zoneid serial NOT NULL,
   affiliateid int4,
   zonename varchar(255) DEFAULT '' NOT NULL,
   description varchar(255) DEFAULT '' NOT NULL,
   delivery int2 DEFAULT 0 NOT NULL,
   zonetype int2 DEFAULT 0 NOT NULL,
   what text DEFAULT '' NOT NULL,
   width int2 DEFAULT 0 NOT NULL,
   height int2 DEFAULT 0 NOT NULL,
   chain text DEFAULT '' NOT NULL,
   prepend text DEFAULT '' NOT NULL,
   append text DEFAULT '' NOT NULL,
   appendtype int2 DEFAULT 0 NOT NULL,
   PRIMARY KEY (zoneid),
   FOREIGN KEY (affiliateid) REFERENCES phpads_affiliates (affiliateid) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE INDEX phpads_zones_affiliateid_idx ON phpads_zones (affiliateid);
CREATE INDEX phpads_zones_zonename_zoneid_idx ON phpads_zones (zonename,zoneid);


-- Table structure for table 'phpads_adclicks'

CREATE TABLE phpads_adclicks (
   bannerid int4 DEFAULT 0 NOT NULL,
   zoneid int4 DEFAULT 0 NOT NULL,
   t_stamp timestamp DEFAULT NOW() NOT NULL,
   host varchar(255) DEFAULT '' NOT NULL,
   source varchar(50) DEFAULT '' NOT NULL,
   country varchar(2) DEFAULT '' NOT NULL
);

CREATE INDEX phpads_adclicks_bid_date_idx ON phpads_adclicks (bannerid,t_stamp);
CREATE INDEX phpads_adclicks_date_idx ON phpads_adclicks (t_stamp);
CREATE INDEX phpads_adclicks_zoneid_idx ON phpads_adclicks (zoneid);


-- Table structure for table 'phpads_adviews'

CREATE TABLE phpads_adviews (
   bannerid int4 DEFAULT 0 NOT NULL,
   zoneid int4 DEFAULT 0 NOT NULL,
   t_stamp timestamp DEFAULT NOW() NOT NULL,
   host varchar(255) DEFAULT '' NOT NULL,
   source varchar(50) DEFAULT '' NOT NULL,
   country varchar(2) DEFAULT '' NOT NULL
);

CREATE INDEX phpads_adviews_bid_date_idx ON phpads_adviews (bannerid,t_stamp);
CREATE INDEX phpads_adviews_date_idx ON phpads_adviews (t_stamp);
CREATE INDEX phpads_adviews_zoneid_idx ON phpads_adviews (zoneid);

-- Table structure for table 'phpads_acls'

CREATE TABLE phpads_acls (
   bannerid int4 DEFAULT 0 NOT NULL,
   logical varchar(3) DEFAULT 'and' NOT NULL,
   type varchar(16) DEFAULT '' NOT NULL,
   comparison varchar(2) DEFAULT '==' NOT NULL,
   executionorder int4 DEFAULT '0' NOT NULL,
   data text NOT NULL,
   UNIQUE (bannerid,executionorder),
   FOREIGN KEY (bannerid) REFERENCES phpads_banners (bannerid) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE INDEX phpads_acls_bannerid_idx ON phpads_acls (bannerid);


-- Table structure for table 'phpads_adstats'

CREATE TABLE phpads_adstats (
   views int4 DEFAULT 0 NOT NULL,
   clicks int4 DEFAULT 0 NOT NULL,
   day date DEFAULT NOW() NOT NULL,
   hour int4 DEFAULT 0 NOT NULL,
   bannerid int4 DEFAULT 0 NOT NULL,
   zoneid int4 DEFAULT 0 NOT NULL,
   source varchar(50) DEFAULT '' NOT NULL,
   PRIMARY KEY (day,hour,bannerid,zoneid,source)
);

CREATE INDEX phpads_adstats_bid_day_idx ON phpads_adstats (bannerid,day);
CREATE INDEX phpads_adstats_zoneid_idx ON phpads_adstats (zoneid);


-- Table structure for table 'phpads_session'

CREATE TABLE phpads_session (
   sessionid varchar(32) DEFAULT '' NOT NULL,
   sessiondata text DEFAULT '' NOT NULL,
   lastused timestamp DEFAULT NOW() NOT NULL,
   PRIMARY KEY (sessionid)
);


-- Table structure for table 'phpads_targetstats'

CREATE TABLE phpads_targetstats (
   day date DEFAULT NOW() NOT NULL,
   clientid int4 DEFAULT 0 NOT NULL,
   target int4 DEFAULT 0 NOT NULL,
   views int4 DEFAULT 0 NOT NULL,
   modified int2 DEFAULT 0 NOT NULL,
   PRIMARY KEY (day,clientid)
);


-- Table structure for table 'phpads_config'

CREATE TABLE phpads_config (
   configid int4 NOT NULL DEFAULT 0,
   config_version float4 NOT NULL,
   my_header text NOT NULL DEFAULT '',
   my_footer text NOT NULL DEFAULT '',
   table_border_color char(7) NOT NULL DEFAULT '#000099',
   table_back_color char(7) NOT NULL DEFAULT '#CCCCCC',
   table_back_color_alternative char(7) NOT NULL DEFAULT '#F7F7F7',
   main_back_color char(7) NOT NULL DEFAULT '#FFFFFF',
   language varchar(32) NOT NULL DEFAULT 'english',
   name varchar(32) NOT NULL DEFAULT '',
   company_name varchar(255) NOT NULL DEFAULT 'mysite.com',
   override_gd_imageformat varchar(4) NOT NULL DEFAULT '',
   begin_of_week int2 NOT NULL DEFAULT 1,
   percentage_decimals int2 NOT NULL DEFAULT 2,
   type_sql_allow boolean NOT NULL DEFAULT 't',
   type_url_allow boolean NOT NULL DEFAULT 't',
   type_web_allow boolean NOT NULL DEFAULT 'f',
   type_html_allow boolean NOT NULL DEFAULT 't',
   type_txt_allow boolean NOT NULL DEFAULT 't',
   type_web_mode int2 NOT NULL DEFAULT 0,
   type_web_url varchar(255) NOT NULL DEFAULT '',
   type_web_dir varchar(255) NOT NULL DEFAULT '',
   type_web_ftp varchar(255) NOT NULL DEFAULT '',
   admin varchar(64) NOT NULL DEFAULT 'phpadsuser',
   admin_pw varchar(64) NOT NULL DEFAULT 'phpadspass',
   admin_fullname varchar(255) NOT NULL DEFAULT 'Your Name',
   admin_email varchar(64) NOT NULL DEFAULT 'your@email.com',
   admin_email_headers varchar(64) NOT NULL DEFAULT '',
   admin_novice boolean NOT NULL DEFAULT 't',
   default_banner_weight int2 NOT NULL DEFAULT '1',
   default_campaign_weight int2 NOT NULL DEFAULT '1',
   client_welcome boolean NOT NULL DEFAULT 't',
   client_welcome_msg text NOT NULL DEFAULT '',
   content_gzip_compression boolean NOT NULL DEFAULT 'f',
   userlog_email boolean NOT NULL DEFAULT 't',
   userlog_priority boolean NOT NULL DEFAULT 't',
   userlog_autoclean boolean NOT NULL DEFAULT 't',
   gui_show_campaign_info boolean NOT NULL DEFAULT 't',
   gui_show_campaign_preview boolean NOT NULL DEFAULT 'f',
   gui_show_banner_info boolean NOT NULL DEFAULT 't',
   gui_show_banner_preview boolean NOT NULL DEFAULT 't',
   gui_show_banner_html boolean NOT NULL DEFAULT 'f',
   gui_show_matching boolean NOT NULL DEFAULT 't',
   gui_show_parents boolean NOT NULL DEFAULT 'f',
   gui_hide_inactive boolean NOT NULL DEFAULT 'f',
   gui_link_compact_limit int4 NOT NULL DEFAULT '50',
   qmail_patch boolean NOT NULL DEFAULT 'f',
   updates_frequency int2 NOT NULL DEFAULT 7,
   updates_timestamp int4 NOT NULL DEFAULT 0,
   updates_last_seen float4 NOT NULL DEFAULT 0,
   updates_dev_builds boolean NOT NULL DEFAULT 'f',
   allow_invocation_plain boolean NOT NULL DEFAULT 'f',
   allow_invocation_js boolean NOT NULL DEFAULT 't',
   allow_invocation_frame boolean NOT NULL DEFAULT 'f',
   allow_invocation_xmlrpc boolean NOT NULL DEFAULT 'f',
   allow_invocation_local boolean NOT NULL DEFAULT 't',
   allow_invocation_interstitial boolean NOT NULL DEFAULT 't',
   allow_invocation_popup boolean NOT NULL DEFAULT 't',
   auto_clean_tables boolean NOT NULL DEFAULT 'f',
   auto_clean_tables_interval int2 NOT NULL DEFAULT 5,
   auto_clean_userlog boolean NOT NULL DEFAULT 'f',
   auto_clean_userlog_interval int2 NOT NULL DEFAULT 5,
   auto_clean_tables_vacuum boolean NOT NULL DEFAULT 't',
   autotarget_factor float NOT NULL DEFAULT -1,
   maintenance_timestamp int4 NOT NULL DEFAULT '0',
   PRIMARY KEY (configid)
);
