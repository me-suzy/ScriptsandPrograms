Almond Classifieds. Classified Ads Script.
 

Steps for setting up Almond Classifieds  on your Web-server: 

Keep in mind: some features described below are not available
for "Almond Classified (Free Edition)". Visit pages
http://www.almondsoft.com/alcl.html and 
http://www.almondsoft.com/alclfree.html
to see differences between free and commerce versions.

 Unzip your loaded zip file; 

 "Configuring your Web Server" 

1. Create a new directory under the html directory of your Web server where
      photo files and files with more detailed ad info will be kept. For example,
      /home/httpd/html/photos
    (we prefer, to create such directory inside directory where 
      placed classifieds .php files )
2. Make permission 777 for this  directory by chmod command. 


"Setting up the config.php file" 

Go through  config.php file and set up the 
following variables only: 

1. Set up MySQL database parameters:
Database name ( $db_name ), hostname ( $host_name ), 
user name ($db_user), password ($password).
These parameters you can ask in your web site hosting company.
Also choose name for database table ($table_ads) where ads 
entries will be saved.
 
2. Set the base of the path to the directory where 
   photo files and files with more detailed ad info will be kept. 
    e.g.  $photopath="/home/httpd/html/photos/"; 
    (if you have create photos directory named "photos" inside
     directory with .php files you can set up relative  path $photopath="photos/" , as
     it made in our default settings in config.php file ).    
3.  Set the base to the URL of the directory where 
    photo files and files with more detailed ad info will be kept.
    e.g.  $photourl="http://www.yoursite.com/photo/";
(if you have create photos directory named "photos" inside
     directory with .php files you can set up relative  path $photourl="photos/" , as
     it made in our default settings in config.php file ).   

Do not forget about end slash "/" in the paths :) 

 "Upload Files" 

      1. Upload all script files ( .php) via ftp to your php directory, 
          You have to do this via ftp program 
          from computer with Windows system ( such as files saved in Windows text format)
          to Unix server in ASCII mode.
      2. Make permission 755 ( or 777) for these files by chmod command. 



 "Test the Script" 

Create MySQL database (with the same name as specified in config.php file ) 
by  using special web interface provided by your web site hosting company,
or via telnet by using mysqladmin utility.
After configuration, start via your browser createtb.php script for
creation classifieds table.
Input your admin password into form ( this password is set up 
in the config.php file ).
Keep in mind, script uses cookies for admin authorization ( so cookies must 
be set up in your browser) and if you have once inputed your admin password,
script will not ask you about password until you close your browser.
Cookies work during one browser session ( when you close your browser, on 
the next session you have to log in as admin again ).
Click on the link to create classifieds table, if the table is created successfully
you have to see the name of your chosen database table name  in the list of  
database tables.
  
 On your Web browser input the URL of the index.php script, for example,
 http://www.yourname.com/index.php. Script should work. 

----------------------------------------------------------------------------------

MORE DETAILED INSTRUCTIONS (these features are not available for free version ).

How to edit the ad by admin:
Go to admin.php URL in your browser, then input ad id# in the edit area,
then make editing of the ad.

How to delete ads by admin:
Go to delete area in the web admin interface ( admin.php ) , input
ads id# you need to delete, separated by commas, e.g. if you input
5,16,23-27,35,45-48
then  ads with the following id#  will be deleted:
5,16,23,24,25,26,27,35,45,46,47,48

How to moderate ads by admin:
First you have to set up variable 
$moderating="yes"
in the config.php file.
After this if some user submits ad, this ad will be placed into moderate
folder and will be not visible in the public ads index. 
Admin can click on the "moderate" link in the web admin interface area,
then browse and edit submitted ads. 
To make ads visible, admin goes to " Make ads visible/unvisible" area
and submits list of ads id# he needs to make visible in the public ads 
index. 
 e.g. if you input
5,16,23-27,35,45-48
then   ads with the following id# will become visible:
5,16,23,24,25,26,27,35,45,46,47,48
If you need to delete some ads in the moderate folder, you can submit 
ads id# for deleting in the delete admin area as described above.
If moderating option is set up and some user makes editing of his/her ad, this
ad will be placed into editing folder and only after approving by admin
with the following above way ( as for moderating folder ) this ad can appear 
in the public index. 

How to make ads invisible:
If you need to make some ads invisible for some time period 
you can submit list of ad id# of these ads to the  invisible folder,
and after some period make them visible as in the moderating case.

How to get e-mails of ad owners:
To get e-mails of ad owners, you can click on the link with category
name in the web admin interface. You will get e-mails of ad owners
of this category in the alphabetical order. You can copy this list 
for using in  mail list programs. If you click on the e-mail link you will see
the ad details page with this contact e-mail.

-----------------------------------------------------------------------------------

Once you have the script working, you can start to set up the script
 parameters according to your needs. 

 
