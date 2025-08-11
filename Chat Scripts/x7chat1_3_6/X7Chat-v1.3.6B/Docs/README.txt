/////////////////////////////////////////////////////////////// 
//							    			 				 //
//		X7 Chat Version 1.3.6 Beta		     	       		 //          
//		Released June 17, 2004		 	 	 			 //
//		Copyright (c) 2004 By the X7 Group	   				 //
//		Website: http://www.x7chat.com		   	  			 //
//							   			  					 //
///////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////// 
///			Official Readme			   		  				 //
///////////////////////////////////////////////////////////////

Contents
 1) Installation
 2) Bugs
 3) Documentation
 4) Copyright and License
 5) Authors
 6) History
 
 
 
 
1) Installation
 Follow the instructions in the file INSTALL.txt.          
 
 

 
 
2) Bugs
 You have downloaded a Beta version of X7 Chat version 1.  That means
 that we are still looking for all the bugs in the code.  If you find
 one please visit our website or send an E-Mail to bugs@x7chat.com
 and report it.  We will fix the bug and then issue a patch for the beta
 version.  This is Release Candidate Number 3.  That means that if no new
 bugs are discovered for a while this will be the first stable release.
 This release is generally considered to be stable.
 

 
 
 
3) Documentation
 Documentation can be found at our website at http://www.x7chat.com.  If
 the documentation located there does not help you enough please visit
 the forum on our website and ask for help.
 
 
 
 
 
4) Copyright and License
 This program, all images, source code, librarys, documentation and files
 included in this release are copyright 2004 By the X7 Group.  By using
 this program you agree to the terms and conditions set forth in the
 file "license.txt" which was included with this download.  If the file
 "license.txt" was not included in this download please visit our
 website at http://www.x7chat.com/ and download an official copy of
 X7 Chat.
 
 
 
 
 
 
5) Authors
 This script was programmed by Tim Chamness.
 The images included were made by Tim Chamness.
 The Layout was designed by Tim Chamness.
 The librarys were programmed by Tim Chamness.
 The documentation was written by Tim Chamness.

 A Special thanks to:
 	Peter Hartog, Geraldo Poppeliers - Dutch Translation
	Chuca - Spanish Translation
	Lasse Thorbjrnsen - Norwegian Translation
	Daniel Taillon - French Translation
	Deco - Indonesian Translation
	Volf - Russian Translation
	Daniel Gustafik - Slovak Translation
	Carl C. - SMF AuthMod File
 
 If you would like to help with this script please E-Mail me at 
 webmaster@x7chat.com.

 
 
 
 
 

6) History 
Version 1.3.6 Beta (Not a core relase) (June 17, 2004)
  - Core Features Added
    - Xoops AuthMod file
	- Russian Language File
	- Indonesian Language File
  - Bug Fixes
    - English.lng typos fixed by Chozo4.
	- Bandwidth error page styles fixed by Chozo4.
	- Two javascript errors in IE fixed by Chozo4.
	- Invite fixed
  - Changes
    - Default refresh rate changed from 1 seconds to 5 seconds
	- New news from us section to replace old broken one

Version 1.3.5 Beta (Not a core relase) (April 20, 2004)
  - Core Features Added
    - XMB AuthMod file
    - YabbSe AuthMod file
  - Bug Fixes
    - Fixed filter displaying as images bug
  - Changes
    - Improved PhpNuke AuthMod file
    - Changed Online system to support LAN's
    - Changed cookie system to go around Internet Explorer's bug
    - Improved auto-linking system

Version 1.3.4 Beta (Not a core release) (Mar. 24, 2004)
  - Core Features Added
    - Added invision AuthMod
  - Bug Fixes
    - Fixed ' errors on all systems
    - Fixed a view IP bug
  - Changes
    - none

