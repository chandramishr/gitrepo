<?php
$username ='samarth-p';
$gitreponame= 'College-ERP';
 $actual_link = "https://github.com/";

$url = $actual_link.$username.'/'.$gitreponame.'/archive/refs/heads/master.zip';
//https://github.com/samarth-p/College-ERP/archive/refs/heads/master.zip
$gitpath = $url;
$server_directory_path = '';
$git_repo_backup_path = '';
$git_upload_path = '';

function gitRepoDownload($gitreponame='', $gitpath='', $server_directory_path='', $git_repo_backup_path='', $git_upload_path=''){
    //just an example repository


    $fh = fopen('master.zip', 'w');
    file_put_contents("master.zip", 
        file_get_contents($gitpath)
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $gitpath); 
    curl_setopt($ch, CURLOPT_FILE, $fh); 
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // this will follow redirects
    curl_exec($ch);

    return 'Attempting download of '.$gitpath.'<br />';
    if(curl_error($ch) == '')
        $errors = '<u>none</u>';
    else
        $errors = '<u>'.curl_error($ch).'</u>';
            return 'cURL Errors : '.$errors;
            curl_close($ch);

            fclose($fh);


 }
/*class ApplicationVersion
{
    const MAJOR = 1;
    const MINOR = 2;
    const PATCH = 3;

    public static function get()
    {
        $commitHash = trim(exec('git log --pretty="%h" -n1 HEAD'));

        $commitDate = new \DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
        $commitDate->setTimezone(new \DateTimeZone('UTC'));

        return sprintf('v%s.%s.%s-dev.%s (%s)', self::MAJOR, self::MINOR, self::PATCH, $commitHash, $commitDate->format('Y-m-d H:i:s'));
    }
}*/
/*function getVersion() {
  $hash = exec("git rev-list --tags --max-count=1");
  return exec("git describe --tags $hash"); 
}*/
function getVersion() {
  return exec("git tag");
}
//echo getVersion();
echo getVersion(); // "v1.2.4"
// Usage: echo 'MyApplication ' . ApplicationVersion::get();
//gitRepoDownload($gitreponame, $url);


?>
