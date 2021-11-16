<?php  //version my103
header("Content-Type: application/octet-stream");

error_reporting(0);
set_time_limit(0);

function phpversion_int()
{
    list($maVer, $miVer, $edVer) = split("[/.-]", phpversion());
    return $maVer*10000 + $miVer*100 + $edVer;
}

function CheckFunctions()
{
    if (!function_exists("mysqli_connect"))
        return "mysql_connect";
    return "";
}

function GetLongBinary($num)
{
    return pack("N",$num);
}

function GetShortBinary($num)
{
    return pack("n",$num);
}

function GetDummy($count)
{
    $str = "";
    for($i=0;$i<$count;$i++)
        $str .= "\x00";
    return $str;
}

function GetBlock($val)
{
    $len = strlen($val);
    if( $len < 254 )
        return chr($len).$val;
    else
        return "\xFE".GetLongBinary($len).$val;
}

function EchoHeader($errno)
{
    $str = GetLongBinary(1111);
    $str .= GetShortBinary(103);
    $str .= GetLongBinary($errno);
    $str .= GetDummy(6);
    echo $str;
}

function EchoConnInfo($conn)
{
    $str = GetBlock(((is_null($___mysqli_res = mysqli_get_host_info($conn))) ? false : $___mysqli_res));
    $str .= GetBlock(((is_null($___mysqli_res = mysqli_get_proto_info($conn))) ? false : $___mysqli_res));
    $str .= GetBlock(((is_null($___mysqli_res = mysqli_get_server_info($conn))) ? false : $___mysqli_res));
    echo $str;
}

function EchoResultSetHeader($errno, $affectrows, $insertid, $numfields, $numrows)
{
    $str = GetLongBinary($errno);
    $str .= GetLongBinary($affectrows);
    $str .= GetLongBinary($insertid);
    $str .= GetLongBinary($numfields);
    $str .= GetLongBinary($numrows);
    $str .= GetDummy(12);
    echo $str;
}

