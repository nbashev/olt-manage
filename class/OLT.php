<?php
/**
 * Created by PhpStorm.
 * User: Liang
 * Date: 16-9-28
 * Time: 下午1:41
 */

namespace OLT;
require_once('Telnet.php'); //引入Telnet类

class OLT
{
    /**
     * 格林OLT
     * @param $ip
     * @param $username
     * @param $password
     * @param $enpassword
     * @param $mac
     * @param $device
     * @return mixed
     */
    public function green($ip, $username, $password, $enpassword, $mac, $device)
    {
        preg_match('/[0-9a-fA-F]{4}.[0-9a-fA-F]{4}.[0-9a-fA-F]{4}/', $mac, $isMac);
        //验证是否为有效MAC地址
        if (!$isMac) {
            $result['status'] = false;
            $result['msg']['info'] = 'MAC输入有误';
            return $result;
        }
        $telnet = new \Telnet\Telnet($ip, 23);
        $telnet->read_till(": ");
        $telnet->write("$username\r\n");
        $telnet->read_till(": ");
        $telnet->write("$password\r\n");
        $telnet->read_till("> ");
        $telnet->write("en\r\n");
        $telnet->read_till(": ");
        $telnet->write("$enpassword\r\n");
        $telnet->read_till("#");
        //显示ONU的MAC告警
        $telnet->write("show alarm log class 3\r\n");
        $str = $telnet->read_till("#");
        do {
            $str = preg_replace('/continue/', '', $str);
            $telnet->write("\r\n");
            $str .= $telnet->read_till("#");
        } while (strstr($str, 'continue'));
        $onus = explode(chr(10), $str);
        $PON_PORT = null;
        foreach ($onus as $onu) {
            if (strstr($onu, $mac)) {
                preg_match('/\d*\/\d*/', $onu, $pon_port);
                $PON_PORT = $pon_port[0];
            }
        }

        //判断设备是否注册 也有可能是没有查询到
        if ($PON_PORT) {
            //注册ONU
            $telnet->read_till("#");
            $telnet->write("add onu-register authentication entry $PON_PORT $mac\r\n");
            //显示PON口 ONU注册情况
            $regStatus = $telnet->read_till("#");
            if (strstr($regStatus, 'mac')) {
                $regStatus = '已注册';
            } else {
                $regStatus = '注册成功';
            }
            $telnet->write("show onu-li pon  $PON_PORT\r\n");
            $str = $telnet->read_till("(config)#");
            do {
                $str = preg_replace('/continue/', '', $str);
                $telnet->write("\r\n");
                $str .= $telnet->read_till("(config)#");
            } while (strstr($str, 'continue'));
            $onus = explode(chr(10), $str);
            $PON_IDX = null;
            foreach ($onus as $onu) {
                if (strstr($onu, $mac)) {
                    preg_match('/-?[1-9]\d*  /', $onu, $pon_idx);
                    $PON_IDX = $pon_idx[0];
                }
            }


            if ($PON_IDX) {
                $telnet->read_till("#");
                $telnet->write("onu $PON_PORT/$PON_IDX\r\n");
                $telnet->read_till("#");
                $telnet->write("device name $device\r\n"); //更改设备名称
                //todo list  设备名称先循环2次进行查询
                $str = $telnet->read_till("#");
                $str .= $telnet->read_till("#");
                preg_match_all('/[\S]+/', $str, $devName); //第3个
            } else {
                $result['status'] = false;
                $result['msg']['info'] = '当前ONU设备没有pon索引';
                return $result;
            }
            $result['status'] = true;
            $result['msg']['regStatus'] = $regStatus ? $regStatus : ' ';
            $result['msg']['devName'] = $devName[0][2] ? $devName[0][2] : ' ';
            $result['msg']['ponPort'] = $PON_PORT ? $PON_PORT : ' ';
            $result['msg']['ponIdx'] = $PON_IDX ? $PON_IDX : ' ';
            $result['msg']['info'] = '注册成功';
            return $result;
        } else {
            $result['status'] = false;
            $result['msg']['info'] = '当前ONU设备已注册或不存在';
            return $result;
        }
    }

