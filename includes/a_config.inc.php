<?php
	switch ($_SERVER["SCRIPT_NAME"]) {
		case "index.php":
			$CURRENT_PAGE = "Sign in"; 
			$PAGE_TITLE = "Sign in";
			break;
		case "contact.php":
			$CURRENT_PAGE = "Contact"; 
			$PAGE_TITLE = "Contact Us";
			break;
		default:
			$CURRENT_PAGE = "Index";
			$PAGE_TITLE = "Sign in";
	}
?>