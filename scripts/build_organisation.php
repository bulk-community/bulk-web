<?php

Class OrganisationBuilder {
	private $meetups, $files;

	public function __construct(){
		$this->meetups = json_decode(file_get_contents("./_organisation/meetup.json"), true);

		$this->files = array_filter(scandir("./_organisation/"), ["OrganisationBuilder", "markdownsource"]);
	}

	private function markdownsource($filename){
		if(strpos($filename, ".") === 0 || strpos($filename, "_") !== 0){
			return false;
		}

		return true;
	}

	public function build(){
		$this->cleanupBuild();

		$meetup_list = $this->generateList();
		$meetup_diary = $this->generateDiary();

		foreach($this->files as $file){
			$data = file_get_contents("./_organisation/".$file);

			$data = str_replace("{{meetup_list}}", $meetup_list, $data);
			$data = str_replace("{{meetup_diary}}", $meetup_diary, $data);

			file_put_contents("./organisation/".ltrim($file, "_"), $data);
		}
	}

	private function cleanupBuild(){
		$files = scandir("./organisation/");

		foreach($files as $file){
			if(is_file("./organisation/".$file)){
				unlink("./organisation/".$file);
			}
		}
	}

	private function generateList(){
		$list = "";
		
		foreach($this->meetups as $meetup){
			extract($meetup);

			$list .= "*$name*		$time	$date\n\n";
		}

		$list = trim($list, "\n");

		return $list;
	}

	private function generateDiary(){
		$diary_content = "";
		
		foreach($this->meetups as $meetup){
			extract($meetup);

			$diary_content .= "### *$name*\n\n$diary\n\n";
		}

		$diary = trim($diary_content, "\n");

		return $diary_content;
	}
}

$organisation = new OrganisationBuilder();
$organisation->build();

