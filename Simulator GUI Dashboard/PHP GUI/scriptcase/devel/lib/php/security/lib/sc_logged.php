<?php
//__NM____NM__NFUNCTION__NM__//

	function sc_logged($user)
	{
		$str_sql = "SELECT sec_logged.date_login FROM sec_logged WHERE sec_logged.login = '". $user ."'";

		sc_select(data, $str_sql);

		if({data} === FALSE || !isset($data->fields[0]))
		{
			sc_logged_in($user);
			return true;
		}
		else
		{
            sc_reset_apl_conf("nmapp_logged");
			sc_redir("nmapp_logged", user=$user, 'modal');
			return false;
		}
	}

	function sc_verify_logged()
	{
		$str_sql = "SELECT count(*) FROM sec_logged WHERE sec_logged.login = '". [logged_user] . "' AND sec_logged.date_login = '". [logged_date_login] ."'";
		sc_lookup(rs_logged, $str_sql);
		if({rs_logged[0][0]} != 1)
		{
			sc_redir("nmapp_Login","","_parent");
		}
	}

    function sc_logged_in($user)
	{
		$str_select = "SELECT count(*) FROM sec_users WHERE sec_users.login = '". $user . "'";
		sc_lookup(rs_logged, $str_select);
		if({rs_logged[0][0]} == 1)
		{
			[logged_user] = $user;
			[logged_date_login] = microtime(true);
		
			$str_sql = "INSERT INTO sec_logged(sec_logged.login, sec_logged.date_login, sec_logged.sc_session) VALUES ('". $user ."', '". [logged_date_login] ."', '". session_id() ."')";
			sc_exec_sql($str_sql);
		}
	}

    function sc_logged_out($user, $date_login = '')
	{
		$date_login = ($date_login == '' ? "" : " AND sec_logged.date_login = '". $date_login ."'");

		$str_sql = "SELECT sec_logged.sc_session FROM sec_logged WHERE sec_logged.login = '". $user ."' ". $date_login;
		sc_lookup(data, $str_sql);
		if(isset({data[0][0]}) && !empty({data[0][0]}))
                {
			$session_bkp = $_SESSION;
			$sessionid = session_id();
			session_write_close();

			session_id({data[0][0]});
			session_start();
			$_SESSION['logged_user'] = 'logout';
			session_write_close();

			session_id($sessionid);
			session_start();
			$_SESSION = $session_bkp;
		}


		$str_sql = "DELETE FROM sec_logged WHERE sec_logged.login = '". $user . "' " . $date_login;
		sc_exec_sql($str_sql);
		sc_reset_global([logged_date_login], [logged_user]);
	}
    function sc_looged_check_logout()
    {
        if(isset([logged_user]) && ([logged_user] == 'logout' || empty([logged_user])))
        {
            sc_reset_global ([usr_login], [logged_user], [logged_date_login], [usr_email]);
        }
    }

?>
