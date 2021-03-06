--TEST--
mysqli_change_user()
--SKIPIF--
<?php
require_once('skipif.inc');
require_once('skipifemb.inc');
require_once('skipifconnectfailure.inc');
?>
--FILE--
<?php
	require_once("connect.inc");

	$tmp	= NULL;
	$link	= NULL;

	if (!is_null($tmp = @mysqli_change_user()))
		printf("[001] Expecting NULL, got %s/%s\n", gettype($tmp), $tmp);

	if (!is_null($tmp = @mysqli_change_user($link)))
		printf("[002] Expecting NULL, got %s/%s\n", gettype($tmp), $tmp);

	if (!is_null($tmp = @mysqli_change_user($link, $link)))
		printf("[003] Expecting NULL, got %s/%s\n", gettype($tmp), $tmp);

	if (!is_null($tmp = @mysqli_change_user($link, $link, $link)))
		printf("[004] Expecting NULL, got %s/%s\n", gettype($tmp), $tmp);

	if (!is_null($tmp = @mysqli_change_user($link, $link, $link, $link, $link)))
		printf("[005] Expecting NULL, got %s/%s\n", gettype($tmp), $tmp);

	if (!$link = my_mysqli_connect($host, $user, $passwd, $db, $port, $socket))
		printf("[006] Cannot connect to the server using host=%s, user=%s, passwd=***, dbname=%s, port=%s, socket=%s\n",
			$host, $user, $db, $port, $socket);

	if (false !== ($tmp = mysqli_change_user($link, $user . '_unknown_really', $passwd . 'non_empty', $db)))
		printf("[007] Expecting false, got %s/%s\n", gettype($tmp), $tmp);

	if (false !== ($tmp = mysqli_change_user($link, $user, $passwd . '_unknown_really', $db)))
		printf("[008] Expecting false, got %s/%s\n", gettype($tmp), $tmp);

	if (false !== ($tmp = mysqli_change_user($link, $user, $passwd, $db . '_unknown_really')))
		printf("[009] Expecting false, got %s/%s\n", gettype($tmp), $tmp);

	if (!mysqli_query($link, 'SET @mysqli_change_user_test_var=1'))
		printf("[010] Failed to set test variable: [%d] %s\n", mysqli_errno($link), mysqli_error($link));

	if (!$res = mysqli_query($link, 'SELECT @mysqli_change_user_test_var AS test_var'))
		printf("[011] [%d] %s\n", mysqli_errno($link), mysqli_error($link));
	$tmp = mysqli_fetch_assoc($res);
	mysqli_free_result($res);
	if (1 != $tmp['test_var'])
		printf("[012] Cannot set test variable\n");

	if (true !== ($tmp = mysqli_change_user($link, $user, $passwd, $db)))
		printf("[013] Expecting true, got %s/%s\n", gettype($tmp), $tmp);

	if (!$res = mysqli_query($link, 'SELECT database() AS dbname, user() AS user'))
		printf("[014] [%d] %s\n", mysqli_errno($link), mysqli_error($link));
	$tmp = mysqli_fetch_assoc($res);
	mysqli_free_result($res);

	if (substr($tmp['user'], 0, strlen($user)) !== $user)
		printf("[015] Expecting user %s, got user() %s\n", $user, $tmp['user']);
	if ($tmp['dbname'] != $db)
		printf("[016] Expecting database %s, got database() %s\n", $db, $tmp['dbname']);

	if (!$res = mysqli_query($link, 'SELECT @mysqli_change_user_test_var AS test_var'))
		printf("[017] [%d] %s\n", mysqli_errno($link), mysqli_error($link));
	$tmp = mysqli_fetch_assoc($res);
	mysqli_free_result($res);
	if (NULL !== $tmp['test_var'])
		printf("[019] Test variable is still set!\n");

	mysqli_close($link);

	if (NULL !== ($tmp = @mysqli_change_user($link, $user, $passwd, $db)))
		printf("[020] Expecting NULL, got %s/%s\n", gettype($tmp), $tmp);

	print "done!";
?>
--EXPECTF--
done!