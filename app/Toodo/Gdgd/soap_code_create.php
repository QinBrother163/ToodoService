<?php

class soap_code_create
{
    public $wsdl;
    public $root_dir;
    private $soap;
    private $class_pre;
    private $php_pre_separation;
    private $php_end_separation;
    private $br_separation;

    public function __construct($wsdl, $root_dir, $class_pre)
    {
        $this->wsdl = $wsdl;
        $this->root_dir = $root_dir;
        $this->soap = new SoapClient ($wsdl);
        $this->class_pre = $class_pre;
        $this->php_pre_separation = "<?php ";
        $this->php_end_separation = "?>";
        $this->br_separation = "\n";
    }

    public function getFunctions()
    {
        return $this->soap->__getFunctions();
    }

    public function getTypes()
    {
        return $this->soap->__getTypes();
    }

    public function write_file($file_path, $content)
    {
        $handle = fopen($file_path, 'a');
        fwrite($handle, $content);
        fclose($handle);
    }

    public function create_construct_pre()
    {
        return "public function __construct(\$parmas){" . $this->br_separation;
    }

    public function create_construct_end()
    {
        return "}" . $this->br_separation;
    }

    public function create_base_class()
    {
        $types = $this->getTypes();
        if (sizeof($types) > 0) {
            foreach ($types as $type) {
                $type_array = split("\n", $type);
                $x_size = sizeof($type_array);
                if ($x_size > 0) {
                    $vars = array();
                    $class_content_string = "";
                    $class_name = "";
                    foreach ($type_array as $k_x => $x_value) {
                        if ($k_x == 0) {
                            //处理获取文件名
                            $class_name = str_ireplace(" {", "", $x_value);
                            $class_name = str_ireplace("struct ", "", $class_name);
                            $class_name = str_ireplace(" ", "", $class_name);
                            //生成初始字符串
                            if ($this->class_pre == "") {
                                $class_name = $class_name;
                            } else {
                                $class_name = $this->class_pre . "_" . $class_name;
                            }

                        } elseif ($k_x == ($x_size - 1)) {
                            //处理}没有任何操作

                        } else {
                            $body = str_ireplace(";", "", $x_value);
                            $body = $this->cut_first_letter($body, " ");
                            $body = $this->cut_end_letter($body, " ");
                            $var = split(" ", $body);
                            $vars [] = $var;
                        }
                    }
                    $class_content_string .= $this->php_pre_separation;
                    $class_content_string .= $this->br_separation;
                    $class_content_string .= "class " . $class_name . " { ";
                    $class_content_string .= $this->br_separation;
                    $content_var = "";
                    $content_fun = "";
                    if (sizeof($vars) > 0) {
                        foreach ($vars as $v) {
                            $content_var .= "public $" . $v [1] . "; " . $this->br_separation;
                        }
                        foreach ($vars as $v2) {
                            $content_fun .= "$" . "this->" . $v2 [1] . " = " . "$" . "parmas['" . $v2 [1] . "'];";
                            $content_fun .= $this->br_separation;
                        }
                    }
                    $class_content_string .= $content_var;
                    $class_content_string .= $this->create_construct_pre();
                    $class_content_string .= $content_fun;
                    $class_content_string .= $this->create_construct_end();
                    $class_content_string .= "}" . $this->br_separation;
                    $class_content_string .= $this->php_end_separation;
                    $class_file_name = $class_name . ".class.php";
                    $file_path = $this->root_dir . "/" . $class_file_name;
                    $this->write_file($file_path, $class_content_string);
                }

            }
        }
    }

    /**
     * 去除字符串前的特定字符
     */
    public function cut_first_letter($letters, $split)
    {
        $strlen = strlen($letters);
        $first_flag = false;
        $letters_cut_first = "";
        for ($i = 0; $i < $strlen; $i++) {
            if ($first_flag) {
                continue;
            }
            $current_letter = substr($letters, $i, 1);
            $next_i = ($i == $strlen - 1) ? $strlen - 1 : $i + 1;
            $next_letter = substr($letters, $next_i, 1);
            if ($current_letter != $split) {
                $first_flag = true;
                $letters_cut_first = $letters;
            }
            if ($current_letter == $split && $next_letter != $split) {
                $first_flag = true;
                $letters_cut_first = substr($letters, $next_i, $strlen - $i);
            }
        }
        return $letters_cut_first;
    }

    /**
     * 去除字符串尾部的指定字符
     */
    public function cut_end_letter($letters, $split)
    {
        $strlen = strlen($letters);
        $letters_cut_end = "";
        $end_flag = false;
        for ($j = $strlen; $j > 0; $j--) {
            if ($end_flag) {
                continue;
            }
            $end_letter = substr($letters, $j, 1);
            $end_letter_pre = substr($letters, $j - 1, 1);
            if ($end_letter != $split) {
                $end_flag = true;
                $letters_cut_end = $letters;
            }
            if ($end_letter == $split && $end_letter_pre != $split) {
                $end_flag = true;
                $letters_cut_end = substr($letters, 0, $j);
            }
        }
        return $letters_cut_end;
    }

}
