<?
global $USER;
$authors=Array();
foreach ($arResult['rows'] as &$row){
	$authors[$row["UF_AUTHOR"]]=$row["UF_AUTHOR"];
}
$authors=array_values($authors);

if (count($authors)) {
	$rsUsers = CUser::GetList(($by = "id"), ($order = "desc"), Array('ID' => implode("|", $authors)));
	unset($authors);
	$authors = Array();
	while ($arUser = $rsUsers->getNext()) {
		$authors[$arUser["ID"]] = $arUser;
	}

	foreach ($arResult['rows'] as &$row) {
		$row["AUTHOR"] = $authors[$row['UF_AUTHOR']];
		if (!empty($row["AUTHOR"]["PERSONAL_PHOTO"]))
			$row["AUTHOR"]["AVATAR"] = CFile::GetFileArray($row["AUTHOR"]["PERSONAL_PHOTO"]);
		else
			$row["AUTHOR"]["AVATAR"]["SRC"] = DEFAULT_USERPHOTO;

		if (trim($row["UF_LIKES"]) == "" || $row["UF_LIKES"] == '&nbsp;' || $row["UF_LIKES"] == 'nbsp')
			$likes = array();
		else
			$likes = explode(";", $row["UF_LIKES"]);

		$row["LIKES_COUNT"] = count(array_filter($likes));
		$row["I_LIKE"] = (array_search($USER->getID(), $likes) !== false);
		$row["AUTHOR"]["USER_NAME"] = $row["AUTHOR"]["LAST_NAME"] . " " . $row["AUTHOR"]["NAME"];
	}
}
