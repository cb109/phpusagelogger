-- Call this function into a maxscript tool
-- e.g. in the "on create" or "on open" handler

fn log_usage toolname =
(
	url = @"http://buelter.freeunix.net/temp/phptest/usage.php?tool="+toolname
	con = internet.CheckConnection url:url force:True
	if con do
	(
		wc = dotNetObject "System.Net.WebClient"
		wc.DownloadString url -- To execute the PHP
	)--end if
)--end fn