<?php
/**
 * Date Helper
 *
 * @author David Carr - dave@novaframework.com
 * @version 3.0
 */

namespace Helpers;

/**
 * collection of methods for working with dates.
 */
class Date
{
    /**
     * get the difference between 2 dates
     *
     * @param  date $from start date
     * @param  date $to   end date
     * @param  string $type the type of difference to return
     * @return string or array, if type is set then a string is returned otherwise an array is returned
     */
    public static function difference($from, $to, $type = null)
    {
        $d1 = new \DateTime($from);
        $d2 = new \DateTime($to);
        $diff = $d2->diff($d1);
        if ($type == null) {
            //return array
            return $diff;
        } else {
            return $diff->$type;
        }
    }

    /**
     * Business Days
     *
     * Get number of working days between 2 dates
     *
     * Taken from http://mugurel.sumanariu.ro/php-2/php-how-to-calculate-number-of-work-days-between-2-dates/
     *
     * @param  date     $startDate date in the format of Y-m-d
     * @param  date     $endDate date in the format of Y-m-d
     * @param  booleen  $weekendDays returns the number of weekends
     * @return integer  returns the total number of days
     */
    public static function businessDays($startDate, $endDate, $weekendDays = false)
    {
        $begin = strtotime($startDate);
        $end = strtotime($endDate);

        if ($begin > $end) {
            //startDate is in the future
            return 0;
        } else {
            $numDays = 0;
            $weekends = 0;

            while ($begin <= $end) {
                $numDays++; // no of days in the given interval
                $whatDay = date('N', $begin);

                if ($whatDay > 5) { // 6 and 7 are weekend days
                    $weekends++;
                }
                $begin+=86400; // +1 day
            };

            if ($weekendDays == true) {
                return $weekends;
            }

            $working_days = $numDays - $weekends;
            return $working_days;
        }
    }

    /**
    * get an array of dates between 2 dates (not including weekends)
    *
    * @param  date    $startDate start date
    * @param  date    $endDate end date
    * @param  integer $nonWork day of week(int) where weekend begins - 5 = fri -> sun, 6 = sat -> sun, 7 = sunday
    * @return array   list of dates between $startDate and $endDate
    */
    public static function businessDates($startDate, $endDate, $nonWork = 6)
    {
        $begin    = new \DateTime($startDate);
        $end      = new \DateTime($endDate);
        $holiday  = array();
        $interval = new \DateInterval('P1D');
        $dateRange= new \DatePeriod($begin, $interval, $end);
        foreach ($dateRange as $date) {
            if ($date->format("N") < $nonWork and !in_array($date->format("Y-m-d"), $holiday)) {
                $dates[] = $date->format("Y-m-d");
            }
        }
        return $dates;
    }

    /**
     * Takes a month/year as input and returns the number of days
     * for the given month/year. Takes leap years into consideration.
     * @param int $month
     * @param int $year
     * @return int
     */
    public static function daysInMonth($month = 0, $year = '')
    {
        if ($month < 1 or $month > 12) {
            return 0;
        } elseif (!is_numeric($year) or strlen($year) !== 4) {
            $year = date('Y');
        }
        if (defined('CAL_GREGORIAN')) {
            return cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }
        if ($year >= 1970) {
            return (int) date('t', mktime(12, 0, 0, $month, 1, $year));
        }
        if ($month == 2) {
            if ($year % 400 === 0 or ( $year % 4 === 0 && $year % 100 !== 0)) {
                return 29;
            }
        }
        $days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        return $days_in_month[$month - 1];
    }


    static public function dataHoraDbToUnix($dataHora) {
        $dataHora = explode(' ', $dataHora);

        $data = explode('-', $dataHora[0]);
        $hora = explode(':', $dataHora[1]);
        //mktime ($hora ,$minuto,$second,$mes,$dia,$ano)

        // print_r(array(
        //     !empty($hora[0]) ? $hora[0] : 0, // horas
        //     !empty($hora[1]) ? $hora[1] : 0, //minutos
        //     !empty($hora[2]) ? $hora[2] : 0, // segundos
        //     $data[1], // mes
        //     $data[2], // dia
        //     $data[0]
        // ));

        return mktime(
            !empty($hora[0]) ? $hora[0] : 0, // horas
            !empty($hora[1]) ? $hora[1] : 0, //minutos
            !empty($hora[2]) ? $hora[2] : 0, // segundos
            $data[1], // mes
            $data[2], // dia
            $data[0] // ano
            );
    }

    static public function dataDbToData($data) {
        $data = explode('-', $data);

        return $data[2].'/'.$data[1].'/'.$data[0];
    }
    static public function dataToDataDb($data) {
        $data = explode('/', $data);

        return $data[2].'-'.$data[1].'-'.$data[0];
    }

