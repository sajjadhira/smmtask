<?php


function license_name($license){
    $array = [
        "individual_license_annual" => "Individual Annual License", 
        "individual_license_lifetime" => "Individual Lifetime License", 
        "freelancer_license_annual" => "Freelancer Annual License", 
        "freelancer_license_lifetime" => "Freelancer Lifetime License", 
        "agency_license_annual" => "Agency Annual License", 
        "agency_license_lifetime" => "Agency Lifetime License", 
    ];
    return $array[$license];
}

function make_slug($str,$sign ='-'){
    return strtolower(preg_replace('#[ -]+#', $sign, $str));
}

function make_key(){
    $az = range("A", "Z");
    $zeronine = range(0, 9);
    $property = array_merge($az, $zeronine);

    $key = '';
    for ($i=0;$i<=2;$i++) {
        $rand = rand(0, 25);
        $num_rand = rand(0, 9);
        $key.=$az[$rand];
    }
    $key.=$zeronine[$num_rand];
    $key = str_shuffle($key);

    return $key;
}

function license_key($part){
    $key = '';
    for($i=0;$i<$part;$i++){
        $key.=make_key().'-';
    }
    return rtrim($key,'-');
}

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}




function timeago($time) { 
  
    // Calculate difference between current 
    // time and given timestamp in seconds 
    $diff     = time() - $time; 
      
    // Time difference in seconds 
    $sec     = $diff; 
      
    // Convert time difference in minutes 
    $min     = round($diff / 60 ); 
      
    // Convert time difference in hours 
    $hrs     = round($diff / 3600); 
      
    // Convert time difference in days 
    $days     = round($diff / 86400 ); 
      
    // Convert time difference in weeks 
    $weeks     = round($diff / 604800); 
      
    // Convert time difference in months 
    $mnths     = round($diff / 2600640 ); 
      
    // Convert time difference in years 
    $yrs     = round($diff / 31207680 ); 
      
    // Check for seconds 
    if($sec <= 60) { 
        echo "$sec seconds ago"; 
    } 
      
    // Check for minutes 
    else if($min <= 60) { 
        if($min==1) { 
            echo "one minute ago"; 
        } 
        else { 
            echo "$min minutes ago"; 
        } 
    } 
      
    // Check for hours 
    else if($hrs <= 24) { 
        if($hrs == 1) {  
            echo "an hour ago"; 
        } 
        else { 
            echo "$hrs hours ago"; 
        } 
    } 
      
    // Check for days 
    else if($days <= 7) { 
        if($days == 1) { 
            echo "Yesterday"; 
        } 
        else { 
            echo "$days days ago"; 
        } 
    } 
      
    // Check for weeks 
    else if($weeks <= 4.3) { 
        if($weeks == 1) { 
            echo "a week ago"; 
        } 
        else { 
            echo "$weeks weeks ago"; 
        } 
    } 
      
    // Check for months 
    else if($mnths <= 12) { 
        if($mnths == 1) { 
            echo "a month ago"; 
        } 
        else { 
            echo "$mnths months ago"; 
        } 
    } 
      
    // Check for years 
    else { 
        if($yrs == 1) { 
            echo "one year ago"; 
        } 
        else { 
            echo "$yrs years ago"; 
        } 
    } 
}
