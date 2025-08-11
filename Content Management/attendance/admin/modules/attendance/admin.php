<?php
class CAttendance {
	function CAttendance() {
	}

	function DoEvents(){
		global $base, $_CONF, $_TSM , $_VARS , $_USER , $_BASE;

		if ($_GET["mod"] != "attendance") 
			return false;

		switch ($_GET["sub"]) {
			case "events":
			case "users":
			case "users2":
				if (is_subaction("users2","assign")) {
					if (is_array($_POST["user_id"])) {
						foreach ($_POST["user_id"] as $key => $val) {
							if (!is_array($this->db->QFetchArray("SELECT * FROM {$this->private->tables[events_users]} WHERE user_id='{$val}' AND event_id='{$_GET[event_id]}'"))) 
								$this->db->QueryInsert($this->private->tables["events_users"], array(
											"event_id" => $_GET["event_id"],
											"user_id" => $val
										));
						}
						
					}

					header("Location:" . urldecode($_GET["returnurl"]));
					exit;
				}
				

				if (is_subaction("events","eventdetails") || is_subaction("users","eventdetails")) {
					switch ($_GET["section"]) {
						case 1:
							$data = new CSQLAdmin("users", $_CONF["forms"]["admintemplate"],$this->db,$this->private->tables);					
							$extra["details"]["after"] = $data->DoEvents();
						break;
					}					
				}

				$data = new CSQLAdmin($_GET["sub"], $_CONF["forms"]["admintemplate"],$this->db,$this->private->tables,$extra);
				if ((is_subaction("events","eventdetails") || is_subaction("events","eventdetails")) && ($_GET["section"])) {
					unset($data->forms["forms"]["details"]["fields"]["event_description"]);
				}		
				return $data->DoEvents();

			break;
		}
		
	}
}

?>