    /**
     * 瑞斯康达OLT
     * @param $ip
     * @param $username
     * @param $password
     * @param $enpassword
     * @param $mac
     * @param $mac
     * @return string
     *
     */
    public function raisecom($ip, $username, $password, $enpassword, $mac, $device)
    {
        preg_match('/[0-9a-fA-F]{4}.[0-9a-fA-F]{4}.[0-9a-fA-F]{4}/', $mac, $isMac);
        //验证是否为有效MAC地址
        if (!$isMac) {
            $result['status'] = false;
            $result['msg']['info'] = 'MAC输入有误';
            return $result;
        }
        $telnet = new \Telnet\Telnet($ip, 23);
        $telnet->read_till(":");
        $telnet->write("$username\r\n");
        $telnet->read_till(":");
        $telnet->write("$password\r\n");
        $telnet->read_till(">");
        $telnet->write("en\r\n");
        $telnet->read_till(": ");
        $telnet->write("$enpassword\r\n");
        $brand = $telnet->read_till("#");

        if (strstr($brand, '6800')) {
            $telnet->write("show interface epon-olt illegal-onu\r\n");
            $str = $telnet->read_till("#");
            $onus = explode(chr(10), $str);
            $PON_PORT = null;
            foreach ($onus as $onu) {
                if (strstr($onu, $mac)) {
                    preg_match('/\d+\/\d+/', $onu, $pon_idx);
                    $PON_PORT = $pon_idx[0];
                }
            }
            if ($PON_PORT) {
                $telnet->write("config terminal \r\n");
                $telnet->read_till("#");
                $telnet->write("interface epon-olt $PON_PORT\r\n");
                $telnet->read_till("#");
                $telnet->write("create epon-onu mac $mac\r\n");
                $str = $telnet->read_till("#");
                if (strstr($str, "unsuccessfully")) {
                    $result['status'] = false;
                    $result['msg']['info'] = '当前ONU设备已注册';
                    return $result;
                } else {
                    $result['status'] = true;
                    $result['msg']['regStatus'] = '注册成功';
                    $result['msg']['devName'] = ' ';
                    $result['msg']['ponPort'] = $PON_PORT ? $PON_PORT : ' ';
                    $result['msg']['ponIdx'] = ' ';
                    $result['msg']['info'] = '注册成功';
                    return $result;
                }
            } else {
                $result['status'] = false;
                $result['msg']['info'] = '当前ONU设备已注册';
                return $result;
            }
        } elseif (strstr($brand, '5800')) {
            $telnet->write("show  interface olt illegal-onu\r\n");
            $str = $telnet->read_till("#");
            $onus = explode(chr(10), $str);
            $PON_PORT = null;
            foreach ($onus as $onu) {
                if (strstr($onu, $mac)) {
                    preg_match('/\d+\/\d+/', $onu, $pon_idx);
                    $PON_PORT = $pon_idx[0];
                }
            }
            if ($PON_PORT) {
                $telnet->write("fttx\r\n");
                $telnet->read_till("#");
                $telnet->write("interface olt $PON_PORT\r\n");
                $telnet->read_till("#");
                $telnet->write("create onu mac $mac\r\n");
                $str = $telnet->read_till("#");
                if (strstr($str, "unsuccessfully")) {
                    $result['status'] = false;
                    $result['msg']['info'] = '当前ONU设备已注册';
                    return $result;
                } else {
                    $result['status'] = true;
                    $result['msg']['regStatus'] = '注册成功';
                    $result['msg']['devName'] = ' ';
                    $result['msg']['ponPort'] = $PON_PORT ? $PON_PORT : ' ';
                    $result['msg']['ponIdx'] = ' ';
                    $result['msg']['info'] = '注册成功';
                    return $result;
                }
            } else {
                $result['status'] = false;
                $result['msg']['info'] = '当前ONU设备已注册';
                return $result;
            }
        } else {
            $result['status'] = false;
            $result['msg']['info'] = '当前设备名称未包含5800或6800请更改设备名称后再注册';
            return $result;
        }
    }

    /**
     * 中兴OLT
     * @param $ip
     * @param $username
     * @param $password
     * @param $mac
     * @param $device
     * @return string
     */
    public function zte($ip, $username, $password, $mac, $device)
    {
        preg_match('/[0-9a-fA-F]{4}.[0-9a-fA-F]{4}.[0-9a-fA-F]{4}/', $mac, $isMac);
        //验证是否为有效MAC地址
        if (!$isMac) {
            $result['status'] = false;
            $result['msg']['info'] = 'MAC输入有误';
            return $result;
        }
        $telnet = new \Telnet\Telnet($ip, 23);
        $telnet->read_till(": ");
        $telnet->write("$username\r\n");
        $telnet->read_till(": ");
        $telnet->write("$password\r\n");
        $telnet->read_till("#");
        $telnet->write("conf t\r\n");
        $telnet->read_till("(config)#");
        $telnet->write("show onu unauthentication\r\n");
        $str = $telnet->read_till("(config)#");
        $onus = explode('                     ', $str);
        $PON_PORT = null;
        $PON_IDX = null;
        $OnuModel = null;
        foreach ($onus as $onu) {
            if (strstr($onu, $mac)) {
                preg_match('/Onu Model        :   \S+/', $onu, $Model);
                preg_match('/\S+$/', $Model[0], $OnuModel);
                preg_match('/Onu Interface    :   \S+/', $onu, $Interface);
                preg_match('/_\w+\/\w+\/\w+:\w+/', $Interface[0], $OnuInterface);
                $pon = explode(':', $OnuInterface[0]);
                $PON_PORT = $pon[0];
                $PON_IDX = $pon[1];
            }
        }

        if ($PON_PORT) {
            $telnet->write(chr(13) . "\r\n");
            $telnet->write(chr(13) . "\r\n");
            $telnet->write(chr(13) . "\r\n");
            $telnet->write(chr(13) . "\r\n");
            $telnet->write(chr(13) . "\r\n");
            $telnet->read_till("(config)#");
            $telnet->write("interface epon-olt$PON_PORT\r\n");
            $telnet->read_till("(config-if)#");
            $telnet->write("onu $PON_IDX type $OnuModel[0] mac $mac\r\n");
            $str = $telnet->read_till("(config-if)#");
            if (strstr($str, 'exist')) {
                $result['status'] = false;
                $result['msg']['info'] = '当前设备已注册';
                return $result;
            } else {
                $result['status'] = true;
                $result['msg']['regStatus'] = '注册成功';
                $result['msg']['devName'] = ' ';
                $result['msg']['ponPort'] = $PON_PORT ? $PON_PORT : ' ';
                $result['msg']['ponIdx'] = $PON_IDX ? $PON_IDX : ' ';
                $result['msg']['info'] = '注册成功';
                return $result;
            }

        } else {
            $result['status'] = false;
            $result['msg']['info'] = '当前设备已注册或不存在';
            return $result;
        }
    }
}