Now you need to set up custom categories set and ad fields for each category.
 
 "Setting up the ad fields." 

      1.
        In the file  config.php you can find variable $categories with description of categories,
        variable  %ads_fields where the  description of ad fields used in all categories
         is set up,
        variable %fields_set where  the  description of specific ad fields used only 
        in some categories is set up.
        These default settings are a good example to understand the main principles 
        of setting categoreis and ads fields.
        We give you only a little explanation.
      To set up an ad field you must define 8 different parts in each field.
      Each different field within the ad is described as the following example: 
      'comp' => array('Company',"12",'keyword','20:30','text', '1','text', 'selectparam'),
where 
    'comp' -  is short name of the field (it is required for script using) ;
      'Company' = displayed name of the field. This is the name of the field
      that will appear on the form; 
      
       '12' - parameter which shows how this field will be displayed:
       '1' - only at the first page (ads index);
       '2' - only at the second page ( 'detailed info');
       '12' - on both first and second pages;
       '00' - is not displayed on pages (hidden fields). 
      'keyword' = search parameter that sets the principle of search, it must have
      one of three different values explained below: 
           'keyword' = defines this as a search field. Users will be able to search
           for keys in this field; 
           'minmax' = when field has numerical value, it will be searched in range
           [minvalue, maxvalue]; 
           'nosearch' = not a search field. No search for keys in this field; 

      '20:30' = defines the length of the input field in ad submitting form(20) and 
               max length of the info in this field (30).
       If field type ( see below) is 'textarea' at this place you will have e.g. the following:
       '40:6:2000' - where 40 - number of cols, 6 - number of rows, 2000 - max size of the field.  
       ( See our default settings in config.php ).

      'text' = type of input field, it can be 'text' or 'select', 'checkbox', 'textarea'.  
       ( See our default settings in config.php )

       "1" - means this field reqired to be filled out ("0" is not required).

      'text' - parameter means MySQL type for this field, it can be text, char(n), integer,
               real...
      'selectparam' - this last parameter can appear only for fields types
                      'select' and 'checkbox', this parameter means default values for 
                       users' choice. All values are separated by delimiter "<option>"
                      See our default settings in config.php file for fields with types
                       'select' and 'checkbox' to understand how it works.

 
The fields list should contain standard ad fields with the following short names: 
"passw" - password for ad edition;
"email" - contact e-mail;
"urlpage" - Home page URL;
"title" - Title;
"brief" - brief description;

keyword in the fields "keyword" of  the search form on the ads index page will be searched
in the ad fields with short names "title", and "brief".
 
Standart fields with short names "passw", "email", "urlpage" should have  
"00" parameter of page displaying (see above).

           To understand field descriptions look through our  default settings 
          in config.php file.
  
Warning! To avoid the coincidence of the fields short names with reserved words please
         use short names with 6-10 characters.
     Avoid the following short names for fields and categories, these words are reserved 
     script words:
               idnum, time, exptime, catname, visible, adphotos, login, 
               adrate, ed_passw, ed_id, userfile, select_text, photo_url, 
               moderating, adphotos ....
 

Each category you need is described in the variable %categories as the following example: 
      'manw' =>array("Man Looking for Woman","set1"),
       
       'manw' - is the short name of the category, with this name the script works,  
                 so it must be one whole word ;
       If you set up as short name of category  reserved words "title_1" ,
       "title_2", "title_3" ..... it means you create a new group of categories 
       (see our default settings ).  
      'Man Looking for Woman' - name of category ; 
      "set1" -  key in the variable $fields_set which are connected with list of short 
       names of the fields which will be used in this category e.g. you can find in the 
       variable $fields_set (see our default settings in config.php) the following:
             'set1' => array (title,name,age,weihgt,height,smoker,goal,brief,
              moredetails,contact_name,contact_phone,email,homeurl,passw),
        The fields will be displayed on the ad in the order  they are placed 
        in the following above case.
 
       If some categories have the same   set of fileds then they will have 
       the same   key ( in our case "set1").
 
        You also have to set up variable $allcatfields in which you have to place 
        short names of the fields which are used in all categories. It is neccessary for 
         searching ads through all categories via search form on the top page of classifieds
        ( where categories are listed ).
  
       Setting up of other variables in the config.php file is very easy. 

If you need different options for different categories, e.g. you need moderating 
feature for some category "Category 1" ( with short name "catn1" ) you 
can use "if" operator in the config.php file. E.g. you can place the following cod
in the config.php
$moderating="no";
if ($ct=="catn1") { $moderating="yes"; }


Frequency encountered problems.
Problem 1.

Submitted ads do not appear in the index or in invisible folders.

Reasons: 
1. Classifeds mysql table is not created successfully.
2. In the fields set for this category you set up short name of the field that does not
exist in the created table. Keep in mind that it is impossible to add new fields in the config file 
after you have created classifieds table in the database.
 
Problem 2.
You can submit photos but they do not appear in the index.

It can be caused by the problem with variable $photos_path.
  Keep in mind photo directory should be created inside 
your html directory and should have permission 777 ( by chmod command ).
 This problem can be also caused by incorrect url to 
the photo directory in $photos_url variable.

