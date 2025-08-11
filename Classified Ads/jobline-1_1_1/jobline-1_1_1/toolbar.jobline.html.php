<?php
//Jobline Admin//
	/**
	 *	Jobline Component for Mambo 4.5
 	 *
	 *	Copyright (C) 2004 Olle Johansson
	 *	Distributed under the terms of the GNU General Public License
	 *	This software may be used without warrany provided and
	 *  copyright statements are left intact.
	 *
	 *	Site Name: Mambo 4.5
	 *	File Name: toolbar.jobline.html.php
	 *	Developer: Olle Johansson - Olle@Johansson.com
	 *	Date: 2 Aug 2004
	 * 	Version #: 1.0
	 *	Comments:
	**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class TOOLBAR_jobline {

	function _EDIT_CONFIG() {
		mosMenuBar::startTable();
		mosMenuBar::spacer();
		mosMenuBar::save( 'saveconf' );
		mosMenuBar::back();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function BACKONLY_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::back();
		mosMenuBar::endTable();
	}

	function QUEUE_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::spacer();
		mosMenuBar::editList();
		mosMenuBar::deleteList();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
	
	function LIST_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::spacer();
		mosMenuBar::publish();
		mosMenuBar::unpublish();
		mosMenuBar::divider();
		mosMenuBar::addNew();
		mosMenuBar::editList();
		mosMenuBar::deleteList();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
	
	function EDIT_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::preview( '../components/com_jobline/preview' );
		mosMenuBar::divider();
		mosMenuBar::save();
		mosMenuBar::divider();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function LISTTMPL_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::editList( 'edittemplate' );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function EDITTMPL_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::save( 'savetemplate' );
		mosMenuBar::divider();
		mosMenuBar::cancel( 'canceltemplate' );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

}
?>