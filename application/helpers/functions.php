<?php

function getYearList($ytype, $yearname, $sel = '')
{
    $start = ($ytype == 'NP') ? 2000 : 1944;
    $end = ($ytype == 'NP') ? 2089 : 2033;
    echo '<select class="form-control"  name="' . $yearname . '" id="' . $yearname . '">';
    for ($year = $start; $year <= $end; $year++)
    {
        echo '<option';
        if ($sel != '' and $year == $sel)
        {
            echo ' selected="selected" ';
        }
        echo '>';
        echo $year;
        echo '</option>';
    }
    echo '</select>';
}

function getMonthName($mon)
{
    $arr_np = array('Baishakh', 'Jeth', 'Ashar', 'Shrawan', 'Bhadra', 'Ashoj', 'Kartik', 'Mangshir', 'Poush', 'Magh', 'Falgun', 'Chaitra');
    return $arr_np[$mon-1];
}

function getMonthList($monthname, $cur = '', $lng = 'NP')
{
    $arr_np = array('Baishakh', 'Jeth', 'Ashar', 'Shrawan', 'Bhadra', 'Ashoj', 'Kartik', 'Mangshir', 'Poush', 'Magh', 'Falgun', 'Chaitra');
    $arr_en = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    echo '<select class="form-control" name="' . $monthname . '" id="' . $monthname . '">';
    for ($i = 1; $i <= 12; $i++)
    {
        echo '<option';
        if ($cur != '' and $i == $cur)
        {
            echo ' selected="selected" ';
        }
        echo ' value="' . $i . '"';
        echo '>';
        if ($lng == 'EN')
            echo $arr_en[$i - 1];
        else
            echo $arr_np[$i - 1];
        echo '</option>';
    }
    echo '</select>';
}

function getDayList($max, $monthname, $cur = '')
{
    echo '<select  class="form-control" name="' . $monthname . '" id="' . $monthname . '">';
    for ($i = 1; $i <= $max; $i++)
    {
        echo '<option';
        if ($cur != '' and $i == $cur)
        {
            echo ' selected="selected" ';
        }
        echo '>';
        echo $i;
        echo '</option>';
    }
    echo '</select>';
}

function crossCheck($y, $m, $d)
{
    //takes nepali date	
    $objC = new Nepali_Calendar();
    $engdate = $objC->nep_to_eng($y, $m, $d);
    $eyear = $engdate['year'];
    $emonth = $engdate['month'];
    $eday = $engdate['date'];
    //
    $nepdate = $objC->eng_to_nep($eyear, $emonth, $eday);
    $new_year = $nepdate['year'];
    $new_month = $nepdate['month'];
    $new_day = $nepdate['date'];
    if ($y == $new_year && $m == $new_month && $d == $new_day)
        return true;
    return false;
}

/**
 * showpre
 *
 * Displays formatted output
 * 
 * @author Nilambar Sharma <nilambar@outlook.com>
 * @copyright Copyright (c) 2013, Nilambar Sharma
 * @version 1.0
 *
 * @param mixed $str What do you want to display
 * @param string $title Title 
 * @param bool $die Enable/disable die
 * @param bool $style   Enable/disable styling
 * @param bool $html Encoded html content
 * @return null
 * 
 * @todo Make more advanced
 */
function showpre($str, $title = '', $die = false, $style = true, $html = false)
{
    $o = '<pre';
    if ($style)
        $o.=' style="
		border:1px solid red; background-color:#eee;margin:3px;height:auto; margin-left:3%; 
		overflow:hidden; width:94%;padding:5px; color:#000; text-align:left;
		white-space: pre-wrap;
		white-space: -moz-pre-wrap !important;
		word-wrap: break-word;
		white-space: -o-pre-wrap;
		white-space: -pre-wrap;"';
    $o.='>';
    if ($title != '')
    {
        $o.= '<p';
        if ($style)
            $o.= '  style="border-bottom:1px solid red; color:#f00;font-weight:bold;padding:2px; margin:0px; text-align:left;"';
        $o.= '>' . $title . '</p>';
    }
    if (!$html)
    {
        $o.= print_r($str, true);
    }
    else
    {
        $o.= print_r(htmlentities($str), true);
    }

    $o.='</pre>';
    echo $o;
    if ($die)
        die;
    return;
}