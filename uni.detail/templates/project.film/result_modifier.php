<?
$project = CTCLove\Project::i()->getProject();
global $duration;


function time_to_iso8601_duration($time)
{
    $units = array(
        "Y" => 365 * 24 * 3600,
        "D" => 24 * 3600,
        "H" => 3600,
        "M" => 60,
        "S" => 1,
    );

    $str = "P";
    $istime = false;

    foreach ($units as $unitName => &$unit) {
        $quot = intval($time / $unit);
        $time -= $quot * $unit;
        $unit = $quot;
        if ($unit > 0) {
            if (!$istime && in_array($unitName, array("H", "M", "S"))) { // There may be a better way to do this
                $str .= "T";
                $istime = true;
            }
            $str .= strval($unit) . $unitName;
        }
    }

    return $str;
}
// get movie params from VM
$movie = VideomoreApi::getVideos($project['PROPERTY_VM_PID_VALUE']);
if (intval($movie->error->code) <= 0) {
// work with params
    $arResult['DATE'] = date('Y-m-d', strtotime($movie[0]->published_at));
    $arResult['DURATTION'] = time_to_iso8601_duration($movie[0]->duration);
    $hours = floor($movie[0]->duration / 3600);
    $minutes = intval($movie[0]->duration / 60 % 60);
    $duration = intval($movie[0]->duration / 60) . " мин. / " . $hours . ":" . $minutes;
    $arResult['PICTURE_SIZE'] = getimagesize($_SERVER['DOCUMENT_ROOT'] . $project['PROPERTY_BANNER_IN_SLIDER_SRC']);
    $arResult['VID'] = $movie[0]->id;
}
