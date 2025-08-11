<?php
class CAttendance {
	function CAttendance() {
	}

	function DoEvents(){
		global $base, $_CONF, $_TSM , $_VARS , $_USER , $_BASE;

		switch ($_GET["sub"]) {

			case "user":
				$user = $this->db->QFetchArray("SELECT * FROM {$this->private->tables[users]} WHERE user_id='{$_GET[user]}'");

				if (is_array($user)) {
					$user = array_merge ($user , $_GET);
					return $this->private->templates["users"]->blocks["Details"]->Replace($user);
				}else {
					header("Location: index.php?sub=event&id={$_GET[event]}");
					exit;
				}

			break;

			case "users":
				$alternate = 0;
				$users = $this->db->QFetchRowArray("SELECT * FROM `{$this->private->tables['users']}` as user, `{$this->private->tables['events_users']}` as user2 WHERE user.user_id=user2.user_id AND event_id={$_GET[id]} ORDER BY user_name ASC ");

				if (is_array($users)) {
					foreach ($users as $key => $val) {
						$alternate = !$alternate;
						$users[$key]["alternate"] = $this->private->templates["users"]->blocks["Alternate" . ((int) $alternate)]->output;
					}					
				}

				$tmp = new CTemplate($base->html->Table($this->private->templates["users"], "List" , $users) , "string");

				return $tmp->Replace(Array(
							"event" => $_GET["id"]
						));
			
			break;

			case "show":
				$event = $this->db->QFetchArray("SELECT * FROM {$this->private->tables[events]} WHERE event_public='1' AND event_id='{$_GET[id]}'");

				if (is_array($event)) {
					$event["event_date"] = date("F d, Y g:i a" , $event["event_date"]);
					return $this->private->templates["events"]->blocks["Details"]->Replace($event);
				} else {
					header("Location: index.php");
					exit;
				}				
				
			break;

			default:
				$alternate = 0;
				//show the public events
				$events = $this->db->QFetchRowArray("SELECT * FROM {$this->private->tables[events]} WHERE event_public='1' ORDER BY event_date ASC");

				if (is_array($events)) {
					foreach ($events as $key => $val) {
						$alternate = !$alternate;

						$events[$key]["event_date"] = date("F d, Y g:i a" , $val["event_date"]);
						$events[$key]["alternate"] = $this->private->templates["events"]->blocks["Alternate" . ((int) $alternate)]->output;

					}
					
				}
				

				return $base->html->Table($this->private->templates["events"], "List" , $events);
				
			break;
		}
		
	}
}

?>