Version 1.3.3 Beta (Not a core release) (Feb. 29, 2004)
  - Core Features Added
    - Added phpNuke AuthMod
  - Bug Fixes
    - Fixed Repeated messages when entering room
  - Changes
    - Improved PHPBB Mod installation instructions

 Version 1.3.2 Beta (Not a core release) (Feb. 21, 2004)
  - Core Features Added
    - none
  - Bug Fixes
    - Fixed bug in md5 AUTH Mod where passwords where not encrypted
    - Password not being required for private room
    - Fixed guest login with null password
    - Fixed bug with expire time on admin acounts
  - Changes
    - Changed cursor to a hand when it goes over room and user menu buttons

 Version 1.3.1 Beta (Not a core release) (Feb. 13, 2004)
  - Core Features Added
    - Added phpBB2 session support
  - Bug Fixes
    - Fixed phpBB Mod Bug where it lept out of frame
    - Fixed Background image bug
    - Fixed Users online and Total rooms counter bug
    - Fixed many notice errors
  - Changes
    - none

 Version 1.3.0 Beta (Feb. 02, 2004)
  - Core Features Added
    - Added logout button on all pages
    - User Menus
	- Added multiple fonts for users to pick from
	- Background images for chat rooms
	- Added invisable smiley parser to admin panel (allows you to use 
	  ^, ., [, ], [, $, (, ), |, *, ?, {, and } in smiley codes)
	- Added news on login screen
	- Added greetings, user recieved them when entering a room.
	- System message is sent when a user goes into or comes out of an away state
    - Added support for message logging
	- Added Data transfer viewer and limit controls
	- Added Unique E-Mail checker (when registering)
	- Added ability change system message color
	- Added ability change username colors (both yours and others)
	- Added default time offset setting
	- Added stricter username, password and E-Mail checking
  - Bug Fixes
    - Fixed popup window private message bug that causes message loss, message
	  loss is now under 0.25%.
    - Fixed user disabling of smilies and styles bug
    - Fix away bug
	- Removed my username from the /me command
	- Removed hard coded link from admin panel
	- Correct spelling error in $txt[142] (english language file)
	- Fixed style settings bug (header/body mixup) in Admin Panel
	- Fixed a bug that messed up voice permissions
	- Fixed a bug in User profiles that set regular users to never expire
	- Fixed a bug in install.php that prevented users from installing when no
	  table prefix was specified
	- Fixed exploit that allowed user to gain full administrator access
  - Changes
    - Changed the layout of popup user message windows
    - Changed user refresh rate to seconds instead of miliseconds
    - Added Back to Chat button on admin panel
    - Allowed Admin to see password for rooms in Room Manager
    - When you send a private message that is not in a popup window 
	  it displays who you are sending it to in the chat screen.
    - Major Layout change
	- Added some space between timestamp and username and the actual message
	- Added Admins online and Users online together
	- Moved copyright to bottom
	- Colored the value of Users Online and Total Rooms to dark font

 Version 1.2.0 Beta (Jan. 05, 2004)
  - Core Features Added
     - Multi-Language Support (working on)
     - Added /me command
     - Added custom time offset
	 - Swear word filter
	 - Advanced Admin Feature, Smilie customization
	 - Advanced user manager
	 - Advanced room manager
	 - Added sounds
	 - Added advanced permissions control
	 - Private messages appear in seperate windows
  - Bug Fixes
     - Fixed Kick/Ban user not "appearing" to leave room bug
     - Fixed error where room names had an ' in it
     - Fixed still online after logoff bug
     - Fixed kick/ban bug
	 - Fixed ignore bug
	 - Fixed default text style display bug
     - Fixed $USER bug (carryover from $XUSER) 
	 - Fixed Help and List commands
	 - Fixed saving of avatar URL in profile
  - Changes
     - Lists users you can invite when inviting
	 - Administrators can login when server is disabled
	 
 Version 1.1.2 Beta (Not a core release)
  - Core Features Added
     - None
  - Bug Fixes
     - Fixed Assign-Op Bug
	 - Fixed public room password request bug
	 - Non-online update report error bug
  - Changes
     - None

 Version 1.1.1 Beta (Not a core release)
  - Core Features Added
     - None
  - Bug Fixes
     - Fixed cookie Bug
  - Changes
     - Changed the way config.php works

 Version 1.1.0 Beta (Not a core release)
  - Core Features Added
     - Dice Roller
 - Bug Fixes
     - Get Messages error fixed
     - Whos online bug fixed
     - Private Message Exit Bug fixed
     - Missing Message Bug Fixed
     - HTML Library fixed missing variable notice
     - Added support for global_registers off
     - Fixed cookie problem
  - Changes
    - Changed page you go to after login
	
 Version 1.0.0 Beta
  - Core Features
      - Every feature included in the script to date
  - Bugs
      - None found yet but they are here somewhere
  
 Version .5 Alpha
  - Yes there was a version .5 alpha.  However it was very bad and
    I did not release it.  Instead I decided to scrap it and re-make
    the entire thing and call it version 1.0 Beta.   