function EchoFieldsHeader($res, $numfields)
{
    $str = "";
    for( $i = 0; $i < $numfields; $i++ ) {
        $str .= GetBlock(((($___mysqli_tmp = mysqli_fetch_field_direct($res,  $i)->name) && (!is_null($___mysqli_tmp))) ? $___mysqli_tmp : false));
        $str .= GetBlock((mysqli_fetch_field_direct($res,  $i)->table));

        $type = ((is_object($___mysqli_tmp = mysqli_fetch_field_direct($res, 0)) && !is_null($___mysqli_tmp = $___mysqli_tmp->type)) ? ((($___mysqli_tmp = (string)(substr(( (($___mysqli_tmp == MYSQLI_TYPE_STRING) || ($___mysqli_tmp == MYSQLI_TYPE_VAR_STRING) ) ? "string " : "" ) . ( (in_array($___mysqli_tmp, array(MYSQLI_TYPE_TINY, MYSQLI_TYPE_SHORT, MYSQLI_TYPE_LONG, MYSQLI_TYPE_LONGLONG, MYSQLI_TYPE_INT24))) ? "int " : "" ) . ( (in_array($___mysqli_tmp, array(MYSQLI_TYPE_FLOAT, MYSQLI_TYPE_DOUBLE, MYSQLI_TYPE_DECIMAL, ((defined("MYSQLI_TYPE_NEWDECIMAL")) ? constant("MYSQLI_TYPE_NEWDECIMAL") : -1)))) ? "real " : "" ) . ( ($___mysqli_tmp == MYSQLI_TYPE_TIMESTAMP) ? "timestamp " : "" ) . ( ($___mysqli_tmp == MYSQLI_TYPE_YEAR) ? "year " : "" ) . ( (($___mysqli_tmp == MYSQLI_TYPE_DATE) || ($___mysqli_tmp == MYSQLI_TYPE_NEWDATE) ) ? "date " : "" ) . ( ($___mysqli_tmp == MYSQLI_TYPE_TIME) ? "time " : "" ) . ( ($___mysqli_tmp == MYSQLI_TYPE_SET) ? "set " : "" ) . ( ($___mysqli_tmp == MYSQLI_TYPE_ENUM) ? "enum " : "" ) . ( ($___mysqli_tmp == MYSQLI_TYPE_GEOMETRY) ? "geometry " : "" ) . ( ($___mysqli_tmp == MYSQLI_TYPE_DATETIME) ? "datetime " : "" ) . ( (in_array($___mysqli_tmp, array(MYSQLI_TYPE_TINY_BLOB, MYSQLI_TYPE_BLOB, MYSQLI_TYPE_MEDIUM_BLOB, MYSQLI_TYPE_LONG_BLOB))) ? "blob " : "" ) . ( ($___mysqli_tmp == MYSQLI_TYPE_NULL) ? "null " : "" ), 0, -1))) == "") ? "unknown" : $___mysqli_tmp) : false);
        $length = ((($___mysqli_tmp = mysqli_fetch_fields($res)) && (isset($___mysqli_tmp[0]))) ? $___mysqli_tmp[0]->length : false);
        switch ($type) {
            case "int":
                if( $length > 11 ) $type = 8;
                elseif( $length > 9 ) $type = 3;
                elseif( $length > 6 ) $type = 9;
                elseif( $length > 4 ) $type = 2;
                else $type = 1;
                break;
            case "real":
                if( $length == 12 ) $type = 4;
                elseif( $length == 22 ) $type = 5;
                else $type = 0;
                break;
            case "null":
                $type = 6;
                break;
            case "timestamp":
                $type = 7;
                break;
            case "date":
                $type = 10;
                break;
            case "time":
                $type = 11;
                break;
            case "datetime":
                $type = 12;
                break;
            case "year":
                $type = 13;
                break;
            case "blob":
                if( $length > 16777215 ) $type = 251;
                elseif( $length > 65535 ) $type = 250;
                elseif( $length > 255 ) $type = 252;
                else $type = 249;
                break;
            default:
                $type = 253;
        }
        $str .= GetLongBinary($type);

        $flags = explode( " ", (($___mysqli_tmp = mysqli_fetch_field_direct( $res,  $i )->flags) ? (string)(substr((($___mysqli_tmp & MYSQLI_NOT_NULL_FLAG)       ? "not_null "       : "") . (($___mysqli_tmp & MYSQLI_PRI_KEY_FLAG)        ? "primary_key "    : "") . (($___mysqli_tmp & MYSQLI_UNIQUE_KEY_FLAG)     ? "unique_key "     : "") . (($___mysqli_tmp & MYSQLI_MULTIPLE_KEY_FLAG)   ? "unique_key "     : "") . (($___mysqli_tmp & MYSQLI_BLOB_FLAG)           ? "blob "           : "") . (($___mysqli_tmp & MYSQLI_UNSIGNED_FLAG)       ? "unsigned "       : "") . (($___mysqli_tmp & MYSQLI_ZEROFILL_FLAG)       ? "zerofill "       : "") . (($___mysqli_tmp & 128)                        ? "binary "         : "") . (($___mysqli_tmp & 256)                        ? "enum "           : "") . (($___mysqli_tmp & MYSQLI_AUTO_INCREMENT_FLAG) ? "auto_increment " : "") . (($___mysqli_tmp & MYSQLI_TIMESTAMP_FLAG)      ? "timestamp "      : "") . (($___mysqli_tmp & MYSQLI_SET_FLAG)            ? "set "            : ""), 0, -1)) : false) );
        $intflag = 0;
        if(in_array( "not_null", $flags )) $intflag += 1;
        if(in_array( "primary_key", $flags )) $intflag += 2;
        if(in_array( "unique_key", $flags )) $intflag += 4;
        if(in_array( "multiple_key", $flags )) $intflag += 8;
        if(in_array( "blob", $flags )) $intflag += 16;
        if(in_array( "unsigned", $flags )) $intflag += 32;
        if(in_array( "zerofill", $flags )) $intflag += 64;
        if(in_array( "binary", $flags)) $intflag += 128;
        if(in_array( "enum", $flags )) $intflag += 256;
        if(in_array( "auto_increment", $flags )) $intflag += 512;
        if(in_array( "timestamp", $flags )) $intflag += 1024;
        if(in_array( "set", $flags )) $intflag += 2048;
        $str .= GetLongBinary($intflag);

        $str .= GetLongBinary($length);
    }
    echo $str;
}

