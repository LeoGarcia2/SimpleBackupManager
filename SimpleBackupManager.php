<?php

class SimpleBackupManager
{

	public function zip_folder($folder, $target){
		try{
			$phar = new PharData($target);
			$phar->buildFromDirectory($folder);
		}catch(Exception $e){
			echo $e->getMessage();
		}
		
	}

	public function unzip_archive($archive, $target){
		try{
		    $phar = new PharData($archive);
		    $phar->extractTo($target, null, true);
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	public function export_database($database, $user, $password, $host, $target){
		exec("mysqldump --user={$user} --password={$password} --host={$host} {$database} > {$target}");
	}

	public function import_database($database, $user, $password, $host, $file){
		exec("mysql --user={$user} --password={$password} --host={$host} -e \"create database {$database}\"");
		sleep(1);
		exec("mysql --user={$user} --password={$password} --host={$host} {$database} < {$file}");
	}

}