You can easily customize the layout of classifieds pages.
To customize ads index layout you need to customize html tags 
in the function browse_ads() (file index.php )
Ads on the index page are generated by the loop, ads layout you can change 
in the function print_ad ($row) (file index.php ).
Caption for ads table are generated by function get_ads_captions() (file index.php ).
Search form on the index page is generated by function get_search_form() (file index.php ).
To customize second ads page with details you need to customize html tags 
in the function ad_details() (details.php )
To customize top page with categories list  you need to customize html tags 
in the function print_categories() (file top.php ).
To customize add/edit form for ads you need to customize html tags 
in the function  ad_form($ed_add) (file forms.php ).
To customize privacy mail form page  you need to customize html tags 
in the  function privacy_form($idnum) (file forms.php ).
To customize layout of messages you need to customize html tags
in the  function output_message($message) (file funcs2.php )

-----------------
How to rate ads?
-----------------
 Users have the ability to click on special link "view best ads" to browse ads separated and 
 rated by admin.  
  In the admin areas you can see a place with the title "Rate ads". Submit rating you 
 need and then list of ads id# for which you have to submit this rating. After this 
 submitted ads will additionally appear under the link "Best Ads" in the order of rate,
 ads with the same rate will be placed in the order of ads adding date; link "Best ads"
 will appear on the index page if at least one ad is rated with rate 1, 2, 3,... Ads with
 rate "0" will not appear under the link "view best ads". You can also change rating for 
 some ads by re-submitting rating.  
---------------------------------------------------------------------------           

How specify additional info on the classifieds pages :
-----------------------------------------------------
In the config.php file you can set up html tags for all header and footer of all
classifieds pages  in the variables $html_header and $html_footer 
You can also specify html info for left columns for top, index, and ad deatails pages
in the following variables: $top_leftcol, $ind_leftcol, $detl_leftcol.
Keep in mind - information in the variables $top_leftcol, $ind_leftcol, $detl_leftcol 
should begin by tag <td> and finish by tag </td> ( as it specified in default settings 
in config.php file ).
------------------------------------------------------------------------------

Please read the following before using Almond Classifieds:

 LICENSE AGREEMENT. 

By using Almond Classifieds  you signify that you
accept all terms of this agreement. Purchase of one license 
of Almond Classifieds script entitles you the usage of Almond Classifieds 
script for one web site ( for a single domain  ). You may NOT 
resell, install give away or distribute by any methods this script
without purchasing an additional license for each new website.
Each next license costs half of the first license price and can be 
purchased at the following link:
 
http://www.almondsoft.com/license.html 

Each legal installation of the Almond Classifieds script should be registered
 in our database at the following link:
 
http://www.almondsoft.com/reg/reg.php
 
You may not  submit any information about this script or URL of  your 
web pages with script description to webmasters' resources or any other
 web resources, only official site http://www.almondsoft.com can offer 
and sell licenses for this script. 

You may make any modifications to the Almond Classifieds script according to
your needs for your personal usage at your own risk.
However, we will not be able to fix problems caused by your modifications. 
Modified version cannot be resold or distributed without  purchasing an 
additional license for each new website. You may  purchase additional license 
per half price of first license to install this script to your own client.
 
The small text link to http://www.almondsoft.com must remain in the 
script and appear at the footer of all web pages genarated by this script. 
 
Almond Classifieds script, including sources code, HTML layout, user 
and admin interfaces is Copyrigt © 2003 AlmondSoft.Com
and protected under international laws and treaties.
 
   
DISCLAIMER OF WARRANTY & LIMIT 
OF LIABILITY.
 
THIS SOFTWARE AND THE ACCOMPANYING FILES ARE PROVIDED
"AS IS" AND WITHOUT WARRANTIES AS TO PERFORMANCE OR 
MERCHANTABILITY OR ANY OTHER WARRANTIES WHETHER 
EXPRESSED OR IMPLIED.  NO WARRANTY OF FITNESS FOR 
A PARTICULAR PURPOSE IS OFFERED. IN NO EVENT WILL THE 
AUTHOR BE LIABLE FOR ANY SPECIAL, INCIDENTAL, INDIRECT, 
OR CONSEQUENTIAL DAMAGES WHATSOEVER (INCLUDING, BUT NOT 
LIMITED TO, DAMAGES FOR LOSS OF BUSINESS PROFITS, BUSINESS
INTERRUPTION, LOSS OF BUSINESS INFORMATION, OR ANY OTHER
PECUNIARY LOSS) ARISING OUT OF THE USE OF OR INABILITY TO 
USE THE SOFTWARE PRODUCT. ANY LIABILITY OF THE SELLER WILL 
BE LIMITED EXCLUSIVELY TO PRODUCT REPLACEMENT OR REFUND OF
PURCHASE PRICE.
 
Failure to install the program or not being able to run this script
 on your server is not a valid reason for requesting a refund of the
 purchase price such as you have an ability to load for free 
"Almond Classifieds (free version)" and try all main features of the 
script before purchasing commerce version.

By purchasing  the script "Almond Classifieds" you agree to the terms
of our licensing and copyright policies. If you do not agree to all 
the terms of this agreement please do not purchase this script.

------------------------------------------------------------------------
Visit  site http://www.almondsoft.com/alcl.html for more details 
about Almond Classifieds script.

Copyright © 1999-2003 AlmondSoft.Com   All Rights Reserved. 