function EchoData($res, $numfields, $numrows)
{
    for( $i = 0; $i < $numrows; $i++ ) {
        $str = "";
        $row = mysqli_fetch_row( $res );
        for( $j = 0; $j < $numfields; $j++ ){
            if( is_null($row[$j]) )
                $str .= "\xFF";
            else
                $str .= GetBlock($row[$j]);
        }
        echo $str;
    }
}

    if (phpversion_int() < 40005) {
        EchoHeader(201);
        echo GetBlock("unsupported php version");
        exit();
    }

    if (phpversion_int() < 40010) {
        global $HTTP_POST_VARS;
        $_POST = &$HTTP_POST_VARS;	
    }

    if (!isset($_POST["actn"]) || !isset($_POST["host"]) || !isset($_POST["port"]) || !isset($_POST["login"])) {
        EchoHeader(202);
        echo GetBlock("invalid parameters");
        exit();
    }

    $strCheckFunctions = CheckFunctions();
    if (strlen($strCheckFunctions) > 0) {
        EchoHeader(203);
        echo GetBlock("function not exist: ".$strCheckFunctions);
        exit();
    }

    $errno_c = 0;
    $hs = $_POST["host"];
    if( $_POST["port"] ) $hs .= ":".$_POST["port"];
    $conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect($hs,  $_POST["login"],  $_POST["password"]));
    $errno_c = mysqli_errno($GLOBALS["___mysqli_ston"]);
    if(($errno_c <= 0) && ( $_POST["db"] != "" )) {
        $res = mysqli_select_db( $conn, $_POST["db"]);
        $errno_c = mysqli_errno($GLOBALS["___mysqli_ston"]);
    }

    EchoHeader($errno_c);
    if($errno_c > 0) {
        echo GetBlock(mysqli_error($GLOBALS["___mysqli_ston"]));
    } elseif($_POST["actn"] == "C") {
        EchoConnInfo($conn);
    } elseif($_POST["actn"] == "Q") {
        for($i=0;$i<count($_POST["q"]);$i++) {
            $query = $_POST["q"][$i];
            if($query == "") continue;
            if(get_magic_quotes_gpc())
                $query = stripslashes($query);
            $res = mysqli_query( $conn, $query);
            $errno = mysqli_errno($GLOBALS["___mysqli_ston"]);
            $affectedrows = mysqli_affected_rows($conn);
            $insertid = ((is_null($___mysqli_res = mysqli_insert_id($conn))) ? false : $___mysqli_res);
            $numfields = (($___mysqli_tmp = mysqli_num_fields($res)) ? $___mysqli_tmp : false);
            $numrows = mysqli_num_rows($res);
            EchoResultSetHeader($errno, $affectedrows, $insertid, $numfields, $numrows);
            if($errno > 0)
                echo GetBlock(mysqli_error($GLOBALS["___mysqli_ston"]));
            else {
                if($numfields > 0) {
                    EchoFieldsHeader($res, $numfields);
                    EchoData($res, $numfields, $numrows);
                } else {
                    if(phpversion_int() >= 40300)
                        echo GetBlock(mysqli_info($conn));
                    else
                        echo GetBlock("");
                }
            }
            if($i<(count($_POST["q"])-1))
                echo "\x01";
            else
                echo "\x00";
            ((mysqli_free_result($res) || (is_object($res) && (get_class($res) == "mysqli_result"))) ? true : false);
        }
    }

?>