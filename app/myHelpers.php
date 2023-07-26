<?php 

function thuGonSoLe($value,$soLe=2) {
    if((int)$value == (float)$value) {
        return number_format($value,0);
    } else {
        return number_format($value,$soLe);
    }
}

/**
 * $value = ngày từ db yyyy-mm-dd
 * $emptyString = chuỗi hiển thị khi $value rỗng
 */
function formatNgayDMY($value,$emptyString = "")
{
    if($value == "" || $value == null || $value == '1970-01-01') {
        return $emptyString;
    }

    return date('d/m/Y',strtotime(str_replace("/",'-',$value)));
}

//format lai kieu ngay y-m-d đe luu vao db
function formatNgayDeLuu($ngay) {
    $ngayDeLuu = str_replace('/','-',$ngay);
    return date('Y-m-d',strtotime($ngayDeLuu));
}

function formatGiaTriDeLuu($giaTri) {
    return str_replace(",","",$giaTri);
}

function endDateFromDays($startDate="today",$days) {
    $weekends = [0, 6]; // 0 = Sunday, 6 = Saturday
    $start = strtotime($startDate);
    $end = $start;

    for ($i = 0; $i < $days;) {
        $end = strtotime('+1 day', $end);
        if (!in_array(date('w', $end), $weekends)) {
            $i++;
        }
    }

    return date("Y-m-d", $end);
}

function getEndDayOfMonth($month,$year) {
    $firstDayOfMonth = \Carbon\Carbon::create($year, $month, 1);
    $lastDayOfMonth = $firstDayOfMonth->addMonth()->subDay();
    return $lastDayOfMonth;

}

function createFirstDayOfMonthForSearch($month,$year) {
    $date = \Carbon\Carbon::create($year, $month, 1);

    // Format the date as yyyy-mm-dd
    $formattedDate = $date->format('Y-m-d');

    // Output the result
    return $formattedDate; 
}

function createLastDayOfMonthForSearch($month,$year) {
    $date = getEndDayOfMonth($month,$year);

    // Format the date as yyyy-mm-dd
    $formattedDate = $date->format('Y-m-d');

    // Output the result
    return $formattedDate; 
}

/**
 * tao raw query cho bieu thuc so sanh voi số
 */
function createOperatorRawQuery($field,$requestString) : string 
{
    $operatorReg = '/<=|>=|>|<|=/';
    $preg = preg_match($operatorReg,$requestString,$bieuThuc);
    if($preg>0) {
        $bieuThuc = $bieuThuc[0];
        $soCanTim = formatGiaTriDeLuu(str_replace($bieuThuc,'',$requestString));

    } else {
        $soCanTim = formatGiaTriDeLuu($requestString);
        $bieuThuc = "=";
    }
    return $field.$bieuThuc.$soCanTim;
}
?>