    static public function getTempo($timeBD) {


        $timeNow = Date::dataHoraDbToUnix(date('Y-m-d H:i:s', time()));
        $timeRes = $timeNow - Date::dataHoraDbToUnix($timeBD);
        //$timeRes = $timeBD - $timeNow;

        // echo $timeNow."<br>";
        // echo $timeBD."<br>";
        // echo $timeRes."<br>";
        // die();

        $nar = 0;
        
        // variável de retorno
        $r = "";

        // Agora
        if ($timeRes == 0){
            $r = "agora";
        } else
        // Segundos
        if ($timeRes > 0 and $timeRes < 60){
            $r = $timeRes. " segundos atr&aacute;s";
        } else
        // Minutos
        if (($timeRes > 59) and ($timeRes < 3599)){
            $timeRes = $timeRes / 60;   
            if (round($timeRes,$nar) >= 1 and round($timeRes,$nar) < 2){
                $r = round($timeRes,$nar). " minuto atr&aacute;s";
            } else {
                $r = round($timeRes,$nar). " minutos atr&aacute;s";
            }
        }
         else
        // Horas
        // Usar expressao regular para fazer hora e MEIA
        if ($timeRes > 3559 and $timeRes < 85399){
            $timeRes = $timeRes / 3600;
            
            if (round($timeRes,$nar) >= 1 and round($timeRes,$nar) < 2){
                $r = round($timeRes,$nar). " hora atr&aacute;s";
            }
            else {
                $r = round($timeRes,$nar). " horas atr&aacute;s";       
            }
        } else
        // Dias
        // Usar expressao regular para fazer dia e MEIO
        if ($timeRes > 86400 and $timeRes < 2591999){
            
            $timeRes = $timeRes / 86400;
            if (round($timeRes,$nar) >= 1 and round($timeRes,$nar) < 2){
                $r = round($timeRes,$nar). " dia atr&aacute;s";
            } else {

                preg_match('/(\d*)\.(\d)/', $timeRes, $matches);
                
                if ($matches[2] >= 5) {
                    $ext = round($timeRes,$nar) - 1;
                    
                    // Imprime o dia
                    $r = $ext;
                    
                    // Formata o dia, singular ou plural
                    if ($ext >= 1 and $ext < 2){ $r.= " dia "; } else { $r.= " dias ";}
                    
                    // Imprime o final da data
                    //$r.= "&frac12; atr&aacute;s";
                    $r.= "atr&aacute;s";
                    
                    
                } else {
                    $r = round($timeRes,0) . " dias atr&aacute;s";
                }
                
            }       
                    
        } else
        // Meses
        if ($timeRes > 2592000 and $timeRes < 31103999){

            $timeRes = $timeRes / 2592000;

            if (round($timeRes,$nar) >= 1 and round($timeRes,$nar) < 2){
                $r = round($timeRes,$nar). " mes atr&aacute;s";
            } else {

                preg_match('/(\d*)\.(\d)/', $timeRes, $matches);
                
                if ($matches[2] >= 5){
                    $ext = round($timeRes,$nar) - 1;
                    
                    // Imprime o mes
                    $r.= $ext;
                    
                    // Formata o mes, singular ou plural
                    if ($ext >= 1 and $ext < 2){ $r.= " mes "; } else { $r.= " meses ";}
                    
                    // Imprime o final da data
                    //$r.= "&frac12; atr&aacute;s";
                    $r.= "atr&aacute;s";
                } else {
                    $r = round($timeRes,0) . " meses atr&aacute;s";
                }
                
            }
        } else
        // Anos
        if ($timeRes > 31104000 and $timeRes < 155519999){
            
            $timeRes /= 31104000;
            if (round($timeRes,$nar) >= 1 and round($timeRes,$nar) < 2){
                $r = round($timeRes,$nar). " ano atr&aacute;s";
            } else {
                $r = round($timeRes,$nar). " anos atr&aacute;s";
            }
        } else
        // 5 anos, mostra data
        if ($timeRes > 155520000){
            
            $localTimeRes = localtime($timeRes);
            $localTimeNow = localtime(time());
                    
            $timeRes /= 31104000;
            $gmt = array();
            $gmt['mes'] = $localTimeRes[4];
            $gmt['ano'] = round($localTimeNow[5] + 1900 - $timeRes,0);              
                        
            $mon = array("Jan ","Fev ","Mar ","Abr ","Mai ","Jun ","Jul ","Ago ","Set ","Out ","Nov ","Dez "); 
            
            $r = $mon[$gmt['mes']] . $gmt['ano'];
        }
        
        return $r;

    }

    static public function getMes($num) {
        switch ($num) {
            case 1:
                return 'Janeiro';
                break;
            case 2:
                return 'Fevereiro';
                break;
            case 3:
                return 'Março';
                break;
            case 4:
                return 'Abril';
                break;
            case 5:
                return 'Maio';
                break;
            case 6:
                return 'Junho';
                break;
            case 7:
                return 'Julho';
                break;
            case 8:
                return 'Agosto';
                break;
            case 9:
                return 'Setembro';
                break;
            case 10:
                return 'Outubro';
                break;
            case 11:
                return 'Novembro';
                break;
            case 12:
                return 'Dezembro';
                break;
            
            default:
                return 'Erro';
                break;
        }
    }
}
